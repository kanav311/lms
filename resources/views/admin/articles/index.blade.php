@extends('layouts.admin')
@section('breadcrumb')
    @include('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            '#'=>__('default.articles')
        ]])
@endsection
@section('search-form')
    <form class="form-inline mr-auto" method="get" action="{{ url('/admin/articles') }}">
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
@section('pageTitle',__('default.articles'))
@section('innerTitle')
    {{ __('default.manage-articles') }} ({{ $articles->count() }})
    @if(Request::get('search'))
        : {{ Request::get('search') }}
    @endif
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">


            <div class="col-md-12">
                <div >
                    <div  >
                        @can('access','view_articles')
                        <a href="{{ url('/admin/articles/create') }}" class="btn btn-success btn-sm" title="@lang('default.add-new')">
                            <i class="fa fa-plus" aria-hidden="true"></i> @lang('default.add-new')
                        </a>
                        @endcan



                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>@lang('default.title')</th><th>@lang('default.slug')</th>
                                        <th>@lang('default.enabled')</th>
                                        <th>{{ __lang('mobile') }}</th>
                                        <th>@lang('default.actions')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($articles as $item)
                                    <tr>
                                        <td>{{ $loop->iteration + ( (Request::get('page',1)-1) *$perPage) }}</td>
                                        <td>{{ $item->title }}</td><td>{{ $item->slug }}</td>
                                        <td>{{ $item->enabled==1? __('default.enabled'):__('default.disabled') }}</td>
                                        <td>
                                            {{ boolToString($item->mobile) }}
                                        </td>
                                        <td>

                                            <div class="btn-group dropup">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-cogs"></i> @lang('default.actions')
                                                </button>
                                                <div class="dropdown-menu">

                                                    @can('access','view_articles')
                                                    <a class="dropdown-item" href="{{ url('/admin/articles/' . $item->id) }}"><i class="fa fa-eye" aria-hidden="true"></i> @lang('default.view')</a>
                                                    @endcan
                                                    @can('access','edit_article')
                                                    <a class="dropdown-item" href="{{ url('/admin/articles/' . $item->id . '/edit') }}"><i class="fa fa-edit" aria-hidden="true"></i> @lang('default.edit')</a>
                                                    @endcan
                                                    @can('access','delete_article')
                                                    <a class="dropdown-item" href="#"  onclick="$('#{{ $item->id }}-article-form').submit()"><i class="fa fa-trash" aria-hidden="true"></i> @lang('default.delete')</a>
                                                        @endcan

                                                    <div class="dropdown-divider"></div>
                                                    @can('access','view_articles')
                                                    <a target="_blank" class="dropdown-item" href="{{ url('/' . $item->slug) }}"><i class="fa fa-link"></i> @lang('default.link')</a>
                                                    @endcan
                                                </div>
                                            </div>
                                            <form id="{{ $item->id }}-article-form" onsubmit="return confirm('@lang('default.confirm-delete')')" method="POST" action="{{ url('/admin/articles' . '/' . $item->id) }}" accept-charset="UTF-8" class="int_inlinedisp">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                            </form>


                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! clean( $articles->appends(['search' => Request::get('search')])->render() ) !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
