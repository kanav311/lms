<?php

namespace App\Http\Controllers\Site;

use App\Course;
use App\CourseCategory;
use App\Http\Controllers\Controller;
use App\Lib\HelperTrait;
use App\V2\Form\DiscussionForm;
use App\V2\Model\DownloadFileTable;
use App\V2\Model\DownloadSessionTable;
use App\V2\Model\LectureTable;
use App\V2\Model\SessionCategoryTable;
use App\V2\Model\SessionInstructorTable;
use App\V2\Model\SessionLessonAccountTable;
use App\V2\Model\SessionLessonTable;
use App\V2\Model\SessionTable;
use App\V2\Model\SessionTestTable;
use App\V2\Model\StudentLectureTable;
use App\V2\Model\StudentSessionLogTable;
use App\V2\Model\StudentSessionTable;
use App\V2\Model\StudentTestTable;
use App\V2\Model\TestQuestionTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laminas\Form\Element\Select;
use Laminas\Form\Element\Text;

class CatalogController extends Controller
{
    use HelperTrait;
    /**
     * For browsing courses
     */
    public function courses(Request $request){

        $table = new SessionTable();
        $studentSessionTable = new StudentSessionTable();
        $sessionCategoryTable = new SessionCategoryTable();


        $filter = request()->get('filter', null);


        if (empty($filter)) {
            $filter=null;
        }

        $group = request()->get('group', null);
        if (empty($group)) {
            $group=null;
        }

        $sort = request()->get('sort', null);
        if (empty($sort)) {
            $sort=null;
        }



        $text = new Text('filter');
        $text->setAttribute('class','form-control');
        $text->setAttribute('placeholder',__lang('Search'));
        $text->setValue($filter);


        $sortSelect = new Select('sort');
        $sortSelect->setAttribute('class','form-control');
        //$sortSelect->setAttribute('style','max-width:100px');

        $valueOptions = [
            'recent'=>__lang('Recently Added'),
            'asc'=>__lang('Alphabetical (Ascending)'),
            'desc'=>__lang('Alphabetical (Descending)'),
            'date'=>__lang('Start Date'),
        ];

        if($this->getSetting('general_show_fee')==1){
            $valueOptions['priceAsc'] = __lang('Price (Lowest to Highest)');
            $valueOptions['priceDesc'] = __lang('Price (Highest to Lowest)');
        }

        $sortSelect->setValueOptions($valueOptions);
        $sortSelect->setEmptyOption('--'.__lang('Sort').'--');
        $sortSelect->setValue($sort);


        $groupTable = new SessionCategoryTable();


        $paginator = $table->getPaginatedCourseRecords(true,null,true,$filter,$group,$sort,'c');




        $paginator->setCurrentPageNumber((int)request()->get('page', 1));
        $paginator->setItemCountPerPage(30);

        //$categories = $sessionCategoryTable->getLimitedRecords(100);
        $categories = CourseCategory::whereNull('parent_id')->orderBy('sort_order')->where('enabled',1)->limit(100)->get();

        $pageTitle = __lang('Online Courses');
        $parent = null;
        if(!empty($group)){
            $categoryRow = $sessionCategoryTable->getRecord($group);
            $pageTitle .=': '.$categoryRow->name;
            $description = $categoryRow->description;
            //get sub categories
            $subCategories = CourseCategory::where('parent_id',$group)->orderBy('sort_order')->where('enabled',1)->get();
            if ($subCategories->count() ==0){
                $subCategories = null;
            }

            if(!empty($categoryRow->parent_id)){
                $parent = $sessionCategoryTable->getRecord($categoryRow->parent_id);
            }
        }
        else{
            $description = '';
            $subCategories = null;
        }



        $output = array(
            'paginator'=>$paginator,
            'pageTitle'=>$pageTitle,
            'studentSessionTable'=>$studentSessionTable,
            'filter'=>$filter,
            'group'=>$group,
            'text'=>$text,
            'sortSelect'=>$sortSelect,
            'sort'=>$sort,
            'categories'=>$categories,
            'description'=>$description,
            'subCategories'=>$subCategories,
            'parent'=>$parent
        );

        if(isStudent()){
            return view('site.catalog.courses',$output);
        }

        if(frontendEnabled()){
            return tview('site.catalog.courses',$output);
        }
        else{
            return redirect('/home');
        }

    }

