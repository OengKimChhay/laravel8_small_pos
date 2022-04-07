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
                    @elseif(Session::has('fail'))
                    <div class="alert alert-warning" role="alert">
                        {{Session::get('fail')}}
                    </div>
                    @endif
                    <!-- end error info -->
                    <div class="d-flex justify-content-between mb-2"><h3>All Products</h3><button class="btn btn-outline-info"><a href="{{route('products.create')}}" class="text-decoration-none"><li class="fa fa-user"></li>Add Products</a></button></div>
                    <!-- product detail -->
                    <div class="table-responsive-lg">
                        <table class="table table-bordered">
                            <span>{{$products->links()}}</span>
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Pro-Name</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($products) >0)
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->brand}}</td>
                                    <td>{{number_format($product->price,2)}} $</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>
                                        @if($product->alert_stock <=50) <span class="badge badge-danger">Low Stock {{$product->alert_stock}}</span>
                                        @else<span class="badge badge-success">{{$product->alert_stock}}</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <button class="btn btn-outline-success btn-sm mr-1"><a href="{{route('products.edit',$product->id)}}" class="text-decoration-none"><li class="fa fa-edit"></li>Edit</a></button>
                                        <form action="{{route('products.destroy',$product->id)}}" method="post">
                                            @csrf 
                                            @method('DELETE') <!--we need to use this method if we use resource controller-->
                                            <button type="submit" class="btn btn-outline-danger btn-sm"><li class="fa fa-trash"></li>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr><td colspan="7">No product</td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
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