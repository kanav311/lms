@extends('layouts.student')
@section('pageTitle',$pageTitle)
@section('innerTitle',$pageTitle)
@section('breadcrumb')
    @include('admin.partials.crumb',[
    'crumbs'=>[
            route('student.dashboard')=>__lang('dashboard'),
            '#'=>$pageTitle
        ]])
@endsection

@section('content')

    <div >
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>{{  __lang('title')  }}</th>
                        <th>{{  __lang('course')  }}</th>
                        <th>{{  __lang('created-on')  }}</th>
                        <th>{{  __lang('due-date')  }}</th>
                        <th class="text-right1" ></th>
                    </tr>
                    </thead>
                    <tbody>
                    @php  foreach($paginator as $row):  @endphp
                        <tr>
                            <td>{{  $row->title }}</td>
                            <td><span >{{  $row->course_name  }}</span></td>
                            <td>{{  showDate('d/M/Y',$row->created_at) }}</td>
                            <td>{{  showDate('d/M/Y',$row->due_date) }}</td>

                            <td class="text-right1">
                                <a class="btn btn-primary" href="{{  route('student.assignment.submit',['id'=>$row->assignment_id]) }}"><i class="fa fa-file"></i> {{  __lang('submit-homework')  }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="readmorebox" colspan="5">

                                <article class="readmore">
                                    {!! clean($row->instruction) !!}
                                </article>
                            </td>
                        </tr>
                    @php  endforeach;  @endphp

                    </tbody>
                </table>

                @php
                // add at the end of the file after the table
                echo paginationControl(
                // the paginator object
                    $paginator,
                    // the scrolling style
                    'sliding',
                    // the partial to use to render the control
                   null,
                    // the route to link to when a user clicks a control link
                    route('student.assignment.index')
                );
                 @endphp
            </div><!--end .box-body -->
        </div>
    </div>


@endsection


@section('footer')
    <script type="text/javascript" src="{{ asset('client/vendor/readmore/readmore.min.js') }}"></script>
    <script>
        $(function(){
            $('article.readmore').readmore({
                collapsedHeight : 200
            });
        });
    </script>
@endsection
