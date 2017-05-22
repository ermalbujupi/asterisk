$(function(){

    $('#button1').on('click',function(){

        ajax('GET','/get_dates','',showResult,'');
    });


});





function showResult(params,success,responseObj){

    if(success){
        var dates = responseObj.dates;

        for(var i = 0; i< dates.length ; ++i){

            var date = new Date(dates[i]);
            var value = 0;

            $.ajax({
                url:'/getsize/'+date.getFullYear()+'/'+(date.getMonth()+1)+'',
                type:'GET',
                success:function(responseObj){
                    alert(responseObj.count);
                    data.push({year:(date.getDate()+"."+(date.getMonth()+1)+"."+date.getFullYear()),value:responseObj.count});

                },
                error:function(responseObj){
                    alert(responseObj.responseText);
                }
            });


        }

        alert(data);

        new Morris.Line({
            // ID of the element in which to draw the chart.
            element: 'myfirstchart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [
                {year:'2015',value:1},
                {year:'2016',value:2},
                {year:'2017',value:3}

            ],
            // The name of the data record attribute that contains x-values.
            xkey: 'year',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['Value']
        });
    }
}








