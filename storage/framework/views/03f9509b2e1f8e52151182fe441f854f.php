<?php $__env->startSection('page-title',''); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            route('admin.student.sessions')=>__lang('courses'),
            '#'=>isset($pageTitle)?$pageTitle:''
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<p>
    <?php echo e(__lang('drag-and-drop-rows')); ?>

    <a class="btn btn-primary float-right" href="#"  data-toggle="modal" data-target="#addClassModal"><i class="fa fa-plus"></i> <?php echo e(__lang('Add Class')); ?></a>
</p>


<table id="selectedTable" class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th  data-sort="string"><?php echo e(__lang('class-name')); ?></th>
        <th><?php echo e(__lang('lectures')); ?></th>
        <th><?php echo e(__lang('opening-date')); ?></th>
        <th></th>
    </tr>
    </thead>
    <tbody  id="selectedlist">

        <?php foreach($session->lessons()->orderBy('pivot_sort_order')->get() as $sessionLesson): ?>
        <tr  id="row-<?php echo e($sessionLesson->id); ?>" class="sort_row">
            <td class="sort_cell"><?php echo e($sessionLesson->pivot->sort_order); ?></td>
            <td><?php echo e($sessionLesson->name); ?></td>
            <td><?php echo e($sessionLesson->lectures()->count()); ?></td>
            <td><input placeholder="optional" style="max-width: 150px" data-id="<?php echo e($sessionLesson->id); ?>" name="lesson_date_<?php echo e($sessionLesson->id); ?>" id="lesson_date_<?php echo e($sessionLesson->id); ?>" class="form-control date lesson_date" value="<?php echo e(showDate('Y-m-d',$sessionLesson->pivot->lesson_date)); ?>" type="text"/></td>
            <td>
                <a target="_blank" class="btn btn-primary" href="<?php echo e(adminUrl(array('controller'=>'lesson','action'=>'edit','id'=>$sessionLesson->id))); ?>"><i class="fa fa-edit"></i> <?php echo e(__lang('edit')); ?></a>
                <a target="_blank" class="btn btn-success" href="<?php echo e(adminUrl(array('controller'=>'lecture','action'=>'index','id'=>$sessionLesson->id))); ?>"><i class="fa fa-file-video"></i> <?php echo e(__lang('lectures')); ?></a>
                <div class="btn-group dropup">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-trash"></i> <?php echo e(__lang('delete')); ?>

                    </button>
                    <ul class="dropdown-menu wide-btn float-right animation-slide" role="menu" style="text-align: left;">

                        <li > <a class="dropdown-item" onclick="return confirm('<?php echo e(__lang('remove-course-only-confirm')); ?>')" href="<?php echo e(route('admin.session.deleteclass',['lesson'=>$sessionLesson->id,'course'=>$sessionLesson->pivot->course_id])); ?>"    > <?php echo e(__lang('remove-course-only')); ?></a></li>
                        <li> <a class="dropdown-item"  onclick="return confirm('<?php echo e(__lang('delete-class-completely-confirm')); ?>')" href="<?php echo e(adminUrl(array('controller'=>'lesson','action'=>'delete','id'=>$sessionLesson->id))); ?>"    > <?php echo e(__lang('delete-class-completely')); ?></a></li>


                    </ul>
                </div>
                <a target="_blank" class="btn btn-success" href="<?php echo e(adminUrl(array('controller'=>'lesson','action'=>'files','id'=>$sessionLesson->id))); ?>"><i class="fa fa-download"></i> <?php echo e(__lang('downloads')); ?></a>

            </td>
        </tr>

    <?php endforeach;  ?>
    </tbody>
</table>



<!--
  End modal
    -->



