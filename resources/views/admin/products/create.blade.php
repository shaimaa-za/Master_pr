@extends('layouts.admin')

@section('content')
<div class="container">
    <div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <h1>Add New Product</h1>
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="supplier_id">Supplier</label>
                <select name="supplier_id" id="supplier_id" class="form-control" required>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="images">Product Images</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple>
            </div>

            <!-- Dynamic Attributes Section -->
            <div class="form-group">
                <label for="attributes">Product Attributes</label>
                <div id="attributes-container">
                    <!-- Dynamic attributes will be appended here -->
                </div>
                <button type="button" id="add-attribute" class="btn btn-secondary mt-2">Add Attribute</button>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Save Product</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('add-attribute').addEventListener('click', function () {
        const container = document.getElementById('attributes-container');
        const index = container.children.length;

        const attributeHtml = `
            <div class="mb-3">
                <label>Attribute Name</label>
                <input type="text" name="attributes[${index}][name]" class="form-control" placeholder="Attribute Name" required>
                <label>Attribute Value</label>
                <input type="text" name="attributes[${index}][value]" class="form-control" placeholder="Attribute Value" required>
                <button type="button" class="btn btn-danger mt-2 remove-attribute">Remove</button>
            </div>
        `;
        const div = document.createElement('div');
        div.innerHTML = attributeHtml;
        container.appendChild(div);

        // Add event listener to remove button
        div.querySelector('.remove-attribute').addEventListener('click', function () {
            div.remove();
        });
    });
</script>
@endsection
