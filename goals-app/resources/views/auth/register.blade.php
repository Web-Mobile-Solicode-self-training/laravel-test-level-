@extends('layouts.public')

@section('content')
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="max-w-md mx-auto bg-white border border-slate-200 rounded-3xl shadow-sm p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-slate-900 sm:text-3xl">Inscription</h1>
                <p class="text-slate-500 mt-2">Rejoignez MyGoals et commencez à tracker.</p>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl mb-6 text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Nom
                        complet</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full border-slate-200 rounded-xl p-3 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 border outline-none transition-all placeholder:text-slate-400">
                </div>

                <div>
                    <label for="email"
                        class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full border-slate-200 rounded-xl p-3 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 border outline-none transition-all placeholder:text-slate-400">
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Mot
                        de passe</label>
                    <input type="password" name="password" id="password" required
                        class="w-full border-slate-200 rounded-xl p-3 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 border outline-none transition-all placeholder:text-slate-400">
                </div>

                <div>
                    <label for="password_confirmation"
                        class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Confirmer le mot de
                        passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full border-slate-200 rounded-xl p-3 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 border outline-none transition-all placeholder:text-slate-400">
                </div>

                <button type="submit"
                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-bold rounded-xl bg-blue-600 text-white hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all active:scale-[0.98]">
                    S'inscrire
                </button>
            </form>

            <div class="mt-8 text-center border-t border-slate-100 pt-8">
                <p class="text-sm text-slate-500">Déjà inscrit ?
                    <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700">Se connecter</a>
                </p>
            </div>
        </div>
    </div>
@endsection