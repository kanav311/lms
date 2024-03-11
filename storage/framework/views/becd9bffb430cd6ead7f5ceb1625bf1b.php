<?php $__env->startSection('pageTitle',$row->name); ?>
<?php $__env->startSection('innerTitle',$row->name); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('student.dashboard')=>__lang('dashboard'),
            route('student.student.mysessions')=>__lang('my-courses'),
            '#'=>$pageTitle
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row mb-4">
    <div class="col-md-4  mb-2">
        <?php if(!empty($row->picture)): ?>
            <img class="rounded img-responsive" src="<?php echo e(resizeImage($row->picture,400,300,url('/'))); ?>" >
        <?php else: ?>
            <img class="rounded img-responsive"  src="<?php echo e(asset('img/course.png')); ?>" >
        <?php endif; ?>

    </div>
    <div class="col-md-8">
        <div class="card course-info profile-widget mt-0">
            <div class="profile-widget-header">
                <div class="profile-widget-items">
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label"><?php echo e(__lang('cost')); ?></div>
                        <div class="profile-widget-item-value">
                            <?php if(empty($row->payment_required)): ?>
                                <?php echo e(__lang('free')); ?>

                            <?php else: ?>
                                <?php echo e(price($row->fee)); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label"><?php echo e(__lang('classes')); ?></div>
                        <div class="profile-widget-item-value"><?php echo e($totalClasses); ?></div>
                    </div>
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label"><?php echo e(__lang('type')); ?></div>
                        <div class="profile-widget-item-value">
                            <?php
                                switch($row->type){
                                    case 'b':
                                        echo __lang('training-online');
                                        break;
                                    case 's':
                                        echo __lang('training-session');
                                        break;
                                    case 'c':
                                        echo __lang('online-course');
                                        break;
                                }
                            ?>
                        </div>
                    </div>
                    <?php if($studentCourse): ?>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label"><?php echo e(__lang('enrollment-code')); ?></div>
                            <div class="profile-widget-item-value"><?php echo e($studentCourse->reg_code); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="profile-widget-description"> <?php echo clean($row->short_description); ?>

            </div>
            <div class="card-footer text-center">


                    <a class="btn btn-primary mb-2  btn-lg" href="<?php echo e($resumeLink); ?>"><i class="fa fa-play-circle"></i> <?php echo e(__lang('Resume Course')); ?></a> &nbsp;&nbsp; <?php echo e(__lang('or')); ?>  &nbsp;&nbsp;
                    <a   href="<?php echo e(route('student.course.intro', ['id'=>$id])); ?>"><?php echo e(__lang('go-to-intro')); ?></a>


            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <ul class="nav nav-pills" id="myTab3" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-info-circle"></i> <?php echo e(__lang('details')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-table"></i> <?php echo e(__lang('classes')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false"><i class="fa fa-chalkboard-teacher"></i> <?php echo e(__lang('instructors')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="test-tab3" data-toggle="tab" href="#test3" role="tab" aria-controls="test" aria-selected="false"><i class="fa fa-check"></i> <?php echo e(__lang('tests')); ?></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent2">
            <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                <div class="card">
                <div class="card-body">
                    <?php echo $row->description; ?>

                </div>
                </div>

            </div>
            <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">

                <?php  $sessionVenue= $row->venue;  ?>

                <?php $__currentLoopData = $rowset; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="card">
                    <div class="card-header"><h4><?php echo e($row2->name); ?></h4>
                        <?php if(!empty($row2->lesson_date)): ?>
                            <div class="card-header-action">
                                <?php echo e(__lang('starts')); ?> <?php echo e(showDate('d/M/Y',$row2->lesson_date)); ?>

                            </div>

                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php  if(!empty($row2->picture)):  ?>
                            <div class="col-md-3">
                                <a href="#" >
                                    <img class="img-responsive rounded" src="<?php echo e(resizeImage($row2->picture,300,300,url('/'))); ?>" >
                                </a>
                            </div>
                            <?php  endif;  ?>

                            <div class="col-md-<?php echo e((empty($row2->picture)? '12':'9')); ?>">
                                <article class="readmore" ><?php echo $row2->description; ?>  </article>
                            </div>
                        </div>
                    </div>
                </div>


                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </div>
            <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                <?php $__currentLoopData = $instructors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instructor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card author-box card-primary">
                        <div class="card-body">
                            <div class="author-box-left">
                                <img alt="image" src="<?php echo e(profilePictureUrl($instructor->user_picture)); ?>" class="rounded-circle author-box-picture">
                                <div class="clearfix"></div>
                                <a href="#" class="btn btn-primary mt-3"  data-toggle="modal" data-target="#contactModal<?php echo e($instructor->admin_id); ?>" ><i class="fa fa-envelope"></i> <?php echo e(__lang('contact')); ?></a>
                           <?php $__env->startSection('footer'); ?>
                               <?php echo \Illuminate\View\Factory::parentPlaceholder('footer'); ?>
                               <!-- Modal -->
                                   <div class="modal fade" id="contactModal<?php echo e($instructor->admin_id); ?>" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel<?php echo e($instructor->admin_id); ?>">
                                       <div class="modal-dialog" role="document">
                                           <div class="modal-content">
                                               <form class="form" method="post" action="<?php echo e(route('student.student.adddiscussion')); ?>">
                                                   <?php echo csrf_field(); ?>
                                                   <div class="modal-header">
                                                       <h4 class="modal-title" id="contactModalLabel"><?php echo e(__lang('contact')); ?> <?php echo e($instructor->name.' '.$instructor->last_name); ?></h4>

                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                                   </div>
                                                   <div class="modal-body">




                                                       <input type="hidden" name="admin_id[]" value="<?php echo e($instructor->admin_id); ?>"/>

                                                       <div class="form-group">
                                                           <?php echo e(formLabel($form->get('subject'))); ?>

                                                           <?php echo e(formElement($form->get('subject'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('subject'))); ?></p>

                                                       </div>




                                                       <div class="form-group">
                                                           <?php echo e(formLabel($form->get('question'))); ?>

                                                           <?php echo e(formElement($form->get('question'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('question'))); ?></p>

                                                       </div>




                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(__lang('close')); ?></button>
                                                       <button type="submit" class="btn btn-primary"><?php echo e(__lang('send-message')); ?></button>
                                                   </div>
                                               </form>
                                           </div>
                                       </div>
                                   </div>

                               <?php $__env->stopSection(); ?>
                            </div>
                            <div class="author-box-details">
                                <div class="author-box-name">
                                    <a href="#"><?php echo e($instructor->name.' '.$instructor->last_name); ?></a>
                                </div>
                                <div class="author-box-job"><?php echo e(\App\Admin::find($instructor->admin_id)->adminRole->name); ?></div>
                                <div class="author-box-description">
                                    <p><?php echo clean($instructor->about); ?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="tab-pane fade" id="test3" role="tabpanel" aria-labelledby="test-tab3">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>

                            <th style="min-width: 100px"><?php echo e(__lang('test')); ?></th>
                            <th><?php echo e(__lang('questions')); ?></th>
                            <th><?php echo e(__lang('opens')); ?></th>
                            <th><?php echo e(__lang('closes')); ?></th>
                            <th><?php echo e(__lang('minutes-allowed')); ?></th>
                            <th><?php echo e(__lang('multiple-attempts-allowed')); ?></th>
                            <th><?php echo e(__lang('passmark')); ?></th>
                            <th ><?php echo e(__lang('actions')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php  foreach($tests as $testRow):  ?>
                        <?php  if($testRow->test_status==1): ?>
                        <tr>
                            <td><?php echo e($testRow->name); ?></td>
                            <td><?php echo e($questionTable->getTotalQuestions($testRow->test_id)); ?></td>
                            <td><?php  if(!empty($testRow->opening_date)) echo showDate('d/M/Y',$testRow->opening_date);  ?></td>
                            <td><?php  if(!empty($testRow->closing_date))  echo showDate('d/M/Y',$testRow->closing_date);  ?></td>

                            <td><?php echo e(empty($testRow->minutes)?__lang('unlimited'):$testRow->minutes); ?></td>
                            <td><?php echo e(boolToString($testRow->allow_multiple)); ?></td>
                            <td><?php echo e(($testRow->passmark > 0)? $testRow->passmark.'%':__lang('ungraded')); ?></td>

                            <td>
                                <?php  if( (!$studentTest->hasTest($testRow->test_id,$studentId) || !empty($testRow->allow_multiple)) && ($testRow->opening_date < time() || $testRow->opening_date == 0 ) && ($testRow->closing_date > time() || $testRow->closing_date ==0)):  ?>
                                <a  target="_blank" href="<?php echo e(route('student.test.taketest',array('id'=>$testRow->test_id))); ?>" class="btn btn-primary " ><?php echo e(__lang('take-test')); ?></a>
                                <?php  endif;  ?>
                            </td>

                        </tr>
                        <?php  endif;  ?>
                        <?php  endforeach;  ?>

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
    <div class="col-md-4">
        <table id="course-specs" class="table table-striped">
            <?php  if(!empty($row->session_date)): ?>
            <tr>
                <td ><?php echo e(__lang('starts')); ?></td>
                <td  ><?php echo e(showDate('d/M/Y',$row->session_date)); ?></td>
            </tr>
            <?php  endif;  ?>

            <?php  if(!empty($row->session_end_date)): ?>
            <tr>
                <td ><?php echo e(__lang('ends')); ?></td>
                <td><?php echo e(showDate('d/M/Y',$row->session_end_date)); ?></td>
            </tr>
            <?php  endif;  ?>
            <?php  if(!empty($row->enrollment_closes)): ?>
            <tr>
                <td ><?php echo e(__lang('enrollment-closes')); ?></td>
                <td><?php echo e(showDate('d/M/Y',$row->enrollment_closes)); ?></td>
            </tr>
            <?php  endif;  ?>

            <?php  if(!empty($row->length)): ?>
            <tr>

                <td><?php echo e(__lang('length')); ?></td>
                <td><?php echo e($row->length); ?></td>
            </tr>
            <?php  endif;  ?>


            <?php  if(!empty($row->effort)): ?>
            <tr>

                <td><?php echo e(__lang('effort')); ?></td>
                <td><?php echo e($row->effort); ?></td>
            </tr>
            <?php  endif;  ?>
            <?php  if(!empty($row->enable_chat)): ?>
            <tr>

                <td><?php echo e(__lang('live-chat')); ?></td>
                <td><?php echo e(__lang('enabled')); ?></td>
            </tr>
            <?php  endif;  ?>
            <?php  if(setting('general_show_fee')==1): ?>
            <tr>
                <td><?php echo e(__lang('fee')); ?></td>
                <td><?php  if(empty($row->payment_required)): ?>
                    <?php echo e(__lang('free')); ?>

                    <?php  else:  ?>
                    <?php echo e(price($row->fee)); ?>

                    <?php  endif;  ?></td>
            </tr>
            <?php  endif;  ?>





        </table>

        <a class="btn btn-primary btn-block btn-lg" href="<?php echo e($resumeLink); ?>"><i class="fa fa-play-circle"></i> <?php echo e(__lang('resume-course')); ?></a>


    </div>

</div>





<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer'); ?>
    <script type="text/javascript" src="<?php echo e(asset('client/vendor/readmore/readmore.min.js')); ?>"></script>
    <script>
        $(function(){
            $('article.readmore').readmore({
                collapsedHeight : 90
            });
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            console.log('clicked');
            $('#timetable article.readmore').readmore({
                collapsedHeight : 90
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <style>
        #course-specs tr:first-child > td{
            border-top: none
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/student/catalog/course.blade.php ENDPATH**/ ?>