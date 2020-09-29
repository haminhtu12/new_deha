$(document).ready(function () {
    getList($('#table-user'));

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
    $(document).on('click', '#btnFilterAllUser', function () {
        let urlChangeStatusUser = $(this).data('action');
        callApi(urlChangeStatusUser)
            .then((res) => {
                $('#table-user').replaceWith(res);
            });
    })
    $(document).on('click', '#btnFilterActiveUser', function () {
        let urlChangeStatusUser = $(this).data('action');
        callApi(urlChangeStatusUser)
            .then((res) => {
                $('#table-user').replaceWith(res);
            });
    })
    $(document).on('click', '#btnFilterInActiveUser', function () {
        let urlChangeStatusUser = $(this).data('action');
        callApi(urlChangeStatusUser)
            .then((res) => {
                $('#table-user').replaceWith(res);
            });
    })

    $(document).on('click', '#pagination a', function (event) {
        let xxxx =   $(document).on('click', '#pagination ').data('action');
        console.log(xxxx)
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        getNextPage(page);
    });

    function getNextPage(page) {
        $.ajax({
            url: "/users/pagination/fetch_data?page=" + page,
            success: function (data) {
                $('#table-user').html(data);
            }
        });
    }

});

function fillUserToModal(user) {
    $('#editUserModalTitle').html(`Edit ${user.name}`);
    $('#name').val(user.name)
    $('#email').val(user.email)
    $('#phone').val(user.phone)
    $('#address').val(user.address)
    $('#status').val(user.status)
}


function seachUser() {
    let searchText = '';
    searchText = document.getElementById("input-search-user").value;
    let urlSearch = $('#input-search-user').attr('data-action');
    callApi(urlSearch + '?search=' + searchText)
        .then((res) => {
            $('#table-user').replaceWith(res);
        })


}
