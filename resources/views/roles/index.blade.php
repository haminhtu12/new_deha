@extends('layouts.master')
@section('title','Roles')
@section('content')
    <div class="row pad-botm">
        <div class="col-md-12">
            <div id="openFormAddRole" class="float-right">
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addModalRole"
                        data-list= {{route('roles.list')}}>Thêm Mới
                </button>
            </div>
            <h4 class="header-line">Roles Mananger</h4>
        </div>
    </div>
    @include('roles.modal.edit')
    <div class="row" style="padding-top: 15px">
        <div class="col-md-12">
            <!-- Advanced Tables -->

            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="table" data-action="{{route('roles.list')}}">

                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>
    @include('roles.modal.add')
    @push('js')
        <script src="{{ asset('assets/js/role/role.js') }}"></script>
    @endpush
@endsection
