@extends('admin.layouts.app')
@section('title')
    Product Add
@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add</li>
        </ol>
    </nav>
    @include('errors.message')
    <div class="row">
        <div class="col-md-12 mx-auto  stretch-card">
            <div class="card">
                <div class="card-body ">

                    <h6 class="card-title">New Product Add Form</h6>

                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data"
                        class="forms-sample" id="form">
                        @csrf
                        <div class="mt-5">
                            <label for="product_title" class="form-label font-semibold text-lg">Product Title: <sup><span
                                        class="text-red-600 text-sm ">*</span></sup></label>
                            <input type="text" name="product_title" class="form-control inputbgtextcolor"
                                id="product_title" autocomplete="off" placeholder="Enter Product Title" required>
                        </div>
                        <div class="form-group my-5">
                            <label for="thumbnailImage" class="font-semibold text-lg">Thumbnail Image: <sup><span
                                        class="text-red-600 text-sm ">*</span></sup></label>
                            <div class="flex justify-start">
                                <span id="uploadthumbnailImage" class="cursor-pointer font-mono text-xl" role="button"
                                    aria-label="Upload Icon">
                                    <svg viewBox="0 0 1024 1024" class="w-20" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" fill="#D74825">
                                        <path
                                            d="M736.68 435.86a173.773 173.773 0 0 1 172.042 172.038c0.578 44.907-18.093 87.822-48.461 119.698-32.761 34.387-76.991 51.744-123.581 52.343-68.202 0.876-68.284 106.718 0 105.841 152.654-1.964 275.918-125.229 277.883-277.883 1.964-152.664-128.188-275.956-277.883-277.879-68.284-0.878-68.202 104.965 0 105.842z"
                                            fill="#312782"></path>
                                        <path
                                            d="M285.262 779.307A173.773 173.773 0 0 1 113.22 607.266c-0.577-44.909 18.09-87.823 48.461-119.705 32.759-34.386 76.988-51.737 123.58-52.337 68.2-0.877 68.284-106.721 0-105.842C132.605 331.344 9.341 454.607 7.379 607.266 5.417 759.929 135.565 883.225 285.262 885.148c68.284 0.876 68.2-104.965 0-105.841z"
                                            fill="#D74825"></path>
                                        <path
                                            d="M339.68 384.204a173.762 173.762 0 0 1 172.037-172.038c44.908-0.577 87.822 18.092 119.698 48.462 34.388 32.759 51.743 76.985 52.343 123.576 0.877 68.199 106.72 68.284 105.843 0-1.964-152.653-125.231-275.917-277.884-277.879-152.664-1.962-275.954 128.182-277.878 277.879-0.88 68.284 104.964 68.199 105.841 0z"
                                            fill="#D74825"></path>
                                        <path
                                            d="M545.039 473.078c16.542 16.542 16.542 43.356 0 59.896l-122.89 122.895c-16.542 16.538-43.357 16.538-59.896 0-16.542-16.546-16.542-43.362 0-59.899l122.892-122.892c16.537-16.542 43.355-16.542 59.894 0z"
                                            fill="#312782"></path>
                                        <path
                                            d="M485.17 473.078c16.537-16.539 43.354-16.539 59.892 0l122.896 122.896c16.538 16.533 16.538 43.354 0 59.896-16.541 16.538-43.361 16.538-59.898 0L485.17 532.979c-16.547-16.543-16.547-43.359 0-59.901z"
                                            fill="#312782"></path>
                                        <path
                                            d="M514.045 634.097c23.972 0 43.402 19.433 43.402 43.399v178.086c0 23.968-19.432 43.398-43.402 43.398-23.964 0-43.396-19.432-43.396-43.398V677.496c0.001-23.968 19.433-43.399 43.396-43.399z"
                                            fill="#D74825"></path>
                                    </svg>
                                </span>
                                <img id="thumbnailPreview" src="" alt="thumbnail Preview"
                                    style="display: none; margin-top: 10px; max-width: 350px; height: 100px;" />
                            </div>
                            <input hidden type="file" name="thumbnail" class="form-control inputbgtextcolor"
                                id="thumbnailImage" accept="image/png, image/jpeg, image/jpg, image/gif" required
                                onchange="onFileChangeIcon(event)">
                        </div>

                        <div class="form-group">
                            <label class="font-semibold text-lg">Product Images: <sup><span
                                        class="text-red-600 text-sm ">*</span></sup></label>
                            <div class="d-flex flex-wrap justify-content-start" id="product_images_container">

                            </div>

                            <div class="flex justify-start">
                                <span onclick="document.getElementById('productImages').click()" for="productImages"
                                    class="cursor-pointer font-mono text-xl" role="button">
                                    <svg viewBox="0 0 1024 1024" class="w-20" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg" fill="#D74825">
                                        <path
                                            d="M736.68 435.86a173.773 173.773 0 0 1 172.042 172.038c0.578 44.907-18.093 87.822-48.461 119.698-32.761 34.387-76.991 51.744-123.581 52.343-68.202 0.876-68.284 106.718 0 105.841 152.654-1.964 275.918-125.229 277.883-277.883 1.964-152.664-128.188-275.956-277.883-277.879-68.284-0.878-68.202 104.965 0 105.842z"
                                            fill="#312782"></path>
                                        <path
                                            d="M285.262 779.307A173.773 173.773 0 0 1 113.22 607.266c-0.577-44.909 18.09-87.823 48.461-119.705 32.759-34.386 76.988-51.737 123.58-52.337 68.2-0.877 68.284-106.721 0-105.842C132.605 331.344 9.341 454.607 7.379 607.266 5.417 759.929 135.565 883.225 285.262 885.148c68.284 0.876 68.2-104.965 0-105.841z"
                                            fill="#D74825"></path>
                                        <path
                                            d="M339.68 384.204a173.762 173.762 0 0 1 172.037-172.038c44.908-0.577 87.822 18.092 119.698 48.462 34.388 32.759 51.743 76.985 52.343 123.576 0.877 68.199 106.72 68.284 105.843 0-1.964-152.653-125.231-275.917-277.884-277.879-152.664-1.962-275.954 128.182-277.878 277.879-0.88 68.284 104.964 68.199 105.841 0z"
                                            fill="#D74825"></path>
                                        <path
                                            d="M545.039 473.078c16.542 16.542 16.542 43.356 0 59.896l-122.89 122.895c-16.542 16.538-43.357 16.538-59.896 0-16.542-16.546-16.542-43.362 0-59.899l122.892-122.892c16.537-16.542 43.355-16.542 59.894 0z"
                                            fill="#312782"></path>
                                        <path
                                            d="M485.17 473.078c16.537-16.539 43.354-16.539 59.892 0l122.896 122.896c16.538 16.533 16.538 43.354 0 59.896-16.541 16.538-43.361 16.538-59.898 0L485.17 532.979c-16.547-16.543-16.547-43.359 0-59.901z"
                                            fill="#312782"></path>
                                        <path
                                            d="M514.045 634.097c23.972 0 43.402 19.433 43.402 43.399v178.086c0 23.968-19.432 43.398-43.402 43.398-23.964 0-43.396-19.432-43.396-43.398V677.496c0.001-23.968 19.433-43.399 43.396-43.399z"
                                            fill="#D74825"></path>
                                    </svg>
                                </span>
                                <input type="file" name="product_images[]" class="d-none form-control inputbgtextcolor"
                                    id="productImages" onchange="product_imges_selected()"
                                    accept="image/png, image/jpeg, image/jpg, image/gif" multiple="" required>
                            </div>
                        </div>
                        <div class="flex gap-5 my-5">
                            <div class=" w-1/2">
                                <label for="price" class="form-label font-semibold text-lg">Price: <sup><span
                                            class="text-red-600 text-sm ">*</span></sup></label>
                                <input type="number" name="price" class="form-control inputbgtextcolor" id="price"
                                    autocomplete="off" placeholder="price" step="0.01" required>
                            </div>
                            <div class=" w-1/2">
                                <label for="discount_price" class="form-label font-semibold text-lg">Discount
                                    Price: <sup><span class="text-red-600 text-sm ">*</span></sup></label>
                                <input type="number" name="discount_price" class="form-control inputbgtextcolor"
                                    id="discount_price" autocomplete="off" placeholder="discount price" step="0.01"
                                    required>
                            </div>
                        </div>

                        <div class="flex gap-5">
                            <div class="form-group mt-2 w-1/2">
                                <label for="main_category" class="font-semibold text-lg">Main Category: <sup><span
                                            class="text-red-600 text-sm">*</span></sup></label>
                                <select class="form-control" name="main_category" id="main_category">
                                    <option value="">Select a main category</option>
                                    @foreach ($mainCategories as $mainCategory)
                                        <option value="{{ $mainCategory->id }}">{{ $mainCategory->main_category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mt-2 w-1/2">
                                <label for="sub_category" class="font-semibold text-lg">Sub Category</label>
                                <select class="form-control" name="sub_category" id="sub_category">
                                    <option value="">Select a Sub category</option>
                                    @foreach ($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->Sub_category_name }}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex gap-5 w-full my-5">
                            <div class="form-group  w-full">
                                <label for="brand" class="font-semibold text-lg">Brand: <sup><span
                                            class="text-red-600 text-sm ">*</span></sup></label>
                                <select class="form-control" name="brand" id="brand">
                                    <option value="">Select a Brand </option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->brand }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full">
                                <label for="quantity" class="form-label font-semibold text-lg">Quantity: <sup><span
                                            class="text-red-600 text-sm ">*</span></sup></label>
                                <input type="number" name="quantity" class="form-control inputbgtextcolor"
                                    id="quantity" autocomplete="off" placeholder="quantity " required>
                            </div>
                            <div class="w-full">
                                <label for="sku" class="form-label font-semibold text-lg">SKU: <sup><span
                                            class="text-red-600 text-sm ">*</span></sup></label>
                                <input type="text" name="sku" class="form-control inputbgtextcolor"
                                    id="sku" autocomplete="off" placeholder="sku" required>
                            </div>
                        </div>

                        <div class="flex gap-5 mb-5 ">
                            <div class="w-full">
                                <label for="color" class="form-label font-semibold text-lg">Color:</label>
                                <input type="text" name="color" class="form-control inputbgtextcolor"
                                    id="color" autocomplete="off" placeholder="color ">
                            </div>
                            <div class="w-full">
                                <label for="size" class="form-label font-semibold text-lg ">Size:</label>
                                <input type="text" name="size" class="form-control inputbgtextcolor"
                                    id="size" autocomplete="off" placeholder="size ">
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="font-semibold text-lg mb-5">Short Description: <sup><span
                                        class="text-red-600 text-sm ">*</span></sup></label>
                            <textarea name="short_description" id="shortDescription" required"></textarea>

                        </div>
                        <div class="mb-5">
                            <label class="font-semibold text-lg mb-5">Full Description: <sup><span
                                        class="text-red-600 text-sm ">*</span></sup></label>
                            <textarea name="full_description" id="fullDescription" required></textarea>
                        </div>

                        <div class="my-5">
                            <h3 class="font-semibold text-lg">Add New Field: <sup><span class="text-red-600 text-xs "> (
                                        If your need )</span></sup></h3>
                            <div class="mt-2 " id="field-container">
                                <div class="flex gap-2 mb-2">
                                    <input type="text" name="new_field_name" class="form-control w-full"
                                        placeholder="New Field..." id="newField">
                                    <button type="button" class="btn btn-primary" onclick="addNewField()">Add</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="categoryStatus">Status: <sup><span
                                        class="text-red-600 text-sm ">*</span></sup></label>
                            <select class="form-control" name="status" id="categoryStatus">
                                <option value="active">Active
                                </option>
                                <option value="inactive">
                                    Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection


@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Initialize TinyMCE editor -->
    <script src="https://cdn.tiny.cloud/1/mao5ue5nvhseruiz5rsib0eu3pud0stwxe8kdpfa76enhe4x/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>


    // This is for thumbnail Image
    <script>
        // Open file dialog when the SVG is clicked
        document.getElementById('uploadthumbnailImage').addEventListener('click', function() {
            document.getElementById('thumbnailImage').click();
        });

        // Open file dialog when the image preview is clicked
        document.getElementById('thumbnailPreview').addEventListener('click', function() {
            document.getElementById('thumbnailImage').click();
        });

        function onFileChangeIcon(event) {
            const input = event.target;
            const file = input.files[0];
            const preview = document.getElementById('thumbnailPreview');
            const uploadButton = document.getElementById('uploadthumbnailImage');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    uploadButton.style.display = 'none'; // Hide the upload button
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
                uploadButton.style.display = 'inline'; // Show the upload button again if no file is selected
            }
        }
    </script>


    {{-- // New field script --}}
    <script>
        let fields = [];

        function addNewField() {
            const newFieldValue = document.getElementById('newField').value;
            if (newFieldValue.trim() !== "") {
                fields.push(newFieldValue);

                const fieldWrapper = document.createElement('div');
                fieldWrapper.classList.add('field-wrapper', 'flex', 'gap-2', 'mb-2');

                const newField = document.createElement('input');
                newField.type = 'text';
                newField.classList = 'w-full';
                newField.value = newFieldValue;
                newField.readOnly = true;

                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.classList.add('btn', 'btn-danger');
                deleteButton.textContent = 'Delete';
                deleteButton.onclick = function() {
                    fieldWrapper.remove();
                    const index = fields.indexOf(newFieldValue);
                    if (index > -1) {
                        fields.splice(index, 1); // Remove the field from the array
                    }
                };

                fieldWrapper.appendChild(newField);
                fieldWrapper.appendChild(deleteButton);
                document.getElementById('field-container').appendChild(fieldWrapper);

                // Clear input field after adding
                document.getElementById('newField').value = '';
            }
        }
    </script>

    {{-- //Product images --}}
    <script type="text/javascript">
        var images = [];

        // Function to handle image selection
        function product_imges_selected() {
            var imageInput = document.getElementById('productImages').files;
            for (var i = 0; i < imageInput.length; i++) {
                if (check_duplicate(imageInput[i].name)) {
                    images.push({
                        "name": imageInput[i].name,
                        "url": URL.createObjectURL(imageInput[i]),
                        "file": imageInput[i]
                    });
                } else {
                    alert(imageInput[i].name + "Is Image Already Exist.");
                }
            }
            document.getElementById('form').reset();
            document.getElementById('product_images_container').innerHTML = product_imges_show();
        }


        function product_imges_show() {
            var image = "";
            images.forEach((i) => {
                image += `<div class="d-flex justify-content-center position-relative"
                                style="width: 200px; overflow: hidden; margin: 10px; border-radius: 6px; height: 120px;">
                                <span onclick="delete_image(` + images.indexOf(i) + `)"
                                    style="position: absolute; top: -8px; right: 8px; cursor: pointer; color: red; font-size: 28px; font-weight: normal;">&times;</span>
                                <img src="` + i.url + `" alt="Image Preview"
                                    class="" style="width: auto; object-fit: cover; height: 100%;" />
                            </div>`;
            })
            return image;
        }

        function delete_image(e) {
            images.splice(e, 1);
            document.getElementById('product_images_container').innerHTML = product_imges_show();

        }

        function check_duplicate(imageInput) {
            var duplicate = true;

            if (images.length > 0) {
                for (e = 0; e < images.length; e++) {
                    if (images[e].name == imageInput) {
                        duplicate = false;
                        break;
                    }
                }
            }
            return duplicate;
        }
    </script>



    {{-- This is for shortDescription --}}
    <script>
        tinymce.init({
            selector: '#shortDescription', // The ID of your textarea
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak table',
            toolbar: 'undo redo | formatselect | bold italic underline forecolor backcolor fontfamily fontsizeinput | alignleft aligncenter alignright alignjustify |table| bullist numlist outdent indent | link image ',
            height: 200,
            skin: (window.matchMedia('(prefers-color-scheme: light)').matches ? 'oxide-light' : 'oxide'),
            content_css: (window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' :
                'default'), // Use default content CSS for dark mode or custom light mode
            setup: function(editor) {
                editor.on('init', function() {
                    var isLightMode = window.matchMedia('(prefers-color-scheme: light)').matches;
                    // Apply custom background color and text color
                    if (isLightMode) {
                        editor.contentDocument.body.style.backgroundColor =
                            '#FFFFFF'; // Light mode background
                        editor.contentDocument.body.style.color = '#000000'; // Dark text for light mode
                    } else {
                        editor.contentDocument.body.style.backgroundColor =
                            '#FFFFFF'; // Dark mode background
                        editor.contentDocument.body.style.color = '#000000'; // Light text for dark mode
                    }
                });
            }
        });
    </script>

    {{-- This is for fullDescription --}}
    <script>
        tinymce.init({
            selector: '#fullDescription', // The ID of your textarea
            apiKey: 'mao5ue5nvhseruiz5rsib0eu3pud0stwxe8kdpfa76enhe4x',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak table',
            toolbar: 'undo redo | formatselect | bold italic underline forecolor backcolor fontfamily fontsizeinput | alignleft aligncenter alignright alignjustify | table | bullist numlist outdent indent | link image',
            readonly: false,
            setup: function(editor) {
                editor.on('init', function() {
                    var isLightMode = window.matchMedia('(prefers-color-scheme: light)').matches;

                    // Apply custom background color and text color in the content area
                    if (isLightMode) {
                        editor.contentDocument.body.style.backgroundColor =
                            '#FFFFFF'; // Light mode background
                        editor.contentDocument.body.style.color = '#000000'; // Dark text for light mode
                    } else {
                        editor.contentDocument.body.style.backgroundColor =
                            '#FFFFFF'; // Dark mode background
                        editor.contentDocument.body.style.color = '#000000'; // Light text for dark mode
                    }

                });
            }
        });
    </script>
@endsection
