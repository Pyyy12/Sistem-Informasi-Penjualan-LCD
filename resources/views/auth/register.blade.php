@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="bg-white p-8 rounded-3xl shadow-xl border border-sky-100">
        <h2 class="text-2xl font-black text-slate-900 text-center">Daftar Customer</h2>
        <p class="text-center text-sm text-slate-500 mt-1">Nikmati kemudahan pesan sparepart LCD HP</p>

        @if($errors->any())
            <div class="mt-4 p-3 bg-rose-50 text-rose-600 rounded-xl text-xs font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-sky-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-sky-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Nomor WhatsApp / HP</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="08..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-sky-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-sky-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:border-sky-400 focus:outline-none">
            </div>

            <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-sky-500 to-teal-400 text-white font-bold rounded-xl shadow-md transition">
                Daftar Sekarang
            </button>
        </form>

        <p class="text-center text-xs text-slate-500 mt-6">
            Sudah ada akun? <a href="{{ route('login') }}" class="font-bold text-sky-600">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection