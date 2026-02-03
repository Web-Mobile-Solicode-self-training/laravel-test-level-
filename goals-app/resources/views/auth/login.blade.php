@extends('layouts.public')

@section('content')
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="max-w-md mx-auto bg-white border border-slate-200 rounded-3xl shadow-sm p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Connexion</h1>
                <p class="text-slate-500 mt-2">Accédez à votre espace MyGoals.</p>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="email"
                        class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full border-slate-200 rounded-xl p-3 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 border outline-none transition-all placeholder:text-slate-400">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-500">Mot de
                            passe</label>
                    </div>
                    <input type="password" name="password" id="password" required
                        class="w-full border-slate-200 rounded-xl p-3 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 border outline-none transition-all placeholder:text-slate-400">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                        class="w-4 h-4 text-blue-600 border-slate-300 rounded focus:ring-blue-500">
                    <label for="remember" class="ml-2 block text-sm text-slate-600">Se souvenir de moi</label>
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-xl bg-blue-600 text-white hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all active:scale-[0.98]">
                    Se connecter
                </button>
            </form>

            <div class="mt-8 text-center border-t border-slate-100 pt-8">
                <p class="text-sm text-slate-500">Pas encore de compte ?
                    <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-700">Inscrivez-vous
                        ici</a>
                </p>
            </div>
        </div>
    </div>
@endsection