<?php $__env->startSection('page-title',''); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            route('admin.test.index')=>__lang('tests'),
            '#'=>__lang('test-questions')
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div>
    <div>
        <div class="card">
            <div class="card-header">
                <button data-toggle="modal" data-target="#myModal" class="btn btn-success float-right"><i class="fa fa-plus"></i>  Add Question</button>
                &nbsp; &nbsp;
                <button data-toggle="modal" data-target="#importModal" class="btn btn-primary float-right"><i class="fa  fa-download"></i>  Import Questions</button>



            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo e(__lang('question')); ?></th>
                        <th><?php echo e(__lang('options')); ?></th>
                        <th><?php echo e(__lang('sort-order')); ?></th>
                        <th  ><?php echo e(__lang('actions')); ?></th>
                    </tr>
                    </thead>
                    <tbody> <?php $number = 1 + (30 * ($page-1));  ?>
                    <?php foreach($paginator as $row):  ?>
                        <tr>
                            <td><?php echo e($number); ?> <?php $number++ ?></td>
                            <td><?php echo $row->question; ?></td>
                            <td><?php echo e($optionTable->getTotalOptions($row->id)); ?></td>
                            <td><?php echo e($row->sort_order); ?></td>

                            <td>

                                <a href="<?php echo e(adminUrl(array('controller'=>'test','action'=>'editquestion','id'=>$row->id))); ?>" class="btn btn-xs btn-primary btn-equal" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(__lang('edit-questions-options')); ?>"><i class="fa fa-edit"></i></a>

                                 <a onclick="return confirm('<?php echo e(__lang('delete-confirm')); ?>')" href="<?php echo e(adminUrl(array('controller'=>'test','action'=>'deletequestion','id'=>$row->id))); ?>"  class="btn btn-xs btn-danger btn-equal" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(__lang('delete')); ?>"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;  ?>

                    </tbody>
                </table>

                <?php
                // add at the end of the file after the table
                echo paginationControl(
                // the paginator object
                    $paginator,
                    // the scrolling style
                    'sliding',
                    // the partial to use to render the control
                    null,
                    // the route to link to when a user clicks a control link
                    array(
                        'route' => 'admin/default',
                        'controller'=>'test',
                        'action'=>'questions',
                        'id'=>$id
                    )
                );
                ?>
            </div><!--end .box-body -->
        </div><!--end .box -->
    </div><!--end .col-lg-12 -->
</div>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('client/vendor/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><?php echo e(__lang('add-question')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <form id="questionform" method="post" action="<?php echo e(adminUrl(['controller'=>'test','action'=>'addquestion','id'=>$id])); ?>">
<?php echo csrf_field(); ?>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="question"><?php echo e(__lang('question')); ?></label>

                            <textarea required="required" class="form-control summernote" name="question" placeholder="<?php echo e(__lang('enter-question')); ?>" id="question"  rows="1"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="sort_order"><?php echo e(__lang('sort-order')); ?> (<?php echo e(__lang('optional')); ?>)</label>
                            <input placeholder="<?php echo e(__lang('digits-only')); ?>" class="form-control number"  type="text" id="sort_order" name="sort_order"/>
                        </div>

                        <h3><?php echo e(__lang('options')); ?></h3>
                        <p><small><?php echo e(__lang('add-question-help')); ?></small></p>
                        <table class="table table-stripped">
                            <thead>
                            <tr>
                                <th><?php echo e(__lang('option')); ?></th>
                                <th><?php echo e(__lang('correct-answer')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for($i=1;$i<=5;$i++): ?>
                            <tr>
                                <td><input name="option_<?php echo e($i); ?>" class="form-control" type="text"/></td>
                                <td><input  required="required"  type="radio" name="correct_option" value="<?php echo e($i); ?>"/></td>
                            </tr>
                            <?php endfor;  ?>
                            </tbody>
                        </table>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__lang('cancel')); ?></button>
                        <button  type="submit" class="btn btn-primary"><?php echo e(__lang('save-changes')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><?php echo e(__lang('import-questions')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>

                <form enctype="multipart/form-data" id="importform" method="post" action="<?php echo e(adminUrl(['controller'=>'test','action'=>'importquestions','id'=>$id])); ?>">
                <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <p>
                            <?php echo __lang('import-questions-help',['link'=>basePath().'/client/data/test_question_sample.csv']); ?>

                        </p>
                        <div class="form-group">
                            <label for="question"><?php echo e(__lang('csv-file')); ?></label>
                            <input type="file" name="file" >
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__lang('cancel')); ?></button>
                        <button  type="submit" class="btn btn-primary"><i class="fa  fa-download"></i> <?php echo e(__lang('import')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="<?php echo e(asset('client/vendor/summernote/summernote-bs4.min.js')); ?>"></script>
    <script>
        $(function(){

            $('.summernote').summernote({
                height: 200
            } );
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/admin/test/questions.blade.php ENDPATH**/ ?>