<div class="table-responsive" id="table-user" data-action="{{route('user.list')}}">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example" >
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
        @foreach($users as $user)
            @if($user->level ==0)
                 {{$level ="Admin"}}
            @else
                {{$level ="User"}}
            @endif
            <tr class="odd gradeX " >
                <td class="center ">{{$loop->iteration}}</td>
                <td class="center" id="avatar{{$user->id}}">@if($user->avatar != '')<img src="{{asset("images/avatar/$user->avatar")}}" alt="">@endif</td>
                <td class="center" id="name{{$user->id}}">{!!$user->name!!}</td>
                <td class="center" id="email{{$user->id}}">{!!$user->email!!}</td>
                <td class="center" id="phone{{$user->id}}">{{$user->phone}}</td>
                <td class="center" id="address{{$user->id}}">{{$user->address}}</td>
                <td class="center" id="level{{$user->id}}">{{$level}}</td>
                <td>
                    <form method="POST" action=""
                          onsubmit="confirm('Bạn có chắc muốn  thay đổi Status  ? ')">
                        @csrf
                        <button type="button" id="status{{$user->id}}"  class=" btn {{$user->status =='active'? 'btn-success':'btn-secondary' }} btn-change-status" data-action="{{route('user.changeStatus',$user->id)}}">{{$user->status}}</button>
                    </form>
                </td>
                <td class="center">
                    <button class="btn btn-danger btn-edit-user" data-action ="{{route('user.edit',$user->id)}}" data-update= {{route('user.update',$user->id)}} data-toggle="modal" data-target="#myModal">Edit</button>

                    <button class="btn btn-primary btn-delete-user" data-toggle="modal" data-target="#idDelete" data-delete = "{{route('user.delete',$user->id)}}" >Delete</button>
                </td>
            </tr>
        @endforeach
        @include('users.modal.delete')

        </tbody>
    </table>
</div>
