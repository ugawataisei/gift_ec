<?php

/** @var string $publicKey */
/** @var Stripe\Checkout\Session $session */

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('cart.stripe_title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>{{ __('cart.stripe_redirect_message') }}</p>
                </div>
            </div>
        </div>
    </div>
    @section('page-script')
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const publicKey = '{{ $publicKey }}';
            const stripe = Stripe(publicKey);

            window.onload = function () {
                stripe.redirectToCheckout({
                    sessionId: '{{ $session->id }}'
                }).then(function (result) {
                    window.location.href = '{{ route('user.cart.index') }}';
                });
            }
        </script>
    @endsection
</x-app-layout>
