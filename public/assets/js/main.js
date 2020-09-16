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

//edit
// // paginate
// function paginate(events,path,selector){
//     $(document).on(events,selector, function (event) {
//         event.preventDefault();
//         var page = $(this).attr('href').split('page=')[1];
//         console.log($(this).attr('href'));
//         return 0;
//         getNextPage(page,path,selector);
//
//     });
//
// }
// function getNextPage(page,path,selector) {
//     $.ajax({
//         // url: "/users/pagination/fetch_data?page=" + page,
//         url: path+ page,
//         success: function (data) {
//             selector.html(data);
//
//         }
//
//     });
// }



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
