<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fitpass HOPn Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <style>
            body {
                background: url('https://images.unsplash.com/photo-1517960413843-0aee8e2d471c?auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
                background-size: cover;
            }
            .glass {
                background: rgba(24, 24, 27, 0.85);
                backdrop-filter: blur(6px);
            }
        </style>
    </head>
    <body class="min-h-screen font-sans">
        <nav class="glass shadow mb-8">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <div class="flex items-center gap-6">
                    <a href="/" class="text-2xl font-extrabold text-yellow-400 tracking-wide hover:text-yellow-300 transition">🏋️‍♂️ Fitpass HOPn Admin</a>
                   
                </div>
                @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition">Logout</button>
                </form>
                @endauth
            </div>
        </nav>
        <main>
            @yield('content')
        </main>
    </body>
</html>
