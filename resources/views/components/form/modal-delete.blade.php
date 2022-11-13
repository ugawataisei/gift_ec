<?php
use App\Models\Owner;

/** @var Owner $model */

$formId = 'delete-owner' . $model->id;

//urlによってルート変更
if (strpos(url()->current(), 'expired')) {
    $formRoute = 'admin.expired-owner.destroy';
} else {
    $formRoute = 'admin.owner.destroy';
}
?>



@props([
    'model' => null,
])
<!-- Main modal -->
<div id="delete{{ $model->id }}Modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    オーナー削除
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="delete{{ $model->id }}Modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                <span class="font-medium">本当に削除しますか？？</span>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <p class="text-red-600 ajax-error-{{ $formId }}"></p>
                <p class="text-base text-red-600 leading-relaxed text-gray-500 dark:text-gray-400">
                    削除対象オーナー： {{ $model->name }} 様
                </p>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                {{ Form::open([ 'id' => $formId . 'ModalForm', 'route' => $formRoute, 'method' => 'post']) }}
                @csrf
                {{ Form::hidden('id', $model->id) }}
                <button data-modal-toggle="delete{{ $model->id }}Modal" type="submit" data-form-id="{{ $formId }}"
                        class="delete-owner-submit text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none
                        focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg
                        text-sm px-4 py-2.5 text-center mr-2 mb-2"><i class="fa-solid fa-trash"></i>削除する
                </button>
                <button data-modal-toggle="delete{{ $model->id }}Modal" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200
                        text-sm font-medium px-4 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white
                        dark:hover:bg-gray-600 dark:focus:ring-gray-600"><i class="fa-solid fa-xmark"></i>閉じる
                </button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

