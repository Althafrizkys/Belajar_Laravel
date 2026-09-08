<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - POS Barokah Mart</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-sm">
        <h1 class="text-2xl font-bold mb-4">Selamat Datang di Dashboard POS</h1>
        <p class="mb-4">Halo, <strong>{{ auth()->user()->name }}</strong> (Role: {{ auth()->user()->role }})</p>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md">
                Logout
            </button>
        </form>
    </div>
</body>
</html>