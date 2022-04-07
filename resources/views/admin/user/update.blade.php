@extends('admin.dashboard')
@section('title','Users')

@section('content')
<div class="container-fluid mt-4">
  <div class="row">
    <!-- content -->
    <div class="col-lg-8 col-md-8 col-sm-12">
        <div class="card">
            <div class="card-header bg-info">Edit User</div>
            <div class="card-body">
                @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('success')}}
                </div>
                @elseif(Session::has('fail'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('fail')}}
                </div>
                @endif
                <div class="table-responsive-lg">
                    <table class="table table-bordered">
                        <tbody>
                        <form method="POST" action="{{route('users.update',$userEdit->id)}}">
                        @csrf
                        @method('put') <!-- @method('put') we do have to add this code with resource ctr to specify method ortherwise it will automatic to show method -->
                            <div class="form-group">
                                <tr>
                                    <td><label for="name">New Name</label></td>
                                    <td>
                                        <input id="name" type="text" class="form-control @error('name') invalid @enderror" name="name" value="{{ $userEdit->name }}"  autocomplete="name">
                                        @error('name')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </td>
                                </tr>
                            </div>
                            <div class="form-group">
                                <tr>
                                    <td><label for="email">New Email</label></td>
                                    <td>
                                        <input id="email" type="text" class="form-control @error('email') invalid @enderror" name="email" value="{{ $userEdit->email }}"  autocomplete="email">
                                        @error('email')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </td>
                                </tr>
                            </div>
                            <div class="form-group">
                                <tr>
                                    <td><label for="password">New Password</label></td>
                                    <td>
                                        <input id="password" type="password" class="form-control @error('password') invalid @enderror" name="password"  autocomplete="password">
                                        @error('password')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </td>
                                </tr>
                            </div>
                            <div class="form-group">
                                <tr>
                                    <td><label for="password_confirmation">Re-Password</label></td>
                                    <td>
                                        <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') invalid @enderror" name="password_confirmation" value="{{ old('password_confirmation') }}"  autocomplete="password_confirmation">
                                        @error('password_confirmation')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </td>
                                </tr>
                            </div>
                            <div class="form-group">
                                <tr>
                                    <td><label for="role">Role</label></td>
                                    <td>
                                        <select name="role" class="form-control" >
                                            @if($userEdit->role == 1)
                                            <option value="1" selected>Admin</option>
                                            <option value="2">Cashier</option>
                                            @else
                                            <option value="2" selected>Cashier</option>
                                            <option value="1">Admin</option>
                                            @endif
                                        </select>
                                        @error('role')
                                            <p class="text-danger">{{$message}}</p>
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
            </div>
        </div>
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