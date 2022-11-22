<?php

use App\Models\Shop;

/** @var Shop $model */
/** @var array $selectIsSelling */

$selectIsSelling = [
    '販売停止',
    '販売中',
];
?>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Flash Messages -->
                    <x-flash-message/>
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    {{ Form::open(['route' => 'owner.shop.update', 'method' => 'post', "enctype"=>"multipart/form-data"]) }}
                    @csrf
                    {{ Form::hidden('id', $model->id) }}
                    <div class="mb-6">
                        {{ Form::label('name', '店名', ['class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300']) }}
                        {{ Form::text('name', $model->name, ['class'=>'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light']) }}
                    </div>
                    <div class="mb-6">
                        {{ Form::label('information', '店名情報', ['class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-white']) }}
                        {{ Form::textarea('information', $model->information, ['id' => "message", "rows" => "4", 'class' => 'block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}
                    </div>
                    <div class="mb-6">
                        {{ Form::label('image', '店舗画像', ['class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-white']) }}
                        {{ Form::file('image', ["aria-describedby" => "user_avatar_help", "class" => "block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"]) }}
                    </div>
                    {{--  todo: アップロード時サムネイル表示 --}}
                    <img class="max-w-xs h-auto mb-6" src="{{ asset('storage/images/shops/' . $model->file_name) }}" alt="image description">
                    <div class="mb-6">
                        {{ Form::label('is_selling', '販売状況', ['class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-white']) }}
                        {{ Form::select('is_selling', $selectIsSelling, null, [ 'placeholder'=>'選択してください', "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"]) }}
                    </div>
                    <button type="button" onclick="location.href='{{ route('owner.shop.index') }}'"
                            class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300
                                dark:focus:ring-cyan-800 shadow-lg shadow-cyan-500/50 dark:shadow-lg dark:shadow-cyan-800/80 font-medium rounded-lg text-sm px-4 py-2.5 text-center mr-2
                                mb-2"><i class="fa-solid fa-arrow-left"></i>戻る
                    </button>
                    <button type="submit"
                            class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none
                                focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg
                                text-sm px-4 py-2.5 text-center mr-2 mb-2"><i class="fa-solid fa-wrench"></i>更新
                    </button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>