<?php

use App\Consts\CommonConst;

/** @var array $selectCategoryList */

?>
{{ Form::open(['route' => 'user.item.index', 'method' => 'get']) }}
    @method('GET')
    <div class="row align-items-center">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6">
                    <select name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full
                            p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>カテゴリー選択</option>
                        @foreach($selectCategoryList as $primaryCategory => $secondaryCategories)
                            <option disabled>{{ $primaryCategory }}</option>
                            @foreach($secondaryCategories as $id => $secondaryCategory)
                                <option value="{{ $id }}">{{ $secondaryCategory }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <select name="order_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full
                            p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>並び順</option>
                        @foreach(CommonConst::ORDER_OPTION as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" name="search_keyword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full
                    p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="キーワードを入力してください">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm
                    px-4 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">検索<i class="fa-solid fa-magnifying-glass ml-1"></i></button>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
@section('page-script')
    <script src="{{ asset('js/select2.js') }}"></script>
@endsection
