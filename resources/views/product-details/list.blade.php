<div class="table-responsive" id="table" data-action="{{route('product-details.list')}}">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Images</th>
            <th>Detail</th>
            <th>Price</th>
            <th>Status</th>
            <th>Amount</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productDetails as $productDetail)
            <tr class="odd gradeX ">
                <td class="center ">{{$loop->iteration}}</td>
                <td class="center" id="name{{$productDetail->id}}">{{$productDetail->name}}</td>
                <td class="center" id="name{{$productDetail->id}}">@if($productDetail->image != '')
                        <img src="{{asset("images/product_details/$productDetail->image")}}" alt="">@endif</td>

                <td class="center" id="name{{$productDetail->id}}">{{$productDetail->detail}}</td>
                <td class="center" id="name{{$productDetail->id}}">{{$productDetail->price}}</td>
                <td class="center" id="name{{$productDetail->id}}">{{$productDetail->status}}</td>
                <td class="center" id="name{{$productDetail->id}}">{{$productDetail->amount}}</td>
                <td class="center">
                    <button class="btn btn-danger btn-edit-product-detail"
                            data-action="{{route('product-details.edit',$productDetail->id)}}"
                            data-update={{route('product-details.update',$productDetail->id)}} data-toggle="modal"
                            data-target="#editModalProductDetail">Edit
                    </button>

                    <button class="btn btn-primary btn-delete-product-detail" data-toggle="modal"
                            data-target="#modalDeleteProduct"
                            data-delete="{{route('product-details.delete',$productDetail->id)}}">Delete
                    </button>
                </td>
            </tr>
        @endforeach
        @include('products.modal.delete')
        </tbody>
    </table>
    <div>
        {{ $productDetails->links() }}
    </div>

</div>
