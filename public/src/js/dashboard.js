$(function(){

   ajax('GET','/get_user_stats','',showResult,'');



});





function showResult(params,success,responseObj){

    if(success){

        var stats = responseObj.stats;

        var dates = [];
        var tempValArray = [];
        var finalValArray = [];

        for(var i =0 ; i< stats.length; i++){
            var date = stats[i].date;
            dates.push(date);
            tempValArray.push(stats[i].count);

        }

        finalValArray.push(tempValArray);

        new Chartist.Line('.ct-chart', {
            labels: date,
            series: finalValArray
        }, {
            low: 0,
            showArea: true,
            width: '100%',
            height: '200px'
        });
    }


}








