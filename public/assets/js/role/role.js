$(document).ready(function () {
    getList($('#table-role'));

    //add
    $(document).on('click', '#add-submit-role', function () {

        let formAdd = $('#add_role_form');
        let data = formAdd.serialize();
        let url = formAdd.data('action');
        callApi(url, data, 'POST').then((res) => {
            toastr.success(" Create Success  Product");
            $('#addModalRole').modal('hide');
            getList($('#table-role'));
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
    rolePermissions = [];
    $(document).on('click', '.btn-edit-role', function () {
        urlUpdate = $(this).data('update');
        let url = $(this).data('action');
        $.get(url, (data) => {
            let {role, rolePermissions} = data;
            $('.permission').val(rolePermissions)
            fillRoleToModal(role);
        })
    });

    //update
    $(document).on('click', '#edit-submit-role', function (e) {
        e.preventDefault();
        let data = $('#edit_role_form').serialize();

        callApi(urlUpdate, data, 'POST')
            .then(() => {

                $('#editModalRole').modal('hide');
                toastr.success('Edit Product sucess');
                $('.permission').val(rolePermissions)
                getList($('#table-role'));
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
    $(document).on('click', '.btn-delete-role', function () {
        urldelete = $(this).data('delete');
        that = $(this);
    })
    // confirm delete
    $(document).on('click', '#confirmDeleteRole', function () {
        $('#modalDeleteRole').modal('hide');
        callApi(urldelete, null, "POST")
            .then((res) => {
                toastr.success('Delete role Success');
                that.parent().parent().remove();
            })
    })

    $(document).on('click', '.checkbox_wrapper', function () {
        let parentClassName = $(this).data('class');

        $(this).parents('.card').find(`.${parentClassName}-select-item`).prop('checked', $(this).prop('checked'));
    });
});

function fillRoleToModal(role) {
    $('#editRoleModalTitle').html(`Edit ${role.name}`);
    $('#name').val(role.name);
    $('#editDescriptionRole').val(role.description);
}

