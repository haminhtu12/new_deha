$(document).ready(function () {
    let urlUpdate = '';
    let urldelete = '';
    let urlList = '';
    getList($('#table-product'));

    //add
    $(document).on('click', '#add-submit-product', function () {
        let urlAddProduct = 'products/add';
        let data = new FormData($('#add_product_form')[0]);
        callApi(urlAddProduct, data, "POST")
            .then((res) => {
                toastr.success(" Create Success  Product");
                $('#addModalProduct').modal('hide');
                getList($('#table-product'));

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
        callApi(urlUpdate, data, 'POST')
            .then(() => {
                getList($('#table-product'));
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

        callApi(urldelete, null, "POST")
            .then((res) => {
                toastr.success('Delete Product Success');
                that.parent().parent().remove();
            })
    })


});

function fillProductToModal(product) {
    $('#editProductModalTitle').html(`Edit ${product.name}`);
    $('#category_id').val(product.category_id);
    $('#name').val(product.name);
}

