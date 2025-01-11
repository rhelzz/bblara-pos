<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Add Product - Bblar'a</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Add these in the head section -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link href="https://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">
        <style>
            body {
                font-family: 'SF Pro Display', sans-serif;
            }
        </style>
    </head>
    <body class="bg-gray-100 flex">

        <!-- Sidebar -->
        <x-navbar-pos></x-navbar-pos>

        <!-- Main Content -->
        <section class="w-4/5 p-4 flex justify-center items-center space-x-8">
            <!-- Form Card -->
            <div class="bg-white p-8 rounded-lg shadow-md max-w-lg w-full">
                <h2 class="text-2xl font-bold mb-6 text-center">Add New Product</h2>
                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Token CSRF untuk keamanan -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="product-name">Product Name</label>
                        <input
                            type="text"
                            id="product_name"
                            name="product_name"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter product name"
                            required
                        />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="product-label">Product Label</label>
                        <input
                            type="text"
                            id="product_label"
                            name="product_label"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter product label"
                            required
                        />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="cost-price">Cost Price</label>
                        <input
                            type="number"
                            id="cost_price"
                            name="cost_price"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter cost price"
                            required
                        />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="product-price">Product Price</label>
                        <input
                            type="number"
                            id="product_price"
                            name="product_price"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            placeholder="Enter product price"
                            required
                        />
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="product-image">Product Image</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="product_image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-3"></i>
                                    <p id="file-name" class="mb-2 text-sm text-gray-500">No file chosen</p>
                                    <p class="text-xs text-gray-500">SVG, PNG, JPG</p>
                                </div>
                                <input id="product_image" name="product_image" type="file" class="hidden" accept="image/*" />
                            </label>
                        </div>
                    </div>                    
                    <div class="flex items-center justify-center">
                        <button
                            type="submit"
                            class="bg-[#3a4074] hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-300"
                        >
                            Add Product
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white p-4 rounded-lg shadow-lg max-w-xs">
                <div class="flex justify-center">
                    <!-- Update the preview image container -->
                    <img
                    src="https://via.placeholder.com/500"
                    alt="Kebab Keju Lumer"
                    id="product-preview"
                    class="rounded-lg mb-4 w-56 h-56 object-cover"
                    />
                </div>
                <div class="text-left">
                    <div class="font-bold text-lg" id="product-name-preview">Nama produk</div>
                    <div class="text-sm text-gray-500 mb-4" id="product-label-preview">Label</div>
                    <div class="text-red-500 font-bold text-sm" id="product-price-preview">Harga</div>
                    <button
                        class="bg-[#3a4074] text-white rounded-lg px-4 py-2 mt-4 hover:bg-indigo-700 transition duration-300 mx-auto w-full add-to-order"
                        data-name="Kebab Keju Lumer"
                        data-price="14000"
                    >
                        Add to order
                    </button>
                </div>
            </div>

        </section>
     
        <script>
        
            // Function to format price to Indonesian Rupiah
            function formatRupiah(price) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(price);
            }
        
            // Real-time preview functionality
            document.addEventListener('DOMContentLoaded', function() {
                const productNameInput = document.getElementById('product_name');
                const productLabelInput = document.getElementById('product_label');
                const productPriceInput = document.getElementById('product_price');
                const productImageInput = document.getElementById('product_image');
                
                const previewName = document.getElementById('product-name-preview');
                const previewLabel = document.getElementById('product-label-preview');
                const previewPrice = document.getElementById('product-price-preview');
                const previewImage = document.getElementById('product-preview');
                const fileNameDisplay = document.getElementById('file-name');
        
                // Update product name preview
                productNameInput.addEventListener('input', function() {
                    previewName.textContent = this.value || 'Kebab Keju Lumer';
                });
        
                // Update product label preview
                productLabelInput.addEventListener('input', function() {
                    previewLabel.textContent = this.value || 'Best Seller';
                });
        
                // Update product price preview
                productPriceInput.addEventListener('input', function() {
                    const price = this.value || '14000';
                    previewPrice.textContent = formatRupiah(price);
                });
        
                // Handle image upload and preview
                productImageInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        // Update file name display
                        fileNameDisplay.textContent = file.name;
        
                        // Create object URL for preview
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            // Create a new image to handle resizing
                            const img = new Image();
                            img.onload = function() {
                                // Create canvas for resizing
                                const canvas = document.createElement('canvas');
                                canvas.width = 500;
                                canvas.height = 500;
                                const ctx = canvas.getContext('2d');
        
                                // Calculate position to center the image
                                let dx = 0, dy = 0, dWidth = 500, dHeight = 500;
                                const ratio = Math.max(500/img.width, 500/img.height);
                                dWidth = img.width * ratio;
                                dHeight = img.height * ratio;
                                dx = (500 - dWidth) / 2;
                                dy = (500 - dHeight) / 2;
        
                                // Draw image centered and scaled
                                ctx.fillStyle = '#ffffff'; // White background
                                ctx.fillRect(0, 0, 500, 500);
                                ctx.drawImage(img, dx, dy, dWidth, dHeight);
        
                                // Update preview with resized image
                                previewImage.src = canvas.toDataURL('image/jpeg');
                            };
                            img.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>

        <script>

            // Existing toastr configuration code...

            @if(session('success'))
                toastr.success("{{ session('success') }}");
            @endif
            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
        
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
        </script>
    </body>
</html>
