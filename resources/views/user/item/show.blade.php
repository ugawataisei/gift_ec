<?php

use App\Models\Product;
use App\Models\Shop;

/** @var Product $model */
/** @var Shop $shop */
/** @var int $quantity */

$selectedQuantity = [];
for($i = 1; $i <= $quantity; $i++) {
    $selectedQuantity[$i] = $i;
}

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('product.title') }}
        </h2>
    </x-slot>
    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font overflow-hidden">
                        <!-- Flash Messages with Session-->
                        <x-flash-message/>
                        <div class="container px-5 py-8 mx-auto">
                            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                                <!-- swiper.js -->
                                <div class="swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            @if ($model->image_first === null)
                                                <img class="rounded-t-lg" src="{{ asset('images/no_image.jpg') }}" alt=""/>
                                            @else
                                                <img class="rounded-t-lg" src="{{ asset('storage/images/products/' . $model->image_first_relation->file_name) }}" alt=""/>
                                            @endif
                                        </div>
                                        <div class="swiper-slide">
                                            @if ($model->image_second === null)
                                                <img class="rounded-t-lg" src="{{ asset('images/no_image.jpg') }}" alt=""/>
                                            @else
                                                <img class="rounded-t-lg" src="{{ asset('storage/images/products/' . $model->image_second_relation->file_name) }}" alt=""/>
                                            @endif
                                        </div>
                                        <div class="swiper-slide">
                                            @if ($model->image_third === null)
                                                <img class="rounded-t-lg" src="{{ asset('images/no_image.jpg') }}" alt=""/>
                                            @else
                                                <img class="rounded-t-lg" src="{{ asset('storage/images/products/' . $model->image_third_relation->file_name) }}" alt=""/>
                                            @endif
                                        </div>
                                        <div class="swiper-slide">
                                            @if ($model->image_fourth === null)
                                                <img class="rounded-t-lg" src="{{ asset('images/no_image.jpg') }}" alt=""/>
                                            @else
                                                <img class="rounded-t-lg" src="{{ asset('storage/images/products/' . $model->image_fourth_relation->file_name) }}" alt=""/>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                    <div class="swiper-button-prev"></div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-scrollbar"></div>
                                </div>
                                <!-- /swiper.js -->
                                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                                    <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $model->name }}</h1>
                                    <p class="leading-relaxed">{{ $model->information }}</p>
                                    {!! Form::open(['route' => 'user.cart.store', 'method' => 'post']) !!}
                                    @csrf
                                    @method('POST')
                                    {{ Form::hidden('product_id', $model->id) }}
                                    <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
                                        <div class="flex justify-content-end items-center">
                                            <span class="mr-3">{{ __('product.view.quantity') }}</span>
                                            <div class="relative">
                                                {{ Form::select('quantity', $selectedQuantity, ['class' => 'rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-500 text-base pl-3 pr-10']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-content-between align-items-center">
                                        <div class="flex justify-content-around align-items-center">
                                            <div><span class="title-font font-medium text-2xl text-gray-900">{{ number_format($model->price) }}</span></div>
                                            <div><span class="text-sm">{{ __('product.view.price_prefix') }}</span></div>
                                        </div>
                                        <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300
                                                font-medium rounded-lg text-sm px-3 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                            {{ __('product.view.cart') }}<i class="fa-solid fa-cart-shopping ml-1"></i>
                                        </button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-6">
        <div class="max-w-7xl mx-auto sm:px-2 lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-3 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font overflow-hidden">
                        <div class="container px-1 py-4 mx-auto">
                            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                                <div class="flex flex-col sm:flex-row">
                                    <div class="flex justify-content-center">
                                        <img
                                            class="max-w-lg h-auto rounded-lg transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0"
                                            src="{{ asset('storage/images/shops/' . $shop->file_name) }}"
                                            alt="image description">
                                        <div class="flex flex-col items-center text-center justify-center ml-1">
                                            <h2 class="font-medium title-font mt-4 text-gray-900 text-lg mb-2">{{ $shop->name }}</h2>
                                            <p class="text-base">{{ $shop->information }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    @section('page-script')
        <script src="{{ asset('js/swiper.js') }}"></script>
    @endsection
</x-app-layout>
