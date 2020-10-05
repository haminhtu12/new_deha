$(document).ready(function () {
    getListUser()

    //edit
    $(document).on('click', '.btn-edit-user', function () {
        urlUpdate = $(this).data('update');
        let url = $(this).data('action');

        $.get(url, (data) => {
            let {user, role_ids_user} = data;
            $('#select_role').val(role_ids_user);
            fillUserToModal(user);
        })
    });
    //update
    $(document).on('click', '#edit-submit', function (e) {
        e.preventDefault();
        let data = new FormData($('#contact_form')[0]);
        callApi(urlUpdate, data, 'POST')
            .then(() => {
                getList($('#table-user'))
                $('#myModal').modal('hide');
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
    $(document).on('click', '.btn-delete-user', function () {
        urldelete = $(this).data('delete');
        that = $(this);
    })

    // confirm delete
    $(document).on('click', '#confirmDeleteUser', function () {
        $('#idDelete').modal('hide');
        callApi(urldelete, "", "POST")
            .then((res) => {
                toastr.success('Delete User Success');
                that.parent().parent().remove();
            })
    })

    //add
    $(document).on('click', '#add-submit-user', function (e) {
        let url = $(this).data('url');
        let data = new FormData($('#add-contact_form')[0]);
        callApi(url, data, "POST")
            .then((res) => {
                let {user} = res;
                console.log(user)
                toastr.success(" Create Success  User");
                $('#addModalUser').modal('hide');
                getList($('#table-user'));

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
    $(document).on('click', '#cancelDeleteUser', function () {
        $('#idDelete').modal('hide');
    });

    //change status
    $(document).on('click', '.btn-change-status', function () {
        let urlChangeStatusUser = $(this).data('action');
        callApi(urlChangeStatusUser)
            .then((res) => {
                toastr.success(" Status Change Success ");
                getList($('#table-user'));

            });
    })

    //filter
    $(document).on('change', '#user-status', function () {
        getListUser();
    })

    $(document).on('click', 'a.page-link', function (event) {
        event.preventDefault();
        let url = $(this).attr('href')
        list(url)
    });

    $(document).on('keyup', '#input-search-user', function () {
        getListUser();
    });

    function getListUser() {
        let form = $('#search-form');
        let url = form.data('action');
        let data = form.serialize();

        list(url, data);
    }

    function list(url, data = {}) {
        callApi(url, data)
            .then((res) => {
                $('#table-user').replaceWith(res);
            })
    }

});

function fillUserToModal(user) {
    $('#editUserModalTitle').html(`Edit ${user.name}`);
    $('#name').val(user.name)
    $('#email').val(user.email)
    $('#phone').val(user.phone)
    $('#address').val(user.address)
    $('#status').val(user.status)
    $('#img').attr("src","images/avatar/"+user.avatar);

}

