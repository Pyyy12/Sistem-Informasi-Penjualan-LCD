@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl grid grid-cols-1 md:grid-cols-2 gap-10">
        <div>
            <div class="rounded-2xl overflow-hidden bg-slate-100 shadow-inner h-96">
                <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=600' }}" class="w-full h-full object-cover">
            </div>
        </div>

        <div>
            <span class="px-3.5 py-1 bg-sky-100 text-sky-700 rounded-full font-bold text-xs uppercase tracking-wider">
                {{ $product->os_type }} - {{ $product->brand }}
            </span>
            <h1 class="text-3xl font-extrabold text-slate-900 mt-3 leading-snug">{{ $product->name }}</h1>
            <p class="text-slate-600 text-sm mt-3 leading-relaxed">{{ $product->description }}</p>

            <form action="{{ route('order.checkout', $product->id) }}" method="POST" class="mt-8 space-y-5">
                @csrf
                
                <!-- Pilihan 2 Menu Pembelian -->
                <div>
                    <label class="block text-sm font-bold text-slate-800 mb-3">Pilih Jenis Layanan:</label>
                    <div class="grid grid-cols-1 gap-3">
                        <label class="flex items-center justify-between p-4 rounded-2xl border-2 border-slate-200 cursor-pointer hover:border-sky-500 transition has-[:checked]:border-sky-500 has-[:checked]:bg-sky-50/40">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="service_type" value="lcd_only" checked class="accent-sky-500 w-5 h-5">
                                <div>
                                    <span class="font-bold text-slate-800 block">1. Pembelian LCD Saja</span>
                                    <span class="text-xs text-slate-500">Unit sparepart dikirim ke alamat Anda (tanpa pemasangan).</span>
                                </div>
                            </div>
                            <span class="font-extrabold text-sky-600">Rp {{ number_format($product->price_lcd_only, 0, ',', '.') }}</span>
                        </label>

                        <label class="flex items-center justify-between p-4 rounded-2xl border-2 border-slate-200 cursor-pointer hover:border-emerald-500 transition has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/40">
                            <div class="flex items-center gap-3">
                                <input type="radio" name="service_type" value="with_installation" class="accent-emerald-500 w-5 h-5">
                                <div>
                                    <span class="font-bold text-slate-800 block">2. LCD + Biaya Pasang</span>
                                    <span class="text-xs text-slate-500">Pemasangan oleh teknisi profesional kami (+Rp {{ number_format($product->installation_fee, 0, ',', '.') }}).</span>
                                </div>
                            </div>
                            <span class="font-extrabold text-emerald-600">Rp {{ number_format($product->price_lcd_only + $product->installation_fee, 0, ',', '.') }}</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-2">Jumlah (Qty)</label>
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-32 border border-slate-200 rounded-xl px-4 py-2 font-semibold focus:outline-none focus:border-sky-400">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase mb-2">Catatan Pesanan / Kerusakan Layar</label>
                    <textarea name="notes" rows="3" placeholder="Contoh: Layar flickering, mau pasang di toko cabang A jam 2 siang..." class="w-full border border-slate-200 rounded-xl p-3 text-sm focus:outline-none focus:border-sky-400"></textarea>
                </div>

                @auth
                    <button type="submit" class="w-full py-4 bg-gradient-to-r from-sky-500 to-teal-400 hover:from-sky-600 hover:to-teal-500 text-white font-bold rounded-2xl shadow-lg shadow-sky-500/30 text-lg transition duration-200">
                        Lanjut ke Pembayaran
                    </button>
                @else
                    <a href="{{ route('login') }}" class="block text-center w-full py-4 bg-slate-800 hover:bg-slate-900 text-white font-bold rounded-2xl text-lg transition">
                        Masuk untuk Membeli
                    </a>
                @endauth
            </form>
        </div>
    </div>
</div>
@endsection