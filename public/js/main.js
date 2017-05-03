function main() {
        // $('.show_order').hide();
        //  $(".order_add").submit(
        //     function (e) {
        //         // e.preventDefault();
        // //          $('.show_order').show();
        //         $.ajax({
        //             type: 'GET',
        //             url: '/ordered',
        //             success: function (responsedata) {
        //                 var m =responsedata.length-1;
        //                 alert(responsedata[m]);
        //
        //             },
        //             error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
        //                 console.log(JSON.stringify(jqXHR));
        //                 console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        //             }
        //         });
        //
        //     }
        //  );

    $('.select_item').change(function() {
        var total=0
        $('.select_item').each(function() {
             var price = $(this).attr('price');
             var count =$(this).val();
             total=total+price*count;
        });

        $('.cost').text(total);

    });
}

$(document).ready(main);