@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <h2 class="text-2xl font-black text-slate-900 mb-6">Riwayat Pesanan Saya</h2>

    <div class="space-y-4">
        @forelse($orders as $order)
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <span class="text-xs font-bold px-2.5 py-1 rounded-full {{ $order->service_type === 'with_installation' ? 'bg-emerald-100 text-emerald-700' : 'bg-sky-100 text-sky-700' }}">
                    {{ $order->service_type === 'with_installation' ? 'LCD + Biaya Pasang' : 'LCD Saja' }}
                </span>
                <h4 class="font-bold text-slate-800 text-lg mt-2">{{ $order->product->name }}</h4>
                <p class="text-xs text-slate-400 mt-1">Tanggal: {{ $order->created_at->format('d M Y, H:i') }} | Qty: {{ $order->quantity }}</p>
                @if($order->notes)
                    <p class="text-xs text-slate-500 italic mt-1">Catatan: {{ $order->notes }}</p>
                @endif
            </div>

            <div class="text-right">
                <p class="text-xs text-slate-400">Total Tagihan:</p>
                <p class="text-xl font-extrabold text-slate-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                <span class="inline-block mt-2 px-3 py-1 text-xs font-bold rounded-full 
                    {{ $order->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : ($order->status === 'pending' ? 'bg-amber-100 text-amber-700' : 'bg-sky-100 text-sky-700') }}">
                    Status: {{ strtoupper($order->status) }}
                </span>
            </div>
        </div>
        @empty
        <div class="p-10 text-center bg-white rounded-2xl border border-slate-100">
            <p class="text-slate-500">Belum ada riwayat pesanan.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection