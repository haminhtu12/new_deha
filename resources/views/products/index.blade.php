@extends('layouts.master')
@section('title','Products')
@section('content')
    @include('template.header',['title'=>'Manage  Product'])
{{--    @include('products.modal.add')--}}
{{--    @include('products.modal.edit')--}}
    <div class="row" style="padding-top: 15px" >
        <div class="col-md-12">
            <!-- Advanced Tables -->

            <div class="panel panel-default">

                <div class="panel-body">
{{--                    <button class="btn btn-warning float-left" id="btnFilterAllProduct" data-action="{{route('product.filter','all')}}">All  <span class="badge badge-secondary">8</span></button>--}}
{{--                    <button class="btn btn-success float-left" id="btnFilterActiveProduct" data-action="{{route('product.filter','active')}}">Active<span class="badge badge-secondary">3</span></button>--}}
{{--                    <button class="btn btn-secondary float-left"  id="btnFilterInActiveProduct" data-action="{{route('product.filter','inactive')}}">InActive<span class="badge badge-secondary">5</span></button>--}}
                    <div class="float-right" style="padding-top: 15px " >


                            <div>
                                <label for="Search">Search:</label>
                                <input type="text" name="searchProduct" placeholder="Email or Name" id="input-search-Product" onkeyup="seachProduct()" data-action="{{route('products.search')}}"/>
                            </div>

                    </div>
                    <div class="table-responsive" id="table-Product" data-action="{{route('products.list')}}">

                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>
@endsection
