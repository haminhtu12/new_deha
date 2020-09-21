
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function (){
    getList();

    //add
    $(document).on('click', '#add-submit-role', function () {

        let formAdd = $('#add_role_form');
        let data = formAdd.serialize();
        let url = formAdd.data('action');
        callRoleApi(url, data, 'POST')  .then((res) => {
                toastr.success(" Create Success  Product");
                $('#addModalRole').modal('hide');
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
    $(document).on('click', '.btn-edit-role', function () {
        urlUpdate = $(this).data('update');
        let url = $(this).data('action');
        $.get(url, (data) => {
            let {role} = data;
            fillRoleToModal(role);
            getList();
            $('#editModalRole').modal('hide');

        })
    });

    //update
    $(document).on('click', '#edit-submit-role', function (e) {
        e.preventDefault();
        let data = $('#edit_role_form').serialize();

        callRoleApi(urlUpdate, data, 'POST')
            .then(() => {

                $('#editModalRole').modal('hide');
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
    //delete
    $(document).on('click', '.btn-delete-role', function () {
        urldelete = $(this).data('delete');
        that = $(this);
    })
    // confirm delete
    $(document).on('click', '#confirmDeleteRole', function () {
        $('#modalDeleteRole').modal('hide');
        callRoleApi(urldelete, null, "POST")
            .then((res) => {
                toastr.success('Delete role Success');
                that.parent().parent().remove();
            })
    })


});
function getList() {
    let url = $('#table-role').attr('data-action');
    callRoleApi(url)
        .then((res) => {
            $('#table-role').replaceWith(res);
        })
}
function callRoleApi(url, data = {}, method = 'get') {
    return $.ajax({
        url: url,
        data: data,
        method: method,
        // processData: false,
        // contentType: false,
    });
}
function fillRoleToModal(role) {
    $('#editRoleModalTitle').html(`Edit ${role.name}`);
    $('#name').val(role.name);
    $('#editDescriptionRole').val(role.description);
}

