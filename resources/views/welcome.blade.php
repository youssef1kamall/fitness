<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitpass HOPn</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1519864600265-abb23847ef2c?auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
            background-size: cover;
        }
        .glass {
            background: rgba(24, 24, 27, 0.85);
            backdrop-filter: blur(6px);
        }
        .slide-background {
            position: relative;
            overflow: hidden;
            z-index: 1;
            transition: color 0.3s ease;
        }
        .slide-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: black;
            transition: all 0.3s ease;
            z-index: -1;
        }
        .slide-background:hover::before {
            left: 0;
        }
        .slide-background:hover {
            color: white;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center font-sans">
    <div class="glass p-10 rounded-xl shadow-2xl text-center max-w-lg w-full">
        <h1 class="text-4xl font-extrabold mb-4 text-yellow-400 tracking-wide">Welcome to Fitpass HOPn</h1>
        <p class="mb-6 text-gray-200 text-lg">Your fitness journey starts here. Manage your gym memberships with style and power.</p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-x-4 sm:space-y-0">
            <a href="/admin/plans" class="inline-block bg-white text-black font-bold py-3 px-8 rounded-full shadow-lg slide-background">Go to Admin Panel</a>
            <a href="/register" class="inline-block bg-white text-black font-bold py-3 px-8 rounded-full shadow-lg slide-background">Register</a>
        </div>
    </div>
</body>
</html>
