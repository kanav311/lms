@extends('layouts.admin')
@section('page-title','')
@section('breadcrumb')
    @include('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            '#'=>isset($pageTitle)?$pageTitle:''
        ]])
@endsection

@section('search-form')
    <form class="form-inline mr-auto" method="get" action="{{ adminUrl(array('controller'=>'video','action'=>'index')) }}">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>
        <div class="search-element">
            <input value="{{ request()->get('filter') }}"   name="filter" class="form-control" type="search" placeholder="{{ __lang('search') }}" aria-label="{{ __lang('search') }}" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </form>
@endsection

@section('content')

    <a class="btn btn-primary" href="{{ adminUrl(array('controller'=>'video','action'=>'add')) }}"><i class="fa fa-plus"></i> {{ __lang('add-video') }}</a>
    <button class="btn btn-success"  data-toggle="collapse" href="#collapseFilter" role="button" aria-expanded="false" aria-controls="collapseFilter"><i class="fa fa-filter"></i> {{ __lang('filter') }}</button>

    <div class="collapse" id="collapseFilter">
        <div class="card card-body">
            <form id="filterform"   role="form"  method="get" action="{{ route('admin.video.index')  }}">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="sr-only" for="filter">{{ __lang('filter') }}</label>
                            {{ formElement($text) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="sr-only" for="group">{{ __lang('sort') }}</label>
                            {{ formElement($sortSelect) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> {{ __lang('filter') }}</button>
                        <button type="button" onclick="$('#filterform input, #filterform select').val(''); $('#filterform').submit();" class="btn btn-success"><i class="fa fa-redo"></i> {{ __lang('clear') }}</button>

                    </div>
                </div>
            </form>
        </div>
    </div>


    <br><br>

    <div>
        <div>
            <div class="box">

                <div class="box-body">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>{{  __lang('id')  }}</th>
                            <th>{{  __lang('thumbnail')  }}</th>
                            <th>{{  __lang('Name')  }}</th>
                            <th>{{ __lang('video_driver') }}</th>

                            @php  if(GLOBAL_ACCESS): @endphp
                            <th>{{  __lang('Created By')  }}</th>
                            @php  endif;  @endphp
                            <th>{{  __lang('Actions')  }}</th>
                        </tr>
                        </thead>
                        <tbody>

                            @php foreach ($paginator as $row): @endphp
                                <tr>
                                    <td><span class="label label-success">{{$row->id}}</span></td>
                                    <td class="pt-1">
                                        @php  $thumb = 'uservideo/'.$row->id.'/'.fileName($row->file_name).'.jpg'; $video = 'uservideo/'.$row->id.'/'.$row->file_name;  @endphp

                                        @php  if(file_exists($thumb)):  @endphp
                                        <img class="img-thumbnail" style="max-width: 100px" src="{{ basePath() }}/uservideo/{{ $row->id  }}/{{ fileName($row->file_name) }}.jpg?rand={{ time() }}" alt="{{ $row->name }}" />
                                        @php  endif;  @endphp

                                        @php  if(!file_exists($thumb)):  @endphp
                                        <strong>{{  __lang('file-missing')  }}</strong>
                                        @php  endif;  @endphp
                                    </td>
                                    <td class="pt-2 pb-2"><strong>{{$row->name}}</strong>

                                        <small>
                                        <div class="row mb-1">
                                            <div class="col-md-6"><strong>{{  __lang('Length')  }}</strong><br>    @php  if(!empty($row->length)): @endphp
                                                {{ $row->length }}
                                                @php  endif;  @endphp</div>
                                            <div class="col-md-6"><strong>{{  __lang('size')  }}</strong><br>              @php  if (!empty($row->file_size)):  @endphp
                                                {{ formatSizeUnits($row->file_size) }}
                                                @php  endif;  @endphp</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6"><strong>{{  __lang('type')  }}</strong><br> {{  strtoupper(@pathinfo($row->file_name)['extension'])  }}</div>
                                            <div class="col-md-6"><strong>{{  __lang('Added On')  }}</strong><br> {{ showDate('d/m/Y',$row->created_at) }}</div>
                                        </div>





                                        </small>
                                    </td>

                                    <td>
                                        {{ $row->location=='r'?'S3':__lang('local') }}
                                    </td>

                                    @php  if(GLOBAL_ACCESS): @endphp
                                    <td>{{adminName($row->admin_id)}}</td>
                                    @php  endif;  @endphp

                                    <td>

                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ __lang('actions') }}
                                            </button>
                                            <div class="dropdown-menu wide-btn">

                                                <a class="dropdown-item" href="{{ adminUrl(['controller'=>'video','action'=>'play','id'=>$row->id]) }}" target="_blank"><i class="fa fa-play"></i> {{  __lang('Play')  }}</a>

                                                <a class="dropdown-item" href="{{ adminUrl(array('controller'=>'video','action'=>'edit','id'=>$row->id)) }}"><i class="fa fa-edit"></i> {{  __lang('Edit')  }}</a>
                                                <a class="dropdown-item" onclick="return confirm('{{ addslashes(__lang('delete-confirm')) }}')" href="{{ adminUrl(array('controller'=>'video','action'=>'delete','id'=>$row->id)) }}"><i class="fa fa-trash"></i> {{  __lang('Delete')  }}</a>

                                            </div>
                                        </div>



                                    </td>
                                </tr>
                            @php endforeach; @endphp


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
                            'controller'=>'video',
                            'action'=>'index',
                            'filter'=>$filter,
                            'sort'=>$sort
                        )
                    );
                     @endphp
                </div><!--end .box-body -->
            </div><!--end .box -->
        </div><!--end .col-lg-12 -->
    </div>

@endsection
