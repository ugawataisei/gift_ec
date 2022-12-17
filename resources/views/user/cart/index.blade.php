<?php

use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;

/** @var Collection $models */
/** @var Cart $model */

?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('cart.title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Flash Messages with Session-->
                    <x-flash-message/>
                    <!-- Flash Messages with Ajax-->
                    <div class="message-alert"></div>
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-3">
                                    {{ __('product.attribute_labels.name') }}
                                </th>
                                <th scope="col" class="py-3 px-8">
                                    {{ __('product.attribute_labels.image_first') }}
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    {{ __('cart.attribute_labels.quantity') }}
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    {{ __('product.attribute_labels.price') }}
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    {{ __('cart.view.operation') }}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $models as $model)
                                <div id="cart-record{{ $model->id }}">
                                    <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="py-4 px-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a href="{{ route('user.item.show', ['id' => $model->id]) }}">{{ $model->product->name }}</a>
                                        </th>
                                        <td class="py-4 px-8">
                                            @if ($model->product->image_first === null)
                                                <img class="rounded-lg" src="{{ asset('images/no_image.jpg') }}" alt="" />
                                            @else
                                                <img class="rounded-lg w-50 h-40" src="{{ asset('storage/images/products/' . $model->product->image_first_relation->file_name) }}" alt="" />
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $model->quantity }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex justify-content-around align-items-center">
                                                <div><span class="title-font font-medium text-gray-900">{{ number_format($model->getTotalPrice()) }}</span></div>
                                                <div><span class="text-sm">{{ __('cart.view.tax') }}</span></div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <button type="button" data-modal-toggle="delete{{ $model->id }}Modal"
                                                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300
                                                font-medium rounded-lg text-sm px-3 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">
                                                {{ __('common.btn_labels.destroy') }}<i class="fa-solid fa-trash ml-1"></i>
                                            </button>
                                        </td>
                                        <x-form.modal-delete :model="$model" />
                                    </tr>
                                </div>
                            @endforeach
                            @if ($models->toArray() !== [])
                                <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="py-4 px-3 font-medium text-gray-900 whitespace-nowrap dark:text-white"></th>
                                    <td class="py-4 px-8"></td>
                                    <td class="py-4 px-6">{{ __('cart.view.total_price') }}</td>
                                    <td class="py-4 px-6">
                                        <div class="flex justify-content-around align-items-center">
                                            <div><span class="title-font font-medium text-gray-900">{{ number_format(Cart::getCartPrice()) }}</span></div>
                                            <div><span class="text-sm">{{ __('cart.view.tax') }}</span></div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6">
                                        <button type="button" onclick="location.href='{{ route('user.cart.checkout') }}'"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm
                                            px-3 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                            {{ __('cart.view.checkout') }}<i class="fa-brands fa-cc-stripe ml-1"></i>
                                        </button>
                                    </td>
                                </tr>
                            @else
                                <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="py-4 px-8">
                                        {{ __('cart.view.no_item_in_cart') }}
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

