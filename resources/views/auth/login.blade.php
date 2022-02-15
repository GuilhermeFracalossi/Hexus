<x-guest-layout>


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('login') }}" class="form-container">
        @csrf

        <h2>Login</h2>
        <!-- Email Address -->
        <div class="fields-container">
            <div>
                <label class="label-form-auth" for="login_mail">E-MAIL</label>
                <input id="login_mail" name="email" type="email" placeholder="seuemail@exemplo.com" class="field-auth"
                    :value="old('email')" required autofocus>
            </div>


            <div>
                <label class="label-form-auth" for="login_pass">SENHA</label>
                <input type="password" required name="password" autocomplete="current-password" class="field-auth"
                    id="login_pass">
            </div>
        </div>
        @if (Route::has('password.request'))
        <a  href="{{ route('password.request') }}"" class="recover-pass-action">ESQUECI MINHA SENHA</a>

        @endif
    
        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    name="remember">
                <span class="remember-text">{{ __('Remember me') }}</span>
            </label>
        </div>

        <button type="submit" class="primary action-button-auth" style="margin-top:30px">Entrar
            <i class="bi bi-arrow-right"></i>
        </button>

    </form>

</x-guest-layout>