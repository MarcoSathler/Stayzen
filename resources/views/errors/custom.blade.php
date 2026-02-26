@extends('layouts.app')

@section('content')
<div class="min-h-[60vh] flex flex-col items-center justify-center text-center px-4">
    <!-- Ícone de Erro (Ilustração SVG ou FontAwesome) -->
    <div class="mb-8 text-gray-200">
        <i class="fas fa-exclamation-circle text-8xl text-red-100"></i>
    </div>

    <!-- Título do Erro -->
    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
        {{ $title ?? 'Oops! Algo deu errado.' }}
    </h1>

    <!-- Mensagem Descritiva -->
    <p class="text-lg text-gray-500 max-w-lg mb-8">
        {{ $message ?? 'Não conseguimos carregar as informações solicitadas no momento. Por favor, tente novamente mais tarde.' }}
    </p>

    <!-- Botões de Ação -->
    <div class="flex flex-col sm:flex-row gap-4">
        <a href="{{ url()->previous() }}" class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition duration-200">
            Voltar
        </a>
        
        <a href="{{ route('home') }}" class="px-6 py-3 rounded-xl bg-orange-500 text-white font-semibold hover:bg-orange-600 shadow-md transition duration-200">
            Ir para o Início
        </a>
    </div>

    <!-- Detalhes técnicos (Opcional - só mostra se passado) -->
    @if(isset($debug) && config('app.debug'))
        <div class="mt-12 p-4 bg-gray-100 rounded-lg text-left max-w-2xl w-full overflow-x-auto">
            <p class="text-xs font-mono text-red-600">DEBUG: {{ $debug }}</p>
        </div>
    @endif
</div>
@endsection
