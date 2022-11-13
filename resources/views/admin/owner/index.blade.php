<?php
use App\Models\Owner;

/** @var Owner $models */

?>



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            オーナー[管理]
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-4 mx-auto">
                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                <div class="flex pl-4 mt-4 mb-4 lg:w-2/3 w-full">
                                    <button type="button" onclick="location.href='{{ route('admin.owner.create') }}'"
                                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4
                                            focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center
                                            mr-2 mb-2"><i class="fa-solid fa-plus"></i>新規作成
                                    </button>
                                </div>
                                <!-- Flash Messages with Session-->
                                <x-flash-message />
                                <!-- Flash Messages with Ajax-->
                                <div class="message-alert"></div>
                                <div class="overflow-x-auto relative mb-4">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="py-3 px-6">
                                                ID
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                お名前
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                メールアドレス
                                            </th>
                                            <th scope="col" class="py-3 px-6">
                                                作成日
                                            </th>
                                            <th scope="col" class="py-3 px-6">

                                            </th>
                                            <th scope="col" class="py-3 px-6">

                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($models as $model)
                                            <tr id="record{{ $model->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $model->id }}
                                                </th>
                                                <td class="py-4 px-6">
                                                    {{ $model->name }}
                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ $model->email }}
                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ $model->created_at->diffforHumans() }}
                                                </td>
                                                <td class="py-4 px-6">
                                                    <button type="button" onclick="location.href='{{ route('admin.owner.edit', ['id' => $model->id]) }}'"
                                                            class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br
                                                            focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50
                                                            dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-3 py-2.5 text-center mr-2 mb-2"><i class="fa-solid fa-pen"></i>編集
                                                    </button>
                                                </td>
                                                <td class="py-4 px-6">
                                                    <button type="button" data-modal-toggle="delete{{ $model->id }}Modal"
                                                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4
                                                            focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80
                                                            font-medium rounded-lg text-sm  px-3 py-2.5 text-center mr-2 mb-2"><i class="fa-solid fa-trash"></i>削除
                                                    </button>
                                                </td>
                                                <x-form.modal-delete :model="$model" />
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

