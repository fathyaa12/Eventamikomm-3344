<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Katalog Event</title>
</head>

<body class="bg-slate-50 p-6">
    <nav class="bg-white shadow-sm p-4 flex justify-center gap-4 mb-10 rounded-lg">
        <a href="/profil" class="hover:text-indigo-600">Profil</a>
        <a href="/katalog" class="text-indigo-600 font-bold">Katalog</a>
        <a href="/bantuan" class="hover:text-indigo-600">Bantuan</a>
        <a href="/kontak" class="hover:text-indigo-600">Kontak</a>
    </nav>

    <h1 class="text-3xl font-bold text-center mb-8">Katalog Event Amikom</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
        <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition border border-slate-200">
            <div class="h-32 bg-indigo-500 rounded-lg mb-4"></div>
            <h2 class="font-bold text-lg text-indigo-700">Workshop Laravel</h2>
            <p class="text-sm text-slate-500">Belajar backend dalam satu hari.</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition border border-slate-200">
            <div class="h-32 bg-emerald-500 rounded-lg mb-4"></div>
            <h2 class="font-bold text-lg text-emerald-700">Seminar UI/UX</h2>
            <p class="text-sm text-slate-500">Mendesain aplikasi yang user-friendly.</p>
        </div>
        <div class="bg-white p-4 rounded-xl shadow hover:shadow-lg transition border border-slate-200">
            <div class="h-32 bg-orange-500 rounded-lg mb-4"></div>
            <h2 class="font-bold text-lg text-orange-700">Lomba Coding</h2>
            <p class="text-sm text-slate-500">Tunjukkan skill algoritma Anda!</p>
        </div>
    </div>
</body>

</html>
