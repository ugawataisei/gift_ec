<?php

use App\Models\Image;

/**@param Image $models */

?>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('image.title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <button type="button" onclick="location.href='{{ route('owner.image.create') }}'"
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4
                            focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                            mr-2 mb-2"><i class="fa-solid fa-plus"></i>{{ __('common.btn_labels.register') }}
                    </button>
                    <!-- Flash Messages with Session-->
                    <x-flash-message/>
                    <!-- Flash Messages with Ajax-->
                    <div class="message-alert"></div>
                    <div class="flex flex-wrap">
                        @foreach($models as $model)
                            <div id="record{{ $model->id }}">
                                <figure class="max-w-lg p-2">
                                    <a href="{{ route('owner.image.edit', ['id' => $model->id]) }}">
                                        <img class="max-w-full h-auto rounded-lg"
                                             src="{{ asset('storage/images/products/' . $model->file_name) }}"
                                             alt="image description">
                                    </a>
                                    <div class="flex justify-content-end">
                                        <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">
                                            {{ $model->title }}
                                        </figcaption>
                                        <button type="button" data-modal-toggle="delete{{ $model->id }}Modal">
                                            <i class="fa-solid fa-trash fa-lg ml-5"></i>
                                        </button>
                                    </div>
                                </figure>
                                <x-form.modal-delete :model="$model"/>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{ $models->links() }}
            </div>
        </div>
    </div>
</x-app-layout>


