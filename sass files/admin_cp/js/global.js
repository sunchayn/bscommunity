(function($){
    var data = new Array();
        data[0] = {
            labels: ["10", "11", "12", "13", "14", "15", "16"],
            datasets: [
                {
                    label: "last 10 days activity",
                    fillColor: "rgba(220,220,220,0.2)",
                    strokeColor: "rgba(220,220,220,1)",
                    pointColor: "rgba(220,220,220,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(220,220,220,1)",
                    data: [65, 59, 80, 81, 56, 55, 40]
                }
            ]
        };
        data[1] =[
            {
                value: 1230,
                color:"#16a085",
                highlight: "#1abc9c",
                label: "google chrome"
            },
            {
                value: 1032,
                color: "#c0392b",
                highlight: "#e74c3c",
                label: "mozila firefox"
            },
            {
                value: 998,
                color: "#8e44ad",
                highlight: "#9b59b6",
                label: "IOS browser"
            },
            {
                value: 434,
                color: "#7f8c8d",
                highlight: "#95a5a6",
                label: "other browser"
            }
        ];
    //draw the charts
    respChart($("#monthlyActivity"), data[0], 1);
    respChart($("#browserUsage"), data[1], 2);
//sub menu
$(".sub-menu>a").on("click", function(e){
    e.preventDefault();
    $(this).toggleClass('focused');
    $(this).next('nav').slideToggle(400);
    $(this).children(".toggle").toggleTwoClass("icon-angle-down", "icon-angle-up");
});
$(".sub-menu>a.checked").next('nav').show();
$(".sub-menu>a.checked").children(".toggle").toggleTwoClass("icon-angle-down", "icon-angle-up");
//end - sub menu
//#####
//help center
    //check tickets
    var len = $(".checkboxTickets").size();
    $(".checkboxTickets").on('change', function(){
        $this = $(this);
        if ($this.is(':checked')) {
           $this.parents('.ticket').addClass('checked');
           var count = 0;
           $(".checkboxTickets").each(function(index){
                if (!$(this).prop("checked")) {
                    return false;
                }
                count++;
                if (count == len){
                    $(".selectAll").prop("checked", true);
                }
           });
        } else {
           $this.parents('.ticket').removeClass('checked');
           $(".selectAll").prop("checked", false);
        }
    });
    //check all tickets
    $(".selectAll").on("change", function(){
        $this = $(this);
        if ($this.is(':checked')) {
           $(".selectAll").prop("checked", true);
           $(".checkboxTickets").each(function(){
                $(this).prop("checked", true);
                $('.ticket').addClass('checked');
           });
        } else {
           $(".selectAll").prop("checked", false);
           $(".checkboxTickets").each(function(){
                $(this).prop("checked", false);
                $('.ticket').removeClass('checked');
           });
        }
    });
//end - help center
//#####

})(jQuery);