@extends('layouts.master')
@section('title','users')
@section('content')
    @include('template.header',['title'=>'Manage  Users'])
    @include('users.modal.add')
    @include('users.modal.edit')
   <div class="container-fluid">
       <div class="row" style="padding-top: 15px" >
           <div class="col-md-12">
               <!-- Advanced Tables -->
               <div class="panel panel-default">

                   <div class="panel-body">
                       <form data-action="{{route('user.search')}}" id="search-form">
                           <div class="row d-flex">
                               <div class="col-3 form-group">
                                   <select name="status" id="user-status" class="form-control btn btn-danger" >
                                       <option value="all" class="btn btn-primary " >All</option>
                                       <option value="active" class="btn btn-success">Active</option>
                                       <option value="inactive" class="btn btn-info">InActive</option>
                                   </select>
                               </div>
                               <div class="col-3 form-group d-flex align-items-center">
                                   <label for="Search " class="m-0" >Name:</label>
                                   <input type="text" name="name" class="ml-2 form-control " placeholder="Email or Name"
                                          id="input-search-user"
                                          data-action="{{route('user.search')}}"/>
                               </div>

                           </div>
                       </form>
                       <div class="table-responsive" id="table-user" data-action="{{route('user.list')}}">

                       </div>

                   </div>
               </div>
               <!--End Advanced Tables -->

           </div>

       </div>
   </div>
    @push('js')
        <script src="{{ asset('assets/js/user/myjs.js') }}"></script>
    @endpush
@endsection
