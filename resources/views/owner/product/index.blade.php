<?php

use App\Models\Product

/** Product $models */

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('商品管理') }}
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
                    @foreach($models as $model)
                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                            <div class="mt-2">
                                @if ( empty($model->image_first))
                                    <a href="#">
                                        <img class="rounded-t-lg" src="{{ asset('images/no_image.jpg') }}" alt=""/>
                                    </a>
                                @else
                                    <a href="#">
                                        <img class="rounded-t-lg"
                                             src="{{ asset('storage/images/products/' . $model->image_first_relation->file_name) }}"
                                             alt=""/>
                                    </a>
                                @endif
                            </div>
                            <div class="p-5">
                                <span
                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $model->name }}</span>
                            </div>
                            <button type="button"
                                    onclick="location.href='{{ route('owner.product.show', ['id' => $model->id]) }}'"
                                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br
                                                focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50
                                                dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
                                <i class="fa-solid fa-pen mr-1"></i>商品詳細
                            </button>
                            <button type="button" data-modal-toggle="delete{{ $model->id }}Modal">
                                <i class="fa-solid fa-trash fa-lg ml-5"></i>
                            </button>
                        </div>
                        {{--  ajax削除用 Modalフォーム  --}}
                        <x-form.modal-delete :model="$model"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
