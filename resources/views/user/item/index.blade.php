<?php

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/** @var Collection $models */
/** @var Product $model */
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('商品ページ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-wrap">
                        @foreach($models as $model)
                            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                                @if ($model->image_first === null)
                                    <img class="rounded-t-lg" src="{{ asset('images/no_image.jpg') }}" alt="" />
                                @else
                                    <img class="rounded-t-lg" src="{{ asset('storage/images/products/' . $model->image_first_relation->file_name) }}" alt="" />
                                @endif
                                <div class="p-5">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $model->name }}</h5>
                                    <div class="flex items-center justify-between">
                                        <span class="text-3xl font-bold text-gray-900 dark:text-white">{{ $model->price }}</span><p class="text-sm">円（税込）</p>
                                        <button type="button" onclick="location.href='{{ route('user.item.show', ['id' => $model->id]) }}'"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full
                                                text-sm px-3 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            詳細<i class="fa-solid fa-book ml-1"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
