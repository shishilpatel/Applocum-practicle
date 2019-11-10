@extends('layouts.app')

@section('template_title')
{!! trans('usersmanagement.create-new-user') !!}
@endsection

@section('template_fastload_css')
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        Add New Company
                        <div class="pull-right">
                            <a href="/employee" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('Back to Companies') }}">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                Back to Employee
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    {!! Form::open(array('route' => 'employee.store', 'method' => 'POST', 'role' => 'form', 'files' => true, 'class' => 'needs-validation')) !!}

                    {!! csrf_field() !!}

                    <div class="form-group has-feedback row {{ $errors->has('fullName') ? ' has-error ' : '' }}">
                        {!! Form::label('first_name', "Full Name", array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('fullName', NULL, array('id' => 'fullName', 'class' => 'form-control', 'placeholder' => "Enter Full Name")) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="first_name">
                                        <i class="fa fa-fw {{ trans('forms.create_user_icon_firstname') }}" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('first_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fullName') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                        {!! Form::label('email', trans('forms.create_user_label_email'), array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => "Enter email ID of Employee")) !!}
                                <div class="input-group-append">
                                    <label for="email" class="input-group-text">
                                        <i class="fa fa-fw {{ trans('forms.create_user_icon_email') }}" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group has-feedback row {{ $errors->has('company') ? ' has-error ' : '' }}">
                        {!! Form::label('company','Company', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {{  Form::select('company', $companies, null, ['class' => 'required form-control select2','id'=>'company']) }} 
                                <div class="input-group-append">
                                    <label for="email" class="input-group-text">
                                        <i class="fa fa-fw {{ trans('forms.create_user_icon_email') }}" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    
                      
                    <div class="form-group has-feedback row {{ $errors->has('phone') ? ' has-error ' : '' }}">
                        {!! Form::label('phone', 'Phone', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('phone', NULL, array('id' => 'phone', 'class' => 'form-control', 'placeholder' => 'Phone number of employee')) !!}
                                <div class="input-group-append">
                                    <label for="email" class="input-group-text">
                                        <i class="fa fa-fw {{ trans('forms.create_user_icon_email') }}" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    {!! Form::button("Create New Employee", array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_scripts')
@endsection
