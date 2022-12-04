<?php

use App\Models\Image;
use Illuminate\Database\Eloquent\Collection;
/** @var Collection $images */
?>

@props([
    'images' => null,
    'number' => null,
])
<div id="image{{$number}}Modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 p-4 w-full md:inset-0 h-modal md:h-full">
    <div class="relative w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    画像選択 {{$number}}
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="image{{$number}}Modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <span class="font-medium text-red-700 text-sm">※画像は1枚だけ選択可能です</span>
                <div class="flex flex-wrap">
                    @foreach($images as $image)
                        <div class="p-2 select-image" data-modal-number="{{ $number }}"
                             data-image-id="{{ $image->id }}">
                            <img class="max-w-sm h-20 rounded-lg"
                                 src="{{ asset('storage/images/products/' . $image->file_name) }}"
                                 alt="image description">
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                <button id="selectImg{{ $number }}" data-modal-toggle="image{{$number}}Modal" data-selected-id=""
                        data-modal-id="{{ $number }}" type="button" class="select-btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm
                px-3 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">選択<i
                        class="fa-solid fa-check ml-1"></i></button>
                <button data-modal-toggle="image{{$number}}Modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium
                px-3 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                    閉じる<i class="fa-solid fa-xmark ml-1"></i></button>
            </div>
        </div>
    </div>
</div>
