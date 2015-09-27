(function($){
    $('.cp-index-page').ajaxRequest({url : 'ajax/getAdminCharts'}, function(response){
        var browsers = response['browsers'],
            act = response['activities'].reverse(),
            data = [],
            dates = [],
            actv = [],
            browser = [];
        for(var i = 0; i < browsers.length; i++)
            browser[browsers[i].browser] = browsers[i].c;
        for(var i = 0; i < act.length; i++)
        {
            actv[i] = act[i][1];
            dates[i] = act[i][0];
        }

        data[0] = {
            labels: dates,
            datasets: [
                {
                    label: "last 7 days activity",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: actv
                }
            ]
        };
        data[1] =[
            {
                value: browser['Google Chrome'] || 0,
                color:"#16a085",
                highlight: "#1abc9c",
                label: "google chrome"
            },
            {
                value: browser['Mozilla Firefox'] || 0,
                color: "#c0392b",
                highlight: "#e74c3c",
                label: "mozila firefox"
            },
            {
                value: browser['Internet Explorer'] || 0,
                color: "#8e44ad",
                highlight: "#9b59b6",
                label: "Internet Explorer"
            },
            {
                value: browser['other'] || 0,
                color: "#7f8c8d",
                highlight: "#95a5a6",
                label: "other browser"
            }
        ];
        //draw the charts
        respChart($("#monthlyActivity"), data[0], 1);
        respChart($("#browserUsage"), data[1], 2);
    });
})(jQuery);