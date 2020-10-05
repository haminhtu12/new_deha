<div class="modal fade" id="editModalProductDetail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->

            <div class="modal-header">
                <h4 class="modal-title" id="editProductDetailModal">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                @include('users.error')
                <form class="form-horizontal" method="post" id="edit-product-detail-form" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>Product Detail Name</h4></label>
                                </div>
                                <div class="col-md-4 col-lg-4 inputGroupContainer">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-account"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="editName" name="name" class="form-control"
                                               placeholder="Product Detail">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>Product </h4></label>
                                </div>
                                <div class="col-md-4 col-lg-4 inputGroupContainer">

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <select name="product_id" id="edit_product_id" class="form-control">
                                                    @foreach ($products as $product)
                                                        <option
                                                            value="{{ $product->id  }}">{{ $product->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>Detail</h4></label>
                                </div>
                                <div class="col-md-4 col-lg-4 inputGroupContainer">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-account"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="edit_detail" name="detail" class="form-control"
                                               placeholder="Detail">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>Price</h4></label>
                                </div>
                                <div class="col-md-4 col-lg-4 inputGroupContainer">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-account"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="edit_price" name="price" class="form-control"
                                               placeholder="Price">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>Amount</h4></label>
                                </div>
                                <div class="col-md-4 col-lg-4 inputGroupContainer">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-account"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="edit_amount" name="amount" class="form-control"
                                               placeholder="Amount ">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 col-lg-4">
                                    <label class="control-label pull-right"><h4>Image</h4></label>
                                </div>
                                <div class="col-md-4 col-lg-4 inputGroupContainer">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="mdi mdi-account"></i>
                                            </span>
                                        </div>
                                        <input type="file" id="edit_image" name="image" class="form-control"
                                               placeholder="Images ">
                                    </div>

                                </div>
                                <div >
                                    <img  alt="" id="img" class="img-thumbnail target-img">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-md-4 col-lg-4 control-label"></label>
                                <div class="col-md-4 col-lg-4">
                                    <button type="button" class="btn btn-danger  raised" id="edit-submit-product-detail">
                                        Submit
                                        <i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cancell-submit-edit" data-dismiss="modal">Close
                </button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
</div>

