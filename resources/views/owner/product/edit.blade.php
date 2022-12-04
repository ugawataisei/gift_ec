<?php

use App\Models\Product;
use App\Consts\StockConst;
use App\Consts\CommonConst;
use Illuminate\Database\Eloquent\Collection;

/** @var Product $model */
/** @var Collection $images */
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
                    <!-- Flash Messages -->
                    <x-flash-message/>
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                    {{ Form::open(['route' => 'owner.product.update', 'method' => 'post']) }}
                    @csrf
                    {{ Form::hidden('id', $model->id) }}
                    {{ Form::hidden('shop_id', $model->shop_id) }}
                    <div class="mb-6">
                        {{ Form::label('is_selling', '販売状況', ['class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-white']) }}
                        {{ Form::select('is_selling', CommonConst::SELLING_OPTION, $model->is_selling, [ 'placeholder'=>'選択してください', "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"]) }}
                    </div>
                    <div class="mb-6">
                        {{ Form::label('secondary_category_id', 'カテゴリー選択', ['class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-white']) }}
                        {{ Form::select('secondary_category_id', $selectCategoryList, $model->secondary_category_id, [ 'placeholder'=>'選択してください', "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"]) }}
                    </div>
                    <div class="mb-6">
                        {{ Form::label('name', '商品名', ['class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300']) }}
                        {{ Form::text('name', $model->name, ['class'=>'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light']) }}
                    </div>
                    <div class="mb-6">
                        {{ Form::label('price', '価格', ['class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300']) }}
                        {{ Form::number('price', $model->price, ['class'=>'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light']) }}
                    </div>
                    <div class="mb-6">
                        {{ Form::label('information', '商品情報', ['class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-white']) }}
                        {{ Form::textarea('information', $model->information, ['id' => "message", "rows" => "4", 'class' => 'block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']) }}
                    </div>
                    <!-- 画像選択 -->
                    {{ Form::label('information', '商品画像選択', ['class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-white']) }}
                    <span class="font-medium text-red-700 text-sm">※商品画像1で設定したものがTopとして表示されます</span>
                    <div class="flex flex-wrap mb-6">
                        <button
                            class="block text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 mr-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button" data-modal-toggle="imageFirstModal">
                            商品画像 1<i class="fa-solid fa-image ml-1"></i>
                        </button>
                        {{ Form::hidden('image_first', $model->image_first ?? null, ['id' => 'image_first']) }}
                        <button
                            class="block text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 mr-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button" data-modal-toggle="imageSecondModal">
                            商品画像 2<i class="fa-solid fa-image ml-1"></i>
                        </button>
                        {{ Form::hidden('image_second', $model->image_second ?? null, ['id' => 'image_second']) }}
                        <button
                            class="block text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 mr-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button" data-modal-toggle="imageThirdModal">
                            商品画像 3<i class="fa-solid fa-image ml-1"></i>
                        </button>
                        {{ Form::hidden('image_third', $model->image_third ?? null, ['id' => 'image_third']) }}
                        <button
                            class="block text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 mr-1 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button" data-modal-toggle="imageFourthModal">
                            商品画像 4<i class="fa-solid fa-image ml-1"></i>
                        </button>
                        {{ Form::hidden('image_fourth', $model->image_fourth ?? null, ['id' => 'image_fourth']) }}
                    </div>
                    <x-form.select-image :images="$images" number="First"/>
                    <x-form.select-image :images="$images" number="Second"/>
                    <x-form.select-image :images="$images" number="Third"/>
                    <x-form.select-image :images="$images" number="Fourth"/>
                    <div
                        class="block p-6 bg-blue-300 border border-gray-200 rounded-lg shadow-md hover:bg-blue-200 mb-6">
                        <div class="mb-6">
                            {{ Form::label('current_quantity', '在庫数', ['class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300']) }}
                            {{ Form::number('current_quantity', $currentQuantity, ['class'=>'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light']) }}
                        </div>
                        <div class="mb-6">
                            {{ Form::label('type', '在庫操作', ['class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-white']) }}
                            {{ Form::select('type', StockConst::STOCK_OPTION, null, [ 'placeholder'=>'選択してください', "class" => "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"]) }}
                        </div>
                        <div class="mb-6">
                            {{ Form::label('quantity', '数量選択', ['class'=>'block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300']) }}
                            <span class="font-medium text-red-700 text-sm">※数量は0~99の間で設定してください</span>
                            {{ Form::number('quantity', 0, ['class'=>'shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light']) }}
                        </div>
                    </div>
                    <button type="button" onclick="location.href='{{ route('owner.product.index') }}'"
                            class="text-white bg-blue-500 hover:bg-blue-400 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm
                            px-3 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        戻る<i class="fa-solid fa-arrow-left ml-1"></i>
                    </button>
                    <button type="submit"
                            class="focus:outline-none text-white bg-green-500 hover:bg-green-400 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm
                            px-3 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        更新<i class="fa-solid fa-wrench ml-1"></i>
                    </button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




