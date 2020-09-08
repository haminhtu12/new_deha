$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    let urlUpdate = '';
    let urldelete = '';
    let urlList = '';
  getList();

    //add
    $(document).on('click', '#add-submit-productdetail', function () {
        let urlAddProductDetail = 'product-details/add';
        let data = new FormData($('#add_productdetail_form')[0]);
        console.log(data)
        callUserApi(urlAddProductDetail, data, "POST")
            .then((res) => {
                toastr.success(" Create Success  Product Detail");
               $('#addModalProductDetail').modal('hide');
                getList();
            })
            .catch((res) => {
                if (res.status == 422) {
                    $(".error").css('display', 'block');
                    $.each(res.responseJSON.errors, function (key, value) {
                        $(".error").find("ul").append('<li>' + value + '</li>');
                    });
                }
            })


    });
});
function callUserApi(url, data = '', method = 'get') {
    return $.ajax({
        url: url,
        data: data,
        method: method,
        processData: false,
        contentType: false,
    });
}
function getList() {
    let url = $('#table-product-details').attr('data-action');
    callUserApi(url)
        .then((res) => {
            $('#table-product-details').replaceWith(res);
        })
}
