@extends('layouts.admin')
@section('page-title','')
@section('breadcrumb')
    @include('admin.partials.crumb',[
    'crumbs'=>[
            route('admin.dashboard')=>__('default.dashboard'),
            '#'=>isset($pageTitle)?$pageTitle:''
        ]])
@endsection

@section('content')
<div>
			<div >
				<div class="card">
					<div class="card-header">
						<header></header>
                          <a class="btn btn-primary float-right" href="{{ adminUrl(array('controller'=>'assignment','action'=>'add')) }}"><i class="fa fa-plus"></i> Add Homework</a>



					</div>
					<div class="card-body">
						<table class="table table-hover">
							<thead>
								<tr>
                                    <th>{{ __lang('title') }}</th>
									<th>{{ __lang('session-course') }}</th>
                                    <th>{{ __lang('type') }}</th>
									<th>{{ __lang('created-on') }}</th>
                                    <th>{{ __lang('opening-date') }}</th>
                                    <th>{{ __lang('due-date') }}</th>
                                    <th>{{ __lang('submissions') }}</th>
                                    @php if(GLOBAL_ACCESS): @endphp
                                    <th>{{ __lang('created-by') }}</th>
                                    @php endif;  @endphp
									<th   >{{ __lang('actions') }}</th>
								</tr>
							</thead>
							<tbody>
                            @php foreach($paginator as $row):  @endphp
								<tr>
									<td>{{ $row->title }}</td>
                                    <td><span >{{ $row->course_name }}</span></td>
                                    <td>{{($row->schedule_type=='s')? __lang('scheduled'):__lang('post-class') }}</td>
									<td>{{ showDate('d/m/Y',$row->created_at) }}</td>
                                    <td>{{ showDate('d/m/Y',$row->opening_date) }}</td>
                                    <td>{{ showDate('d/m/Y',$row->due_date) }}</td>
								    <td>
                                        {{ $submissionTable->getTotalSubmittedForAssignment($row->id) }} <a class="btn btn-primary btn-sm" href="{{ adminUrl(['controller'=>'assignment','action'=>'submissions','id'=>$row->id]) }}">{{ __lang('view-all') }}</a>
                                        </td>
                                    @php if(GLOBAL_ACCESS): @endphp
                                        <td>{{ adminName($row->admin_id) }}</td>
                                    @php endif;  @endphp
									<td  >
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ __lang('actions') }}
                                            </button>
                                            <div class="dropdown-menu dropleft wide-btn">
                                                <a href="{{ adminUrl(array('controller'=>'assignment','action'=>'edit','id'=>$row->id)) }}" class="dropdown-item" data-toggle="tooltip" data-placement="top" data-original-title=""><i class="fa fa-edit"></i> {{ __lang('edit') }}</a>

                                                <a onclick="return confirm('{{__lang('delete-confirm')}}')" href="{{ adminUrl(array('controller'=>'assignment','action'=>'delete','id'=>$row->id)) }}"  class="dropdown-item"  ><i class="fa fa-trash"></i> {{ __lang('delete') }}</a>
                                                <a onclick="openModal('{{__lang('homework-info')}}','{{ adminUrl(['controller'=>'assignment','action'=>'view','id'=>$row->id]) }}')" href="#" class="dropdown-item"  ><i class="fa fa-info"></i> {{ __lang('info') }}</a>

                                            </div>
                                        </div>



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
		 'action'=>'index',
     )
 );
 @endphp
					</div><!--end .box-body -->
				</div><!--end .box -->
			</div><!--end .col-lg-12 -->
		</div>


        <!-- START SIMPLE MODAL MARKUP --><!-- /.modal -->
<!-- END SIMPLE MODAL MARKUP -->

<script type="text/javascript">
$(function(){
	$('.viewbutton').click(function(){
		 $('#info').text('Loading...');
		 var id = $(this).attr('data-id');
        $('#info').load('{{ url('admin/assignment/view')  }}'+'/'+id);
		});
	});
</script>
@endsection
