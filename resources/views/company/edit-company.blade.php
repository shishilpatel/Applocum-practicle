@extends('layouts.app')

@section('template_title')
{!! trans('usersmanagement.editing-user', ['name' => $company->fullName]) !!}
@endsection

@section('template_linked_css')
<style type="text/css">
    .btn-save,
    .pw-change-container {
        display: none;
    }
</style>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        {!! trans('usersmanagement.editing-user', ['name' => $company->name]) !!}
                        <div class="pull-right">
                            <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                {!! trans('usersmanagement.buttons.back-to-users') !!}
                            </a>
                            <a href="{{ url('/users/' . $company->id) }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                {!! trans('usersmanagement.buttons.back-to-user') !!}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    {!! Form::open(array('route' => ['company.update', $company->id], 'method' => 'PUT', 'files' => true, 'role' => 'form', 'class' => 'needs-validation')) !!}

                    {!! csrf_field() !!}

                    <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                        {!! Form::label('fullName', 'Full Name', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('fullName', $company->fullName, array('id' => 'fullName', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_username'))) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="name">
                                        <i class="fa fa-fw {{ trans('forms.create_user_icon_username') }}" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                        {!! Form::label('email', trans('forms.create_user_label_email'), array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('email', $company->email, array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_email'))) !!}
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

                    <div class="form-group has-feedback row {{ $errors->has('logo') ? ' has-error ' : '' }}">
                        {!! Form::label('logo', 'Company Logo', array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::file('logo' , array('id' => 'logo', 'class' => 'form-control')) !!}

                            </div>
                            @if ($errors->has('logo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('logo') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6 mb-2">
                            
                        </div>
                        <div class="col-12 col-sm-6">
                            {!! Form::button(trans('forms.save-changes'), array('class' => 'btn btn-success btn-block margin-bottom-1 mt-3 mb-2 btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => trans('modals.edit_user__modal_text_confirm_title'), 'data-message' => trans('modals.edit_user__modal_text_confirm_message'))) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
</div>

@include('modals.modal-save')
@include('modals.modal-delete')

@endsection

@section('footer_scripts')
@include('scripts.delete-modal-script')
@include('scripts.save-modal-script')
@include('scripts.check-changed')
@endsection
