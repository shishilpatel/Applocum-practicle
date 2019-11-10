@extends('layouts.app')

@section('template_title')
{!! trans('usersmanagement.showing-all-users') !!}
@endsection

@section('template_linked_css')
@if(config('usersmanagement.enabledDatatablesJs'))
<link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
@endif
<style type="text/css" media="screen">
    .users-table {
        border: 0;
    }
    .users-table tr td:first-child {
        padding-left: 15px;
    }
    .users-table tr td:last-child {
        padding-right: 15px;
    }
    .users-table.table-responsive,
    .users-table.table-responsive table {
        margin-bottom: 0;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">

                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            @role('admin')
                            Showing All Employee
                            @endrole
                            @role('company')
                            Showing All Employee of company
                            @endrole
                        </span>

                        <div class="btn-group pull-right btn-group-xs">
                            <a class="dropdown-item" href="/employee/create">
                                <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                Create New Employee
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive users-table">
                        <table class="table table-striped table-sm data-table">
                            <caption id="user_count">
                                {{ $employees->count() . ' Employee Total' }}
                            </caption>
                            <thead class="thead">
                                <tr>
                                    <th>{!! trans('usersmanagement.users-table.id') !!}</th>
                                    <th>Full Name</th>
                                    <th class="hidden-xs">{!! trans('usersmanagement.users-table.email') !!}</th>
                                    <th class="hidden-xs">Phone</th>
                                    <th>{!! trans('usersmanagement.users-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                            </thead>
                            <tbody id="users_table">
                                @foreach($employees as $employee)
                                <tr>
                                    <td>{{$employee->id}}</td>
                                    <td>{{$employee->fullName}}</td>
                                    <td class="hidden-xs"><a href="mailto:{{ $employee->email }}" title="email {{ $employee->email }}">{{ $employee->email }}</a></td>
                                    <td class="hidden-xs">{{$employee->phone}}</td>
                                    <td>
                                        {!! Form::open(array('url' => 'employee/' . $employee->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this employee ?')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('employee/' . $employee->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                            {!! trans('usersmanagement.buttons.edit') !!}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tbody id="search_results"></tbody>
                        </table>

                        @if(config('usersmanagement.enablePagination'))
                        
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modals.modal-delete')

@endsection

@section('footer_scripts')

@include('scripts.delete-modal-script')
@include('scripts.save-modal-script')
@if(config('usersmanagement.tooltipsEnabled'))
@include('scripts.tooltips')
@endif
@endsection
