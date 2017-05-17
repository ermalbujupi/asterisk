$(function(){

    $('#button1').on('click',function(){

        ajax('GET','/get_dates','',showResult,'');
    });


});


var data = [
        { y: '2014', a: 50, b: 90},
        { y: '2015', a: 65,  b: 75},
        { y: '2016', a: 50,  b: 50},
        { y: '2017', a: 75,  b: 60},
        { y: '2018', a: 80,  b: 65},
        { y: '2019', a: 90,  b: 70},
        { y: '2020', a: 100, b: 75},
        { y: '2021', a: 115, b: 75},
        { y: '2022', a: 120, b: 85},
        { y: '2023', a: 145, b: 85},
        { y: '2024', a: 160, b: 900}
    ],
    config = {
        data: data,
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Total Income', 'Total Outcome'],
        fillOpacity: 0.6,
        hideHover: 'auto',
        behaveLikeLine: true,
        resize: true,
        pointFillColors:['#ffffff'],
        pointStrokeColors: ['black'],
        lineColors:['gray','red']
    };
config.element = 'area-chart';
Morris.Area(config);
config.element = 'line-chart';
Morris.Line(config);
config.element = 'bar-chart';
Morris.Bar(config);
config.element = 'stacked';
config.stacked = true;
Morris.Bar(config);


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








