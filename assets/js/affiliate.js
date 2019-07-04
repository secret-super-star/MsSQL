chartColor = "#FFFFFF";
var chart_lavel_week = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
var ctx = document.getElementById("chart_week").getContext("2d");

gradientFill = ctx2.createLinearGradient(0, 170, 0, 50);
gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
gradientFill.addColorStop(1, hexToRGB('#2CA8FF', 0.6));

var a = {
    type: "bar",
    data: {
        labels: chart_lavel_week,
        datasets: [{
            label: "Data",
            backgroundColor: gradientFill,
            borderColor: "#2CA8FF",
            pointBorderColor: "#FFF",
            pointBackgroundColor: "#2CA8FF",
            pointBorderWidth: 2,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 1,
            pointRadius: 4,
            fill: true,
            borderWidth: 1,
            data: [0, 10, 0, 0, 0, 0, 0]
        }]
    },
    options: {
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        tooltips: {
            bodySpacing: 4,
            mode: "nearest",
            intersect: 0,
            position: "nearest",
            xPadding: 10,
            yPadding: 10,
            caretPadding: 10
        },
        responsive: 1,
        scales: {
            yAxes: [{
                gridLines: 0,
                gridLines: {
                    zeroLineColor: "transparent",
                    drawBorder: false
                }
            }],
            xAxes: [{
                gridLines: {
                    zeroLineColor: "transparent",
                    display: false,

                },
                ticks: {
                    padding: 10,
                    fontColor: "rgba(0,0,0,0.4)",
                    fontStyle: "bold"
                }
            }]
        },
        layout: {
            padding: {
                left: 0,
                right: 0,
                top: 15,
                bottom: 15
            }
        }
    }
};

var myChart = new Chart(ctx, a);
var auto_load ;

function load_data() {
    $.ajax({
        url: '/get_data.php',
        type: 'post',
        data: post_data,
        dataType: 'json',
        cache: false,
        success: function (data, textStatus, jQxhr) {
            myChart.data.datasets.forEach((dataset) => {
                dataset.data = data['year'];
            });
            myChart.update();

        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    }).done(function () { });
}
