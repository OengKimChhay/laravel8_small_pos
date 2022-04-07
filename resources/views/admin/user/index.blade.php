@extends('admin.dashboard')
@section('title','Users')

@section('content')
<div class="container-fluid mt-4">
  <div class="row">
    <!-- content -->
    <div class="col-lg-8 col-md-8 col-sm-12">
    <div class="card">
        <div class="card-body">
            @if(Session::has('success'))
            <div class="alert alert-danger" role="alert">
                {{Session::get('success')}}
            </div>
            @elseif(Session::has('fail'))
            <div class="alert alert-warning" role="alert">
                {{Session::get('fail')}}
            </div>
            @endif
            <div class="d-flex justify-content-between mb-2"><h3>All users</h3><button class="btn btn-outline-info"><a href="{{route('users.create')}}" class="text-decoration-none"><li class="fa fa-user"></li>Add User</a></button></div>
                <div class="table-responsive-lg">
                    <table class="table table-bordered">
                    <span>{{$users->links()}}</span>
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($users)>0)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->role ==1? "Admin":"Cashier"}}</td>
                                    <td class="d-flex justify-content-center">
                                        <button class="btn btn-outline-success btn-sm mr-1"><a href="{{route('users.edit',$user->id)}}" class="text-decoration-none"><li class="fa fa-edit"></li>Edit</a></button>
                                        <form action="{{route('users.destroy',$user->id)}}" method="post">
                                            @csrf 
                                            @method('DELETE') <!--we need to use this method if we use resource controller-->
                                            <button type="submit" class="btn btn-outline-danger btn-sm"><li class="fa fa-trash"></li>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr><td colspan="7">No User</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end cardbody -->
        </div>
    <!-- search users -->
    <div class="col-lg-4 col-md-4 col-sm-12"><a href="{{url('admin/users')}}" class="">All users click here</a>
        <div class="card">
          <div class="card-header bg-info">Search User</div>
          <div class="card-body">
            <form action="{{url('admin/users')}}">
              @csrf
              <div class="form-group">
                <label for="searchUser">Enter Username</label>
                <input id="searchUser" type="text" class="form-control @error('searchUser') invalid @enderror" name="searchUser" value="{{ old('searchUser') }}"  autocomplete="SearchUser">
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
        <!-- end card -->
    </div>
  </div>
</div>
@endsection