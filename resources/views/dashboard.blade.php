<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center items-center min-h-[60vh]">
        <div id="dashboard-card" class="max-w-xl w-full bg-white/90 glass shadow-2xl rounded-2xl p-8 flex flex-col items-center">
            <h1 class="text-3xl font-extrabold text-yellow-500 mb-2">Hi, {{ Auth::user()->name }}! 👋</h1>
            <p class="text-lg text-gray-700 mb-4">Welcome to your dashboard. Here you can manage your profile and view your membership plans.</p>
            <div class="w-full flex justify-center">
                <a href="/admin/plans" class="action-button bg-black text-white border border-black slide-background slide-background-black font-bold text-lg">View Membership Plans</a>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.motion) {
                window.motion.animate("#dashboard-card", { opacity: [0, 1], y: [-40, 0] }, { duration: 0.7, easing: 'ease-out' });
            }
        });
    </script>
</x-app-layout>
