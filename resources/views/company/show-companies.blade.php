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
                            Showing All Companies
                        </span>

                        <div class="btn-group pull-right btn-group-xs">
                            <a class="dropdown-item" href="/company/create">
								<i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
								Add New Company
							</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive users-table">
                        <table class="table table-striped table-sm data-table">
                            <caption id="user_count">
                                
                            </caption>
                            <thead class="thead">
                                <tr>
                                    <th>{!! trans('usersmanagement.users-table.id') !!}</th>
                                    <th>Full Name</th>
                                    <th class="hidden-xs">{!! trans('usersmanagement.users-table.email') !!}</th>
                                    <th class="hidden-xs">Logo</th>
                                    <th class="hidden-sm hidden-xs hidden-md">{!! trans('usersmanagement.users-table.created') !!}</th>
                                    <th class="hidden-sm hidden-xs hidden-md">{!! trans('usersmanagement.users-table.updated') !!}</th>
                                    <th>{!! trans('usersmanagement.users-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                            </thead>
                            <tbody id="users_table">
                                @foreach($companies as $company)
                                <tr>
                                    <td>{{$company->id}}</td>
                                    <td>{{$company->fullName}}</td>
                                    <td class="hidden-xs"><a href="mailto:{{ $company->email }}" title="email {{ $company->email }}">{{ $company->email }}</a></td>
                                    <td class="hidden-xs"><img src="{{ $company->logo }}"/></td>
                                    
                                    <td class="hidden-sm hidden-xs hidden-md">{{$company->created_at}}</td>
                                    <td class="hidden-sm hidden-xs hidden-md">{{$company->updated_at}}</td>
                                    <td>
                                        {!! Form::open(array('url' => 'company/' . $company->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::button("Delete", array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Company', 'data-message' => 'Are you sure you want to delete this company ?')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('company/' . $company->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tbody id="search_results"></tbody>
                        </table>

                        

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
