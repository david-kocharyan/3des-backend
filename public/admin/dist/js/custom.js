$(document).ready(function () {

    // Sweet alert table delete
    $('.delete_form').on('click', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        let name = $(this).attr("data-text") || "row";
        swal({
            title: "Do You Really Want To Remove The " + name,
            icon: "warning",
            dangerMode: true,
            buttons: ['No', 'Yes'],
        }).then((willDelete) => {
            if (willDelete) {
                $(this).parent().submit();
            } else {
                swal.close();
            }
        });
    })

})
