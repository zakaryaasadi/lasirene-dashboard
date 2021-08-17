    var info_this_week;
    var info_last_week;
    var info_year;

$(function(){
    
    $('.easypie').each(function(){
        $(this).easyPieChart({
          trackColor: $(this).attr('data-trackColor') || '#f2f2f2',
          scaleColor: false,
        });
    }); 

    
    var ctx = document.getElementById("sales_chart_1").getContext("2d");
    var sales_chart = new Chart(ctx, {
        type: 'bar', 
        data: {
            labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            datasets: [
                {
                    label: "JBR",
                    data: info_this_week[0],
                    borderColor: 'rgba(117,54,230,0.9)',
                    backgroundColor: 'rgba(117,54,230,0.9)',
                    pointBackgroundColor: 'rgba(117,54,230,0.9)',
                    pointBorderColor: 'rgba(117,54,230,0.9)',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    pointRadius: 0,
                    pointHitRadius: 30,
                },{
                    label: "Al Wasl",
                    data: info_this_week[1],
                    backgroundColor: 'rgba(255,64,129, 0.7)',
                    borderColor: 'rgba(255,64,129, 0.7)',
                    pointBackgroundColor: 'rgba(255,64,129, 0.7)',
                    pointBorderColor: 'rgba(255,64,129, 0.7)',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    pointRadius: 0,
                    pointHitRadius: 30,
                },{
                    label: "Burj Al Arab",
                    data: info_this_week[2],
                    borderColor: 'rgba(104,218,221,1)',
                    backgroundColor: 'rgba(104,218,221,1)',
                    pointBackgroundColor: 'rgba(104,218,221,1)',
                    pointBorderColor: 'rgba(104,218,221,1)',
                    borderWidth: 1,
                    pointBorderWidth: 1,
                    pointRadius: 0,
                    pointHitRadius: 30,
                },
            ],
        }, 
        options: {
            responsive: true,
            maintainAspectRatio: false,
            showScale: false,
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    },
                    barPercentage: 0.7,
                    categoryPercentage: 0.5
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                }]
            },
            legend: {
                labels: {
                    boxWidth: 12
                }
            },
        }
    });

    sales_data = {
        1 : {
          data: info_this_week,
          labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        },
        2 : {
          data: info_last_week,
          labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        },
        3 : {
          data: info_year,
          labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        },
    };

    $('#sales_tabs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var id = $(this).attr('data-id');
        if(id && +id in sales_data) {
            sales_chart.data.labels = sales_data[id].labels;
            var datasets = sales_chart.data.datasets;
            $.each(datasets,function(index,value) {
                datasets[index].data = sales_data[id].data[index];
            });
        }
        sales_chart.update();
    });
});


function set(x){
    jbr_week = x;
}