<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Natasya Laundry POS')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans flex min-h-screen">

    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed inset-y-0 shadow-sm z-10">
        <div class="p-6 border-b border-slate-200">
            <h1 class="text-xl font-extrabold text-indigo-600 tracking-tight uppercase">Natasya Laundry</h1>
            <span class="text-xs font-semibold text-slate-400 block mt-1">Sistem Point of Sale</span>
        </div>

        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 mt-4 px-2">Menu Utama</p>

            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-600 hover:bg-slate-50' }} text-sm transition-colors">
                <span>🏠 Dashboard</span>
            </a>

            <a href="{{ route('transactions.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('transactions.*') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-600 hover:bg-slate-50' }} text-sm transition-colors">
                <span>🛒 Kasir & Transaksi</span>
            </a>
            <a href="{{ route('customers.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('customers.*') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-600 hover:bg-slate-50' }} text-sm transition-colors">
                <span>👥 Data Pelanggan</span>
            </a>

            @if(Auth::user()->role === 'admin')
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-2 mt-6 px-2">Menu Manajemen (Admin)</p>

            <a href="{{ route('services.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('services.*') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-600 hover:bg-slate-50' }} text-sm transition-colors">
                <span>🧺 Layanan Jasa</span>
            </a>
            <a href="{{ route('users.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('users.*') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-600 hover:bg-slate-50' }} text-sm transition-colors">
                <span>🔐 Kelola Pengguna</span>
            </a>
            <a href="{{ route('reports.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('reports.*') ? 'bg-indigo-50 text-indigo-700 font-bold' : 'text-slate-600 hover:bg-slate-50' }} text-sm transition-colors">
                <span>📊 Laporan Keuangan</span>
            </a>
            @endif
        </nav>
    </aside>

    <div class="flex-1 pl-64 flex flex-col min-w-0">
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-8 sticky top-0 z-0">
            <h2 class="font-bold text-slate-800 text-lg">@yield('header_title', 'Dashboard')</h2>

            <div class="flex items-center gap-6">
                <div class="text-right hidden md:block">
                    <span class="text-[10px] text-slate-400 font-bold block uppercase tracking-wider">Akses Login</span>
                    <span class="text-sm font-semibold text-slate-700">{{ Auth::user()->name }} ({{ ucfirst(Auth::user()->role) }})</span>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 font-semibold text-xs rounded-lg transition-colors border border-rose-200">
                        Logout Keluar
                    </button>
                </form>
            </div>
        </header>

        <main class="p-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl font-medium shadow-sm">
                    🎉 {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-xl font-medium shadow-sm">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
