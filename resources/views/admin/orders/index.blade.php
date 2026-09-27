@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-black text-slate-900">Kelola Semua Pesanan Customer</h1>
        <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-sky-600">Kembali ke Dashboard</a>
    </div>

    <div class="bg-white rounded-3xl border border-slate-100 overflow-hidden shadow-sm">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] tracking-wider font-extrabold">
                <tr>
                    <th class="p-4">ID Order</th>
                    <th class="p-4">Customer</th>
                    <th class="p-4">Produk LCD</th>
                    <th class="p-4">Layanan</th>
                    <th class="p-4">Total Bayar</th>
                    <th class="p-4">Status & Update</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($orders as $order)
                <tr>
                    <td class="p-4 font-extrabold text-slate-400">#{{ $order->id }}</td>
                    <td class="p-4">
                        <p class="font-bold text-slate-800">{{ $order->user->name }}</p>
                        <p class="text-xs text-slate-400">{{ $order->user->phone }}</p>
                    </td>
                    <td class="p-4 font-medium">{{ $order->product->name }}</td>
                    <td class="p-4">
                        <span class="text-xs px-2 py-0.5 rounded-full font-bold {{ $order->service_type === 'with_installation' ? 'bg-emerald-100 text-emerald-700' : 'bg-sky-100 text-sky-700' }}">
                            {{ $order->service_type === 'with_installation' ? 'LCD + Biaya Pasang' : 'LCD Saja' }}
                        </span>
                    </td>
                    <td class="p-4 font-black text-slate-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="p-4">
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="text-xs font-bold border rounded-lg p-1.5 focus:outline-none">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="in_process" {{ $order->status === 'in_process' ? 'selected' : '' }}>In Process (Dipasang)</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            <button type="submit" class="px-2.5 py-1.5 bg-sky-500 text-white rounded-lg text-xs font-bold">Update</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection