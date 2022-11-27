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
                    <div class="flex flex-wrap">
                        @foreach($models as $model)
                            <div id="record{{ $model->id }}"
                                 class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                                @if($model->image_first_relation)
                                    <img class="rounded-t-lg"
                                         src="{{ asset('storage/images/products/' . $model->image_first_relation->file_name)}}"
                                         alt=""/>
                                @else
                                    <a href="#">
                                        <img class="rounded-t-lg" src="{{ asset('images/no_image.jpg') }}" alt=""/>
                                    </a>
                                @endif
                                <div class="p-5">
                                    <a href="#">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $model->name }}</h5>
                                    </a>
                                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $model->information }}</p>
                                    <div class="flex ms-auto">
                                        <button type="button"
                                                onclick="location.href='{{ route('owner.product.edit', ['id' => $model->id]) }}'"
                                                class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm
                                                px-3 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                            編集<i class="fa-solid fa-pen ml-2"></i></button>
                                        <button type="button" data-modal-toggle="delete{{ $model->id }}Modal"
                                                class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-3
                                    py-2.5 text-center mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                            削除<i class="fa-solid fa-trash ml-2"></i>
                                        </button>
                                    </div>
                                    <x-form.modal-delete :model="$model"/>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
