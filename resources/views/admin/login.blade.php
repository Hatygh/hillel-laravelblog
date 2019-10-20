<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<div class="container">
    <br>
    <form method="post" action="{{ route('admin.auth.login') }}">
        @csrf
        <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label text-success">Email</label>
            <div class="col-sm-7">
                <input type="text"
                       @if ($errors->has('email')) class="form-control is-invalid"
                       @else class="form-control is-valid"
                       @endif
                       name="email" placeholder="Email" value="{{ @old('email')}}">
            </div>
            @error('email')
                <div class="col-sm-3">
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                </div>
            @enderror
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label text-success">Password</label>
            <div class="col-sm-7">
                <input type="password"
                       @if ($errors->has('password')) class="form-control is-invalid"
                       @else class="form-control is-valid"
                       @endif
                       name="password" placeholder="Password" value="{{ @old('password')}}">
            </div>
            @error('password')
                <div class="col-sm-3">
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                </div>
            @enderror
        </div>
        <div class = "form-group row">
            <input type = "submit" value = "Sign in">
        </div>
    </form>
</div>

</body>
</html>
