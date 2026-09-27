@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900">Dashboard Admin</h1>
            <p class="text-slate-500 text-sm">Kelola inventaris sparepart LCD dan order masuk.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.products') }}" class="px-4 py-2.5 bg-white border border-slate-200 font-bold text-sm rounded-xl text-slate-700 hover:bg-slate-50">
                <i class="fa-solid fa-boxes-stacked mr-1"></i> Data LCD
            </a>
            <a href="{{ route('admin.orders') }}" class="px-4 py-2.5 bg-sky-500 hover:bg-sky-600 font-bold text-sm rounded-xl text-white shadow-md">
                <i class="fa-solid fa-list-check mr-1"></i> Kelola Order
            </a>
        </div>
    </div>

    <!-- Quick Stats Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-gradient-to-br from-sky-500 to-cyan-400 p-6 rounded-3xl text-white shadow-lg shadow-sky-500/20">
            <p class="text-xs uppercase font-extrabold tracking-wider opacity-80">Total Order</p>
            <h3 class="text-4xl font-black mt-2">{{ $totalOrders }}</h3>
        </div>

        <div class="bg-gradient-to-br from-emerald-500 to-teal-400 p-6 rounded-3xl text-white shadow-lg shadow-emerald-500/20">
            <p class="text-xs uppercase font-extrabold tracking-wider opacity-80">Total Pendapatan (Completed)</p>
            <h3 class="text-3xl font-black mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
        </div>

        <div class="bg-gradient-to-br from-violet-500 to-indigo-500 p-6 rounded-3xl text-white shadow-lg shadow-violet-500/20">
            <p class="text-xs uppercase font-extrabold tracking-wider opacity-80">Total Tipe LCD</p>
            <h3 class="text-4xl font-black mt-2">{{ $totalProducts }}</h3>
        </div>
    </div>

    <!-- Order Terbaru -->
    <div class="bg-white rounded-3xl border border-slate-100 p-6 shadow-sm">
        <h3 class="font-bold text-slate-800 text-lg mb-4">5 Pesanan Terakhir Masuk</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] tracking-wider font-extrabold">
                    <tr>
                        <th class="p-3">Customer</th>
                        <th class="p-3">Produk LCD</th>
                        <th class="p-3">Layanan</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @foreach($recentOrders as $order)
                    <tr>
                        <td class="p-3 font-bold text-slate-800">{{ $order->user->name }}</td>
                        <td class="p-3">{{ $order->product->name }}</td>
                        <td class="p-3">
                            <span class="text-xs px-2 py-0.5 rounded-full font-bold {{ $order->service_type === 'with_installation' ? 'bg-emerald-100 text-emerald-700' : 'bg-sky-100 text-sky-700' }}">
                                {{ $order->service_type === 'with_installation' ? 'LCD + Pasang' : 'LCD Saja' }}
                            </span>
                        </td>
                        <td class="p-3 font-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        <td class="p-3">
                            <span class="text-xs font-bold uppercase">{{ $order->status }}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection