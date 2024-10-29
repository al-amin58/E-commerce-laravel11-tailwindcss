@extends('admin.layouts.app')
@section('title')
    Product Add
@endsection
@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Product Add</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product Add</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h3 class="card-title">New Product Add Form</h3>
                </div>
                @include('errors.message')
                <div class="card-body">
                    <div class="example">
                        <form  action="{{route('product.store')}}" method="POST" enctype="multipart/form-data"
                           id="form"   class="form-horizontal">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Product Title: <sup><span
                                            class="text-danger fw-700 fs-6 ">*</span></sup></label>
                                <input type="text" name="product_title" class="form-control" placeholder="Enter Product Title" required>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xl-3">
                                    <div class="form-group">
                                        <label class="form-label">Price: <sup><span
                                                    class="text-danger fw-700 fs-6 ">*</span></sup></label>
                                        <input type="number" name="price" class="form-control" placeholder="Enter Price" required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xl-3">
                                    <div class="form-group">
                                        <label class="form-label">Discount
                                            Price: <sup><span
                                                    class="text-danger fw-700 fs-6 ">%</span></sup></label>
                                        <input type="number" name="discount_percentage" placeholder="Enter Discount Price %" class="form-control" min="0" max="100">
                                    </div>
                                </div>
                                <div class="col-md-12 col-xl-3">
                                    <div class="form-group">
                                        <label  class="form-label">Quantity: <sup><span
                                                    class="text-danger fw-700 fs-6 ">*</span></sup></label>
                                        <input type="number" class="form-control" name="quantity"  placeholder="Enter Quantity"  required>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xl-3">
                                    <div class="form-group">
                                        <label class="form-label">SKU: <sup><span
                                                    class="text-danger fw-700 fs-6 ">*</span></sup></label>
                                        <input type="text" class="form-control" name="sku"  placeholder="Enter SKU"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xl-4">
                                    <div class="form-group">
                                        <label class="form-label">Main Category: <sup><span
                                                    class="text-danger fw-700 fs-6 ">*</span></sup></label>
                                        <select name="main_category" class="form-control select2-show-search form-select"  data-placeholder="Choose one">
                                            <option value="">Select a main category</option>
                                            @foreach ($mainCategories as $mainCategory)
                                                <option value="{{ $mainCategory->id }}">{{ $mainCategory->main_category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xl-4">
                                    <div class="form-group">
                                        <label class="form-label">Sub Category: </label>
                                        <select name="sub_category" class="form-control select2-show-search form-select" data-placeholder="Choose one">
                                            <option value="">Select a Sub category</option>
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}">{{ $subcategory->Sub_category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xl-4">
                                    <div class="form-group">
                                        <label class="form-label">Brand: <sup><span
                                                    class="text-danger fw-700 fs-6 ">*</span></sup></label>
                                        <select name="brand_id" class="form-control select2-show-search form-select" data-placeholder="Choose one">
                                            <option value="">Select a Brand </option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->brand_name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xl-4">
                                    <div class="form-group">
                                        <label class="form-label">Color: </label>
                                        <select name="colors[]" class="form-control select-multi-color form-select" data-placeholder="Choose colors" multiple>
                                            @foreach ($colors as $color)
                                                <option value="{{ $color->id }}">{{ $color->color }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-xl-4">
                                    <div class="form-group">
                                        <label class="form-label">Size: </label>
                                        <select name="sizes[]" class="form-control select-multi-size form-select" data-placeholder="Choose sizes" multiple>
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Dynamic Attributes -->
                            <div class="container my-2">
                                <div class="form-group" id="dynamicAttributes">
                                    <label class="form-label">Product Attributes: <sup><span class="text-danger fw-700 fs-6 ">*</span></sup></label>
                                    <button type="button" class="btn btn-primary" id="addAttributeButton">Add Attribute</button>
                                </div>
                            </div>

                            <!-- Short Editor -->
                            <div class="form-group">
                                <label class="form-label">Short Description: <sup><span
                                            class="text-danger fw-700 fs-6 ">*</span></sup>
                                </label>
                                <textarea name="short_description" id="shortDescription" ></textarea>
                            </div>
                            <!--End Short Editor-->
                            <!-- Full Editor -->
                            <div class="form-group">
                                <label class="form-label">Full Description: <sup><span
                                            class="text-danger fw-700 fs-6 ">*</span></sup>
                                </label>
                                <textarea name="full_description" id="fullDescription" ></textarea>
                            </div>
                            <!--End Full Editor-->
                            <!-- Thumbnail Image -->
                            <div class="form-group">
                                <label for="thumbnailImage" class="form-label">Thumbnail Image: <sup><span
                                            class="text-danger fw-700 fs-6 ">*</span></sup></label>
                                <div class="flex justify-start" style=" margin-top: 10px; margin-bottom: 50px; width: 100px; height: 50px;">
                                <span id="uploadthumbnailImage" class="cursor-pointer font-mono text-xl" role="button"
                                      aria-label="Upload Icon" >
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
                                         style="display: none; margin-top: 10px; max-width: 1000px; height: 100px;" />
                                </div>
                                <input hidden type="file" name="thumbnail_image" class="form-control inputbgtextcolor"
                                       id="thumbnailImage" accept="image/png, image/jpeg, image/jpg, image/gif, image/webp"
                                       onchange="onFileChangeIcon(event)">
                            </div>
                            <!-- Product Images -->
                            <div class="form-group" >
                                <label  class="form-label" style="margin-top: 60px !important;">Product Images: <sup><span
                                            class="text-danger fw-700 fs-6 ">*</span></sup></label>
                                <div class="d-flex justify-start">
                                    <div>
                                        <div class="d-flex flex-wrap justify-content-start" id="product_images_container">

                                        </div>
                                    </div>
                                    <div>
                                        <div  style="  margin-bottom: 50px; width: 100px; height: 50px;">
                                            <div>
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
                                                       accept="image/png, image/jpeg, image/jpg, image/gif, image/webp" multiple="" >
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status: <sup><span
                                            class="text-danger fw-700 fs-6 ">*</span></sup></label>
                                <select name="status" class="form-control select2-show-search form-select" data-placeholder="Choose one">
                                    <option value="active">Active </option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" id="saveButton" class="btn btn-primary p-3 fw-semibold">Save Product</button>
                            </div>
                        </form>
                    </div>
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
        // .reset()
            document.getElementById('form');
            document.getElementById('product_images_container').innerHTML = product_imges_show();
        }


        function product_imges_show() {
            var image = "";
            images.forEach((i) => {
                image += `<div class="d-flex justify-content-center position-relative"
                                style="width: 150px; overflow: hidden; margin: 5px; border-radius: 6px; height: 80px;">
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
            plugins: 'advlist  lists ',
            toolbar: 'formatselect | bold italic forecolor | alignleft | bullist ',
            height: 300,
        });
    </script>

    {{-- This is for fullDescription --}}
    <script>
        tinymce.init({
            selector: '#fullDescription', // The ID of your textarea
            apiKey: 'mao5ue5nvhseruiz5rsib0eu3pud0stwxe8kdpfa76enhe4x',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak table',
            toolbar: 'undo redo | formatselect | bold italic underline forecolor backcolor fontfamily fontsizeinput | hr alignleft aligncenter alignright alignjustify | table | bullist numlist outdent indent | link image',
            file_picker_types: 'file image media',
            automatic_uploads: true,
            file_picker_callback: (cb, value, meta) => {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.addEventListener('change', (e) => {
                    const file = e.target.files[0];

                    const reader = new FileReader();
                    reader.addEventListener('load', () => {
                        /*
                          Note: Now we need to register the blob in TinyMCEs image blob
                          registry. In the next release this part hopefully won't be
                          necessary, as we are looking to handle it internally.
                        */
                        const id = 'blobid' + (new Date()).getTime();
                        const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        const base64 = reader.result.split(',')[1];
                        const blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), { title: file.name });
                    });
                    reader.readAsDataURL(file);
                });

                input.click();
            },
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'

        });
    </script>
{{--    select-multi-color--}}
    <script>
        $(document).ready(function() {
            $('.select-multi-color').select2({
                allowClear: true
            });
        });

    </script>
{{--    select-multi-size--}}
    <script>
        $(document).ready(function() {
            $('.select-multi-size').select2({
                allowClear: true // Allows clearing the selected options
            });
        });
    </script>

{{--    new Attribute--}}
    <script>
        let attributeIndex = 0;

        // Function to add an attribute
        function addAttribute() {
            const div = document.createElement('div');
            div.className = "attribute-group mt-2";

            div.innerHTML = `
            <input type="text" class="border border-primary p-2" style="border-radius: 5px;" name="attributes[${attributeIndex}][key]" placeholder="Attribute Name" required>
            <input type="text" class="border border-primary p-2" style="border-radius: 5px;" name="attributes[${attributeIndex}][value]" placeholder="Attribute Value" required>
            <button type="button" class="btn btn-danger btn-sm remove-button">Remove</button>
        `;

            document.getElementById('dynamicAttributes').appendChild(div);
            attributeIndex++;
        }

        // Function to handle clicks on the container
        function handleContainerClick(event) {
            if (event.target.classList.contains('remove-button')) {
                const div = event.target.parentNode;
                div.remove();
            }
        }
        document.getElementById('addAttributeButton').addEventListener('click', addAttribute);
        document.getElementById('dynamicAttributes').addEventListener('click', handleContainerClick);
    </script>

@endsection
