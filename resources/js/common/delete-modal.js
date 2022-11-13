$(function() {
   $('.delete-owner-submit').on('click', function(event) {

       const $formId = $(this).attr('data-form-id');
       const $elForm = $(`#${$formId}ModalForm`);
       const $formRoute = $elForm.attr('action');
       const formData = new FormData($elForm.get(0));

       event.preventDefault();
       $(`.ajax-error-${$formId}`).html('');
       $.ajax({
         type: 'POST',
         url: $formRoute,
         data: formData,
         dataType: 'json',
         processData: false,
         contentType: false,
         success: function (res) {
             const $modal = $(`#delete${res.data.id}Modal`);
             if (!$modal.hasClass('hidden')) {
                 $modal.hide();
             }
             //delete record
             const recordId = $(`#record${res.data.id}`);
             recordId.remove();

             //flash message alert
            const $baseAlert = $('.base-alert-message').html();
            const $messageAlert = $('.message-alert');

            let alertHtml = [];
            let tmpHtml = $baseAlert;

            tmpHtml = tmpHtml.replaceAll('{message}', res.message);
            alertHtml.push(tmpHtml);
            $messageAlert.html('');
            $messageAlert.html(alertHtml.join(''));

            setTimeout(function() {
                $messageAlert.empty();
            }, 5000);
         },
         error: function (res) {
            const messages = res.responseJSON.message;
            for (let key in messages) {
                let $elError = $(`.ajax-error-${$formId}`);
                $elError.html(messages[key]);
            }
         },
       });
   }) ;
});
