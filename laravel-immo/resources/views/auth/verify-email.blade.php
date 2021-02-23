<x-guest-layout>
    <x-auth-card>

        <div class="mb-4">
            {{ __('Merci de votre inscription. Avant de commencer, veuillez vérifier votre adresse email en cliquant sur le lien que vous venez de recevoir par email. Si vous ne l\'avez pas reçu, nous serons heureux de vous le renvoyer') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4">
                {{ __('Un nouveau lien de vérification a été envoyé par email à l\'adresse indiquée lors de votre inscription.') }}
            </div>
        @endif

        <div class="mt-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        {{ __('Renvoyer l\'email de vérification') }}
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="btn btn-primary">
                    {{ __('Se déconnecter') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
