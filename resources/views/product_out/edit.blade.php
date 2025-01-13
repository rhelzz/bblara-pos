<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Product In - Bblar’a</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link href="https://fonts.cdnfonts.com/css/sf-pro-display" rel="stylesheet">
</head>
<body class="bg-gray-100 flex">

    <x-navbar-pos></x-navbar-pos>

    <section class="w-4/5 px-10 py-10">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-semibold">Edit Product Out</h1>
                <p class="text-gray-600">Update data stok barang keluar di sini</p>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('product_out.update', $productOut->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="product" class="block text-sm font-medium text-gray-700">Produk</label>
                    <input type="text" id="product" name="product" class="w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ $productOut->product }}" required />
                </div>
                <div class="mb-4">
                    <label for="expired_date" class="block text-sm font-medium text-gray-700">Tanggal Expired</label>
                    <input type="date" id="expired_date" name="expired_date" class="w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ $productOut->expired_date }}" required />
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input type="number" id="quantity" name="quantity" class="w-full px-4 py-2 border border-gray-300 rounded-md" value="{{ $productOut->quantity }}" required />
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
                        <option value="good" {{ $productOut->status == 'good' ? 'selected' : '' }}>Good</option>
                        <option value="expired" {{ $productOut->status == 'expired' ? 'selected' : '' }}>Expired</option>
                    </select>
                </div>
                <div class="mb-4">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md">Update</button>
                </div>
            </form>
        </div>
    </section>

</body>
</html>
