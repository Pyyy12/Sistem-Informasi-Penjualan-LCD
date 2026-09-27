@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-black text-slate-900">Kelola Produk LCD</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-sky-600">Kembali ke Dashboard</a>
    </div>

    <!-- Form Tambah Produk -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-md mb-10">
        <h2 class="font-bold text-lg text-slate-800 mb-4">+ Tambah LCD Baru</h2>
        <form action="{{ route('admin.products.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nama Layar / Model</label>
                <input type="text" name="name" placeholder="Misal: LCD Xiaomi Mi 11 Lite" required class="w-full p-2.5 text-sm border rounded-xl">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Brand</label>
                <input type="text" name="brand" placeholder="Apple, Samsung, Xiaomi..." required class="w-full p-2.5 text-sm border rounded-xl">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">OS</label>
                <select name="os_type" class="w-full p-2.5 text-sm border rounded-xl">
                    <option value="iPhone">iPhone</option>
                    <option value="Android">Android</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Harga LCD Saja (Rp)</label>
                <input type="number" name="price_lcd_only" required class="w-full p-2.5 text-sm border rounded-xl">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Biaya Pemasangan (Rp)</label>
                <input type="number" name="installation_fee" value="50000" required class="w-full p-2.5 text-sm border rounded-xl">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Stok Unit</label>
                <input type="number" name="stock" value="10" required class="w-full p-2.5 text-sm border rounded-xl">
            </div>
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">URL Gambar</label>
                <input type="url" name="image" placeholder="https://..." class="w-full p-2.5 text-sm border rounded-xl">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Deskripsi Singkat</label>
                <input type="text" name="description" placeholder="Kualitas OLED / Incell..." class="w-full p-2.5 text-sm border rounded-xl">
            </div>
            <div class="md:col-span-3">
                <button type="submit" class="px-6 py-2.5 bg-sky-500 hover:bg-sky-600 text-white font-bold rounded-xl text-sm shadow">Simpan Produk</button>
            </div>
        </form>
    </div>

    <!-- Daftar List Produk -->
    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] tracking-wider font-extrabold">
                <tr>
                    <th class="p-4">Produk</th>
                    <th class="p-4">Brand</th>
                    <th class="p-4">Harga LCD Saja</th>
                    <th class="p-4">Jasa Pasang</th>
                    <th class="p-4">Stok</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($products as $p)
                <tr>
                    <td class="p-4 font-bold text-slate-800">{{ $p->name }}</td>
                    <td class="p-4">{{ $p->brand }} ({{ $p->os_type }})</td>
                    <td class="p-4 text-sky-600 font-bold">Rp {{ number_format($p->price_lcd_only, 0, ',', '.') }}</td>
                    <td class="p-4 text-emerald-600 font-bold">Rp {{ number_format($p->installation_fee, 0, ',', '.') }}</td>
                    <td class="p-4">{{ $p->stock }}</td>
                    <td class="p-4 text-center">
                        <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-500 hover:text-rose-700 text-xs font-bold">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection