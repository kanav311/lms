<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use App\Lib\HelperTrait;
use App\Student;
use App\V2\Model\AssignmentSubmissionTable;
use App\V2\Model\AttendanceTable;
use App\V2\Model\TestGradeTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

use App\Country;
use App\EmailTemplate;
use App\Permission;
use App\PermissionGroup;
use App\Course;
use App\Setting;
use App\SmsTemplate;
use App\TemplateOption;
use App\Video;
use App\V2\Model\LessonTable;
use App\V2\Model\NewsflashTable;
use App\V2\Model\SessionTable;
use App\V2\Model\SettingTable;
use App\V2\Model\StudentSessionTable;
use App\V2\Model\WidgetTable;
use App\V2\Model\WidgetValueTable;
use Laminas\View\Model\ViewModel;
use App\V2\Model\ArticlesTable;
use Laminas\View\View;

class IndexController extends Controller
{
    use HelperTrait;

    public function index(Request $request){

        $output = [];
     //   $viewModel = app('Application\Controller\Catalog',['action'=>'sessions']);
        $viewModel = app(CatalogController::class)->sessions($request);
        $output['sessions'] = $viewModel->getData();
        $output['sessions']['paginator']->setItemCountPerPage(5);



        $viewModel = app(CatalogController::class)->courses($request);
        $output['courses'] = $viewModel->getData();
        $output['courses']['paginator']->setItemCountPerPage(5);



        $studentId = $this->getId();

        $viewModel = app(StudentController::class)->mysessions($request);
        $output['mysessions'] = $viewModel->getData();
        $output['mysessions']['paginator']->setItemCountPerPage(3);



        $viewModel = app(StudentController::class)->notes($request);
        $output['notes'] = $viewModel->getData();
        $output['notes']['paginator']->setItemCountPerPage(5);


        $viewModel = app(DownloadController::class)->index($request);
        $output['downloads'] = $viewModel->getData();
        $output['downloads']['paginator']->setItemCountPerPage(5);



        $viewModel = app(StudentController::class)->discussion($request);
        $output['discussions'] = $viewModel->getData();
        $output['discussions']['paginator']->setItemCountPerPage(5);



        $viewModel = app(AssignmentController::class)->index($request);
        $output['homework'] = $viewModel->getData();
        $output['homework']['paginator']->setItemCountPerPage(100);



        $totalHomework= $output['homework']['total'];
        $submissionTable = new AssignmentSubmissionTable();
        $output['homeworkPresent'] = false;
        if(!empty($totalHomework)){
            foreach ($output['homework']['paginator'] as $row){
                if(!$submissionTable->hasSubmission($this->getId(),$row->assignment_id)){
                    $output['homeworkPresent'] = true;
                }
            }

        }
        $output['controller'] = $this;
        $output['student'] = Student::find($studentId);
        $output['gradeTable'] = new TestGradeTable();

        $viewModel = app(StudentController::class)->certificates($request);
        $output['certificate'] = $viewModel->getData();
        $output['certificate']['paginator']->setItemCountPerPage(7);

        //create forum topics
        $studentSessionTable = new StudentSessionTable();
        $forumTopics = $studentSessionTable->getForumTopics(true,$this->getId());
        $forumTopics->setItemCountPerPage(10);



        $output['forumTopics'] = $forumTopics;

        $output['pageTitle'] = __('Dashboard');

        return view('student.index.index',$output);
    }

    public function getStudentProgress($sessionId){

        $attendanceTable = new AttendanceTable();

        $session = Course::find($sessionId);
        $totalLessons = $session->lessons()->count();


        $totalAttended  = $attendanceTable->getTotalDistinctForStudentInSession($this->getId(),$sessionId);

        if($totalLessons==0){
            $totalLessons = 1;
        }
        //calculate percentage
        $percentage = ($totalAttended/$totalLessons) * 100;
        $percentage = round($percentage);
        return $percentage;

    }

}
