<?php $__env->startSection('pageTitle',$pageTitle); ?>
<?php $__env->startSection('innerTitle',$pageTitle); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php echo $__env->make('admin.partials.crumb',[
    'crumbs'=>[
            route('student.dashboard')=>__lang('dashboard'),
            route('student.test.index')=>__lang('tests'),
            '#'=>__lang('take-test')
        ]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container">



 <div class="row">
     <div class="col-md-4">
         <h4><?php echo e(__lang('total-questions')); ?></h4>
         <h1><?php echo e($totalQuestions); ?></h1>
     </div>
     <?php  if(!empty($testRow->minutes)): ?>
     <div class="col-md-4">
         <h4><?php echo e(__lang('time-allowed')); ?></h4>
         <h1><?php echo e($testRow->minutes); ?> <?php echo e(__lang('mins')); ?></h1>
     </div>

     <div class="col-md-4">
         <h4><?php echo e(__lang('time-remaining')); ?></h4>
         <h1><span id="timespan"><?php echo e($testRow->minutes); ?> <?php echo e(__lang('mins')); ?></span></h1>
     </div>
     <?php  endif;  ?>
 </div>


        <form id="testform" method="post" action="<?php echo e(route('student.test.processtest',['id'=>$testRow->id])); ?>">
       <?php echo csrf_field(); ?>     <input id="studentTestId" type="hidden" name="student_test_id" value=""/>
        <div  class="col-md-8   offset-md-2">

            <div class="card card-default" id="intro">
                <div class="card-header">
                    <h3 class="card-title"><?php echo e(__lang('Instructions')); ?></h3>
                </div>
                <div class="card-body">
                   <p><?php echo $testRow->description; ?>   </p>
                    <button type="button" id="start" class="btn btn-primary btn-lg float-right"><?php echo e(__lang('Start Test')); ?></button>
                </div>
            </div>
<?php  $count = 0;  ?>
            <?php  foreach($questions as $id => $question): ?>
<?php  $count++;  ?>
                <div class="card card-default question" id="question<?php echo e($count); ?>">
                    <div class="card-header">
                        <div class="card-title"><h3><?php echo e($count); ?>.</h3> <?php echo $question['question']->question; ?> </div>

                    </div>
                    <div class="card-body">
                        <p >

                            <?php  foreach($question['options'] as $option): ?>


                         <div class="radio">
                            <label style="font-size: 14px">
                                <input type="radio" id="question_op_<?php echo e($option->test_question_id); ?>" name="question_<?php echo e($option->test_question_id); ?>" value="<?php echo e($option->id); ?>"/>

                                <?php echo e($option->option); ?>

                            </label>
                        </div>

                            <?php  endforeach; ?>


                        </p>

                        <?php  if($count > 1): ?>
                        <button type="button" onclick="showPanel('<?php echo e(($count - 1)); ?>')" class="prev btn btn-primary btn-lg "><?php echo e(__lang('Prev')); ?></button>
                        <?php  endif;  ?>

                        <?php  if($count < $totalQuestions): ?>
                        <button  type="button"  onclick="showPanel('<?php echo e($count + 1); ?>')"  class="next btn btn-primary btn-lg float-right"><?php echo e(__lang('Next')); ?></button>
                        <?php  else:  ?>
                         <a onclick="if(confirm('<?php echo e(__lang('submit-test-msg')); ?>')){$('#testform').submit()};" class="btn btn-success btn-lg float-right" href="#testform"><?php echo e(__lang('finish')); ?></a>
                        <?php  endif;  ?>
                    </div>
                </div>
            <?php  endforeach;  ?>

        </div>
        </form>






</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

    <script>
        var interval;
        $('.question').hide();

        $('#start').click(function(){
            $('#start').text('<?php echo e(__lang('Loading')); ?>...');
            $('#start').attr('disabled','disabled');
            $.ajax({
                dataType: "json",
                url: '<?php echo e(route('student.test.starttest',['id'=>$testRow->id])); ?>',
                success: function(data){
                    if(data.status){
                        $('#studentTestId').val(data.id);
                        $('#intro').hide();
                        showPanel(1);
                        window.onbeforeunload = function(){
                            return confirm("<?php echo e(__lang('are-you-sure-cancel-test')); ?>"<?php  if(empty($testRow->allow_multiple)){ echo '+"'.__lang('not-take-again').'"'; }  ?>);
                        }
                        <?php  if(!empty($testRow->minutes)): ?>
                        var minutes = <?php echo e(intval($testRow->minutes)); ?> * 60 ,
                            display = document.querySelector('#timespan');
                        startTimer(minutes, display);
                        <?php  endif;  ?>

                    }
                    else{
                        $('#start').text('<?php echo e(__lang('start-test')); ?>');
                        $('#start').removeAttr('disabled');
                        alert('<?php echo e(__lang('error-try-again')); ?>');

                    }
                }
            }).fail(function() {
                $('#start').text('<?php echo e(__lang('start-test')); ?>');
                $('#start').removeAttr('disabled');
                alert('<?php echo e(__lang('network-error')); ?>');
            });
        });

        function showPanel(id){
            $('.question').hide();
            $('#question'+id).show();
        }
        $(function(){


        });

        function startTimer(duration, display) {
            var start = Date.now(),
                diff,
                minutes,
                seconds;
            function timer() {
                // get the number of seconds that have elapsed since
                // startTimer() was called
                diff = duration - (((Date.now() - start) / 1000) | 0);

                // does the same job as parseInt truncates the float
                minutes = (diff / 60) | 0;
                seconds = (diff % 60) | 0;

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (diff <= 0) {
                    // add one second so that the count down starts at the full duration
                    // example 05:00 not 04:59
                    // start = Date.now() + 1000;
                    console.log('time is up!');
                    $('#testform').submit();
                    clearInterval(interval);
                }
            };
            // we don't want to wait a full second before the timer starts
            timer();
            interval=  setInterval(timer, 1000);
        }



        $('#testform').on('submit',(function(e){

            window.onbeforeunload = function () {
                // blank function do nothing
            }


        }));
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DHRUVESH TRIPATHI\Desktop\base_file_aiipl\resources\views/student/test/taketest.blade.php ENDPATH**/ ?>