@extends('layouts.admin')

@section('content')
<div class="container my-4">

        <h1>Edit Supplier</h1>

        <form action="{{ route('admin.suppliers.update', $supplier->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $supplier->name }}" required>
            </div>
            <div class="mb-3">
                <label for="contact_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ $supplier->contact_email }}" required>
            </div>
            <div class="mb-3">
                <label for="contact_phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ $supplier->contact_phone }}" required>
            </div>
            <div class="mb-3">
                <label for="api_url" class="form-label">API URL</label>
                <input type="url" class="form-control" id="api_url" name="api_url" value="{{ $supplier->api_url }}">
            </div>
            <div class="mb-3">
                <label for="api_key" class="form-label">API Key</label>
                <input type="text" class="form-control" id="api_key" name="api_key" value="{{ $supplier->api_key }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3">{{ $supplier->address }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('admin.suppliers.index') }}" class="btn btn-secondary">Cancel</a>
        </form>

</div>
@endsection
