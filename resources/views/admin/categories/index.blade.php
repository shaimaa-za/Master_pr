
@extends('layouts.admin')

@section('content')
<div class="container mt-4">

        <h1>Category List</h1>
        <br/>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Icon</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            @if($category->icon_url)
                                <img src="{{ $category->icon_url }}" alt="Icon" width="50">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  
</div>
@endsection
