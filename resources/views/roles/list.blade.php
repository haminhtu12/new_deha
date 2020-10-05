<div class="table-responsive" id="table" data-action="{{route('roles.list')}}">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example" >
        <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr class="odd gradeX " >
                <td class="center ">{{$loop->iteration}}</td>
                <td class="center" id="name{{$role->id}}">{!!$role->name!!}</td>
                <td class="center" id="name{{$role->id}}">{!!$role->description!!}</td>
                <td class="center">
                    <button class="btn btn-danger btn-edit-role" data-action ="{{route('role.edit',$role->id)}}" data-update= {{route('role.update',$role->id)}} data-toggle="modal" data-target="#editModalRole">Edit</button>

                    <button class="btn btn-primary btn-delete-role" data-toggle="modal" data-target="#modalDeleteRole" data-delete = "{{route('role.delete',$role->id)}}" >Delete</button>
                </td>
            </tr>
        @endforeach
        @include('roles.modal.delete')
        </tbody>
    </table>
</div>
