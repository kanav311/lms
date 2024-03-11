@extends('layouts.admin')
@section('page-title','')
@section('breadcrumb')
    @include('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            route('admin.certificate.index')=>__lang('certificates'),
            '#'=>isset($pageTitle)?$pageTitle:''
        ]])
@endsection

@section('content')


<div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{__lang('student')}}</th>
                <th>{{__lang('tracking-number')}}</th>
                <th>{{__lang('downloaded-on')}}</th>
            </tr>
        </thead>

        <tbody>

        @foreach($students as $student)

            <tr>
                <td><a class="viewbutton" style="text-decoration: underline"   data-id="{{ $student->student_id }}" data-toggle="modal" data-target="#simpleModal" href="">{{ $student->student->user->name }} {{ $student->student->user->last_name }}</a></td>
                <td>{{ $student->tracking_number }}</td>
                <td>{{ showDate('d/M/Y',$student->created_at) }}</td>
            </tr>

        @endforeach

        </tbody>

    </table>

</div>
<div>
    {{ $students->links() }}
</div>


@endsection

@section('footer')
    <!-- START SIMPLE MODAL MARKUP -->
    <div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title" id="simpleModalLabel">{{__lang('student-details')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body" id="info">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">{{__lang('close')}}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- END SIMPLE MODAL MARKUP -->

    <script type="text/javascript">
        $(function(){
            $('.viewbutton').click(function(){
                $('#info').text('Loading...');
                var id = $(this).attr('data-id');
                $('#info').load('{{ url('admin/student/view') }}'+'/'+id);
            });
        });
    </script>

@endsection
