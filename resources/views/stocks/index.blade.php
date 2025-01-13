<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Cashier Transaction - Bblar'a</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link href="https://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <style>
            body {
                font-family: 'SF Pro Display', sans-serif;
            }

            #barangKeluarTable_wrapper {
                padding: 1rem;
            }

            table.dataTable thead th {
                border-bottom: 2px solid #e5e7eb;
                font-weight: 600;
                color: #374151;
            }

            table.dataTable tbody tr:hover {
                background-color: #f9fafb;
            }

            .dataTables_paginate .paginate_button {
                padding: 0.5rem 1rem;
                margin: 0 0.2rem;
                background-color: #ffffff;
                border: 1px solid #d1d5db;
                border-radius: 0.375rem;
                color: #1f2937;
            }

            .dataTables_paginate .paginate_button:hover {
                background-color: #e5e7eb; 
                color: #1f2937; 
            }

            .dataTables_paginate .paginate_button.current {
                background-color: #2563eb;
                color: #ffffff;
                border: 1px solid #2563eb;
            }

            .dataTables_filter input {
                padding: 0.25rem;
                border: 1px solid #d1d5db;
                border-radius: 0.375rem;
                margin-left: 0.5rem;
                margin-bottom: 1rem;
                width: 175px;
                height: 30px;
                box-sizing: border-box;
            }

            .dataTables_length select {
                padding: 0.5rem;
                border: 1px solid #d1d5db;
                border-radius: 0.375rem;
                margin-right: 0.5rem;
            }
        </style>
    </head>
    <body class="bg-gray-100 flex">

        <x-navbar-pos></x-navbar-pos>

        <section class="w-4/5 px-10 py-10">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-semibold">Hello, Bblar’a! 👋</h1>
                    <p class="text-gray-600">Ini adalah apa yang terjadi pada stok barang keluar-mu saat ini</p>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table id="barangKeluarTable" class="w-full text-sm text-left text-gray-500 border-collapse">
                    <thead class="bg-gray-200 text-gray-700 uppercase text-sm">
                        <tr>
                            <th class="px-6 py-3">No</th>
                            <th class="px-6 py-3">Produk</th>
                            <th class="px-6 py-3">Tanggal Expired</th>
                            <th class="px-6 py-3">Jumlah Tersedia</th>
                            <th class="px-6 py-3">Jumlah Keluar</th>
                            <th class="px-6 py-3">Jumlah Sekarang</th>
                            <th class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($stocks as $stock)
                        <tr>
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $stock->product }}</td>
                            <td class="px-6 py-4">{{ $stock->expired_date }}</td>
                            <td class="px-6 py-4">{{ $stock->stock_in }}</td>
                            <td class="px-6 py-4">{{ $stock->stock_out }}</td>
                            <td class="px-6 py-4">{{ $stock->stock_now }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('stock.edit', $stock->id) }}" class="px-3 py-2 text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg shadow mr-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('stock.destroy', $stock->id) }}" method="POST" class="inline-block mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg shadow">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>                
            </div>
        </section>
        
        <script>
            $(document).ready(function () {
                $('#barangKeluarTable').DataTable({
                    paging: true,
                    searching: true,
                    ordering: true,
                    info: true,
                    responsive: true,
                    language: {
                        search: "Cari Produk: ",
                        lengthMenu: "Tampilkan _MENU_ data per halaman",
                        info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                        paginate: {
                            previous: "Sebelumnya",
                            next: "Berikutnya"
                        }
                    }
                });
            });
        </script>        

    </body>
</html>
