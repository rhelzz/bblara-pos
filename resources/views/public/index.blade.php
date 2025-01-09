<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Food Order Page</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    </head>
    <body class="bg-gray-100 flex">
        <!-- Sidebar -->
        <div class="w-1/5 bg-[#3a4074] text-white min-h-screen p-4">
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
        <section class="w-3/5 p-4 overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center space-x-2">
                    <input
                        type="text"
                        placeholder="Search Products Here ..."
                        class="border rounded-lg py-2 px-4 mr-5"
                        style="width: 52rem;"
                    />
                    <i class="fas fa-filter text-2xl text-[#d6d6d7]"></i>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-4 mb-4">
                <div class="bg-white p-4 rounded-lg shadow">
                    <i class="fa-solid fa-mug-hot text-[#f2bc14] text-6xl mb-12"></i>
                    <p class="font-bold">Drink</p>
                    <div>20 items</div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <i class="fas fa-ellipsis-h text-[#f2bc14] text-6xl mb-12"></i>
                    <p class="font-bold">Etc.</p>
                    <div>30 items</div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                @foreach ($product as $row)
                    <div class="bg-white p-4 rounded-lg shadow-lg max-w-xs">
                        <div class="flex justify-center">
                            <img
                                src="{{ asset('storage/' . $row->product_image) }}"
                                alt="{{ $row->product_name }}"
                                class="rounded-lg mb-4 w-full h-56 object-cover"
                            />
                        </div>
                        <div class="text-left">
                            <div class="font-bold text-lg">{{ $row->product_name }}</div>
                            <div class="text-sm text-gray-500 mb-4">{{ $row->product_label }}</div>
                            <div class="text-red-500 font-bold text-sm">Rp {{ number_format($row->product_price, 0, ',', '.') }}</div>
                            <div class="flex space-x-2 mt-4">
                                <button
                                    class="bg-[#3a4074] text-white rounded-lg px-4 py-2 hover:bg-indigo-700 transition duration-300 w-full add-to-order"
                                    data-name="{{ $row->product_name }}"
                                    data-price="{{ $row->product_price }}"
                                >
                                    Add to order
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Payment Bill -->
        <div class="w-1/5 bg-white p-4 shadow-lg pt-12">
            <div class="font-bold text-xl mb-4">Payment Bill</div>
            <div class="bg-[#f1f4fd] p-2 rounded-lg mb-4">
                <div class="font-bold text-yellow-500 text-center">All Orders</div>
            </div>
            <div class="space-y-4" id="order-list">
                <!-- Orders will be added here dynamically -->
            </div>
            <div>
                <div class="bg-[#f1f4fd] px-5 py-5 rounded-md mb-5 mt-5">
                    <div class="flex justify-between">
                        <div>Sub total</div>
                        <div id="subtotal">Rp 0</div>
                    </div>
                    <div class="flex justify-between">
                        <div>Tax</div>
                        <div>5%</div>
                    </div>
                    <div class="border-t-[2px] border-[#000000] border-dashed my-4"></div>
                    <div class="flex justify-between text-md font-bold">
                        <div>Total Amount</div>
                        <div id="total-amount">Rp 0</div>
                    </div>
                </div>
            </div>
            <button class="bg-yellow-500 text-white w-full py-2 rounded-lg mt-4">
                Place Order
            </button>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const orderList = document.getElementById("order-list");
                const subtotalElement = document.getElementById("subtotal");
                const totalAmountElement = document.getElementById("total-amount");

                let orders = {};
                let subtotal = 0;

                function formatCurrency(value) {
                    return value.toLocaleString("id-ID", {
                        style: "currency",
                        currency: "IDR",
                    }).replace("IDR", "Rp").trim();
                }

                function updateTotals() {
                    subtotal = Object.values(orders).reduce((sum, order) => sum + order.total, 0);
                    const tax = subtotal * 0.05; // Pajak 5%
                    const total = subtotal + tax;

                    subtotalElement.textContent = formatCurrency(subtotal);
                    totalAmountElement.textContent = formatCurrency(total);
                }

                function renderOrders() {
                    orderList.innerHTML = ""; // Bersihkan daftar pesanan

                    for (const [name, order] of Object.entries(orders)) {
                        // Elemen baru untuk setiap produk
                        const orderItem = document.createElement("div");
                        orderItem.className = "flex justify-between items-center bg-gray-50 p-2 rounded-md shadow";

                        orderItem.innerHTML = `
                            <div>
                                <p class="font-semibold">${order.name}</p>
                                <p class="text-sm text-gray-500">Rp ${order.price.toLocaleString("id-ID")} <span class="order-quantity">${order.quantity}</span>x</p>
                            </div>
                            <div class="text-right">
                                <p class="order-total font-bold">${formatCurrency(order.total)}</p>
                                <button class="text-red-500 text-sm remove-item" data-name="${name}"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        `;

                        // Event Listener untuk tombol "Remove"
                        orderItem.querySelector(".remove-item").addEventListener("click", () => {
                            const itemName = orderItem.querySelector(".remove-item").getAttribute("data-name");
                            if (orders[itemName].quantity > 1) {
                                orders[itemName].quantity--;
                                orders[itemName].total -= orders[itemName].price;
                            } else {
                                delete orders[itemName];
                            }

                            renderOrders();
                            updateTotals();
                        });

                        orderList.appendChild(orderItem);
                    }
                }

                document.querySelectorAll(".add-to-order").forEach((button) => {
                    button.addEventListener("click", function () {
                        const name = this.getAttribute("data-name");
                        const price = parseInt(this.getAttribute("data-price"));

                        // Tambahkan atau perbarui pesanan
                        if (orders[name]) {
                            orders[name].quantity++;
                            orders[name].total += price;
                        } else {
                            orders[name] = { name, price, quantity: 1, total: price };
                        }

                        renderOrders();
                        updateTotals();
                    });
                });
            });
        </script>
    </body>
</html>
