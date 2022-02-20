<x-guest-layout>
    <x-slot name="logo">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
        </a>
    </x-slot>



    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('password.email') }}" class="form-container">
        @csrf

        <h2>Recuperação de senha</h2>

        <p>
            {{ __('Esqueceu sua senha? Sem problemas. Apenas informe o seu endereço de email e enviaremos um link de recuperação de senha.') }}
        </p>
        <!-- Email Address -->
        <div class="fields-container">
            <div>
                <label class="label-form-auth" for="email">E-MAIL</label>
                <input id="email" name="email" type="email" placeholder="seuemail@exemplo.com" class="field-auth" :value="old('email')" required
                autofocus>
            </div>

        </div>

        <button type="submit" class="primary action-button-auth">
            Enviar email de recuperação
        </button>
    </form>
</x-guest-layout>