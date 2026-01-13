<!DOCTYPE html>
<html lang="fr" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GoalTracker 2026 | Atteignez vos sommets</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 h-full font-sans text-slate-900">

    <header class="sticky top-0 z-50 flex flex-wrap sm:justify-start sm:flex-nowrap w-full bg-white/80 backdrop-blur-md border-b border-slate-200">
        <nav class="max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between py-3" aria-label="Global">
            
            <div class="flex items-center justify-between">
                <a class="flex items-center gap-x-2 text-2xl font-black text-blue-600 tracking-tight" href="{{ route('index') }}">
                    <div class="bg-blue-600 p-1 rounded-lg">
                        <i data-lucide="target" class="w-6 h-6 text-white"></i>
                    </div>
                    MyGoals
                </a>
                
                <div class="sm:hidden">
                    <button type="button" class="hs-collapse-toggle p-2 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm" data-hs-collapse="#navbar-collapse-basic" aria-controls="navbar-collapse-basic" aria-label="Toggle navigation">
                        <i data-lucide="menu" class="hs-collapse-open:hidden w-4 h-4"></i>
                        <i data-lucide="x" class="hs-collapse-open:block hidden w-4 h-4"></i>
                    </button>
                </div>
            </div>

            <div id="navbar-collapse-basic" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
                <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:justify-end sm:mt-0 sm:ps-5">
                    
                    <a class="flex items-center gap-x-2 font-semibold {{ Route::is('index') ? 'text-blue-600' : 'text-slate-600 hover:text-blue-600' }} transition-colors" href="{{ route('index') }}">
                        <i data-lucide="home" class="w-4 h-4"></i>
                        Accueil
                    </a>

                    <div class="hidden sm:block border-s border-slate-300 h-6 mx-2"></div>

                    <a class="flex items-center gap-x-2 py-2 px-4 font-bold text-sm rounded-xl transition-all {{ Route::is('admin.index') ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}" 
                       href="{{ route('admin.index') }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        Espace Admin
                    </a>
                    
                </div>
            </div>
        </nav>
    </header>

    <main id="content" role="main" class="min-h-[calc(100vh-73px)]">
        <div class="animate-in fade-in duration-700">
            @yield('content')
        </div>
    </main>

    <footer class="mt-auto w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto border-t border-slate-200">
        <div class="text-center">
            <p class="text-sm text-slate-500">© 2026 GoalTracker. Créé avec passion pour votre réussite.</p>
        </div>
    </footer>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        // Initialisation des icônes au chargement
        lucide.createIcons();
    </script>
</body>
</html>