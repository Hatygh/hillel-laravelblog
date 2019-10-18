<form method="post" action="{{ route('categories.store') }}">
    <input type = "text" name = "name">
    <br>
    <input type = "text" name = "slug">
    <br>
    <input type = "submit" value = "Create">
    @csrf
</form>
