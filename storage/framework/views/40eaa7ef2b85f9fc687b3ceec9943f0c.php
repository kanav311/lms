<?php $__env->startSection('innerTitle',__lang('dashboard')); ?>
<?php $__env->startSection('pageTitle',__lang('dashboard')); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard')
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_students')): ?>
            <a href="<?php echo e(route('admin.student.index')); ?>">
                <?php endif; ?>
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fa fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4><?php echo e(__lang('students')); ?></h4>
                    </div>
                    <div class="card-body">
                        <?php echo e($totalStudents); ?>

                    </div>
                </div>
            </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_students')): ?>
            </a>
            <?php endif; ?>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','course')): ?>
            <a href="<?php echo e(route('admin.student.sessions')); ?>?type=c">
                <?php endif; ?>
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4><?php echo e(__lang('online-courses')); ?></h4>
                    </div>
                    <div class="card-body">
                        <?php echo e($totalCourses); ?>

                    </div>
                </div>
            </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','course')): ?>
            </a>
            <?php endif; ?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','course')): ?>
            <a href="<?php echo e(route('admin.student.sessions')); ?>">
                <?php endif; ?>
                <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-calendar"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4><?php echo e(__lang('active-sessions')); ?></h4>
                    </div>
                    <div class="card-body">
                        <?php echo e($totalSessions); ?>

                    </div>
                </div>
            </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access-group','course')): ?>
            </a>
            <?php endif; ?>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_classes')): ?>
            <a href="<?php echo e(route('admin.lesson.index')); ?>">
                <?php endif; ?>
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-desktop"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4><?php echo e(__lang('classes')); ?></h4>
                    </div>
                    <div class="card-body">
                        <?php echo e($totalClasses); ?>

                    </div>
                </div>
            </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_classes')): ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_payments')): ?>
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__lang('sales')); ?></h4>
                    <div class="card-header-action">
                                <i class="fa fa-chart-bar"></i>

                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myChart" height="182"></canvas>
                    <div class="statistic-details mt-sm-4">
                        <div class="statistic-details-item">
                            <span class="text-muted"><?php echo e($todaySales); ?></span>
                            <div class="detail-value"><?php echo e(price($todaySum)); ?></div>
                            <div class="detail-name"><?php echo e(__lang('today-sales')); ?></div>
                        </div>
                        <div class="statistic-details-item">
                            <span class="text-muted"><?php echo e($weekSales); ?></span>
                            <div class="detail-value"><?php echo e(price($weekSum)); ?></div>
                            <div class="detail-name"><?php echo e(__lang('week-sales')); ?></div>
                        </div>
                        <div class="statistic-details-item">
                            <span class="text-muted"><?php echo e($monthSales); ?></span>
                            <div class="detail-value"><?php echo e(price($monthSum)); ?></div>
                            <div class="detail-name"><?php echo e(__lang('month-sales')); ?></div>
                        </div>
                        <div class="statistic-details-item">
                            <span class="text-muted"><?php echo e($yearSales); ?></span>
                            <div class="detail-value"><?php echo e(price($yearSum)); ?></div>
                            <div class="detail-name"><?php echo e(__lang('year-sales')); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_discussions')): ?>
        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__lang('discussions')); ?></h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                        <?php $__currentLoopData = $discuss['paginator']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="media">
                            <img class="mr-3 rounded-circle" width="50" src="<?php echo e(profilePictureUrl($row->picture)); ?>" alt="avatar">
                            <div class="media-body">
                                <div class="float-right text-primary"><?php echo e(\Illuminate\Support\Carbon::parse($row->created_at)->diffForHumans()); ?></div>
                                <div class="media-title"><?php echo e($row->name); ?> <?php echo e($row->last_name); ?></div>
                                <span class="text-small text-muted"><?php echo e(limitLength($row->subject,200)); ?></span>
                            </div>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                    <div class="text-center pt-1 pb-1">
                        <a href="<?php echo e(route('admin.discuss.index')); ?>" class="btn btn-primary btn-lg btn-round">
                            <?php echo e(__lang('view-all')); ?>

                        </a>
                    </div>
                </div>
            </div>
        </div>
            <?php endif; ?>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_students')): ?>
    <div class="row">

        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__lang('latest-users')); ?></h4>
                </div>
                <div class="card-body">
                    <div class="row pb-2">
                        <?php $__currentLoopData = $latestUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-4 col-sm-3 col-lg-2 mb-4 mb-md-0">
                            <div class="avatar-item mb-0  viewbutton <?php if($user->student): ?> int_curpoin <?php endif; ?>"  <?php if($user->student): ?>   data-id="<?php echo e($user->student->id); ?>" data-toggle="modal" data-target="#simpleModal" title="<?php echo app('translator')->get('default.view'); ?>"   <?php endif; ?> >
                                <img  alt="image" src="<?php echo e(profilePictureUrl($user->picture)); ?>" class="img-fluid" data-toggle="tooltip" title="<?php echo e($user->name); ?> <?php echo e($user->last_name); ?>">
                                <div class="avatar-badge" title="<?php echo e(__lang($user->role->name)); ?>" data-toggle="tooltip">
                                    <?php if($user->role_id==1): ?>
                                    <i class="fas fa-wrench"></i>
                                    <?php else: ?>
                                        <i class="fas fa-graduation-cap"></i>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_payments')): ?>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-inline"><?php echo e(__lang('invoices')); ?></h4>
                    <div class="card-header-action">
                        <a href="<?php echo e(route('admin.student.invoices')); ?>" class="btn btn-primary"><?php echo e(__lang('View All')); ?></a>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled list-unstyled-border">
                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($invoice->user): ?>
                        <li class="media">
                            <img class="mr-3 rounded-circle" width="50" src="<?php echo e(profilePictureUrl($invoice->user->picture)); ?>" alt="avatar">
                            <div class="media-body">
                                <?php if($invoice->paid==1): ?>
                                <div class="badge badge-pill badge-success mb-1 float-right"><?php echo e(__lang('paid')); ?></div>
                                <?php else: ?>
                                <div class="badge badge-pill badge-danger mb-1 float-right"><?php echo e(__lang('unpaid')); ?></div>
                                <?php endif; ?>

                                <h6 class="media-title"><a class=" viewbutton "  <?php if($invoice->user->student): ?>   data-id="<?php echo e($invoice->user->student->id); ?>" data-toggle="modal" data-target="#simpleModal" title="<?php echo app('translator')->get('default.view'); ?>"   <?php endif; ?> href="#"><?php echo e($invoice->user->name); ?> <?php echo e($invoice->user->last_name); ?></a></h6>
                                <div class="text-small text-muted"><?php echo e(price($invoice->amount)); ?>  <?php if(empty($invoice->paid)): ?> <div class="bullet"></div>
                                    <a href="<?php echo e(adminUrl(array('controller'=>'student','action'=>'approvetransaction','id'=>$invoice->id))); ?>"><?php echo e(__lang('approve')); ?></a> <?php endif; ?> <div class="bullet"></div> <span class="text-primary">Now</span></div>
                            </div>
                        </li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </ul>
                </div>
            </div>


        </div>
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access','view_sessions')): ?>
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__lang('recent-courses')); ?></h4>
                    <div class="card-header-action">
                        <a href="<?php echo e(route('admin.student.sessions')); ?>" class="btn btn-primary"><?php echo e(__lang('View All')); ?></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="summary">
                        <div class="summary-item">
                            <ul class="list-unstyled list-unstyled-border">

                                <?php $__currentLoopData = $session['paginator']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $course = \App\Course::find($row->id);
                                    ?>
                                <li class="media">
                                    <a <?php if($course->type != 'c'): ?>  href="<?php echo e(route('admin.student.editsession',['id'=>$row->id])); ?>"  <?php else: ?>  href="<?php echo e(route('admin.session.editcourse',['id'=>$row->id])); ?>"  <?php endif; ?> >
                                        <img class="mr-3 rounded" width="50" <?php if(!empty($course->picture) && file_exists($course->picture)): ?> src="<?php echo e(asset($course->picture)); ?>"  <?php else: ?> src="<?php echo e(asset('client/themes/admin/assets/img/products/product-2-50.png')); ?>" <?php endif; ?> alt="product">
                                    </a>
                                    <div class="media-body">
                                        <div class="media-right"><?php echo e(price($course->fee)); ?></div>
                                        <div class="media-title"><a  <?php if($course->type != 'c'): ?>  href="<?php echo e(route('admin.student.editsession',['id'=>$row->id])); ?>"  <?php else: ?>  href="<?php echo e(route('admin.session.editcourse',['id'=>$row->id])); ?>"  <?php endif; ?> ><?php echo e($course->name); ?></a></div>
                                        <div class="text-muted text-small"><?php if($course->admin): ?><span class="text-primary"><?php echo e($course->admin->user->name); ?> <?php echo e($course->admin->user->last_name); ?></span> <div class="bullet"></div> <?php endif; ?>  <?php echo e(\Illuminate\Support\Carbon::parse($course->created_at)->diffForHumans()); ?></div>
                                    </div>
                                </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
            <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <!-- Page Specific JS File -->
    <script src="<?php echo e(asset('client/themes/admin/assets/js/page/index-0.js_')); ?>"></script>

    <script type="text/javascript">
        "use strict";

        var statistics_chart = document.getElementById("myChart").getContext('2d');

        var myChart = new Chart(statistics_chart, {
            type: 'line',
            data: {
                labels: <?php echo clean($monthList); ?>,
                datasets: [{
                    label: '<?php echo e(__lang('sales')); ?>',
                    data: <?php echo clean($monthSaleData); ?>,
                    borderWidth: 5,
                    borderColor: '#6777ef',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#6777ef',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false,
                        },
                        ticks: {
                            stepSize: 1000
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            color: '#fbfbfb',
                            lineWidth: 2
                        }
                    }]
                },
            }
        });

        $('#visitorMap').vectorMap(
            {
                map: 'world_en',
                backgroundColor: '#ffffff',
                borderColor: '#f2f2f2',
                borderOpacity: .8,
                borderWidth: 1,
                hoverColor: '#000',
                hoverOpacity: .8,
                color: '#ddd',
                normalizeFunction: 'linear',
                selectedRegions: false,
                showTooltip: true,
                pins: {
                    id: '<div class="jqvmap-circle"></div>',
                    my: '<div class="jqvmap-circle"></div>',
                    th: '<div class="jqvmap-circle"></div>',
                    sy: '<div class="jqvmap-circle"></div>',
                    eg: '<div class="jqvmap-circle"></div>',
                    ae: '<div class="jqvmap-circle"></div>',
                    nz: '<div class="jqvmap-circle"></div>',
                    tl: '<div class="jqvmap-circle"></div>',
                    ng: '<div class="jqvmap-circle"></div>',
                    si: '<div class="jqvmap-circle"></div>',
                    pa: '<div class="jqvmap-circle"></div>',
                    au: '<div class="jqvmap-circle"></div>',
                    ca: '<div class="jqvmap-circle"></div>',
                    tr: '<div class="jqvmap-circle"></div>',
                },
            });
    </script>
    <div class="modal fade" id="simpleModal"  tabindex="-1" role="dialog" id="exampleModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__lang('student-details')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="info">
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo e(__lang('close')); ?></button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            $('.viewbutton').click(function(){
                $('#info').text('Loading...');
                var id = $(this).attr('data-id');
                $('#info').load('<?php echo e(adminUrl(array('controller'=>'student','action'=>'view'))); ?>'+'/'+id);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Videos\base_file_aiipl\resources\views/admin/home/index.blade.php ENDPATH**/ ?>