@extends('layouts.master')
@section('title','Categories')
@section('content')
    <div class="row pad-botm">
        <div class="col-md-12">
            <div id="openFormAdd" class="float-right"><button class="btn btn-primary float-right" data-toggle="modal" data-target="#addModalCategory" data-list = {{route('category.list')}}>Thêm Mới</button>
            </div>
            <h4 class="header-line">Category Mananger</h4>
        </div>
    </div>
    @include('categories.modal.add')
{{--    @include('products.modal.edit')--}}
    <div class="row" style="padding-top: 15px" >
        <div class="col-md-12">
            <!-- Advanced Tables -->

            <div class="panel panel-default">

                <div class="panel-body">
                   <div class="table-responsive" id="table-category" data-action="{{route('category.list')}}">
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>
    @include('categories.modal.edit')
    @push('js')
        <script src="{{ asset('assets/js/category/category.js') }}"></script>
    @endpush
@endsection
