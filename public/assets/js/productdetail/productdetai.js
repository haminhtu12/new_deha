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
        callProductDetailApi(urlAddProductDetail, data, "POST")
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

    //edit
    $(document).on('click', '.btn-edit-product-detail', function () {
        urlUpdate = $(this).data('update');
        let url = $(this).data('action');

        $.get(url, (data) => {

            let {productDetail} = data;


            fillProductDetailToModal(productDetail);
        })
    });

    //update
    $(document).on('click', '#edit-submit-productdetail', function (e) {
        e.preventDefault();
        let data = new FormData($('#edit_productdetail_form')[0]);

        callProductDetailApi(urlUpdate, data, 'POST')
            .then(() => {
                getList()
                $('#editModalProductDetail').modal('hide');
                toastr.success('Edit Product Detail sucess');
            })
            .catch((res) => {
                if (res.status == 422) {
                    $(".error").css('display', 'block');
                    $.each(res.responseJSON.errors, function (key, value) {
                        $(".error").find("ul").append('<li>' + value + '</li>');
                    });
                }
            })
    })

    //delete
    $(document).on('click', '.btn-delete-product-detail', function () {
        urldelete = $(this).data('delete');
        that = $(this);
    })

    // confirm delete
    $(document).on('click', '#confirmDeleteProduct', function () {
        $('#modalDeleteProduct').modal('hide');
        console.log(urldelete)
        callProductDetailApi(urldelete, null, "POST")
            .then((res) => {
                console.log(res);
                toastr.success('Delete Product Success');
                that.parent().parent().remove();
            })
    })


});

function callProductDetailApi(url, data = '', method = 'get') {
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
    callProductDetailApi(url)
        .then((res) => {
            $('#table-product-details').replaceWith(res);
        })
}

function fillProductDetailToModal(productDetail) {
    $('#editProductDetailModal').html(`Edit ${productDetail.name}`);
    $('#editName').val(productDetail.name);
    $('#edit_detail').val(productDetail.detail);
    $('#edit_price').val(productDetail.price);
    $('#edit_amount').val(productDetail.amount);
}
