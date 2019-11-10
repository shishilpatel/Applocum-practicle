@extends('layouts.app')

@section('template_title')
{!! trans('usersmanagement.showing-user', ['name' => $employee->name]) !!}
@endsection

@section('content')

@role('company')

@endrole

<div class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">

            <div class="card">

                <div class="card-header text-white @if ($employee->activated == 1) bg-success @else bg-danger @endif">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        {{ $employee->fullName. ' Information'}}
                        <div class="float-right">
                            <a href="/employee" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                                <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                Back to Employee List
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-4 offset-sm-2 col-md-2 offset-md-3">
                            <img src="@if ($employee->profile && $employee->profile->avatar_status == 1) {{ $employee->profile->avatar }} @else {{ Gravatar::get($employee->email) }} @endif" alt="{{ $employee->name }}" class="rounded-circle center-block mb-3 mt-4 user-image">
                        </div>
                        <div class="col-sm-4 col-md-6">
                            <h4 class="text-muted margin-top-sm-1 text-center text-left-tablet">
                                {{ $employee->fullName }}
                            </h4>
                            <p class="text-center text-left-tablet">
                                <strong>
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                </strong>
                                @if($employee->email)
                                <br />
                                <span class="text-center" data-toggle="tooltip" data-placement="top" title="{{ trans('usersmanagement.tooltips.email-user', ['user' => $employee->email]) }}">
                                    {{ Html::mailto($employee->email, $employee->email) }}
                                </span>
                                @endif
                            </p>
                            @if ($employee->profile)
                            <div class="text-center text-left-tablet mb-4">
                                <a href="{{ url('/profile/'.$employee->name) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.viewProfile') }}">
                                    <i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md"> {{ trans('usersmanagement.viewProfile') }}</span>
                                </a>
                                <a href="/users/{{$employee->id}}/edit" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="{{ trans('usersmanagement.editUser') }}">
                                    <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md"> {{ trans('usersmanagement.editUser') }} </span>
                                </a>
                                {!! Form::open(array('url' => 'users/' . $employee->id, 'class' => 'form-inline', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => trans('usersmanagement.deleteUser'))) !!}
                                {!! Form::hidden('_method', 'DELETE') !!}
                                {!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md">' . trans('usersmanagement.deleteUser') . '</span>' , array('class' => 'btn btn-danger btn-sm','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user?')) !!}
                                {!! Form::close() !!}
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="border-bottom"></div>

                    @if ($employee->phone)

                    <div class="col-sm-5 col-6 text-larger">
                        <strong>
                            Contact Number
                        </strong>
                    </div>

                    <div class="col-sm-7">
                        {{ $employee->phone }}
                    </div>

                    <div class="clearfix"></div>
                    <div class="border-bottom"></div>

                    @endif

                    @if ($employee->email)

                    <div class="col-sm-5 col-6 text-larger">
                        <strong>
                            {{ trans('usersmanagement.labelEmail') }}
                        </strong>
                    </div>

                    <div class="col-sm-7">
                        <span data-toggle="tooltip" data-placement="top" title="{{ trans('usersmanagement.tooltips.email-user', ['user' => $employee->email]) }}">
                            {{ HTML::mailto($employee->email, $employee->email) }}
                        </span>
                    </div>

                    <div class="clearfix"></div>
                    <div class="border-bottom"></div>

                    @endif            
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.modal-delete')

@endsection

@section('footer_scripts')
@include('scripts.delete-modal-script')
@if(config('usersmanagement.tooltipsEnabled'))
@include('scripts.tooltips')
@endif
@endsection
