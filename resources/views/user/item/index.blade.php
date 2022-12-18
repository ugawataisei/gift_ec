<?php

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

/** @var Collection|Product $models */
/** @var Product $model */
/** @var array $selectCategoryList */

?>
<x-app-layout>
    <x-slot name="header">
        <x-form.search-input :selectCategoryList="$selectCategoryList"/>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Flash Messages with Session-->
                    <x-flash-message/>
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
                                    <p class="leading-relaxed">{{ $model->information }}</p>
                                    <div class="flex items-center justify-between">
                                        <div class="flex justify-content-around align-items-center">
                                            <div><span class="title-font font-medium text-2xl text-gray-900">{{ number_format($model->price) }}</span></div>
                                            <div><span class="text-sm">{{ __('cart.view.tax') }}</span></div>
                                        </div>
                                        <button type="button" onclick="location.href='{{ route('user.item.show', ['id' => $model->id]) }}'"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full
                                                text-sm px-3 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                {{ __('common.btn_labels.show') }}<i class="fa-solid fa-book ml-1"></i>
                                        </button>
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
