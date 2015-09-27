(function($){
    $('.stats-page').ajaxRequest({url : 'statistics/getData'}, function(response){
        var users = response['users'],
                    data = new Array(),
                    countriesL = new Array(),
                    countriesD = new Array(),
                    categoriesL = new Array(),
                    categoriesD = new Array(),
                    agesL = new Array(),
                    agesD = new Array();
        //set active vs inactive users data
        data[0] =[
            {
                value: users['activeUsers'],
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: response['languages'].active
            },
            {
                value: users['inactiveUsers'],
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: response['languages'].inactive
            }
        ];
        //set genders percentage data
        data[1] =[
            {
                value: users['females'],
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: response['languages'].female
            },
            {
                value: users['males'],
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: response['languages'].male
            },
            {
                value: users['unset'],
                color: "#16a085",
                highlight: "#1abc9c",
                label: response['languages'].unset
            }
        ];
        agesD['M'] = new Array();
        agesD['F'] = new Array();
        //get ages labels and values
        for(var i = 0; i < response['ages'].length; i++)
        {
            agesL.push(response['ages'][i].label);
            agesD['M'].push(Number(response['ages'][i].countM));
            agesD['F'].push(Number(response['ages'][i].countF));
        }
        //set the ages data
        data[2] = {
            labels: agesL,
            datasets: [
                {
                    label: response['languages'].male,
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,0.8)",
                    highlightFill: "rgba(220,220,220,0.75)",
                    highlightStroke: "rgba(220,220,220,1)",
                    data: agesD['M']
                },
                {
                    label: response['languages'].female,
                    fillColor: "rgba(151,187,205,0.5)",
                    strokeColor: "rgba(151,187,205,0.8)",
                    highlightFill: "rgba(151,187,205,0.75)",
                    highlightStroke: "rgba(151,187,205,1)",
                    data: agesD['F']
                }
            ]
        };
        //get countries labels and values
        for(var i = 0; i < response['countries'].length; i++)
        {
            countriesL.push(response['countries'][i].country);
            countriesD.push(Number(response['countries'][i].c));
        }
        //set top countries chart data
        data[3] = {
            labels: countriesL,
            datasets: [
                {
                    label: "top countries",
                    fillColor: "rgba(222,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,0.8)",
                    highlightFill: "rgba(220,220,220,0.75)",
                    highlightStroke: "rgba(220,220,220,1)",
                    data: countriesD
                }
            ]
        };
        //get top categories labels and values
        for(var i = 0; i < response['categories'].length; i++)
        {
            categoriesL.push(response['categories'][i].title);
            categoriesD.push(Number(response['categories'][i].posts));
        }
        //set top categories chart data
        data[4] = {
            labels: categoriesL,
            datasets: [
                {
                    label: "top categories",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: categoriesD
                }
            ]
        };
        //draw the charts
        respChart($("#statsChart1"),data[0], 2);
        respChart($("#statsChart2"),data[1], 2);
        respChart($("#agesChart"),data[2], 3);
        respChart($("#cntryChart"),data[3], 3);
        respChart($("#catChart"), data[4], 1);
    });
})(jQuery);