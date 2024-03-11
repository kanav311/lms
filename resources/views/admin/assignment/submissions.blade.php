@extends('layouts.admin')
@section('page-title','')
@section('breadcrumb')
    @include('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            route('admin.assignment.index')=>__lang('homework'),
            '#'=>__lang('submissions')
        ]])
@endsection

@section('content')
<div>
    <div >
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="far fa-thumbs-up"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __lang('passed') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $passed }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-thumbs-down"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __lang('failed') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $failed }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-chart-bar"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ __lang('average-score') }}</h4>
                            </div>
                            <div class="card-body">
                                {{ $average }}%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">



                </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="dropdown d-inline mr-2">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-download"></i>   {{ __lang('export') }}
                    </button>
                    <div class="dropdown-menu wide-btn">
                        <a class="dropdown-item" href="{{ adminUrl(['controller'=>'assignment','action'=>'exportresult','id'=>$row->id]) }}?type=pass" ><i class="fa fa-thumbs-up"></i> {{ __lang('export-passed') }}</a>
                        <a class="dropdown-item"  href="{{ adminUrl(['controller'=>'assignment','action'=>'exportresult','id'=>$row->id]) }}?type=fail"><i class="fa fa-thumbs-down"></i> {{ __lang('export-failed') }}</a>

                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>{{ __lang('student') }}</th>
                        <th>{{ __lang('Submission Date') }}</th>
                        <th>{{ __lang('grade') }}</th>
                        <th>{{ __lang('status') }}</th>
                        <th class="text-right1" >{{ __lang('actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php foreach($paginator as $row):  @endphp
                        <tr>
                            <td>{{ $row->first_name.' '.$row->last_name }}</td>
                            <td><span >{{ showDate('d/m/Y',$row->updated_at) }}</span></td>
                            <td>
                                @php if(!is_null($row->grade)): @endphp
                                {{ $row->grade }}%
                            @php endif;  @endphp
                            </td>
                            <td>
                               {{ ($row->editable==1)? __lang('ungraded'):__lang('graded') }}
                            </td>

                            <td class="text-right1">
                                <a class="btn btn-primary" href="{{ adminUrl(['controller'=>'assignment','action'=>'viewsubmission','id'=>$row->id]) }}"><i class="fa fa-info-circle"></i> {{ __lang('view-entry') }}</a>
                            </td>
                        </tr>
                    @php endforeach;  @endphp

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
                    array(
                        'route' => 'admin/default',
                        'controller'=>'assignment',
                        'action'=>'submissions',
                        'id'=>$id
                    )
                );
                @endphp
            </div><!--end .box-body -->
        </div><!--end .box -->
    </div><!--end .col-lg-12 -->
</div>


<!-- START SIMPLE MODAL MARKUP --><!-- /.modal -->
<!-- END SIMPLE MODAL MARKUP -->

@endsection
