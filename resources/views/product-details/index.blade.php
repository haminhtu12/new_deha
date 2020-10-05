@extends('layouts.master')
@section('title','Product-Details')
@section('content')
    <div class="row pad-botm">
        <div class="col-md-12">
            <div id="openFormAdd" class="float-right">
                <button class="btn btn-primary float-right" data-toggle="modal" data-target="#addModalProductDetail"
                        data-list= {{route('product-details.list')}}>Thêm Mới
                </button>
            </div>
            <h4 class="header-line">Product Detail Mananger</h4>
        </div>
    </div>
    @include('product-details.modal.add')
    @include('product-details.modal.edit')
    <div class="row" style="padding-top: 15px">
        <div class="col-md-12">
            <!-- Advanced Tables -->

            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="table"
                         data-action="{{route('product-details.list')}}">

                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>
    {{--    @include('products.modal.edit')--}}
    @push('js')
        <script src="{{ asset('assets/js/productdetail/productdetai.js') }}"></script>
    @endpush
@endsection
