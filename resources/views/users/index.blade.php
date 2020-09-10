@extends('layouts.master')
@section('title','users')
@section('content')
    @include('template.header',['title'=>'Manage  Users'])
    @include('users.modal.add')
    @include('users.modal.edit')
    <div class="row" style="padding-top: 15px" >
        <div class="col-md-12">
            <!-- Advanced Tables -->

            <div class="panel panel-default">

                <div class="panel-body">
                    <button class="btn btn-warning float-left" id="btnFilterAllUser" data-action="{{route('user.search','all')}}">All  <span class="badge badge-secondary">8</span></button>
                    <button class="btn btn-success float-left" id="btnFilterActiveUser" data-action="{{route('user.search','active')}}">Active<span class="badge badge-secondary">3</span></button>
                    <button class="btn btn-secondary float-left"  id="btnFilterInActiveUser" data-action="{{route('user.search','inactive')}}">InActive<span class="badge badge-secondary">5</span></button>
                    <div class="float-right" style="padding-top: 15px " >


                            <div>
                                <label for="Search">Search:</label>
                                <input type="text" name="searchUser" placeholder="Email or Name" id="input-search-user" onkeyup="seachUser()" data-action="{{route('user.search')}}"/>
                            </div>

                    </div>
                    <div class="table-responsive" id="table-user" data-action="{{route('user.list')}}">

                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->

        </div>

    </div>
    @push('js')
        <script src="{{ asset('assets/js/user/myjs.js') }}"></script>
    @endpush
@endsection
