
function main() {
    total_cost(0)
    $(".orderList").click(
        function (e) {
            // e.preventDefault();
            $.ajax({
                type: 'GET',
                url: '/ordered',
                success:function(res_data)
                {
                    var dowMap = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    if(res_data!='')
                    {
                        var getting_res=res_data;
                        var get_tr="<tr><th>Food</th><th>COUNT</th><th>DAY</th>";
                        for(var x in getting_res)
                        {
                            var food_id=getting_res[x].food.name;
                            var count=getting_res[x].count;
                            // var id=getting_res[x].id;
                            var day=dowMap[getting_res[x].day];
                            get_tr+="<tr><td>"+food_id+"</td><td>"+count+"</td><td>"+day+"</td><tr>";
                        }
                        $('#table_show').html(get_tr);
                    }else{
                         $('.order_status').fadeIn(500);
                         $('.order_status').text('Empty');
                         $('.order_status').fadeOut(1000);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });
        }
    );

    $('.select_item').change(function() {
        var price = $(this).attr('price');
        var count =$(this).val();
        var cost=price*count;

        total_cost(cost);
    });

    $('.static_menu').change(function() {
         var price = $(this).attr('price');
         var count =$(this).val();
         var cost =price*count;
        days_Offer(cost);

        // var cost=price*count;
        //
        // total_cost(cost);
    });
}
// function delete_item(id) {
//     console.debug(id);
//     $.ajax({
//         url: '/order/'+id,
//         type: 'DELETE',
//         success: function(result) {
//             console.log(result);
//         }
//     });
// }
function total_cost(s) {
    var total=s;

    $.ajax({
        type: 'GET',
        url: '/total',
        success:function(res_data)
        {
            total=total+parseFloat(res_data);
            if(total>0){
                $('.cost').text(total);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });
}
function days_Offer(s) {
    $.ajax({
        type: 'GET',
        url: '/offered/day',
        success:function(res_data)
        {
            total_cost(res_data*s);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(JSON.stringify(jqXHR));
            console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        }
    });
}
$(document).ready(main);