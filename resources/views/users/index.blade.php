@extends('layouts.master')
@section('title','users')
@section('content')
{{--    @include('template.header',['link'=>route(),'title'=>'Manage Reg Users'])--}}
    @include('template.header',['title'=>'Manage  Users'])
    @include('users.modal.add')
    @include('users.modal.edit')
    <div class="row" style="padding-top: 15px" >
        <div class="col-md-12">
            <!-- Advanced Tables -->

            <div class="panel panel-default">

                <div class="panel-body">
                    <a class="btn btn-warning float-left"  href="#">All  <span class="badge badge-secondary">8</span></a>
                    <a class="btn btn-success float-left" href="#">Active  <span class="badge badge-secondary">3</span></a>
                    <a class="btn btn-danger float-left"  href="#">InActive  <span class="badge badge-secondary">5</span></a>
                    <div class="float-right" style="padding-top: 15px " >
                        <form method="get" action="">
                            @csrf
                            <input type="hidden" name="_method" value="put">
                            <div>
                                <label for="Search">Search:</label>
                                <input type="text" name="search" placeholder="Email or Name"/>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive" id="table-user" data-action="{{route('user.list')}}">

                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>

@endsection
