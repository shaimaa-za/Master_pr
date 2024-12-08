@extends('layouts.admin')

@section('content')
<div class="container mt-4">
        <h1>Add New Category</h1>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="icon_url" class="form-label">Icon URL</label>
                <input type="url" class="form-control" id="icon_url" name="icon_url">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
</div>
@endsection
