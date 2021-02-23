<x-guest-layout>
    <x-auth-card>

        <div class="mb-4">
            {{ __('Ceci est une zone sécurisé de l\'application. Veuillez confirmer votre mot de passe avant de continuer.') }}
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="mt-4">
                <x-button>
                    {{ __('Confirmer') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
