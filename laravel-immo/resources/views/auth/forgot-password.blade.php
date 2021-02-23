<x-guest-layout>
    <x-auth-card>

        <div class="mb-4">
            {{ __('Vous avez oublié votre mot de passe ? Pas de problème ! Indiquez-nous votre adresse email et nous vous enverrons un lien permettant de réinitialiser votre mot de passe.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-button>
                    {{ __('Recevoir le lien par email') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
