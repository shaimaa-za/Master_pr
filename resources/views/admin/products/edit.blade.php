@extends('layouts.admin')

@section('content')
<div class="container">
 
        <h1>Edit Product</h1>
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- معلومات المنتج الأساسية -->
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="supplier_id">Supplier</label>
                <select name="supplier_id" id="supplier_id" class="form-control" required>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ $supplier->id == $product->supplier_id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}" required>
            </div>

            <!-- الصور الحالية -->
            <div class="form-group">
                <label>Current Images:</label>
                <div>
                    @foreach($product->images as $image)
                        <div style="display: inline-block; margin-right: 10px;">
                            <img src="{{ asset('storage/' . $image->image_url) }}" width="100">
                            <label>
                                <input type="checkbox" name="remove_images[]" value="{{ $image->id }}">
                                Remove
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- صور جديدة -->
            <div class="form-group">
                <label for="images">New Product Images</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple>
            </div>

            <!-- الصفات وقيمها -->
            <div class="form-group">
                <label for="attributes">Product Attributes</label>
                <div id="attributes-container">
                    @foreach($product->attributes as $index => $attribute)
                        <div class="mb-3">
                            <label>{{ $attribute->name }}</label>
                            <input type="hidden" name="attributes[{{ $index }}][id]" value="{{ $attribute->pivot->id }}">
                            <input type="hidden" name="attributes[{{ $index }}][attribute_id]" value="{{ $attribute->id }}">
                            <input type="text" name="attributes[{{ $index }}][value]" class="form-control" value="{{ $attribute->pivot->value }}">
                            <label>
                                <input type="checkbox" name="attributes[{{ $index }}][remove]" value="1">
                                Remove
                            </label>
                        </div>
                    @endforeach
                </div>

                <!-- إضافة صفات جديدة -->
                <button type="button" id="add-attribute-btn" class="btn btn-primary">Add Attribute</button>
            </div>
            <br>
            <!-- زر الحفظ -->
            <button type="submit" class="btn btn-success">Update Product</button>
        </form>
 
</div>

<script>
    // JavaScript لإضافة حقول للصفات الجديدة
    document.getElementById('add-attribute-btn').addEventListener('click', function () {
        const container = document.getElementById('attributes-container');
        const index = container.children.length;

        const html = `
            <div class="mb-3">
                <label>New Attribute Name</label>
                <input type="text" name="new_attributes[${index}][name]" class="form-control">
                <label>New Attribute Value</label>
                <input type="text" name="new_attributes[${index}][value]" class="form-control">
            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);
    });
</script>
@endsection
