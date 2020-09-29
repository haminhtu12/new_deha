$(document).ready(function () {
    let urlUpdate = '';
    let urldelete = '';
    getList($('#table-category'));

    //add
    $(document).on('click', '#add-submit-category', function () {
        let urlAddCategory = $(this).data('action');
        let data = new FormData($('#add_category_form')[0]);
        callApi(urlAddCategory, data, "POST")
            .then((res) => {
                toastr.success(" Create Success  Category");
                $('#addModalCategory').modal('hide');
                getList($('#table-category'));
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

    //delete
    let that = '';

    //delete
    $(document).on('click', '.btn-delete-category', function () {
        urldelete = $(this).data('delete');
        that = $(this);
    })
    // confirm delete
    $(document).on('click', '#confirmDeleteCategory', function () {
        $('#modalDeleteCategory').modal('hide');
        callApi(urldelete, null, "POST")
            .then((res) => {
                toastr.success('Delete category Success');
                getList($('#table-category'));
           // that.parent().parent().remove();
            })
    })

    //edit
    $(document).on('click', '.btn-edit-category', function () {
        urlUpdate = $(this).data('update');
        let url = $(this).data('action');

        $.get(url, (data) => {
            let {category} = data;
            fillCategoryToModal(category);
        })
    });

    //update
    $(document).on('click', '#edit-submit-category', function (e) {
        e.preventDefault();
        let data = new FormData($('#edit_category_form')[0]);
        callApi(urlUpdate, data, 'POST')
            .then(() => {
                $('#editModalCategory').modal('hide');
                toastr.success('Edit Product success');
                getList($('#table-category'));
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
})
function fillCategoryToModal(category) {
    $('#editCategoryModalTitle').html(`Edit ${category.name}`);
    $('#name').val(category.name);
}

