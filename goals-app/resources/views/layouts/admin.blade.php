<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | GoalTracker 2026</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full">
    <div class="sticky top-0 inset-x-0 z-20 bg-white border-y px-4 sm:px-6 md:px-8 lg:hidden">
        <div class="flex items-center py-4">
            <button type="button" class="text-gray-500 hover:text-gray-600" data-hs-overlay="#application-sidebar" aria-controls="application-sidebar" aria-label="Toggle navigation">
                <i data-lucide="menu"></i>
            </button>
        </div>
    </div>

    <div id="application-sidebar" class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform fixed top-0 start-0 bottom-0 z-[60] w-64 bg-white border-e border-gray-200 pt-7 pb-10 overflow-y-auto lg:block lg:translate-x-0 lg:end-auto lg:bottom-0">
        <div class="px-6 mb-8">
            <a class="flex-none text-xl font-bold text-blue-600" href="{{ route('admin.goals.index') }}">
                Admin<span class="text-slate-900">Tracker</span>
            </a>
        </div>

        <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap">
            <ul class="space-y-1.5">
                <li>
                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 {{ Route::is('admin.goals.index') ? 'bg-gray-100' : '' }} text-sm text-slate-700 rounded-lg hover:bg-gray-100" href="{{ route('admin.goals.index') }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Tableau de bord
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 {{ Route::is('admin.goals.*') ? 'bg-gray-100' : '' }} text-sm text-slate-700 rounded-lg hover:bg-gray-100" href="{{ route('admin.goals.index') }}">
                        <i data-lucide="target" class="w-4 h-4"></i> Mes Objectifs
                    </a>
                </li>
                <li>
                    <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100" href="{{ route('public.index') }}">
                        <i data-lucide="external-link" class="w-4 h-4"></i> Voir le site public
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="w-full pt-10 px-4 sm:px-6 md:px-8 lg:ps-72">
        @yield('content')
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>lucide.createIcons();</script>
    @vite(['resources/js/admin-goals.js'])
</body>
</html>