<?php $__env->startSection('page-title',''); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            route('admin.certificate.index')=>__lang('certificates'),
            '#'=>__lang('edit')
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <form class="form-horizontal" id="editform" method="post" action="<?php echo e(adminUrl(['controller'=>'certificate','action'=>'edit','id'=>$row->id])); ?>">
<?php echo csrf_field(); ?>
<div class="card"   ng-app="myApp" ng-controller="myCtrl" >
    <div class="card-header">

        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> <?php echo e(__lang('save')); ?> </button>
    </div>
    <div class="card-body">

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo e(__lang('design')); ?></a></li>
            <li  class="nav-item"><a  class="nav-link" href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php echo e(__lang('details')); ?></a></li>
            <li  class="nav-item"><a class="nav-link" href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><?php echo e(__lang('mandatory-classes')); ?></a></li>
            <li  class="nav-item"><a class="nav-link" href="#tests" aria-controls="tests" role="tab" data-toggle="tab"><?php echo e(__lang('mandatory-tests')); ?></a></li>
         <li  class="nav-item"><a class="nav-link" href="#assignments" aria-controls="assignments" role="tab" data-toggle="tab"><?php echo e(__lang('mandatory-homework')); ?></a></li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                   <i class="fa fa-cogs"></i>  <?php echo e(__lang('Options')); ?>

                </a>

                <a onclick="return confirm('<?php echo e(__lang('certificate-reset-warning')); ?>')" class="btn btn-primary float-right" href="<?php echo e(adminUrl(['controller'=>'certificate','action'=>'reset','id'=>$id])); ?>"><i class="fa fa-redo"></i> <?php echo e(__lang('reset')); ?></a>
                <div class="collapse" id="collapseExample">
                    <div class="well">
                        <?php $elements = [
                            'student_name','session_name','session_start_date','session_end_date','date_generated','company_name','certificate_number'
                        ];  ?>

                        <div class="row">
                            <?php foreach($elements as $element): ?>
                                <div class="col-md-2">
                                    <input class="item_control" checked type="checkbox" id="control_<?php echo e($element); ?>" data-target="box_<?php echo e($element); ?>" value="<?php echo e($element); ?>" name="control_<?php echo e($element); ?>"/> <?php echo e(ucfirst(str_replace('_',' ',$element))); ?>

                                </div>

                            <?php endforeach;  ?>
                        </div>

                        <br/>
                        <br/>


                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                            <i class="fa fa-calendar"></i> <?php echo e(__lang('class-attendance-dates')); ?>

                        </button>
                        <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                            <i class="fa fa-user"></i> <?php echo e(__lang('custom-student-fields')); ?>

                        </button>
                        <div class="collapse mt-1" id="collapseExample1">
                            <div class="well bg-light p-2">
                                <small><?php echo e(__lang('class-attendance-dates')); ?></small>
                                <div class="row">
                                    <?php foreach($lessons as $lessonRow):  ?>
                                        <div class="col-md-3">
                                            <input class="item_control" checked type="checkbox" id="control_class_date_<?php echo e($lessonRow->lesson_id.'_'.strtoupper(safeUrl($lessonRow->name))); ?>" data-target="box_class_date_<?php echo e($lessonRow->lesson_id.'_'.strtoupper(safeUrl($lessonRow->name))); ?>" value="class_date_<?php echo e($lessonRow->lesson_id.'_'.strtoupper(safeUrl($lessonRow->name))); ?>" name="control_class_date_<?php echo e($lessonRow->lesson_id.'_'.strtoupper(safeUrl($lessonRow->name))); ?>"/>
                                            <label for="control_class_date_<?php echo e($lessonRow->lesson_id.'_'.strtoupper(safeUrl($lessonRow->name))); ?>"><?php echo e($lessonRow->name); ?></label>

                                        </div>
                                    <?php endforeach;  ?>
                                </div>
                            </div>
                        </div>

                        <div class="collapse mt-1" id="collapseExample2">
                            <div class="well bg-light p-2">
                                <small><?php echo e(__lang('custom-student-fields')); ?></small>
                                <div class="row">
                                    <?php foreach($studentFields as $field):  ?>
                                    <div class="col-md-3">
                                        <input class="item_control" checked type="checkbox" id="control_student_field_<?php echo e($field->id.'_'.strtoupper(safeUrl($field->name))); ?>" data-target="box_student_field_<?php echo e($field->id.'_'.strtoupper(safeUrl($field->name))); ?>" value="student_field_<?php echo e($field->id.'_'.strtoupper(safeUrl($field->name))); ?>" name="control_student_field_<?php echo e($field->id.'_'.strtoupper(safeUrl($field->name))); ?>"/>
                                        <label  for="control_student_field_<?php echo e($field->id.'_'.strtoupper(safeUrl($field->name))); ?>"><?php echo e($field->name); ?></label>

                                    </div>
                                    <?php endforeach;  ?>
                                </div>
                            </div>
                        </div>




                        <div >
                            <hr/>
                            <h4 class="ml-3"><?php echo e(__lang('set-font-size')); ?></h4>

                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <select class="form-control" name="element_selector" id="element_selector">
                                        <option value=""><?php echo e(__lang('select-an-element')); ?></option>
                                        <?php foreach($elements as $element): ?>
                                            <option value="<?php echo e($element); ?>"><?php echo e(ucfirst(str_replace('_',' ',$element))); ?></option>
                                        <?php endforeach;  ?>
                                        <?php foreach($lessons as $lessonRow):  ?>
                                            <option value="class_date_<?php echo e($lessonRow->lesson_id.'_'.strtoupper(safeUrl($lessonRow->name))); ?>"><?php echo e(__lang('class-date')); ?>: <?php echo e($lessonRow->lesson_id.' - '.$lessonRow->name); ?></option>
                                        <?php endforeach;  ?>
                                        <?php foreach($studentFields as $field):  ?>
                                        <option value="student_field_<?php echo e($field->id.'_'.strtoupper(safeUrl($field->name))); ?>"><?php echo e(__lang('student-field')); ?>: <?php echo e($field->id.' - '.$field->name); ?></option>
                                        <?php endforeach;  ?>

                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input value="14" placeholder="e.g. 14" type="number" name="font_size" id="font_size" class="form-control number"/>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>

               <div id="canvas_wrapper" style="overflow: auto">
                   <?php if(empty($row->html)):  ?>
                   <div id="canvas" style=" font-size: 14px; margin:0px auto; position: relative; width: <?php echo e($width); ?>px; height: <?php echo e($height); ?>px; overflow: hidden " >
                       <div class="canvas_item" id="box_student_name" style=" position: absolute; top: 20px; left: 20px; width: 20px; height: 20px; white-space: nowrap;" >
                           [STUDENT_NAME]
                       </div>

                       <div class="canvas_item" id="box_session_name" style=" position: absolute; top: 50px; left: 20px; width: 20px; height: 20px; white-space: nowrap;" >
                           [SESSION_NAME]
                       </div>

                       <div class="canvas_item" id="box_session_start_date" style=" position: absolute; top: 80px; left: 20px; width: 20px; height: 20px; white-space: nowrap;" >
                           [SESSION_START_DATE]
                       </div>

                       <div class="canvas_item" id="box_session_end_date" style=" position: absolute; top: 110px; left: 20px; width: 20px; height: 20px; white-space: nowrap;" >
                           [SESSION_END_DATE]
                       </div>

                       <div class="canvas_item" id="box_date_generated" style=" position: absolute; top: 140px; left: 20px; width: 20px; height: 20px; white-space: nowrap;" >
                           [DATE_GENERATED]
                       </div>

                       <div class="canvas_item" id="box_company_name" style=" position: absolute; top: 170px; left: 20px; width: 20px; height: 20px; white-space: nowrap;" >
                           [COMPANY_NAME]
                       </div>

                       <div class="canvas_item" id="box_certificate_number" style=" position: absolute; top: 200px; left: 20px; width: 20px; height: 20px; white-space: nowrap;" >
                           [CERTIFICATE_NUMBER]
                       </div>

                       <?php $count= 230; foreach($lessons as $lessonRow):  ?>
                           <div  class="canvas_item" id="box_class_date_<?php echo e($lessonRow->lesson_id.'_'.strtoupper(safeUrl($lessonRow->name))); ?>" style="display:none; position: absolute; top: <?php echo e($count); ?>px; left: 20px; width: 20px; height: 20px; white-space: nowrap;" >
                               [CLASS_DATE_<?php echo e($lessonRow->lesson_id.'_'.strtoupper(safeUrl($lessonRow->name))); ?>]
                           </div>
                           <?php $count = $count + 30;  ?>
                       <?php endforeach;  ?>

                       <?php
                          $count = 20;
                       ?>

                       <?php foreach($studentFields as $field):  ?>
                       <div  class="canvas_item" id="box_student_field_<?php echo e($field->id.'_'.strtoupper(safeUrl($field->name))); ?>" style="display:none; position: absolute; top: <?php echo e($count); ?>px; left: 350px; width: 20px; height: 20px; white-space: nowrap;" >
                           [STUDENT_FIELD_<?php echo e($field->id.'_'.strtoupper(safeUrl($field->name))); ?>]
                       </div>
                       <?php $count = $count + 30;  ?>
                       <?php endforeach;  ?>


                       <img src="<?php echo e($siteUrl); ?>/<?php echo e($row->image); ?>" style="width: 100%; height: 100%" alt=""/>


                   </div>
                   <?php else:  ?>
                   <?php echo $row->html; ?>

                   <?php endif;  ?>
               </div>
                <?php echo e(formElement($form->get('html'))); ?>

            </div>
            <div role="tabpanel" class="tab-pane" id="profile">


                <div class="card-body">

                    <div class="form-group">
                        <?php echo e(formLabel($form->get('name'))); ?>

                        <?php echo e(formElement($form->get('name'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('name'))); ?></p>

                    </div>

                    <div class="form-group">
                        <?php echo e(formLabel($form->get('course_id'))); ?>

                        <div>
                        <?php echo e(formElement($form->get('course_id'))); ?>   </div>
                        <div>
                        <p class="help-block"><?php echo e(formElementErrors($form->get('course_id'))); ?></p>
                        <p class="help-block"><?php echo e(__lang('certificate-warning')); ?></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php echo e(formLabel($form->get('description'))); ?>

                        <?php echo e(formElement($form->get('description'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('description'))); ?></p>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(formLabel($form->get('enabled'))); ?>

                                <?php echo e(formElement($form->get('enabled'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('enabled'))); ?></p>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(formLabel($form->get('orientation'))); ?>

                                <?php echo e(formElement($form->get('orientation'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('orientation'))); ?></p>
                                <p class="help-block"><?php echo e(__lang('certificate-orientation-warning')); ?></p>
                            </div>


                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(formLabel($form->get('max_downloads'))); ?>

                                <?php echo e(formElement($form->get('max_downloads'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('max_downloads'))); ?></p>
                                <p class="help-block"><?php echo e(__lang('max-download-help')); ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom:10px">

                                <label for="image" class="control-label"><?php echo e(__lang('certificate-image')); ?>(A4 <?php echo e(__lang('size')); ?> - 595 <?php echo e(__lang('pixels')); ?> x 842 <?php echo e(__lang('pixels')); ?>)</label><br />


                                <div class="image"><img data-name="image" src="<?php echo e($display_image); ?>" alt="" id="thumb" /><br />
                                    <?php echo e(formElement($form->get('image'))); ?>

                                    <a class="pointer" onclick="image_upload('image', 'thumb');"><?php echo e(__lang('browse')); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="pointer" onclick="$('#thumb').attr('src', '<?php echo e($no_image); ?>'); $('#image').attr('value', '');"><?php echo e(__lang('clear')); ?></a></div>

                            </div>

                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(formLabel($form->get('payment_required'))); ?>

                                <?php echo e(formElement($form->get('payment_required'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('payment_required'))); ?></p>

                            </div>
                        </div>
                        <div class="col-md-6" id="priceBox" style="display: none">
                            <div class="form-group">
                                <?php echo e(formLabel($form->get('price'))); ?>

                                <?php echo e(formElement($form->get('price'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('price'))); ?></p>

                            </div>


                        </div>
                    </div>


                </div>

            </div>
            <div role="tabpanel" class="tab-pane" id="messages">

                <div id="classlist" class="option classes">
                    <?php foreach($form->getElements() as $element):  ?>
                        <?php if(preg_match('#lesson_#',$element->getName())): ?>
                        <div  class="form-group" >
                            <input type="checkbox" value="<?php echo e($element->getCheckedValue()); ?>" name="<?php echo e($element->getName()); ?>" <?php if(old($element->getName(),$certificate->lessons()->where('id',$element->getCheckedValue())->first())): ?> checked <?php endif; ?>> <?php echo e($element->getLabel()); ?>


                        </div>
                         <?php endif;  ?>
                    <?php endforeach;  ?>

                </div>
                <hr/>
                <div  class="form-group" style="padding-bottom: 10px">
                    <input type="hidden" name="any_session" value="0" />
                    <input type="checkbox" name="any_session" value="1" <?php if(old('any_session',$certificate->any_session)==1): ?> checked <?php endif; ?>>
                      <?php echo e($form->get('any_session')->getLabel()); ?>

                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="tests">
                <div class="section-title mt-0"><?php echo e(__lang('selected-test')); ?></div>

                <div style="max-height: 500px; height: auto">
                <table class="table-stripped table">
                    <thead>
                    <tr>
                        <th><?php echo e(__lang('test')); ?></th>
                        <th><?php echo e(__lang('passmark')); ?></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr ng-repeat="test in tests">
                        <td>{{ test.name }}</td>
                        <td>{{test.passmark}}%</td>
                        <td><button ng-click="deleteTest(test)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            <input type="hidden" name="test_{{ test.test_id }}" value="{{test.test_id}}"/></td>
                    </tr>
                    </tbody>
                </table>
                </div>
                <div class="section-title mt-0"><?php echo e(__lang('add-tests')); ?></div>

                <table id="datatable" class="table table-stripped">
                    <thead>
                    <tr>

                        <th> <?php echo e(__lang('test')); ?></th>
                        <th  class="no-sort"><?php echo e(__lang('created-on')); ?></th>
                        <th  class="no-sort"><?php echo e(__lang('passmark')); ?></th>
                        <th  class="no-sort"><?php echo e(__lang('enabled')); ?></th>
                        <th  class="no-sort"> </th>
                    </tr>
                    </thead>
                    <tbody id="classes">
                    <?php foreach($allTests as $row):  ?>
                        <tr>

                            <td><?php echo e($row->name); ?> </td>
                            <td><?php echo e(showDate('d/M/Y',$row->created_at)); ?></td>
                            <td><?php echo e($row->passmark); ?>%</td>
                            <td><?php echo e(boolToString($row->enabled)); ?></td>
                            <td><button type="button" ng-click="addTest({test_id:'<?php echo e($row->id); ?>',name:'<?php echo e($row->name); ?>',passmark:'<?php echo e($row->passmark); ?>'})" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo e(__lang('add')); ?></button></td>
                        </tr>
                    <?php endforeach;  ?>
                    </tbody>

                </table>


            </div>
<div role="tabpanel" class="tab-pane" id="assignments">
    <div class="section-title mt-0"><?php echo e(__lang('selected-homework')); ?></div>

                <div style="max-height: 500px; height: auto">
                <table class="table-stripped table">
                    <thead>
                    <tr>
                        <th><?php echo e(__lang('homework')); ?></th>
                        <th><?php echo e(__lang('passmark')); ?></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    <tr ng-repeat="assignment in assignments">
                        <td>{{ assignment.name }}</td>
                        <td>{{assignment.passmark}}%</td>
                        <td><button type="button" ng-click="deleteAssignment(assignment)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            <input type="hidden" name="assignment_{{ assignment.assignment_id }}" value="{{assignment.assignment_id}}"/></td>
                    </tr>
                    
                    </tbody>
                </table>
                </div>
    <div class="section-title mt-0"><?php echo e(__lang('add-homework')); ?></div>

                <table id="datatable" class="table table-stripped">
                    <thead>
                    <tr>

                        <th> <?php echo e(__lang('homework')); ?></th>
                        <th  class="no-sort"><?php echo e(__lang('created-on')); ?></th>
                        <th  class="no-sort"><?php echo e(__lang('passmark')); ?></th>
                        <th  class="no-sort"> </th>
                    </tr>
                    </thead>
                    <tbody id="classes">
                    <?php foreach($allAssignments as $row):  ?>
                        <tr>

                            <td><?php echo e($row->title); ?> </td>
                            <td><?php echo e(showDate('d/M/Y',$row->created_at)); ?></td>
                            <td><?php echo e($row->passmark); ?>%</td>
                            <td><button type="button" ng-click="addAssignment({assignment_id:'<?php echo e($row->id); ?>',name:'<?php echo e(addslashes($row->title)); ?>',passmark:'<?php echo e($row->passmark); ?>'})" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo e(__lang('add')); ?></button></td>
                        </tr>
                    <?php endforeach;  ?>
                    </tbody>

                </table>


            </div>
        </div>

    </div>
</div>

</form>

<script type="text/javascript">
    $(function(){
        $( ".canvas_item" ).draggable({
            containment: "parent"
        });
    });
</script>
<style>
    .canvas_item{
        cursor: move;
    }
</style>



<?php $__env->stopSection(); ?>



<?php $__env->startSection('footer'); ?>
    <script type="text/javascript" src="<?php echo e(asset('client/vendor/ckeditor/ckeditor.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('client/js/angular.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('client/app/certificate.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('client/vendor/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>

    <script type="text/javascript">

        CKEDITOR.replace('hcontent', {
            filebrowserBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager',
            filebrowserImageBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager',
            filebrowserFlashBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager'
        });
        $(function(){
            $('#payment_required').change(function(val){
                console.log($(this).val());
                if($(this).val()==1){
                    console.log('showing box');
                    $('#priceBox').show();
                }
                else{
                    $('#priceBox').hide();
                }
            });
            $('#payment_required').trigger('change');
        });
    </script>
    <script type="text/javascript"><!--
        function image_upload(field, thumb) {
            $('#dialog').remove();

            $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="<?php echo e(basePath()); ?>/admin/filemanager?&token=true&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

            $('#dialog').dialog({
                title: '<?php echo e(addslashes(__lang('Image Manager'))); ?>',
                close: function (event, ui) {
                    if ($('#' + field).attr('value')) {
                        $.ajax({
                            url: '<?php echo e(basePath()); ?>/admin/filemanager/image?&image=' + encodeURIComponent($('#' + field).val()),
                            dataType: 'text',
                            success: function(data) {
                                $('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
                            }
                        });
                    }
                },
                bgiframe: false,
                width: 800,
                height: 570,
                resizable: true,
                modal: false,
                position: "center"
            });
        };

        $('select[name=course_id]').change(function(){
            $('#classlist').text('Loading...');
            $('#classlist').load('<?php echo e(basePath()); ?>/admin/certificate/loadclasses/'+$(this).val());
        });

        $('#editform').submit(function(e){
            e.preventDefault();
            var html = $('#canvas_wrapper').html();

            // console.log(html);
            // return false;
            $('#html').val(html);
            $(this).unbind('submit');
            $(this).submit();
        });

        $('#font_size').change(function(){
            console.log('buttoncliced');
            //get the selected element
            var element =  $('#element_selector').val();
            var size= $('#font_size').val();
            if(element.length==0 || size.length==0){
                alert('Please select an element and enter a font size');
            }
            else{
                $('#box_'+element).css('font-size',size+'px');
                console.log('size set');
            }

        });
        $('#element_selector').change(function(){
            var val= $(this).val();
            if(val.length>0){
                var size = $('#box_'+val).css('font-size');
                size = parseInt(size);
                if(size < 1 ){
                    size =14;
                }
                $('#font_size').val(parseInt(size));
            }
        });

        $('.item_control').click(function(){
            console.log($(this).attr('data-target'));
            $('#'+$(this).attr('data-target')).toggle(this.checked);
        });

        $('.canvas_item').each(function(){
            var isVisible = $(this).is(':visible');
            $('input[data-target='+$(this).attr('id')+']').prop('checked',isVisible);

        })

        //set orientation based on selection
        $('select[name=orientation]').change(function(){
            var val = $(this).val();
            var width,height;
            if(val=='p'){
                width= 595;
                height= 842;
            }
            else{
                height= 595;
                width= 842;
            }
            $('#canvas').css('width',width+'px');
            $('#height').css('height',height+'px');
        });

        var table;
        var dtOptions = {

            "ordering": true,
            columnDefs: [{
                orderable: false,
                targets: "no-sort"
            }]

        };

        table = $('#datatable').DataTable(dtOptions);
        //--></script>
    <script type="text/javascript">
        var app = angular.module('myApp', []);
        app.controller('myCtrl', function($scope,$http) {
            $http.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';

            $scope.tests = {
            <?php foreach($tests as $row): ?>
            <?php echo e($row->test_id); ?>: {test_id:'<?php echo e($row->test_id); ?>',name:'<?php echo e($row->name); ?>',passmark:'<?php echo e($row->passmark); ?>'},
            <?php endforeach;  ?>
        };



            $scope.addTest = function(test){
                $scope.tests[test.test_id]=test;
            }

            $scope.deleteTest = function(test){
                delete  $scope.tests[test.test_id];
            }


            $scope.assignments = {
            <?php foreach($assignments as $row): ?>
            <?php echo e($row->assignment_id); ?>: {assignment_id:'<?php echo e($row->assignment_id); ?>',name:'<?php echo e($row->title); ?>',passmark:'<?php echo e($row->passmark); ?>'},
            <?php endforeach;  ?>
        };



            $scope.addAssignment = function(assignment){
                $scope.assignments[assignment.assignment_id]=assignment;
            }

            $scope.deleteAssignment = function(assignment){
                console.log($scope.assignments);
                delete  $scope.assignments[assignment.assignment_id];
                return false;
            }

        });

    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/admin/certificate/edit.blade.php ENDPATH**/ ?>