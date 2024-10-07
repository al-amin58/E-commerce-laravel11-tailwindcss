<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Product Name</label>
    <input type="text" name="product_name" required>

    <label>Thumbnail Image</label>
    <input type="file" name="thumbnail_image" required>

    <label>Product Images</label>
    <input type="file" name="product_images[]" multiple required>

    <label>Price</label>
    <input type="number" name="price" step="0.01" required>

    <label>Discount Price (%)</label>
    <input type="number" name="discount_price" step="0.01" required>

    <label>Main Category</label>
    <select name="main_category" required>
        <!-- Populate categories -->
    </select>

    <label>Sub Category</label>
    <select name="sub_category">
        <!-- Populate subcategories based on selected main category -->
    </select>

    <label>Brand</label>
    <input type="text" name="brand" required>

    <label>Quantity</label>
    <input type="number" name="quantity" required>

    <label>Choose Color</label>
    <input type="text" name="color" required>

    <label>Size</label>
    <input type="text" name="size" required>

    <label>SKU</label>
    <input type="text" name="sku" required>

    <label>Short Description</label>
    <textarea name="short_description" required></textarea>

    <label>Full Description</label>
    <textarea name="full_description" required></textarea>

    <label>New Field</label>
    <input type="text" name="new_field">

    <label>Status</label>
    <select name="status" required>
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
    </select>

    <button type="submit">Save Product</button>
</form>
