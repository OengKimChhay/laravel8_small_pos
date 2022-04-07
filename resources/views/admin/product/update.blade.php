@extends('admin.dashboard')
@section('title','Products')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <!-- for error info -->
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}
                    </div>
                    <a href="{{route('products.index')}}">All Products</a>
                    @elseif(Session::has('fail'))
                    <div class="alert alert-warning" role="alert">
                        {{Session::get('fail')}}
                    </div>
                    @endif
                    <!-- end error info -->
                    <!-- form edit prodcut -->
                    <div class="table-responsive-lg">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                               <h3>Edit Products</h3>
                            </thead>
                            <tbody>
                                <form method="POST" action="{{route('products.update',$proEdit->id)}}">
                                @csrf
                                @method('put')
                                    <div class="form-group">
                                    <tr>
                                        <td><label for="product_name">Product Name</label></td>
                                        <td>
                                            <input id="product_name" type="text" class="form-control @error('product_name') invalid @enderror" name="product_name" value="{{ $proEdit->product_name }}"  autocomplete="proname">
                                            @error('product_name')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                    </div>
                                    <div class="form-group">
                                    <tr>
                                        <td><label for="prand">Prand</label></td>
                                        <td>
                                            <input id="prand" type="text" class="form-control @error('prand') invalid @enderror" name="prand" value="{{ $proEdit->brand }}"  autocomplete="prand">
                                            @error('prand')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                    </div>
                                    <div class="form-group">
                                    <tr>
                                        <td><label for="price">Price</label></td>
                                        <td>
                                            <input id="price" type="number" class="form-control @error('price') invalid @enderror" name="price" value="{{ $proEdit->price }}"  autocomplete="price">
                                            @error('price')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                    </div>
                                    <div class="form-group">
                                    <tr>
                                        <td><label for="quantity">Quantity</label></td>
                                        <td>
                                            <input id="quantity" type="number" class="form-control @error('quantity') invalid @enderror" name="quantity" value="{{ $proEdit->quantity }}"  autocomplete="quantity">
                                            @error('quantity')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                    </div>
                                    <div class="form-group">
                                    <tr>
                                        <td><label for="stock">Stock</label></td>
                                        <td>
                                            <input id="stock" type="number" class="form-control @error('stock') invalid @enderror" name="stock" value="{{ $proEdit->alert_stock}}"  autocomplete="stock">
                                            @error('stock')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                    </div>
                                    <div class="form-group">
                                    <tr>
                                        <td><label for="description">Description</label></td>
                                        <td>
                                            <input id="description" type="text" class="form-control @error('description') invalid @enderror" name="description" value="{{$proEdit->description}}"  autocomplete="description">
                                            @error('description')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                    </div>
                                    <div class="form-group">
                                        <tr ><td colspan="2"><button type="submit" class="btn btn-success">Update</button></td></tr>
                                    </div>
                                </form>
                            </tbody>
                        </table>
                    </div>
                    <!-- end form -->
                </div>
            </div>
        </div>
        <!-- for search product -->
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="card">
                <div class="card-header bg-info">Search Product</div>
                <div class="card-body">
                    <form action="{{url('admin/products')}}">
                    @csrf
                    <div class="form-group">
                        <label for="searchPro">Enter Product Name</label>
                        <input id="searchPro" type="text" class="form-control @error('searchPro') invalid @enderror" name="searchPro" value="{{ old('searchPro') }}"  autocomplete="searchPro">
                        @error('searchUser')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Search</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection