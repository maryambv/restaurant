function main() {
        // $('.show_order').hide();
         $(".order").click(
            function (e) {
                // e.preventDefault();
        //          $('.show_order').show();
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
                                var day=dowMap[getting_res[x].day];
                                get_tr+="<tr><td>"+food_id+"</td><td>"+count+"</td><td>"+day+"</td><tr>";
                            }
                            $('#table_show').html(get_tr);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                });

            }
         );

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