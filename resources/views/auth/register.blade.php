<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
      *{
         margin:0;
         padding:0;
      }
      body{
         min-height:100vh;
         display:flex;
         justify-content: center;
         align-items:center;
         background-color:#EEF2F7;
      }
      .invalid{
         border:3px solid rgb(205 26 26 / 58%);
      }
      .card{
         box-shadow: 0 2.8px 2.2px rgba(0, 0, 0, 0.034),
                     0 6.7px 5.3px rgba(0, 0, 0, 0.048),
                     0 12.5px 10px rgba(0, 0, 0, 0.06),
                     0 22.3px 17.9px rgba(0, 0, 0, 0.072),
                     0 41.8px 33.4px rgba(0, 0, 0, 0.086),
                     0 60px 80px rgba(0, 0, 0, 0.12);
         border-radius: 5px;
         background: white;
      }
   </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-5 col-sm-12">
            <div class="card">
            <div class="card-header text-center" style="font-size:20px;">Register</div>
                @if($message = Session::get('error'))
                <p class=" text-center text-danger">{{$message}}</p>
                @elseif($message = Session::get('success'))
                <p class=" text-center text-success">{{$message}}</p>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{route('register')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" class="form-control @error('name') invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>
                            @error('email')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') invalid @enderror" name="password"  autocomplete="current-password">
                            @error('password')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                            <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') invalid @enderror" name="password_confirmation"  autocomplete="password-confirmation">
                            @error('password_confirmation')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Stay login</label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Register</button><a class="ml-2" href="{{route('login')}}">Already have account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>