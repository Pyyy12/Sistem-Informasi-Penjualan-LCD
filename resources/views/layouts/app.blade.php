<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LCD Master - Pusat LCD Android & iPhone</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen">

    <!-- Top Notification Banner -->
    <div class="bg-gradient-to-r from-sky-500 via-indigo-500 to-cyan-400 text-white text-xs font-semibold py-2 text-center tracking-wide shadow-sm">
        ✨ Promo Spesial: Gratis Konsultasi Kerusakan Layar & Diskon Jasa Pasang LCD iPhone/Android Hari Ini!
    </div>

    <!-- Navigation Header -->
    <nav class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-sky-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-tr from-sky-500 to-cyan-400 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-sky-500/30">
                        <i class="fa-solid fa-mobile-screen-button text-2xl"></i>
                    </div>
                    <div>
                        <span class="text-2xl font-extrabold bg-gradient-to-r from-sky-600 to-teal-500 bg-clip-text text-transparent">LCD Store</span>
                        <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Android & iPhone Specialist</p>
                    </div>
                </a>

                <div class="flex items-center gap-4">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl bg-amber-500/10 text-amber-700 hover:bg-amber-500/20 font-bold text-sm border border-amber-300">
                                <i class="fa-solid fa-gauge-high mr-1"></i> Panel Admin
                            </a>
                        @else
                            <a href="{{ route('orders.my') }}" class="px-4 py-2 rounded-xl bg-sky-50 text-sky-600 hover:bg-sky-100 font-semibold text-sm transition">
                                <i class="fa-solid fa-receipt mr-1"></i> Pesanan Saya
                            </a>
                        @endif
                        <span class="text-sm font-semibold text-slate-600 hidden md:block">Halo, {{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-100 text-sm font-semibold transition">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 text-slate-700 hover:text-sky-600 font-semibold text-sm transition">Masuk</a>
                        <a href="{{ route('register') }}" class="px-5 py-2.5 bg-gradient-to-r from-sky-500 to-teal-400 text-white rounded-xl font-bold text-sm shadow-md hover:shadow-sky-400/40 transition">Daftar Akun</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 mt-6">
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-xl"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-100 mt-20 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm text-slate-500">
            &copy; {{ date('Y') }} LCD Store. Solusi Layar HP Segala Tipe & Merk dengan Teknisi Berpengalaman.
        </div>
    </footer>
</body>
</html>