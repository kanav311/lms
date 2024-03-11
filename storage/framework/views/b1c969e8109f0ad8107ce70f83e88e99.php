<?php $__env->startSection('pageTitle',$pageTitle); ?>
<?php $__env->startSection('innerTitle',$sessionRow->name); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>$customCrumbs], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="card profile-widget mt-5">
        <div class="profile-widget-header">
            <?php if(!empty($sessionRow->picture)): ?>
                <img  class="rounded-circle profile-widget-picture" src="<?php echo e(resizeImage($sessionRow->picture,400,300,url('/'))); ?>" >
            <?php else: ?>
                <img  class="rounded-circle profile-widget-picture"  src="<?php echo e(asset('img/course.png')); ?>" >
            <?php endif; ?>
            <div class="profile-widget-items">
                <div class="profile-widget-item">
                    <div class="profile-widget-item-value pt-2 pb-1"><?php echo e(__lang('introduction')); ?></div>
                </div>
                <div class="profile-widget-item">
                    <a class="btn btn-success btn-lg " href="<?php echo e($classLink); ?>"><i class="fa fa-play-circle"></i> <?php echo e(__lang('start-course')); ?></a>
                </div>
            </div>
        </div>
        <div class="profile-widget-description">
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item"><a class="nav-link active" href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-info-circle"></i> <?php echo e(__lang('introduction')); ?></a></li>
                    <li  class="nav-item"><a class="nav-link"  href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-table"></i> <?php echo e(__lang('table-of-contents')); ?></a></li>
                    <li  class="nav-item"><a class="nav-link"  href="#resources" aria-controls="resources" role="tab" data-toggle="tab"><i class="fa fa-download"></i> <?php echo e(__lang('resources')); ?></a></li>
                    <li  class="nav-item"><a class="nav-link"  href="#progress" aria-controls="progress" role="tab" data-toggle="tab"><i class="fa fa-chart-bar"></i> <?php echo e(__lang('progress')); ?></a></li>
                    <?php  if(!empty($sessionRow->enable_discussion)): ?>
                    <li  class="nav-item"><a class="nav-link"  href="#discuss" aria-controls="discuss" role="tab" data-toggle="tab"><i class="fa fa-comments"></i> <?php echo e(__lang('discuss')); ?></a></li>
                    <?php  endif;  ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">

                        <div  >
                            <div  >
                                <p><?php echo $sessionRow->introduction; ?>  </p>
                            </div>
                            <a class="btn btn-success btn-lg float-right" href="<?php echo e($classLink); ?>"><i class="fa fa-play-circle"></i> <?php echo e(__lang('start-course')); ?></a>

                        </div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <?php  if($totalClasses>0): ?>
                        <?php  $count=1; foreach($classes as $row):  ?>

                        <?php if($row): ?>
                        <div class="card">
                            <div class="card-header">
                                <?php echo e($count.'. '.$row->name); ?>

                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__lang('lectures')); ?></th>
                                        <th><?php echo e(__lang('attendance')); ?></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php  foreach($lectureTable->getPaginatedRecords(false,$row->lesson_id) as $lecture):  ?>
                                    <tr>
                                        <td><?php echo e($lecture->title); ?></td>
                                        <td>
                                            <?php  if($sessionLogTable->hasAttendance($studentId,$sessionId,$lecture->id)): ?>
                                            <?php echo e(__lang('completed-on')); ?> <?php echo e(showDate('d/M/Y',$sessionLogTable->getAttendance($studentId,$sessionId,$lecture->id)->created_at)); ?>

                                            <?php  else:  ?>
                                            <?php echo e(__lang('pending')); ?>

                                            <?php  endif;  ?>
                                        </td>
                                        <td><a class="btn btn-xs btn-primary" href="<?php echo e(route(MODULE.'.course.lecture',['course'=>$sessionId,'lecture'=>$lecture->id])); ?>"><?php echo e(__lang('view-lecture')); ?></a></td>
                                    </tr>
                                    <?php  endforeach;  ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer"  >
                                <a class="btn btn-primary btn-lg float-right" href="<?php echo e(route(MODULE.'.course.class',['course'=>$sessionId,'lesson'=>$row->lesson_id])); ?>"><i class="fa fa-play-circle"></i> <?php echo e(__lang('start-class')); ?></a>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php  $count++;  ?>
                        <?php  endforeach;  ?>
                        <?php  endif;  ?>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="resources">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th><?php echo e(__lang('name')); ?></th>
                                <th><?php echo e(__lang('files')); ?></th>
                                <th ></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $downloads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $download): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td><?php echo e($download->name); ?></td>
                                <td><?php echo e($fileTable->getTotalForDownload($download->download_id)); ?></td>

                                <td class="text-right">
                                    <?php if($fileTable->getTotalForDownload($download->download_id)> 0): ?>
                                        <a href="<?php echo e(route('student.download.files',array('id'=>$download->download_id))); ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" data-original-title="View Files"><i class="fa fa-eye"></i> <?php echo e(__lang('view-files')); ?></a>
                                        <a href="<?php echo e(route('student.download.allfiles',array('id'=>$download->download_id))); ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" data-original-title="Download All Files"><i class="fa fa-download"></i> <?php echo e(__lang('download-all')); ?></a>
                                    <?php else: ?>
                                        <strong><?php echo e(__lang('no-files-available')); ?></strong>
                                    <?php endif; ?>
                                </td>
                                </tr>

                                <?php  endforeach;  ?>

                            </tbody>
                        </table>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="progress">

                        <div class="text-center mt-3"><h2><?php echo e($percentage); ?>%</h2></div>

                            <div class="progress mb-3 mb-3" data-height="25">
                                <div class="progress-bar bg-success" role="progressbar" data-width="<?php echo e($percentage); ?>%" aria-valuenow="<?php echo e($percentage); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                        <div class="row mt-5">

                            <div class="col-md-6 col-sm-6 col-xs-12">

                                <div id="accordion">
                                    <div class="accordion">
                                        <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                                            <h4><?php echo e(__lang('classes-attended')); ?></h4>
                                        </div>
                                        <div class="accordion-body collapse show" id="panel-body-1" data-parent="#accordion">
                                            <p><?php echo e(__lang('here-are-classes')); ?></p>
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th><?php echo e(__lang('class')); ?></th>
                                                    <th><?php echo e(__lang('date')); ?></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  foreach($attendanceRecords as $attendance): ?>
                                                <tr>
                                                    <td><a href="<?php echo e(route(MODULE.'.course.class',['lesson'=>$attendance->lesson_id,'course'=>$attendance->course_id])); ?>"><?php echo e($attendance->name); ?></a></td>
                                                    <td><?php echo e(showDate('d/M/Y',$attendance->attendance_date)); ?></td>
                                                </tr>

                                                <?php  endforeach;  ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                            </div>



                            <div class="col-md-6 col-sm-6 col-xs-12">


                                <div id="accordion2">
                                    <div class="accordion">
                                        <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-12" aria-expanded="true">
                                            <h4><?php echo e(__lang('pending-classes')); ?></h4>
                                        </div>
                                        <div class="accordion-body collapse show" id="panel-body-12" data-parent="#accordion2">
                                            <p><?php echo e(__lang('classes-yet-to-take')); ?></p>
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th><?php echo e(__lang('class')); ?></th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  if($totalClasses>0): ?>
                                                <?php  foreach($classes as $class): ?>
                                                <?php  if(!$attendanceTable->hasAttendance($studentId,$class->lesson_id,$sessionId)): ?>
                                                <tr>
                                                    <td><?php echo e($class->name); ?></td>
                                                    <td>
                                                        <?php  if($class->lesson_date > time()): ?>
                                                        <?php echo e(__lang('starts-on')); ?> <?php echo e(showDate('d/M/Y',$class->lesson_date)); ?>

                                                        <?php  else:  ?>
                                                        <a class="btn btn-primary" href="<?php echo e(route(MODULE.'.course.class',['lesson'=>$class->lesson_id,'course'=>$sessionId])); ?>"><?php echo e(__lang('start-class')); ?></a>
                                                        <?php  endif;  ?>
                                                    </td>
                                                </tr>
                                                <?php  endif;  ?>
                                                <?php  endforeach;  ?>
                                                <?php  endif;  ?>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="discuss">

                        <div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-pills" role="tablist">
                                <li  class="nav-item"><a  class="nav-link active"  href="#home1" aria-controls="home1" role="tab" data-toggle="tab"><?php echo e(__lang('instructor-chat')); ?></a></li>
                                <li  class="nav-item"><a  class="nav-link"  href="#profile1" aria-controls="profile1" role="tab" data-toggle="tab"><?php echo e(__lang('student-forum')); ?></a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home1">
                                    <?php  if(!empty($sessionRow->enable_discussion)): ?>
                                    <form class="form" method="post" action="<?php echo e(route('student.student.adddiscussion')); ?>">

                                        <p><?php echo e(__lang('ask-a-question')); ?></p>
                                        <div class="modal-body">

                                            <?php echo csrf_field(); ?>
                                            <div class="form-group">
                                                <label>Recipients</label>
                                                <?php echo e(formElement($form->get('admin_id[]'))); ?>

                                            </div>


                                            <input type="hidden" name="course_id" value="<?php echo e($sessionId); ?>"/>
                                            <div class="form-group">
                                                <?php echo e(formLabel($form->get('subject'))); ?>

                                                <?php echo e(formElement($form->get('subject'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('subject'))); ?></p>

                                            </div>




                                            <div class="form-group">
                                                <?php echo e(formLabel($form->get('question'))); ?>

                                                <?php echo e(formElement($form->get('question'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('question'))); ?></p>

                                            </div>

                                            <button type="submit" class="btn btn-primary"><?php echo e(__lang('submit')); ?></button>

                                        </div>

                                    </form>
                                    <div class="row">
                                        <div class="col-md-12" style="margin-top: 20px">
                                            <h4><?php echo e(__lang('your-questions')); ?></h4>
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th><?php echo e(__lang('subject')); ?></th>
                                                    <th><?php echo e(__lang('created-on')); ?></th>
                                                    <th><?php echo e(__lang('recipients')); ?></th>
                                                    <th><?php echo e(__lang('replied')); ?></th>
                                                    <th class="text-right1" style="width:90px"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php  foreach($discussions as $row):  ?>
                                                <tr>
                                                    <td><?php echo e($row->subject); ?>

                                                    </td>

                                                    <td><?php echo e(showDate('d/M/Y',$row->created_at)); ?></td>
                                                    <td>

                                                        <?php  if($row->admin==1): ?>
                                                        <?php echo e(__lang('administrators')); ?>,
                                                        <?php  endif;  ?>

                                                        <?php  foreach($accountTable->getDiscussionAccounts($row->id) as $row2):  ?>
                                                        <?php echo e($row2->name.' '.$row2->last_name); ?>,
                                                        <?php  endforeach;  ?>



                                                    </td>

                                                    <td><?php echo e(boolToString($row->replied)); ?></td>

                                                    <td class="text-right">
                                                        <a href="<?php echo e(route('student.student.viewdiscussion',array('id'=>$row->id))); ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" data-original-title="View"><i class="fa fa-eye"></i> <?php echo e(__lang('view')); ?></a>

                                                    </td>
                                                </tr>
                                                <?php  endforeach;  ?>

                                                </tbody>
                                            </table>


                                        </div>

                                    </div>
                                    <?php  else: ?>
                                    <?php echo e(__lang('instruct-chat-unavailable')); ?>

                                    <?php  endif;  ?>


                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile1">
                                    <?php  if(!empty($sessionRow->enable_forum)): ?>
                                    <?php echo $forumTopics; ?>

                                    <?php  else: ?>
                                    <?php echo e(__lang('student-forum-unavailable')); ?>

                                    <?php  endif;  ?>
                                </div>
                            </div>

                        </div>





                    </div>

                </div>

            </div>



        </div>

    </div>








<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/student/course/intro.blade.php ENDPATH**/ ?>