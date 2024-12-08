@extends('layouts.admin')

@section('content')
<div class="container my-4">

        <h1>Suppliers</h1>
        <br/>
        <a href="{{ route('admin.suppliers.create') }}" class="btn btn-primary mb-3">Add New Supplier</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->id }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->contact_email }}</td>
                    <td>{{ $supplier->contact_phone }}</td>
                    <td>
                        <a href="{{ route('admin.suppliers.edit', $supplier->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('admin.suppliers.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
   
</div>
@endsection
