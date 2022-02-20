<x-guest-layout>
        {{-- <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot> --}}

        <!-- Validation Errors -->


        <form method="POST" action="{{ route('register') }}" class="form-container">
            @csrf

        <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <h2>Cadastro</h2>
            <!-- Name -->
            <div class="fields-container">
                <div>
                    <label class="label-form-auth" for="register_name">NOME</label>
                    <input id="register_name" name="name" type="text" placeholder="Seu nome completo" class="field-auth" :value="old('name')" required autofocus>
                </div>
                <div>
                    <label class="label-form-auth" for="register_mail">E-MAIL</label>
                    <input id="register_mail" name="email" type="email" placeholder="seuemail@exemplo.com"
                        class="field-auth" :value="old('email')" required>
                </div>
                <div>
                    <label class="label-form-auth" for="register_cpf">CPF</label>
                    <input id="register_cpf" type="text" name="cpf" placeholder="000.000.000-00" class="field-auth">
                </div>
    
                <div>
                    <label class="label-form-auth" for="register_pass">SENHA</label>
                    <input type="password" name="password" class="field-auth" id="register_pass" 
                    required autocomplete="new-password" >
                </div>
                <div>
                    <label class="label-form-auth" for="register_pass_confirmation">CONFIRME A SENHA</label>
                    <input type="password" class="field-auth" id="register_pass_confirmation"
                    name="password_confirmation" required>
                </div>
            </div>


            <button type="submit" class="primary action-button-auth" style="margin-top:30px">Cadastre-se
            </button>

            <div class="bottom-text-login">
                <p>Já possui uma conta? <a href="{{ route('login') }}">Faça login</a></p>
            </div>
        </form>
</x-guest-layout>
