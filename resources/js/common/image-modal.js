$(function () {
    'use strict';
    //todo : コード汚いので様改善 date 2022/11/27 author 鵜川泰成
    //画像クリック
    $('.select-image').on('click', function () {
        //outline css 適応/解除
        if ($(this).css('outline') === 'rgb(0, 0, 255) solid 1px') {
            $(this).css('outline', '');
        } else {
            $(this).css('outline', '1px solid blue');
        }

        //選択ボタンのデータ属性に値を設定
        let selectImgId = $(this).attr('data-image-id');
        let modalNumber = $(this).attr('data-modal-number');
        const selectBtn = $(`#selectImg${modalNumber}`);
        let selectedImgId = selectBtn.attr('data-selected-id');

        if (selectedImgId === '' && selectImgId !== selectedImgId) {
            selectBtn.attr('data-selected-id', selectImgId);
        } else if (selectImgId === selectedImgId) {
            selectBtn.attr('data-selected-id', '');
        } else {
            //既に他の画像が選択されている場合 outline css解除してから値を設定
            $('.select-image').filter(function () {
                return ($(this).attr('data-image-id') === selectedImgId);
            }).css('outline', '');
            selectBtn.attr('data-selected-id', selectImgId);
        }
    });

    //選択ボタン
    $('.select-btn').on('click', function () {
        const selectedId = $(this).attr('data-selected-id');
        const modalId = $(this).attr('data-modal-id');

        //各inputタグのvalueに値を設定
        if (modalId === 'First') {
            $('#image_first').val(selectedId);
        } else if (modalId === 'Second') {
            $('#image_second').val(selectedId);
        } else if (modalId === 'Third') {
            $('#image_third').val(selectedId);
        } else {
            $('#image_fourth').val(selectedId);
        }
    });
});
