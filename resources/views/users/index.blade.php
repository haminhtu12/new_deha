@extends('layouts.master')
@section('content')
    <div class="row" style="padding-top: 15px">
        <div class="col-md-12">
            <!-- Advanced Tables -->

            <div class="panel panel-default">

                <div class="panel-heading">
                    Reg Users
                </div>
                <a class="btn btn-warning float-left"  href="#">All  <span class="badge badge-secondary">$countAll</span></a>
                <a class="btn btn-success float-left" href="#">Active  <span class="badge badge-secondary">$countActive</span></a>
                <a class="btn btn-danger float-left"  href="#">InActive  <span class="badge badge-secondary">$countInActive</span></a>
                <div class="float-right" style="padding-top: 15px ;padding-bottom: 15px" >
                    <form method="get" action="">
                        @csrf
                        {{--                            {{$countActive}}--}}
                        <input type="hidden" name="_method" value="put">
                        <div>
                            <label for="Search">Search:</label>
                            <input type="text" name="search" placeholder="Email or Name"/>
                        </div>
                    </form>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Adress </th>
                                <th>Level</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Created_at </th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;

                            @endphp
                            @foreach($users as $user)
                                @php

                                    $status = 'active';




                                @endphp
                                <tr class="odd gradeX">
                                    <td class="center">{{$i}}</td>
{{--                                    @php--}}
{{--                                        if (isset($search)){--}}
{{--                                        $user->email =  Hightlight::show($search,$user->email);--}}
{{--                                        $user->name =  Hightlight::show($search,$user->name);--}}
{{--                                        }--}}


{{--                                    @endphp--}}
                                    <td class="center">{!!$user->name!!}</td>
                                    <td class="center">{!!$user->email!!}</td>
                                    <td class="center">{{$user->phone}}</td>
                                    <td class="center">{{$user->address}}</td>
                                    <td class="center">{{$user->created_at}}</td>
                                    <td>
                                        <form method="POST" action=""
                                              onsubmit="confirm('Bạn có chắc muốn  thay đổi Status  ? ')">
                                            @csrf
                                            <input type="submit" value="{{$status}}" class="btn btn-success"/>
                                        </form>
                                    </td>
                                    <td></td>
                                    <td class="center">
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#myModal">Edit</button>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#idDelete">Delete</button>
                                        @include('users.modal.delete');

                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach


                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>
    @include('users.modal.edit');

@endsection
