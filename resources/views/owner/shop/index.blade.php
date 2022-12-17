<?php

use App\Models\Shop;
use App\Consts\CommonConst;
use Illuminate\Database\Eloquent\Collection;

/**@var Collection $models */
/**@var Shop $model */

?>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('shop.title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($models as $model)
                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                            @if ( empty($model->file_name))
                                <a href="#"><img class="rounded-t-lg" src="{{ asset('images/no_image.jpg') }}" alt=""/></a>
                            @else
                                <a href="#"><img class="rounded-t-lg" src="{{ asset('storage/images/shops/' . $model->file_name) }}" alt=""/></a>
                            @endif
                            <div class="p-5">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $model->name }}</h5>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{!! nl2br($model->information) !!}</p>
                                <div class="ms-auto">
                                    @if ($model->is_selling ===  CommonConst::SELLING_DISCONTINUED)
                                        <span class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">販売停止</span>
                                    @else
                                        <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">販売中</span>
                                    @endif
                                    <button type="button" onclick="location.href='{{ route('owner.shop.edit', ['id' => $model->id]) }}'"
                                            class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br
                                                        focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50
                                                        dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2">
                                        <i class="fa-solid fa-pen mr-1"></i>{{ __('common.btn_labels.edit') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

