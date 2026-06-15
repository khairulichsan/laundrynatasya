<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Natasya Laundry POS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-md border border-slate-200 w-full max-w-md">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-slate-800">Natasya Laundry</h2>
            <p class="text-sm text-slate-500 mt-1">Point of Sale Berbasis Web</p>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-xl text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 bg-rose-50 text-rose-700 border border-rose-200 rounded-xl text-sm font-medium">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="username" class="block text-xs font-bold text-slate-600 uppercase mb-1">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required
                    class="w-full p-3 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-indigo-500" placeholder="Masukkan username">
            </div>

            <div>
                <label for="password" class="block text-xs font-bold text-slate-600 uppercase mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full p-3 border border-slate-200 rounded-xl bg-slate-50 text-sm focus:outline-none focus:border-indigo-500" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm p-3 rounded-xl shadow-md transition-all pt-3">
                Masuk ke Sistem
            </button>
        </form>
    </div>

</body>
</html>
