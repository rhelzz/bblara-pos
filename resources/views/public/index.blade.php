<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Food Order Page</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
        <style>
            body {
            font-family: 'Poppins', sans-serif;
            }
            .main-content {
                height: calc(100vh - 16px); /* Adjust height considering padding/margin */
                overflow-y: auto;
            }
        </style>
    </head>
    <body class="bg-gray-100" style="display: flex;">
        <!-- Sidebar -->
        <div class="w-1/5 bg-indigo-900 text-white min-h-screen p-4">
            <div class="flex items-center mb-8">
            <img src="{{ asset('assets/logo.png') }}" alt="" class="w-32 h-32 mx-auto bg-white rounded-full">
            </div>
            <nav class="space-y-4 ml-7">
                <a href="#" class="flex items-center space-x-2">
                    <i class="fas fa-cash-register"></i>
                    <span>Cashier</span>
                </a>
                <a href="#" class="flex items-center space-x-2">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tambah Produk</span>
                </a>
                <a href="#" class="flex items-center space-x-2">
                    <i class="fas fa-box-open"></i>
                    <span>Barang Masuk</span>
                </a>
                <a href="#" class="flex items-center space-x-2">
                    <i class="fas fa-box"></i>
                    <span>Barang Keluar</span>
                </a>
                <a href="#" class="flex items-center space-x-2">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transaksi Kasir</span>
                </a>
                <a href="#" class="flex items-center space-x-2">
                    <i class="fas fa-file-alt"></i>
                    <span>Laporan Penjualan</span>
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <section class="w-3/5 p-4 main-content">
            <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-2">
                <i class="fas fa-bars text-2xl"></i>
                <input
                type="text"
                placeholder="Search Products Here ..."
                class="border rounded-lg py-2 px-4"
                style="width: 50rem;"
                />
                <i class="fas fa-filter text-2xl"></i>
            </div>
            </div>

            <div class="grid grid-cols-4 gap-4 mb-4">
            <div class="bg-white p-4 rounded-lg shadow">
                <i class="fas fa-hamburger text-yellow-500 text-3xl mb-2"></i>
                <div>Food</div>
                <div>10 items</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <i class="fas fa-glass-cheers text-yellow-500 text-3xl mb-2"></i>
                <div>Drink</div>
                <div>20 items</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <i class="fas fa-birthday-cake text-yellow-500 text-3xl mb-2"></i>
                <div>Dessert</div>
                <div>12 items</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <i class="fas fa-ellipsis-h text-yellow-500 text-3xl mb-2"></i>
                <div>Etc.</div>
                <div>30 items</div>
            </div>
            </div>

            <div class="grid grid-cols-3 gap-4">

                <!-- Example Products -->
                <div class="bg-white p-4 rounded-lg shadow-lg text-center max-w-xs">
                    <img
                        src="https://storage.googleapis.com/a1aa/image/GTduNWUxOho3NF78dxHfAwSFGrw43BefZuNIKqCQ6urDpxFoA.jpg"
                        alt="Kebab Keju Lumer"
                        class="rounded-lg mb-4 w-full h-40 object-cover"
                    />
                    <div class="font-bold text-lg">Kebab Keju Lumer</div>
                    <div class="text-sm text-gray-500 mb-2">Best Seller</div>
                    <div class="text-red-500 font-bold text-xl">Rp 14.000</div>
                    <button
                        class="bg-indigo-900 text-white rounded-lg px-4 py-2 mt-4 hover:bg-indigo-700 transition duration-300"
                    >
                        Add to order
                    </button>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-lg text-center max-w-xs">
                    <img
                        src="https://storage.googleapis.com/a1aa/image/GTduNWUxOho3NF78dxHfAwSFGrw43BefZuNIKqCQ6urDpxFoA.jpg"
                        alt="Kebab Keju Lumer"
                        class="rounded-lg mb-4 w-full h-40 object-cover"
                    />
                    <div class="font-bold text-lg">Kebab Keju Lumer</div>
                    <div class="text-sm text-gray-500 mb-2">Best Seller</div>
                    <div class="text-red-500 font-bold text-xl">Rp 14.000</div>
                    <button
                        class="bg-indigo-900 text-white rounded-lg px-4 py-2 mt-4 hover:bg-indigo-700 transition duration-300"
                    >
                        Add to order
                    </button>
                </div>
                
                <div class="bg-white p-4 rounded-lg shadow-lg text-center max-w-xs">
                    <img
                        src="https://storage.googleapis.com/a1aa/image/GTduNWUxOho3NF78dxHfAwSFGrw43BefZuNIKqCQ6urDpxFoA.jpg"
                        alt="Kebab Keju Lumer"
                        class="rounded-lg mb-4 w-full h-40 object-cover"
                    />
                    <div class="font-bold text-lg">Kebab Keju Lumer</div>
                    <div class="text-sm text-gray-500 mb-2">Best Seller</div>
                    <div class="text-red-500 font-bold text-xl">Rp 14.000</div>
                    <button
                        class="bg-indigo-900 text-white rounded-lg px-4 py-2 mt-4 hover:bg-indigo-700 transition duration-300"
                    >
                        Add to order
                    </button>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-lg text-center max-w-xs">
                    <img
                        src="https://storage.googleapis.com/a1aa/image/GTduNWUxOho3NF78dxHfAwSFGrw43BefZuNIKqCQ6urDpxFoA.jpg"
                        alt="Kebab Keju Lumer"
                        class="rounded-lg mb-4 w-full h-40 object-cover"
                    />
                    <div class="font-bold text-lg">Kebab Keju Lumer</div>
                    <div class="text-sm text-gray-500 mb-2">Best Seller</div>
                    <div class="text-red-500 font-bold text-xl">Rp 14.000</div>
                    <button
                        class="bg-indigo-900 text-white rounded-lg px-4 py-2 mt-4 hover:bg-indigo-700 transition duration-300"
                    >
                        Add to order
                    </button>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-lg text-center max-w-xs">
                    <img
                        src="https://storage.googleapis.com/a1aa/image/GTduNWUxOho3NF78dxHfAwSFGrw43BefZuNIKqCQ6urDpxFoA.jpg"
                        alt="Kebab Keju Lumer"
                        class="rounded-lg mb-4 w-full h-40 object-cover"
                    />
                    <div class="font-bold text-lg">Kebab Keju Lumer</div>
                    <div class="text-sm text-gray-500 mb-2">Best Seller</div>
                    <div class="text-red-500 font-bold text-xl">Rp 14.000</div>
                    <button
                        class="bg-indigo-900 text-white rounded-lg px-4 py-2 mt-4 hover:bg-indigo-700 transition duration-300"
                    >
                        Add to order
                    </button>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-lg text-center max-w-xs">
                    <img
                        src="https://storage.googleapis.com/a1aa/image/GTduNWUxOho3NF78dxHfAwSFGrw43BefZuNIKqCQ6urDpxFoA.jpg"
                        alt="Kebab Keju Lumer"
                        class="rounded-lg mb-4 w-full h-40 object-cover"
                    />
                    <div class="font-bold text-lg">Kebab Keju Lumer</div>
                    <div class="text-sm text-gray-500 mb-2">Best Seller</div>
                    <div class="text-red-500 font-bold text-xl">Rp 14.000</div>
                    <button
                        class="bg-indigo-900 text-white rounded-lg px-4 py-2 mt-4 hover:bg-indigo-700 transition duration-300"
                    >
                        Add to order
                    </button>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-lg text-center max-w-xs">
                    <img
                        src="https://storage.googleapis.com/a1aa/image/GTduNWUxOho3NF78dxHfAwSFGrw43BefZuNIKqCQ6urDpxFoA.jpg"
                        alt="Kebab Keju Lumer"
                        class="rounded-lg mb-4 w-full h-40 object-cover"
                    />
                    <div class="font-bold text-lg">Kebab Keju Lumer</div>
                    <div class="text-sm text-gray-500 mb-2">Best Seller</div>
                    <div class="text-red-500 font-bold text-xl">Rp 14.000</div>
                    <button
                        class="bg-indigo-900 text-white rounded-lg px-4 py-2 mt-4 hover:bg-indigo-700 transition duration-300"
                    >
                        Add to order
                    </button>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-lg text-center max-w-xs">
                    <img
                        src="https://storage.googleapis.com/a1aa/image/GTduNWUxOho3NF78dxHfAwSFGrw43BefZuNIKqCQ6urDpxFoA.jpg"
                        alt="Kebab Keju Lumer"
                        class="rounded-lg mb-4 w-full h-40 object-cover"
                    />
                    <div class="font-bold text-lg">Kebab Keju Lumer</div>
                    <div class="text-sm text-gray-500 mb-2">Best Seller</div>
                    <div class="text-red-500 font-bold text-xl">Rp 14.000</div>
                    <button
                        class="bg-indigo-900 text-white rounded-lg px-4 py-2 mt-4 hover:bg-indigo-700 transition duration-300"
                    >
                        Add to order
                    </button>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-lg text-center max-w-xs">
                    <img
                        src="https://storage.googleapis.com/a1aa/image/GTduNWUxOho3NF78dxHfAwSFGrw43BefZuNIKqCQ6urDpxFoA.jpg"
                        alt="Kebab Keju Lumer"
                        class="rounded-lg mb-4 w-full h-40 object-cover"
                    />
                    <div class="font-bold text-lg">Kebab Keju Lumer</div>
                    <div class="text-sm text-gray-500 mb-2">Best Seller</div>
                    <div class="text-red-500 font-bold text-xl">Rp 14.000</div>
                    <button
                        class="bg-indigo-900 text-white rounded-lg px-4 py-2 mt-4 hover:bg-indigo-700 transition duration-300"
                    >
                        Add to order
                    </button>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-lg text-center max-w-xs">
                    <img
                        src="https://storage.googleapis.com/a1aa/image/GTduNWUxOho3NF78dxHfAwSFGrw43BefZuNIKqCQ6urDpxFoA.jpg"
                        alt="Kebab Keju Lumer"
                        class="rounded-lg mb-4 w-full h-40 object-cover"
                    />
                    <div class="font-bold text-lg">Kebab Keju Lumer</div>
                    <div class="text-sm text-gray-500 mb-2">Best Seller</div>
                    <div class="text-red-500 font-bold text-xl">Rp 14.000</div>
                    <button
                        class="bg-indigo-900 text-white rounded-lg px-4 py-2 mt-4 hover:bg-indigo-700 transition duration-300"
                    >
                        Add to order
                    </button>
                </div>

                <div class="bg-white p-4 rounded-lg shadow-lg text-center max-w-xs">
                    <img
                        src="https://storage.googleapis.com/a1aa/image/GTduNWUxOho3NF78dxHfAwSFGrw43BefZuNIKqCQ6urDpxFoA.jpg"
                        alt="Kebab Keju Lumer"
                        class="rounded-lg mb-4 w-full h-40 object-cover"
                    />
                    <div class="font-bold text-lg">Kebab Keju Lumer</div>
                    <div class="text-sm text-gray-500 mb-2">Best Seller</div>
                    <div class="text-red-500 font-bold text-xl">Rp 14.000</div>
                    <button
                        class="bg-indigo-900 text-white rounded-lg px-4 py-2 mt-4 hover:bg-indigo-700 transition duration-300"
                    >
                        Add to order
                    </button>
                </div>
                <!-- More products as needed... -->
            </div>
        </section>

        <!-- Payment Bill -->
        <div class="w-1/5 bg-white p-4 shadow-lg">
            <div class="font-bold text-xl mb-4">Payment Bill</div>
            <div class="bg-gray-100 p-2 rounded-lg mb-4">
            <div class="font-bold text-yellow-500 text-center">All Orders</div>
            </div>
            <div class="space-y-4">
            <div class="flex justify-between">
                <div>
                    <div>Kentang Saus Keju</div>
                    <div class="text-sm text-gray-500">
                        Rp 15.000
                        <span class="text-red-500">2x</span>
                    </div>
                </div>
                <div class="text-red-500 font-bold">Rp 30.000</div>
            </div>
            <!-- More orders as needed... -->
            </div>
            <div class="border-t border-gray-300 my-4"></div>
            <div class="flex justify-between">
            <div>Sub total</div>
            <div class="font-bold">Rp 125.000</div>
            </div>
            <div class="flex justify-between">
            <div>Tax</div>
            <div class="font-bold">5%</div>
            </div>
            <div class="border-t border-gray-300 my-4"></div>
            <div class="flex justify-between text-xl font-bold">
            <div>Total Amount</div>
            <div>Rp 131.500</div>
            </div>
            <button class="bg-yellow-500 text-white w-full py-2 rounded-lg mt-4">
            Place Order
            </button>
        </div>
    </body>
</html>
