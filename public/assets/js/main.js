$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


});


let urlUpdate = '';
let urldelete = '';
let urlList = '';
function callApi(url, data = '', method = 'get') {
    return $.ajax({
        url: url,
        data: data,
        method: method,
        processData: false,
        contentType: false,
    });
}
function getList(selector) {
    let url = selector.attr('data-action');
    callApi(url)
        .then((res) => {
            selector.replaceWith(res);
        })
}