<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('client/vendor/pickadate/themes/default.date.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/vendor/pickadate/themes/default.time.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/vendor/pickadate/themes/default.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('client/vendor/datatables/media/css/jquery.dataTables.min.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
    <div class="modal fade" id="addClassModal" tabindex="-1" role="dialog" aria-labelledby="addClassModalLabel">


        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><?php echo e(__lang('add')); ?>      <?php if($session->lessons()->count()==0): ?>
                        <?php echo e(__lang('your-first')); ?>

                        <?php endif;  ?> <?php echo e(__lang('class')); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                </div>
                <div class="modal-body">



                    <div class="" role="tabpanel" data-example-id="togglable-tabs">


                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true"><?php echo e(__lang('new-class')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false"><?php echo e(__lang('existing-class')); ?></a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">

                                <div  >
                                    <div >
                                        <div class="card_">

                                            <div class="card-body_">
                                                <?php
                                                    $form->prepare();
                                                    $form->setAttribute('action', adminUrl(array('controller'=>'lesson','action'=>'add')).'?sessionId='.$session->id.'&back=true');
                                                    $form->setAttribute('method', 'post');
                                                    $form->setAttribute('role', 'form');
                                                    $form->setAttribute('class', 'form-horizontal');
                                                    $form->get('type')->setValue('c');

                                                ?>
                                                <form method="post" action="<?php echo e(adminUrl(array('controller'=>'lesson','action'=>'add')).'?sessionId='.$session->id.'&back=true'); ?>">
                                                    <?php echo csrf_field(); ?>




                                                    <div class="form-group">
                                                        <?php echo e(formLabel($form->get('name'))); ?>

                                                        <?php echo e(formElement($form->get('name'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('name'))); ?></p>

                                                    </div>


                                                    <div class="form-group" style="display: none;">
                                                        <?php echo e(formLabel($form->get('type'))); ?>

                                                        <?php echo e(formElement($form->get('type'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('type'))); ?></p>

                                                    </div>



                                                    <div class="form-group online">
                                                        <?php echo e(formElement($form->get('test_required'))); ?>  <?php echo e(formLabel($form->get('test_required'))); ?>


                                                        <p class="help-block"><?php echo e(formElementErrors($form->get('test_required'))); ?></p>
                                                        <p class="help-block"><?php echo e(__lang('test-required-help')); ?></p>
                                                    </div>


                                                    <div id="test_id_box" class="form-group online">
                                                        <?php echo e(formLabel($form->get('test_id'))); ?>

                                                        <?php echo e(formElement($form->get('test_id'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('test_id'))); ?></p>

                                                    </div>

                                                    <div class="form-group online">
                                                        <?php echo e(formElement($form->get('enforce_lecture_order'))); ?>   <?php echo e(formLabel($form->get('enforce_lecture_order'))); ?>


                                                        <p class="help-block"><?php echo e(__lang('enforce-lecture-order-help')); ?></p>

                                                    </div>



                                                    <div class="form-group">
                                                        <?php echo e(formLabel($form->get('description'))); ?>

                                                        <?php echo e(formElement($form->get('description'))); ?>


                                                        <p class="help-block"><?php echo e(formElementErrors($form->get('description'))); ?></p>

                                                    </div>

                                                    <div class="form-group online">
                                                        <?php echo e(formLabel($form->get('introduction'))); ?>


                                                        <?php echo e(formElement($form->get('introduction'))); ?>


                                                        <p class="help-block"><?php echo e(formElementErrors($form->get('introduction'))); ?></p>

                                                    </div>


                                                    <div class="form-group">
                                                        <?php echo e(formLabel($form->get('lesson_group_id[]'))); ?>

                                                        <?php echo e(formElement($form->get('lesson_group_id[]'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('lesson_group_id[]'))); ?></p>

                                                    </div>


                                                    <div class="form-group">
                                                        <?php echo e(formLabel($form->get('sort_order'))); ?>

                                                        <?php echo e(formElement($form->get('sort_order'))); ?>   <p class="help-block"><?php echo e(formElementErrors($form->get('sort_order'))); ?></p>

                                                    </div>
                                                    <div class="form-group" style="margin-bottom:10px">

                                                        <label for="image" class="control-label"><?php echo e(__lang('cover-image')); ?> (<?php echo e(__lang('optional')); ?>)</label><br />


                                                        <div class="image"><img data-name="image" src="<?php echo e($display_image); ?>" alt="" id="thumb" /><br />
                                                            <?php echo e(formElement($form->get('picture'))); ?>

                                                            <a class="pointer" onclick="image_upload('image', 'thumb');"><?php echo e(__lang('browse')); ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="pointer" onclick="$('#thumb').attr('src', '<?php echo e($no_image); ?>'); $('#image').attr('value', '');"><?php echo e(__lang('clear')); ?></a></div>

                                                    </div>









                                                    <div class="form-footer">
                                                        <button type="submit" class="btn btn-primary float-right"><?php echo e(__lang('save-changes')); ?></button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div><!--end .box -->
                                    </div><!--end .col-lg-12 -->
                                </div>

                            </div>
                            <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">


                                <div id="classlistbox"></div>


                            </div>
                        </div>













                    </div>


















                </div>

            </div>
        </div>


    </div>
    <script type="text/javascript" src="<?php echo e(basePath()); ?>/client/vendor/pickadate/picker.js"></script>
    <script type="text/javascript" src="<?php echo e(basePath()); ?>/client/vendor/pickadate/picker.date.js"></script>
    <script type="text/javascript" src="<?php echo e(basePath()); ?>/client/vendor/pickadate/picker.time.js"></script>
    <script type="text/javascript" src="<?php echo e(basePath()); ?>/client/vendor/pickadate/legacy.js"></script>
    <script type="text/javascript" src="<?php echo e(asset('client/vendor/ckeditor/ckeditor.js')); ?>"></script>
    <style>
        #selectedTable tr{
            cursor: grabbing;
        }
    </style>
    <script>
        jQuery(function(){

            <?php if($session->lessons()->count()==0): ?>
            $('#addClassModal').modal('show');
            <?php endif;  ?>

            $('#classlistbox').load('<?php echo e(adminUrl(['controller'=>'session','action'=>'browseclasses','id'=>$session->id])); ?>',function(){
                $('.select2').select2();
            });

            $('.date').pickadate({
                format: 'yyyy-mm-dd'
            });

            $("#selectedTable tbody").sortable({ opacity:0.6, update: function() {

                    var counter = 1;
                    //console.log(order);

                    $('.sort_row').each(function(){
                        $(this).find('.sort_cell').text(counter);

                        counter++;
                    });

                    var order = $(this).sortable("serialize") + '&action=sort&_token=<?php echo e(csrf_token()); ?>';
                    console.log(order);
                    $.post("<?php echo e(adminUrl(['controller'=>'session','action'=>'reorder','course'=>$session->id])); ?>",order,function(data){
                        console.log(data);
                    }) }});

            $('.lesson_date').change(function(){
                var date= $(this).val();
                var id = $(this).attr('data-id');
                $.post('<?php echo e(adminUrl(['controller'=>'session','action'=>'setdate','course'=>$session->id])); ?>/'+id,{
                    date:date,
                    '_token': '<?php echo e(csrf_token()); ?>'
                });
            });

        });
    </script>

    <script type="text/javascript">

        CKEDITOR.replace('hcontent', {
            filebrowserBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager',
            filebrowserImageBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager',
            filebrowserFlashBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager'
        });

        CKEDITOR.replace('hintroduction', {
            filebrowserBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager',
            filebrowserImageBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager',
            filebrowserFlashBrowseUrl: '<?php echo e(basePath()); ?>/admin/filemanager'
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
        $(function(){


            if($('select[name=type]').val()!='c'){
                $('.online').hide();
            };

            $('select[name=type]').change(function(){
                if($(this).val()=='c'){
                    $('.online').show();
                }
                else{
                    $('.online').hide();
                }

            });

        });

        $(document).on('click','#pagerlinks a',function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            $('#classlistbox').html(' <img  src="<?php echo e(basePath()); ?>/img/ajax-loader.gif">');

            $('#classlistbox').load(url);
        })
        $(document).on("submit","#filterform", function (event) {
            var $this = $(this);
            var frmValues = $this.serialize();
            $('#classlistbox').html(' <img  src="<?php echo e(basePath()); ?>/img/ajax-loader.gif">');

            $.ajax({
                type: $this.attr('method'),
                url: $this.attr('action'),
                data: frmValues
            })
                .done(function (data) {
                    $('#classlistbox').html(data);
                    $('.select2').select2();
                })
                .fail(function () {
                    $('#classlistbox').text("<?php echo e(__lang('error-occurred')); ?>");
                });
            event.preventDefault();
        });
        //--></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/admin/session/courseclasses.blade.php ENDPATH**/ ?>