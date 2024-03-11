<?php $__env->startSection('innerTitle',$pageTitle); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            url('/')=>__lang('home'),
            '#'=>__lang('dashboard')
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-md-<?php echo e((setting('menu_show_certificates')==1 || setting('menu_show_tests')==1) ? '5':'10'); ?>">


            <?php if($homeworkPresent): ?>

                <div class="card card-danger">
                 <div class="card-header">
                     <div ><h4><i class="fa fa-edit"></i> <?php echo e(__lang('homework')); ?></h4></div>

                </div>
                <div class="card-body">
                    <?php echo e(__lang('pending-homework')); ?>

                </div>
                    <div class="card-footer">
                        <a href="<?php echo e(route('student.assignment.index')); ?>" class="btn btn-success   float-right"><i class="fa fa-edit"></i> <?php echo e(__lang('view-homework')); ?></a>
                    </div>
                </div>

            <?php endif; ?>


            <div class="card card-primary">
                <div class="card-header">
                    <h4><i class="fa fa-book"></i> <?php echo e(setting('label_sessions_courses',__lang('courses-sessions'))); ?></h4>
                    <div class="card-header-action">
                        <a href="<?php echo e(route('student.student.mysessions')); ?>" class="btn btn-primary"><?php echo e(__lang('view-all')); ?></a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="summary">
                        <div class="summary-item">
                            <h6><?php echo e(__lang('enrolled-courses')); ?> <span class="text-muted">(<?php echo e($mysessions['total']); ?> <?php echo e(__lang('Items')); ?>)</span></h6>
                            <ul class="list-unstyled list-unstyled-border">

                                <?php $__currentLoopData = $mysessions['paginator']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="media">
                                    <?php
                                        if($row->type=='c'){
                                                $url = route('student.course-details',['id'=>$row->course_id,'slug'=>safeUrl($row->name)]);
                                            }
                                            else{
                                                $url = route('student.session-details',['id'=>$row->course_id,'slug'=>safeUrl($row->name)]);
                                            }
                                    ?>

                                    <a href="<?php echo e($url); ?>">

                                        <?php if(!empty($row->picture)): ?>
                                            <img class="mr-3 rounded" src="<?php echo e(resizeImage($row->picture,671,480,basePath())); ?>" alt="product" width="50">

                                        <?php else: ?>
                                            <img class="mr-3 rounded" src="<?php echo e(asset('img/course.png')); ?>" alt="product" width="50">

                                        <?php endif; ?>
                                    </a>
                                    <div class="media-body">
                                        <div class="media-right"><a class="btn btn-primary btn-sm" href="<?php echo e($url); ?>"><i class="fa fa-play-circle"></i> <?php echo e(__lang('view')); ?></a></div>
                                        <div class="media-title"><a href="<?php echo e($url); ?>"><?php echo e(limitLength($row->name,100)); ?></a>

                                            <div style="width: 70%">
                                                <div class="progress" data-height="3" >
                                                    <div class="progress-bar" role="progressbar" data-width="<?php echo e($controller->getStudentProgress($row->course_id)); ?>%" aria-valuenow="<?php echo e($controller->getStudentProgress($row->course_id)); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="text-muted text-small"><a href="<?php echo e($url); ?>"><?php echo e(\App\Course::find($row->course_id)->lessons()->count()); ?> <?php echo e(__lang('classes')); ?></a>
                                            <div class="bullet"></div> <?php echo e(courseType($row->type)); ?></div>
                                    </div>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>




                <?php if(setting('menu_show_discussions')==1): ?>
                <div class="card card-success">
                    <div class="card-header">
                        <h4 class="d-inline"><i class="fa fa-comments"></i> <?php echo e(__lang('discussions')); ?></h4>
                    </div>
                    <div class="card-body">
                          <ul class="nav nav-pills" id="myTab3" role="tablist">
                                                <li class="nav-item">
                                                  <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true"><?php echo e(__lang('student-forum')); ?></a>
                                                </li>
                                                <li class="nav-item">
                                                  <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false"><?php echo e(__lang('instructor-chats')); ?></a>
                                                </li>
                                              </ul>
                                              <div class="tab-content" id="myTabContent2">
                                                <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">

                                                    <div class="card-title"><?php echo e(__lang('latest-topics')); ?> </div>

                                                    <ul class="list-unstyled list-unstyled-border">
                                                        <?php $__currentLoopData = $forumTopics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                $user = \App\User::find($row->user_id);
                                                            ?>
                                                            <li class="media">
                                                                <?php if($user): ?>
                                                                    <img data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e($user->name); ?>" class="mr-3 rounded-circle" width="50" src="<?php echo e(profilePictureUrl($user->picture)); ?>" alt="avatar">
                                                                <?php endif; ?>
                                                                <div class="media-body">
                                                                    <a  class="badge badge-pill badge-success mb-1 float-right" href="<?php echo e(route('student.forum.topic',['id'=>$row->forum_topic_id])); ?>"><?php echo e(__lang('view')); ?></a>

                                                                    <h6 class="media-title"><a href="<?php echo e(route('student.forum.topic',['id'=>$row->id])); ?>"><?php echo e($row->title); ?></a></h6>
                                                                    <div class="text-small text-muted">  <?php echo e($row->name); ?>  <div class="bullet"></div> <span class="text-primary"><?php echo e(\Illuminate\Support\Carbon::parse($row->forum_created_on)->diffForHumans()); ?></span></div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                    </ul>

                                                    <a href="<?php echo e(route('student.forum.index')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-right"></i> <?php echo e(__lang('view-all')); ?></a>
                                                </div>
                                                <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">


                                                    <ul class="list-unstyled list-unstyled-border">
                                                        <?php $__currentLoopData = $discussions['paginator']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                            <li class="media">

                                                                <div class="media-body">
                                                                    <a  class="badge badge-pill badge-success mb-1 float-right" href="<?php echo e(route('student.student.viewdiscussion',['id'=>$row->id])); ?>"><?php echo e(__lang('view')); ?></a>

                                                                    <h6 class="media-title"><a href="<?php echo e(route('student.student.viewdiscussion',['id'=>$row->id])); ?>"><?php echo e($row->subject); ?></a></h6>
                                                                    <div class="text-small text-muted">
                                                                    <?php if(\App\Course::find($row->course_id)): ?>
                                                                     <?php echo e(\App\Course::find($row->course_id)->name); ?>  <div class="bullet"></div>
                                                                    <?php endif; ?>
                                                                     <?php echo e(\App\Discussion::find($row->id)->discussionReplies()->count()); ?> <?php echo e(__lang('replies')); ?>   <div class="bullet"></div>
                                                                        <span class="text-primary"><?php echo e(\Illuminate\Support\Carbon::parse($row->created_at)->diffForHumans()); ?></span>

                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                    </ul>

                                                    <a href="<?php echo e(route('student.student.discussion')); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-right"></i> <?php echo e(__lang('view-all')); ?></a>

                                                </div>

                                              </div>



                    </div>
                </div>

                <?php endif; ?>



        </div>
        <?php if(setting('menu_show_certificates')==1 || setting('menu_show_tests')==1 ): ?>
        <div class="col-md-5">

            <?php if(setting('menu_show_certificates')==1): ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h4><i class="fa fa-certificate"></i> <?php echo e(__lang('certificates')); ?></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php $__currentLoopData = $certificate['paginator']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col text-center">
                            <a href="<?php echo e(route('student.student.downloadcertificate',['id'=>$row->certificate_id])); ?>">
                                <h1><i class="fa fa-file-pdf"></i></h1>
                             </a>
                            <div class="mt-2 font-weight-bold"><?php echo e($row->certificate_name); ?></div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(setting('menu_show_tests')==1): ?>
            <div class="card card-info">
                <div class="card-header">
                    <h4><i class="fas fa-check-circle"></i> <?php echo e(__lang('tests')); ?></h4>
                    <div class="card-header-action"><a class="btn btn-primary" href="<?php echo e(route('student.test.statement')); ?>"><?php echo e(__lang('view-all')); ?></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="summary">
                        <div class="summary-item">
                            <h6><?php echo e(__lang('your-recent-performance')); ?></h6>
                            <ul class="list-unstyled list-unstyled-border">
                                <?php $__currentLoopData = $student->studentTests()->orderBy('id','desc')->limit(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testResult): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="media">

                                    <div class="media-body">
                                        <div class="media-right"><?php echo e(round($testResult->score)); ?>%</div>
                                        <div class="media-title"><a href="<?php echo e(route('student.test.taketest',['id'=>$testResult->test_id])); ?>"><?php echo e($testResult->test->name); ?></a></div>
                                        <div class="text-muted text-small"><?php echo e(__lang('taken-on')); ?>    <?php echo e(\Illuminate\Support\Carbon::parse($testResult->created_at)->format('d m Y')); ?></div>
                                    </div>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>


        </div>
        <?php endif; ?>
        <div class="col-md-2">
            <ul class="list-group">
                <li class="list-group-item active"><?php echo e(__lang('my-account')); ?></li>
                <li class="list-group-item"><a href="<?php echo e(route('student.student.mysessions')); ?>"><i class="fas fa-chalkboard-teacher"></i> <?php echo e(setting('label_my_sessions',__lang('my-courses'))); ?></a></li>
                <?php if(setting('menu_show_homework')==1): ?>
                <li class="list-group-item"><a href="<?php echo e(route('student.assignment.index')); ?>"><i class="fas fa-edit"></i> <?php echo e(__lang('homework')); ?></a> </li>
                <?php endif; ?>

                <?php if(setting('menu_show_discussions')==1): ?>
                <li class="list-group-item"><a href="<?php echo e(route('student.forum.index')); ?>"><i class="fas fa-comments"></i> <?php echo e(__lang('student-forum')); ?></a> </li>
                <li class="list-group-item"><a href="<?php echo e(route('student.student.discussion')); ?>"><i class="fas fa-comment"></i> <?php echo e(__lang('instructor-chat')); ?></a> </li>
                <?php endif; ?>
                <?php if(setting('menu_show_downloads')==1): ?>
                <li class="list-group-item"><a href="<?php echo e(route('student.download.index')); ?>"><i class="fas fa-download"></i> <?php echo e(__lang('downloads')); ?></a> </li>
                <?php endif; ?>
                <?php if(setting('menu_show_certificates')==1): ?>
                <li class="list-group-item"><a href="<?php echo e(route('student.student.certificates')); ?>"><i class="fas fa-certificate"></i> <?php echo e(__lang('certificates')); ?></a> </li>
                <?php endif; ?>
            </ul>


        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/student/index/index.blade.php ENDPATH**/ ?>