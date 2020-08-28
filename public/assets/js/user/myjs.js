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

    $(document).on('click', '.btn-edit-user', function () {
        urlUpdate = $(this).data('update');
        let url = $(this).data('action');
        $.get(url, (data) => {
            let {user} = data;
            fillUserToModal(user);
        })
    });

    //edit
    $(document).on('click', '#edit-submit', function (e) {
        e.preventDefault();
        let data = new FormData($('#contact_form')[0]);
        callUserApi(urlUpdate, data, 'POST')
            .then(() => {
                getList()
                $('#myModal').modal('hide');
            })
    })
    let that = '';

    //delete
    $(document).on('click', '.btn-delete-user', function () {
        urldelete = $(this).data('delete');
        that = $(this);
    })
    $(document).on('click', '#openFormAddUser', function () {
    })

    // confirm delete
    $(document).on('click', '#confirmDeleteUser', function () {
        $('#idDelete').modal('hide');
        callUserApi(urldelete, "", "POST")
            .then((res) => {
                console.log(1)
                toastr.success('Delete User Success');
                that.parent().parent().remove();
            })
    })

    //add
    $(document).on('click', '#add-submit-user', function () {
        let urlAddUser = 'users/add';
        let data = new FormData($('#add-contact_form')[0]);
        callUserApi(urlAddUser, data, "POST")
            .then((res) => {
                toastr.success(" Create Success  User");
                $('#addModalUser').modal('hide');
                getList();
            });

    })
    $(document).on('click', '#cancelDeleteUser', function () {
        $('#idDelete').modal('hide');
    });

    //change status
    $(document).on('click','.btn-change-status',function (){
        let urlChangeStatusUser = $(this).data('action');
        callUserApi(urlChangeStatusUser)
            .then((res) => {
                toastr.success(" Status Change Success ");
                getList();

            });
    })

    //filter
    $(document).on('click','#btnFilterAllUser',function (){
        let urlChangeStatusUser = $(this).data('action');
        callUserApi(urlChangeStatusUser)
            .then((res) => {
                $('#table-user').replaceWith(res);
            });
    })
    $(document).on('click','#btnFilterActiveUser',function (){
        let urlChangeStatusUser = $(this).data('action');
        callUserApi(urlChangeStatusUser)
            .then((res) => {
                $('#table-user').replaceWith(res);
            });
    })
    $(document).on('click','#btnFilterInActiveUser',function (){
        let urlChangeStatusUser = $(this).data('action');
        callUserApi(urlChangeStatusUser)
            .then((res) => {
                $('#table-user').replaceWith(res);
            });
    })



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

function fillUserToModal(user) {
    $('#editUserModalTitle').html(`Edit ${user.name}`);
    $('#name').val(user.name)
    $('#email').val(user.email)
    $('#phone').val(user.phone)
    $('#address').val(user.address)
    $('#status').val(user.status)
    $('#avatar').val(user.avatar)
}

function getList() {
    let url = $('#table-user').attr('data-action');
    callUserApi(url)
        .then((res) => {
            $('#table-user').replaceWith(res);
        })
}
function seachUser(){
    let searchText = '';
    searchText = document.getElementById("input-search-user").value;
        let urlSearch =  $('#input-search-user').attr('data-action');
        callUserApi(urlSearch + '?search=' + searchText)
            .then((res) => {
                $('#table-user').replaceWith(res);
            })




}
