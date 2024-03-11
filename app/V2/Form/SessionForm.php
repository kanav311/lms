<?php

namespace App\V2\Form;

use App\V2\Model\AccountsTable;
use App\V2\Model\LessonTable;
use App\Lib\BaseForm;
use Laminas\Form\Form;

class SessionForm extends BaseForm {
    public function __construct($name = null,$serviceLocator,$type=null)
    {
        // we want to ignore the name passed
        parent::__construct('user');
        $this->setAttribute('method', 'post');



        $this->add(array(
            'name'=>'session_name',
            'attributes' => array(
                'type'=>'text',
                'class'=>'form-control',
                'required'=>'required',
            ),
            'options'=>array('label'=>__lang('Session Name')),
        ));

        $this->add(array(
            'name'=>'session_date',
            'attributes' => array(
                'type'=>'text',
                'class'=>'form-control date',
            ),
            'options'=>array('label'=>__lang('Session Date')),
        ));

        $this->add(array(
            'name'=>'session_end_date',
            'attributes' => array(
                'type'=>'text',
                'class'=>'form-control date',
            ),
            'options'=>array('label'=>__lang('Session End Date')),
        ));

        $this->createSelect('payment_required','Payment Required',['0'=>__lang('No'),'1'=>__lang('Yes')],true,false);
        $this->createText('amount','Session Fee',false,'form-control digit',null,__lang('digits-only-optional'));
        $this->createSelect('session_status','Status',array('0'=>__lang('Disabled'),'1'=>__lang('Enabled')),true,false);
        $this->createTextArea('short_description','Short Description');
        $this->get('short_description')->setAttribute('maxlength',300);
        $this->add(array(
            'name'=>'enrollment_closes',
            'attributes' => array(
                'type'=>'text',
                'class'=>'form-control date',
            ),
            'options'=>array('label'=>__lang('Enrollment Closes')),
        ));


        $this->createTextArea('description','Description');
        $this->get('description')->setAttribute('id','description');
        $this->createTextArea('venue','Venue');


        $this->add(array(
            'name'=>'picture',
            'attributes' => array(
                'type'=>'hidden',
                'class'=>'form-control ',
                'required'=>'required',
                'id'=>'image'
            ),
            'options'=>array('label'=>__lang('Picture')),
        ));

        $accountsTable = new AccountsTable($serviceLocator);
        $rowset = $accountsTable->getRecordsSorted();
        $options = [];
        foreach($rowset as $row){
            $options[$row->id]= $row->user_name.' ('.$row->email.')';
        }

        $this->createSelect('session_instructor_id[]','Course Instructors (Optional)',$options,false);
        $this->get('session_instructor_id[]')->setAttribute('multiple','multiple');
        $this->get('session_instructor_id[]')->setAttribute('class','form-control select2');
        $this->createSelect('enable_forum','Enable Forum',['1'=>__lang('Yes'),'0'=>__lang('No')],true,false);
        $this->createSelect('enable_discussion','Enable Discussions',['1'=>__lang('Yes'),'0'=>__lang('No')],true,false);
        $this->createText('capacity',__lang('capacity'),false,'form-control digit',null,__lang('digits-only-optional'));
        $this->createSelect('enforce_capacity','Enforce Capacity',['0'=>__lang('No'),'1'=>__lang('Yes')],true,false);

    }

}

?>
