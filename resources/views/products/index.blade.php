@extends('layouts.master')
@section('title','Products')
@section('content')
    <div class="row pad-botm">
        <div class="col-md-12">
            <div id="openFormAdd" class="float-right"><button class="btn btn-primary float-right" data-toggle="modal" data-target="#addModalProduct" data-list = {{route('products.list')}}>Thêm Mới</button>
            </div>
            <h4 class="header-line">Product Mananger</h4>
        </div>
    </div>
    @include('products.modal.add')
{{--    @include('products.modal.edit')--}}
    <div class="row" style="padding-top: 15px" >
        <div class="col-md-12">
            <!-- Advanced Tables -->

            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="table-product" data-action="{{route('products.list')}}">

                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>
    @include('products.modal.edit')
    @push('js')
        <script src="{{ asset('assets/js/product/myjs.js') }}"></script>
    @endpush
@endsection
