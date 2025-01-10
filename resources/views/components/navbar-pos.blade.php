<div class="w-1/5 bg-[#3a4074] text-white min-h-screen p-4">
    <div class="flex items-center mb-8">
        <img src="{{ asset('assets/logo.png') }}" alt="" class="w-32 h-32 mx-auto bg-white rounded-full">
    </div>
    <nav class="space-y-4 ml-7">
        <a href="#" class="flex items-center space-x-2 group">
            <i class="fas fa-file-alt"></i>
            <span class="relative group-hover:text-yellow-400 lg:text-xs xl:text-base">
                Laporan Penjualan
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"></span>
            </span>
        </a>
        <a href="{{ route('cashier.index') }}" class="flex items-center space-x-2 group">
            <i class="fas fa-cash-register"></i>
            <span class="relative group-hover:text-yellow-400 lg:text-xs xl:text-base">
                Cashier
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"></span>
            </span>
        </a>
        <a href="{{ route('product.index') }}" class="flex items-center space-x-2 group">
            <i class="fa-solid fa-plus"></i>
            <span class="relative group-hover:text-yellow-400 lg:text-xs xl:text-base">
                Tambah Produk
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"></span>
            </span>
        </a>
        <a href="#" class="flex items-center space-x-2 group">
            <i class="fas fa-box-open"></i>
            <span class="relative group-hover:text-yellow-400 lg:text-xs xl:text-base">
                Barang Masuk
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"></span>
            </span>
        </a>
        <a href="#" class="flex items-center space-x-2 group">
            <i class="fas fa-box"></i>
            <span class="relative group-hover:text-yellow-400 lg:text-xs xl:text-base">
                Barang Keluar
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"></span>
            </span>
        </a>
        <a href="#" class="flex items-center space-x-2 group">
            <i class="fas fa-exchange-alt"></i>
            <span class="relative group-hover:text-yellow-400 lg:text-xs xl:text-base">
                Transaksi Kasir
                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-white transition-all duration-300 group-hover:w-full"></span>
            </span>
        </a>
    </nav>
</div>
