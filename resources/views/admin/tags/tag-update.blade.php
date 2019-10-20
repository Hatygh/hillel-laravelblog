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
    <form method="post" action="{{ route('tags.update', $tag) }}">
        @method('put')
        @csrf
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label text-success">Tag</label>
            <div class="col-sm-7">
                <input type="text"
                       @if ($errors->has('name')) class="form-control is-invalid"
                       @else class="form-control is-valid"
                       @endif
                       name="name" placeholder="Tag" value="{{ @old('name', $tag->name) }}">
            </div>
            @if ($errors->has('name'))
                <div class="col-sm-3">
                    @foreach ($errors->get('name') as $error)
                        <small class="text-danger">
                            {{ $error }}
                        </small>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-group row">
            <label for="slug" class="col-sm-2 col-form-label text-success">Slug</label>
            <div class="col-sm-7">
                <input type="text"
                       @if ($errors->has('slug')) class="form-control is-invalid"
                       @else class="form-control is-valid"
                       @endif
                       name="slug" placeholder="Slug" value="{{ @old('slug', $tag->slug) }}">
            </div>
            @if ($errors->has('slug'))
                <div class="col-sm-3">
                    @foreach ($errors->get('slug') as $error)
                        <small class="text-danger">
                            {{ $error }}
                        </small>
                    @endforeach
                </div>
            @endif
        </div>
        <div class = "form-group row">
            <input type = "submit" value = "Update">
        </div>

    </form>
</div>

</body>
</html>


