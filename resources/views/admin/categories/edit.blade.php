@extends('layouts.admin')

@section('content')
<div class="container mt-4">
        <h1>Edit Category</h1>

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description">{{ $category->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="icon_url" class="form-label">Icon URL</label>
                <input type="url" class="form-control" id="icon_url" name="icon_url" value="{{ $category->icon_url }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
</div>
@endsection