    public function sessions(Request $request){
        $table = new SessionTable();
        $studentSessionTable = new StudentSessionTable();
        $filter = request()->get('filter', null);
        if (empty($filter)) {
            $filter=null;
        }
        $group = request()->get('group', null);
        if (empty($group)) {
            $group=null;
        }
        $sort = request()->get('sort', null);
        if (empty($sort)) {
            $sort=null;
        }



        $text = new Text('filter');
        $text->setAttribute('class','form-control');
        $text->setAttribute('placeholder','Search');
        $text->setValue($filter);


        $sortSelect = new Select('sort');
        $sortSelect->setAttribute('class','form-control');
        //$sortSelect->setAttribute('style','max-width:100px');

        $valueOptions = [
            'recent'=>__lang('Recently Added'),
            'asc'=>__lang('Alphabetical (Ascending)'),
            'desc'=>__lang('Alphabetical (Descending)'),
            'date'=>__lang('Start Date'),
        ];

        if($this->getSetting('general_show_fee')==1){
            $valueOptions['priceAsc'] = __lang('Price (Lowest to Highest)');
            $valueOptions['priceDesc'] = __lang('Price (Highest to Lowest)');
        }

        $sortSelect->setValueOptions($valueOptions);
        $sortSelect->setEmptyOption('--'.__lang('Sort').'--');
        $sortSelect->setValue($sort);


        $groupTable = new SessionCategoryTable();
        $groupRowset = $groupTable->getLimitedRecords(100);


        $paginator = $table->getPaginatedRecords(true,null,true,$filter,$group,$sort,['s','b'],true);




        $paginator->setCurrentPageNumber((int)request()->get('page', 1));
        $paginator->setItemCountPerPage(30);




        $output = array(
            'paginator'=>$paginator,
            'pageTitle'=>__lang('Upcoming Sessions'),
            'studentSessionTable'=>$studentSessionTable,
            'filter'=>$filter,
            'group'=>$group,
            'text'=>$text,
            'sortSelect'=>$sortSelect,
            'sort'=>$sort,
        );



        if(isStudent()){
            return view('site.catalog.sessions',$output);
        }

        if(frontendEnabled()){
            return tview('site.catalog.sessions',$output);
        }
        else{
            return redirect('/home');
        }

    }



    public function course(Request $request,Course $course){



        $sessionTable = new SessionTable();
        $sessionLessonTable = new SessionLessonTable();
        $sessionLessonAccountTable = new SessionLessonAccountTable();
        $studentSessionTable = new StudentSessionTable();
        $sessionInstructorTable = new SessionInstructorTable();
        $studentLectureTable = new StudentLectureTable();
        $logTable = new StudentSessionLogTable();
        $enrolled = false;
        $resumeLink = null;


         $id = $course->id;
        $downloadSessionTable = new DownloadSessionTable();

        $row = $sessionTable->getRecord($id);
        $rowset = $sessionLessonTable->getSessionRecords($id);


        //ensure it is an online course


        //get instructors
        $instructors = $sessionInstructorTable->getSessionRecords($id);

        //get downloads
        $downloads = $downloadSessionTable->getSessionRecords($id);

        //check if student has started course
        //get session tests
        $sessionTestTable  = new SessionTestTable();
        $tests = $sessionTestTable->getSessionRecords($id);

        $output = ['rowset'=>$rowset,'row'=>$row,'pageTitle'=>__lang('Course Details'),'table'=>$sessionLessonAccountTable,'id'=>$id,

            'studentSessionTable'=>$studentSessionTable,
            'instructors' => $instructors,
            'downloads'=>$downloads,
            'fileTable'=> new DownloadFileTable(),
            'enrolled'=>$enrolled,
            'tests'=>$tests,
            'questionTable'=>new TestQuestionTable(),
            'studentTest'=> new StudentTestTable(),
            'totalClasses'=> $sessionLessonTable->getSessionRecords($id)->count(),
            'course'=>$course
        ];


        if($course->type=='c'){
            $view = tview('site.catalog.course',$output);
        }
       else{
           $view = tview('site.catalog.session',$output);
       }




        if(isStudent()){
            if($course->type=='c'){
                $view = view('site.catalog.course',$output);
            }
            else{
                $view = view('site.catalog.session',$output);
            }
            return $view;
        }

        if(frontendEnabled()){
            return $view;
        }
        else{
            return redirect('/home');
        }


    }


}
