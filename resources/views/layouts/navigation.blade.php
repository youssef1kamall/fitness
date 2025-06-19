<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <style>
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
            transition: all 0.3s ease;
            z-index: -1;
        }
        .slide-background:hover::before {
            left: 0;
        }
        .slide-background-red::before {
            background: rgb(239, 68, 68);
        }
        .slide-background:hover {
            color: white !important;
        }
        .action-button {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            text-align: center;
            min-width: 80px;
        }
    </style>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="/" class="transition-transform hover:scale-105">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Logout Button -->
            <div class="flex items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="action-button bg-white text-red-500 border border-red-500 slide-background slide-background-red">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
