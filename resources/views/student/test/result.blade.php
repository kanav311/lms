@extends('layouts.student')
@section('pageTitle',$pageTitle)
@section('innerTitle',$pageTitle)
@section('breadcrumb')
    @include('admin.partials.crumb',[
    'crumbs'=>[
            route('student.dashboard')=>__lang('dashboard'),
            route('student.test.index')=>__lang('tests'),
            '#'=>$pageTitle
        ]])
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7 offset-3">
            <div class="card">

                <div class="card-body">
                    <div class="container">
                        @php  if($testRow->show_result==1): @endphp
                        <div class="row">
                            <div class="col-md-4 col-md-offset-3">
                                <h4>{{  __lang('your-score')  }}</h4>
                                <h1>{{  $row->score  }}%</h1>
                            </div>
                            <div class="col-md-4">
                                <h4>{{  __lang('passmark')  }}</h4>
                                <h1>{{  $testRow->passmark  }}%</h1>
                            </div>
                        </div>

                        <div id="testresult" class="row" style="text-align: center; margin-top: 30px">

                            @php  if($row->score >= $testRow->passmark ):  @endphp
                            <h1 style="color:green">{{  __lang('you-passed-test')  }}</h1>
                            @php  else:  @endphp
                            <h1 style="color:red">{{  __lang('you-failed-test')  }}</h1>
                            @php  endif;  @endphp

                        </div>
                        @php  else:  @endphp
                        <div class="row">
                            <h4>{{  __lang('you-completed-test')  }}</h4>
                        </div>

                        @php  endif;  @endphp

                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
