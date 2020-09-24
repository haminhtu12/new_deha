<div class="table-responsive" id="table-category" data-action="{{route('category.list')}}">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example" >
        <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr class="odd gradeX " id="category-warp-{{$category->id}}">
                <td class="center ">{{$loop->iteration}}</td>
                <td class="center" id="name{{$category->id}}">{!!$category->name!!}</td>
                <td class="center">
                    <button class="btn btn-danger btn-edit-category" data-action ="{{route('category.edit',$category->id)}}" data-update= {{route('category.update',$category->id)}} data-toggle="modal" data-target="#editModalCategory">Edit</button>
{{--                    @can('delete_category')--}}
                    <button class="btn btn-primary btn-delete-category" data-toggle="modal" data-target="#modalDeleteCategory" data-delete = "{{route('category.delete',$category->id)}}" >Delete</button>
{{--                    @endcan--}}
                </td>
            </tr>
        @endforeach
        @include('categories.modal.delete')
        </tbody>
    </table>

</div>
