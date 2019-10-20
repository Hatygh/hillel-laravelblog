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
    <form method="post" enctype="multipart/form-data" action="{{ route('posts.store') }}">
        @csrf
        <div class="form-group row">
            <label for="user_id" class="col-sm-2 col-form-label text-success">Author</label>
            <div class="col-sm-7">
                <select  class="custom-select" name="user_id"
                       @if ($errors->has('user_id')) class="form-control is-invalid"
                       @else class="form-control is-valid"
                       @endif>
                    @foreach($users as $user)
                        <option
                            @if ($user->id == @old('user_id'))
                                selected
                            @endif
                            value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('user_id'))
                <div class="col-sm-3">
                    @foreach ($errors->get('user_id') as $error)
                        <small class="text-danger">
                            {{ $error }}
                        </small>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-group row">
            <label for="category_id" class="col-sm-2 col-form-label text-success">Category</label>
            <div class="col-sm-7">
                <select  class="custom-select" name="category_id"
                         @if ($errors->has('category_id')) class="form-control is-invalid"
                         @else class="form-control is-valid"
                    @endif>
                    @foreach($categories as $category)
                        <option
                            @if ($category->id == @old('category_id'))
                            selected
                            @endif
                            value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            @if ($errors->has('category_id'))
                <div class="col-sm-3">
                    @foreach ($errors->get('category_id') as $error)
                        <small class="text-danger">
                            {{ $error }}
                        </small>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-group row">
            <label for="title" class="col-sm-2 col-form-label text-success">Title</label>
            <div class="col-sm-7">
                <input type="text"
                       @if ($errors->has('title')) class="form-control is-invalid"
                       @else class="form-control is-valid"
                       @endif
                       name="title" placeholder="Title" value="{{ @old('title')}}">
            </div>
            @if ($errors->has('title'))
                <div class="col-sm-3">
                    @foreach ($errors->get('title') as $error)
                        <small class="text-danger">
                            {{ $error }}
                        </small>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-group row">
            <label for="preview_text" class="col-sm-2 col-form-label text-success">Preview text</label>
            <textarea class = "form-control" name="preview_text" rows="3"
                   @if ($errors->has('preview_text')) class="form-control is-invalid"
                   @else class="form-control is-valid"
                   @endif>{{ @old('preview_text')}} </textarea>
            @if ($errors->has('preview_text'))
                <div class="col-sm-3">
                    @foreach ($errors->get('preview_text') as $error)
                        <small class="text-danger">
                            {{ $error }}
                        </small>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-group row">
            <label for="body" class="col-sm-2 col-form-label text-success">Post</label>
            <textarea class = "form-control" name="body" rows="10"
                      @if ($errors->has('body')) class="form-control is-invalid"
                      @else class="form-control is-valid"
                   @endif>{{ @old('body')}} </textarea>
            @if ($errors->has('body'))
                <div class="col-sm-3">
                    @foreach ($errors->get('body') as $error)
                        <small class="text-danger">
                            {{ $error }}
                        </small>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-group row">
            @foreach($tags as $tag)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}"
                          @if ($errors->has('tags.*')) class="form-control is-invalid"
                          @else class="form-control is-valid"
                          @endif>
                    <label for="tags" class="form-check-label text-success">{{ $tag->name }}</label>
                </div>
            @endforeach
            @if ($errors->has('tags.*'))
                <div class="col-sm-3">
                    @foreach ($errors->get('tags.*') as $error)
                        <small class="text-danger">
                            Invalid tag has been chosen
                        </small>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-success" for="preview_image">Choose preview image</label>
            <input type="file" name="preview_image">
            @error('preview_image')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label text-success" for="cover_image">Choose cover image</label>
            <input type="file" name="preview_cover">
            @error('preview_cover')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
        </div>

        <div class = "form-group row">
            <input type = "submit" value = "Create">
        </div>

    </form>

</div>

</body>
</html>


