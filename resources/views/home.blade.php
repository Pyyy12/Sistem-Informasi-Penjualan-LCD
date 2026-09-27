@extends('layouts.app')

@section('content')
<!-- Hero Section Cerah -->
<section class="relative overflow-hidden bg-gradient-to-b from-sky-100/60 via-cyan-50/40 to-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block py-1.5 px-4 rounded-full bg-sky-100 text-sky-700 font-bold text-xs uppercase tracking-widest mb-4">
            🚀 100% Presisi, Bergaransi & Berpengalaman
        </span>
        <h1 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tight leading-tight max-w-4xl mx-auto">
            Ganti Layar LCD HP Impian, <span class="bg-gradient-to-r from-sky-500 to-teal-500 bg-clip-text text-transparent">Beli LCD Saja</span> atau <span class="bg-gradient-to-r from-amber-500 to-rose-500 bg-clip-text text-transparent">Plus Pasang</span>.
        </h1>
        <p class="mt-4 text-slate-600 max-w-2xl mx-auto text-base md:text-lg">
            Sedia seluruh tipe LCD merk Android (Samsung, Xiaomi, Oppo, Vivo, Infinix) dan Apple iPhone dengan kualitas terbaik dan opsi pasang langsung.
        </p>

        <!-- Search Bar -->
        <div class="mt-8 max-w-2xl mx-auto bg-white p-2.5 rounded-2xl shadow-xl shadow-sky-500/10 border border-sky-100 flex flex-col sm:flex-row gap-2">
            <form action="{{ route('home') }}" method="GET" class="flex-1 flex items-center px-4">
                <i class="fa-solid fa-magnifying-glass text-slate-400 mr-3"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tipe: iPhone 13, Samsung S23, Redmi..." class="w-full focus:outline-none text-sm text-slate-700">
                <button type="submit" class="bg-sky-500 hover:bg-sky-600 text-white font-bold px-6 py-2.5 rounded-xl text-sm transition">Cari</button>
            </form>
        </div>
    </div>
</section>

<!-- Filter & Produk -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Brand Filter Badges -->
    <div class="flex flex-wrap gap-2 justify-center mb-10">
        <a href="{{ route('home') }}" class="px-5 py-2 rounded-xl text-sm font-bold {{ !request('os') && !request('brand') ? 'bg-sky-500 text-white shadow-md shadow-sky-400/30' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">Semua</a>
        <a href="{{ route('home', ['os' => 'iPhone']) }}" class="px-5 py-2 rounded-xl text-sm font-bold {{ request('os') == 'iPhone' ? 'bg-sky-500 text-white shadow-md shadow-sky-400/30' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">🍎 Apple iPhone</a>
        <a href="{{ route('home', ['os' => 'Android']) }}" class="px-5 py-2 rounded-xl text-sm font-bold {{ request('os') == 'Android' ? 'bg-sky-500 text-white shadow-md shadow-sky-400/30' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200' }}">🤖 Android All Brands</a>
    </div>

    <!-- Grid Produk LCD -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($products as $product)
        <div class="bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col group">
            <div class="relative h-60 bg-slate-100 overflow-hidden">
                <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=600' }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <span class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur-md rounded-full text-xs font-extrabold {{ $product->os_type === 'iPhone' ? 'text-indigo-600' : 'text-emerald-600' }}">
                    {{ $product->os_type }} • {{ $product->brand }}
                </span>
                <span class="absolute top-4 right-4 px-3 py-1 bg-sky-500 text-white rounded-full text-xs font-bold shadow-sm">
                    Stok: {{ $product->stock }}
                </span>
            </div>

            <div class="p-6 flex-1 flex flex-col justify-between">
                <div>
                    <h3 class="font-bold text-lg text-slate-900 group-hover:text-sky-600 transition">{{ $product->name }}</h3>
                    <p class="text-xs text-slate-500 mt-2 line-clamp-2 leading-relaxed">{{ $product->description }}</p>
                </div>

                <!-- 2 Model Opsi Harga -->
                <div class="mt-6 pt-4 border-t border-slate-100 space-y-2">
                    <div class="flex items-center justify-between text-sm bg-sky-50/60 p-2.5 rounded-xl border border-sky-100">
                        <span class="text-slate-600 font-medium"><i class="fa-solid fa-box text-sky-500 mr-1.5"></i> Beli LCD Saja</span>
                        <span class="font-extrabold text-sky-700">Rp {{ number_format($product->price_lcd_only, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex items-center justify-between text-sm bg-emerald-50/60 p-2.5 rounded-xl border border-emerald-100">
                        <span class="text-slate-600 font-medium"><i class="fa-solid fa-screwdriver-wrench text-emerald-500 mr-1.5"></i> LCD + Pasang</span>
                        <span class="font-extrabold text-emerald-700">Rp {{ number_format($product->price_lcd_only + $product->installation_fee, 0, ',', '.') }}</span>
                    </div>

                    <a href="{{ route('product.show', $product->id) }}" class="mt-4 block w-full text-center py-3 bg-gradient-to-r from-sky-500 to-teal-400 hover:from-sky-600 hover:to-teal-500 text-white font-bold rounded-xl shadow-md transition duration-200">
                        Pilih Layanan & Pesan
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-20">
            <i class="fa-solid fa-box-open text-5xl text-slate-300 mb-4"></i>
            <h3 class="text-lg font-bold text-slate-600">Tidak ada produk LCD yang ditemukan.</h3>
        </div>
        @endforelse
    </div>

    <div class="mt-10">
        {{ $products->links() }}
    </div>
</section>
@endsection