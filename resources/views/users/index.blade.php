@extends('layouts.master')
@section('content')
{{--    @include('template.header',['link'=>route('suser'),'title'=>'Manage Reg Users'])--}}
    <div class="row" style="padding-top: 15px">
        <div class="col-md-12">
            <!-- Advanced Tables -->

            <div class="panel panel-default">

                <div class="panel-heading">
                    Reg Users
                </div>
                <a class="btn btn-warning float-left"  href="#">All  <span class="badge badge-secondary">8</span></a>
                <a class="btn btn-success float-left" href="#">Active  <span class="badge badge-secondary">3</span></a>
                <a class="btn btn-danger float-left"  href="#">InActive  <span class="badge badge-secondary">5</span></a>
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
                                <th>Avatar </th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Adress </th>
                                <th>Level</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 1;

                            @endphp
                            @foreach($users as $user)
                                @php
                                    if ($user->level ==0){
                                        $level ="Admin";
                                    }else{
                                        $level ="User";
                                    }

                                @endphp
                                <tr class="odd gradeX">
                                    <td class="center">{{$loop->iteration}}</td>
{{--                                    @php--}}
{{--                                        if (isset($search)){--}}
{{--                                        $user->email =  Hightlight::show($search,$user->email);--}}
{{--                                        $user->name =  Hightlight::show($search,$user->name);--}}
{{--                                        }--}}


{{--                                    @endphp--}}
                                    <td class="center" id="rootAvatar">{{$user->avatar}}</td>
                                    <td class="center" id="rootName">{!!$user->name!!}</td>
                                    <td class="center" id="rootEmail">{!!$user->email!!}</td>
                                    <td class="center" id="rootPhone">{{$user->phone}}</td>
                                    <td class="center" id="rootAddress">{{$user->address}}</td>
                                    <td class="center" id="rootLevel">{{$level}}</td>
                                    <td>
                                        <form method="POST" action=""
                                              onsubmit="confirm('Bạn có chắc muốn  thay đổi Status  ? ')">
                                            @csrf
                                            <input type="submit" value="{{$user->status}}" class="btn btn-success" id="rootStatus"/>
                                        </form>
                                    </td>
                                    <td class="center">
                                        <button class="btn btn-danger btn-edit-user" data-action ="{{route('user.edit',$user->id)}}" data-update= {{route('user.update',$user->id)}} data-toggle="modal" data-target="#myModal">Edit</button>

                                        <button class="btn btn-primary" data-toggle="modal" data-target="#idDelete">Delete</button>
                                        @include('users.modal.delete');
                                    </td>


                                </tr>


                                @php
                                    $i++;
                                @endphp
                            @endforeach


                            </tbody>
                            @include('users.modal.edit');
                        </table>
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>
    <script>
        $(document).ready(function (){
            let urlUpdate = '';
            $(".btn-edit-user").click(function (){
                urlUpdate = $(this).data('update');
                let url = $(this).data('action');
                $.get(url,(data)=>{
                    let {user} = data;
                    fillUserToModal(user);
                })
            });
            $(document).on('click','#edit-submit',function (e){
                e.preventDefault();
                let data =  new FormData($('#contact_form')[0]);
                callUserApi(urlUpdate,data,'POST')
                    .then((res)=>{
                        console.log(res.user.name);
                        $('#myModal').modal('hide');
                        $('#rootName').text(res.user.name)
                        $('#rootEmail').text(res.user.email)
                        $('#rootPhone').text(res.user.phone)
                        $('#rootAddress').text(res.user.address)
                        console.log($('#rootStatus').val());
                        $('.rootStatus').val(res.user.status)
                        $('#rootAvatar').text(res.user.avatar)

                    })
            })

            $(document).on('click','',function () {

            })
        });

        function callUserApi(url, data ='', method = 'get') {
            return $.ajax({
                url: url,
                data: data,
                method:method,
                processData: false,
                contentType: false,
            });
        }

        function fillUserToModal(user)
        {
            $('#editUserModalTitle').html(`Edit ${user.name}`);
            $('#name').val(user.name)
            $('#email').val(user.email)
            $('#phone').val(user.phone)
            $('#address').val(user.address)
            $('#status').val(user.status)
            $('#avatar').val(user.avatar)
        }
    </script>
@endsection
