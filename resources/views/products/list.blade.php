<div class="table-responsive" id="table-product" data-action="{{route('products.list')}}">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example" >
        <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Category_id</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr class="odd gradeX " >
                <td class="center ">{{$loop->iteration}}</td>
                <td class="center" id="name{{$product->id}}">{!!$product->name!!}</td>
                <td class="center" id="name{{$product->id}}">{!!$product->category_id!!}</td>
                <td class="center">
{{--                    @can("edit-product")--}}
{{--                    @endcan--}}
{{--                        --}}

                    <button class="btn btn-danger btn-edit-product" data-action ="{{route('product.edit',$product->id)}}" data-update= {{route('product.update',$product->id)}} data-toggle="modal" data-target="#editModal">Edit</button>

                    <button class="btn btn-primary btn-delete-product" data-toggle="modal" data-target="#modalDeleteProduct" data-delete = "{{route('product.delete',$product->id)}}" >Delete</button>

                </td>
            </tr>
        @endforeach
        @include('products.modal.delete')
        </tbody>
    </table>
</div>
