<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <p><a href="{{ route('tags.create') }}">Create</a></p>

    <table>
        @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->id }}</td>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->slug }}</td>
                <td>
                    <form method="post" action="{{ route('tags.destroy', $tag->id) }}">
                        @method('delete')
                        @csrf
                        <input type="submit" value="x">
                    </form>
                </td>

            </tr>
        @endforeach
    </table>

</body>
</html>
