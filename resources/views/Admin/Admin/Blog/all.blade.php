@extends('Layouts.Admin.app')
@section('content')
<a href="/dashboard">Dashboard</a>
<a href="/cms">CMS</a>
<a href="/profile">Profile</a>
<a href="/admin/blogs">Blogs</a>
<br>
<a href="/admin/blog">Create</a>

<br><br><br><br><br>

<form action="/admin/blog" method="post" enctype="multipart/form-data" accept="image/png, image/jpeg, image/gif, image/bmp">
    @csrf
        <div class="form-group mt-3">
            <input type="file" class="form-control" name="image">
        </div>
        <div class="form-group mt-3">
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group mt-3">
            <input type="text" class="form-control" name="description">
        </div>
        <div class="form-group mt-3">
            <input type="hidden" class="form-control" name="is_live" value="1">
        </div>
        @error('image')
            <div class="my-3">
                <div class="error-message">{{ $message }}</div>
            </div>
        @enderror
        
        <div class="text-center"><button type="submit">Create</button></div>
</form>

@endsection