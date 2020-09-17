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
    $(document).on('click', '#add-submit-product', function () {
        let urlAddProduct = 'products/add';
        let data = new FormData($('#add_product_form')[0]);
        callProductApi(urlAddProduct, data, "POST")
            .then((res) => {
                toastr.success(" Create Success  Product");
                $('#addModalProduct').modal('hide');
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
    $(document).on('click', '.btn-edit-product', function () {
        urlUpdate = $(this).data('update');
        let url = $(this).data('action');
        $.get(url, (data) => {
            let {product} = data;
            fillProductToModal(product);
        })
    });

    //update
    $(document).on('click', '#edit-submit-product', function (e) {
        e.preventDefault();
        let data = new FormData($('#edit_product_form')[0]);

        console.log(data)
        callProductApi(urlUpdate, data, 'POST')
            .then(() => {
                getList()
                $('#editModal').modal('hide');
                toastr.success('Edit Product sucess');
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

    let that = '';

    //delete
    $(document).on('click', '.btn-delete-product', function () {
        urldelete = $(this).data('delete');
        that = $(this);
    })

    // confirm delete
    $(document).on('click', '#confirmDeleteProduct', function () {
        $('#modalDeleteProduct').modal('hide');

        callProductApi(urldelete, null, "POST")
            .then((res) => {
                toastr.success('Delete Product Success');
                that.parent().parent().remove();
            })
    })


});

//update

function callProductApi(url, data = '', method = 'get') {
    return $.ajax({
        url: url,
        data: data,
        method: method,
        processData: false,
        contentType: false,
    });
}

function fillProductToModal(product) {
    $('#editProductModalTitle').html(`Edit ${product.name}`);
    $('#category_id').val(product.category_id);
    $('#name').val(product.name);
}

function getList() {
    let url = $('#table-product').attr('data-action');
    callProductApi(url)
        .then((res) => {
            $('#table-product').replaceWith(res);
        })
}
