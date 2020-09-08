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
    $(document).on('click', '#add-submit-category', function () {
        let urlAddCategory = 'categories/add';
        let data = new FormData($('#add_category_form')[0]);
        callCategoryApi(urlAddCategory, data, "POST")
            .then((res) => {
                toastr.success(" Create Success  Category");
                $('#addModalCategory').modal('hide');
                getList();

            })
            .catch((res)=>{
                if (res.status == 422){
                    $(".error").css('display','block');
                    $.each( res.responseJSON.errors, function( key, value ) {
                        $(".error").find("ul").append('<li>'+value+'</li>');
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
        // console.log(urldelete)
        callCategoryApi(urldelete, null, "POST")
            .then((res) => {
                toastr.success('Delete category Success');
                that.parent().parent().remove();
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

        // console.log(urlUpdate)
        callCategoryApi(urlUpdate, data, 'POST')
            .then(() => {
                // getList()
                $('#editModalCategory').modal('hide');
                toastr.success('Edit Product sucess');
                getList();
            })
            .catch((res)=>{
                if (res.status == 422){
                    $(".error").css('display','block');
                    $.each( res.responseJSON.errors, function( key, value ) {
                        $(".error").find("ul").append('<li>'+value+'</li>');
                    });
                }
            })
    })
})
function getList() {
    let url = $('#table-category').data('action');
    callCategoryApi(url)
        .then((res) => {
            $('#table-category').replaceWith(res);
        })
}
function callCategoryApi(url, data = '', method = 'get') {
    return $.ajax({
        url: url,
        data: data,
        method: method,
        processData: false,
        contentType: false,
    });
}
function fillCategoryToModal(category) {
    $('#editCategoryModalTitle').html(`Edit ${category.name}`);
    $('#name').val(category.name);
}

