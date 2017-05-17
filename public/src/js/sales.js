$(function(){

    $('#year_select').on('change',function () {
        var year = this.value;

        if(year!=0)
        {
            $('#month_select').removeAttr('disabled');
        }
    });
});