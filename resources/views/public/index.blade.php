<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Order Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <section class="w-3/5 p-4 overflow-y-auto" style="max-height: 100vh;">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center space-x-2">
                <input
                    type="text"
                    id="search-input"
                    placeholder="Search Products Here ..."
                    class="border rounded-lg py-2 px-4 mr-5 w-[52rem] xl:w-[52rem] lg:w-[33.5rem] xl:mr-2 lg:mr-1"
                />
                <i class="fas fa-filter text-2xl text-[#d6d6d7]"></i>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4 lg:gap-2 xl:gap-3" id="product-list">
            @foreach ($product as $row)
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-xs xl:p-4 lg:p-2 product-card" data-name="{{ strtolower($row->product_name) }}" data-cost="{{ $row->cost_price }}">
                <div class="flex justify-center">
                    <img
                        src="{{ asset('storage/' . $row->product_image) }}"
                        alt="{{ $row->product_name }}"
                        class="rounded-lg mb-4 w-full h-56 object-cover lg:h-40 xl:h-56 lg:mb-1 xl:mb-4"
                    />
                </div>
                <div class="text-left">
                    <div class="font-bold text-lg lg:text-base xl:text-lg">{{ $row->product_name }}</div>
                    <div class="text-sm text-gray-500 mb-4 xl:mb-4 lg:mb-[0.35rem] xl:text-sm lg:text-xs">{{ $row->product_label }}</div>
                    <div class="text-red-500 font-bold text-sm">Rp {{ number_format($row->product_price, 0, ',', '.') }}</div>
                    <div class="flex space-x-2 mt-4">
                        <button
                            class="bg-[#3a4074] text-white rounded-lg px-4 py-2 hover:bg-indigo-700 transition duration-300 w-full add-to-order"
                            data-name="{{ $row->product_name }}"
                            data-price="{{ $row->product_price }}"
                            data-cost="{{ $row->cost_price }}"
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
            <form id="order-form" action="{{ route('cashier.store') }}" method="POST">
                @csrf
                <div class="bg-[#f1f4fd] px-5 py-5 rounded-md mb-5 mt-5">
                    <div class="flex justify-between">
                        <div class="text-base xl:text-base lg:text-xs">Sub total</div>
                        <div class="text-base xl:text-base lg:text-xs" id="subtotal">Rp 0</div>
                        <input type="hidden" name="subtotal" id="subtotal-input" value="0">
                    </div>
                    <div class="flex justify-between">
                        <div class="text-base xl:text-base lg:text-xs">Tax</div>
                        <div class="text-base xl:text-base lg:text-xs">5%</div>
                        <input type="hidden" name="tax" id="tax-input" value="5">
                    </div>
                    <div class="border-t-[2px] border-[#000000] border-dashed my-4"></div>
                    <div class="flex justify-between text-md font-bold">
                        <div class="text-base xl:text-base lg:text-xs">Total Amount</div>
                        <div class="text-base xl:text-base lg:text-xs" id="total-amount-display">Rp 0</div>
                        <input type="hidden" name="total_amount" id="total-amount-input" value="0">
                    </div>
                    <div class="hidden">
                        <!-- Menyertakan cost_price untuk setiap item -->
                        @foreach ($product as $row)
                        <input type="hidden" name="orders[{{ $row->product_name }}][cost_price]" value="{{ $row->cost_price }}">
                        @endforeach
                    </div>
                    <button type="button" id="place-order-button" class="bg-yellow-500 text-white w-full py-2 rounded-lg mt-4">
                        Place Order
                    </button>
                </div>
            </form>            
        </div>        
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const orderList = document.getElementById("order-list");
            const subtotalElement = document.getElementById("subtotal");
            const totalAmountElement = document.getElementById("total-amount");
            const searchInput = document.getElementById("search-input");
            const productCards = document.querySelectorAll(".product-card");

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

                // Update tampilan subtotal dan total amount
                subtotalElement.textContent = formatCurrency(subtotal);
                const totalAmountDisplay = document.getElementById("total-amount-display");
                totalAmountDisplay.textContent = formatCurrency(total);

                // Set nilai ke input hidden
                document.getElementById("subtotal-input").value = subtotal;
                document.getElementById("total-amount-input").value = total;
            }

            function renderOrders() {
                orderList.innerHTML = ""; // Bersihkan daftar pesanan
                let totalCostAll = 0; // Untuk menyimpan total cost semua item

                for (const [name, order] of Object.entries(orders)) {
                    const orderItem = document.createElement("div");
                    orderItem.className = "flex justify-between items-center bg-gray-50 p-2 rounded-md shadow";

                    // Hitung total cost berdasarkan quantity
                    const totalCost = order.cost * order.quantity;
                    totalCostAll += totalCost; // Menambahkan ke total keseluruhan

                    orderItem.innerHTML = `
                        <div>
                            <p class="font-semibold text-base xl:text-base lg:text-xs">${order.name}</p>
                            <p class="text-sm text-gray-500 xl:text-sm lg:text-xs">Rp ${order.price.toLocaleString("id-ID")} <span class="order-quantity">${order.quantity}</span>x</p>
                        </div>
                        <div class="text-right">
                            <p class="order-total font-bold text-base xl:text-base lg:text-xs">${formatCurrency(order.total)}</p>
                            <button class="text-red-500 text-sm remove-item xl:text-sm lg:text-xs" data-name="${name}"><i class="fa-solid fa-trash"></i></button>
                        </div>
                        <input type="hidden" name="orders[${name}][cost_price]" value="${totalCost}">
                        <input type="hidden" name="orders[${name}][quantity]" value="${order.quantity}">
                    `;

                    orderItem.querySelector(".remove-item").addEventListener("click", () => {
                        if (orders[name].quantity > 1) {
                            orders[name].quantity--;
                            orders[name].total -= orders[name].price;
                        } else {
                            delete orders[name];
                        }
                        renderOrders();
                        updateTotals();
                    });

                    orderList.appendChild(orderItem);
                }

                // Update input hidden cost_price di payment form
                const existingCostInput = document.querySelector('input[name="cost_price"]');
                if (!existingCostInput) {
                    // Jika belum ada, buat input baru
                    const costInput = document.createElement('input');
                    costInput.type = 'hidden';
                    costInput.name = 'cost_price';
                    costInput.value = totalCostAll;
                    document.getElementById('order-form').appendChild(costInput);
                } else {
                    // Jika sudah ada, update nilainya
                    existingCostInput.value = totalCostAll;
                }
            }

            function initializeAddToOrder() {
                document.querySelectorAll(".add-to-order").forEach((button) => {
                    button.onclick = function () {
                        const name = this.getAttribute("data-name");
                        const price = parseInt(this.getAttribute("data-price"));
                        const cost = parseInt(this.getAttribute("data-cost"));  // Ambil cost_price

                        if (orders[name]) {
                            orders[name].quantity++;
                            orders[name].total += price;
                        } else {
                            orders[name] = { name, price, cost, quantity: 1, total: price };
                        }

                        renderOrders();
                        updateTotals();
                    };
                });
            }

            function handleSearch() {
                const query = searchInput.value.toLowerCase();

                productCards.forEach((card) => {
                    const productName = card.getAttribute("data-name");
                    if (productName.includes(query)) {
                        card.classList.remove("hidden");
                    } else {
                        card.classList.add("hidden");
                    }
                });
            }

            searchInput.addEventListener("input", () => {
                handleSearch();
                initializeAddToOrder(); // Reinitialize events after filtering
            });

            initializeAddToOrder();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const placeOrderButton = document.getElementById("place-order-button");
            const orderForm = document.getElementById("order-form");

            placeOrderButton.addEventListener("click", function () {
                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to place this order?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, place it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            "Order Placed!",
                            "Your order has been successfully placed.",
                            "success"
                        ).then(() => {
                            orderForm.submit();
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
