$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


});
function callApi(url, data = '', method = 'get') {
    return $.ajax({
        url: url,
        data: data,
        method: method,
        processData: false,
        contentType: false,
    });
}
function getList() {
    let url = $('#table').attr('data-action');
    callApi(url)
        .then((res) => {
            $('#table').replaceWith(res);
        })
}
