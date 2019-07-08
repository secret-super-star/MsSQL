chartColor = "#FFFFFF";

// General configuration for the charts with Line gradientStroke
gradientChartOptionsConfiguration = {
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
            display: 0,
            gridLines: 0,
            ticks: {
                display: false
            },
            gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false
            }
        }],
        xAxes: [{
            display: 0,
            gridLines: 0,
            ticks: {
                display: false
            },
            gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false
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
};

gradientChartOptionsConfigurationWithNumbersAndGrid = {
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
    responsive: true,
    scales: {
        yAxes: [{
            gridLines: 0,
            gridLines: {
                zeroLineColor: "transparent",
                drawBorder: false
            }
        }],
        xAxes: [{
            display: 0,
            gridLines: 0,
            ticks: {
                display: false
            },
            gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
                drawBorder: false
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
};
var ctx = document.getElementById('chart_year').getContext("2d");

// var ctx2 = document.getElementById('chart_time').getContext("2d");

var gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
gradientStroke.addColorStop(0, '#80b6f4');
gradientStroke.addColorStop(1, chartColor);

var gradientFill = ctx.createLinearGradient(0, 200, 0, 50);
gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
gradientFill.addColorStop(1, "rgba(255, 255, 255, 0.24)");

var chart_lavel_week = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];
var chart_lavel_year = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AGU", "SEP", "OCT", "NOV", "DEC"];
var chart_lavel_day = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"];
var chart_lavel_time = ["00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"];
var chart_data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,];


var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: chart_lavel_year,
        datasets: [{
            label: "Data",
            borderColor: chartColor,
            pointBorderColor: chartColor,
            pointBackgroundColor: "#1e3d60",
            pointHoverBackgroundColor: "#1e3d60",
            pointHoverBorderColor: chartColor,
            pointBorderWidth: 1,
            pointHoverRadius: 7,
            pointHoverBorderWidth: 2,
            pointRadius: 5,
            fill: true,
            backgroundColor: gradientFill,
            borderWidth: 2,
            data: chart_data
        }]
    },
    options: {
        layout: {
            padding: {
                left: 20,
                right: 20,
                top: 0,
                bottom: 0
            }
        },
        maintainAspectRatio: false,
        tooltips: {
            backgroundColor: '#fff',
            titleFontColor: '#333',
            bodyFontColor: '#666',
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
        },
        legend: {
            position: "bottom",
            fillStyle: "#FFF",
            display: false
        },
        scales: {
            yAxes: [{
                ticks: {
                    fontColor: "rgba(255,255,255,0.4)",
                    fontStyle: "bold",
                    beginAtZero: true,
                    maxTicksLimit: 5,
                    padding: 10
                },
                gridLines: {
                    drawTicks: true,
                    drawBorder: false,
                    display: true,
                    color: "rgba(255,255,255,0.1)",
                    zeroLineColor: "transparent"
                }

            }],
            xAxes: [{
                gridLines: {
                    zeroLineColor: "transparent",
                    display: false,

                },
                ticks: {
                    padding: 10,
                    fontColor: "rgba(255,255,255,0.4)",
                    fontStyle: "bold"
                }
            }]
        }
    }
});

chartColor = "#FFFFFF";

// General configuration for the charts with Line gradientStroke
gradientChartOptionsConfiguration = {
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
    responsive: true,
    scales: {
        yAxes: [{
            display: 0,
            gridLines: 0,
            ticks: {
                display: false
            },
            gridLines: {
                zeroLineColor: "transparent",
                drawTicks: false,
                display: false,
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
};

var ctx1 = document.getElementById('chart_month').getContext("2d");

gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
gradientStroke.addColorStop(0, '#80b6f4');
gradientStroke.addColorStop(1, chartColor);

gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
gradientFill.addColorStop(1, hexToRGB('#18ce0f', 0.4));

myChart1 = new Chart(ctx1, {
    type: 'bar',
    responsive: true,
    data: {
        labels: chart_lavel_day,
        datasets: [{
            label: "Data",
            borderColor: "#18ce0f",
            pointBorderColor: "#FFF",
            pointBackgroundColor: "#18ce0f",
            pointBorderWidth: 2,
            pointHoverRadius: 4,
            pointHoverBorderWidth: 1,
            pointRadius: 4,
            fill: true,
            backgroundColor: gradientFill,
            borderWidth: 1,
            data: chart_data
        }]
    },
    options: gradientChartOptionsConfiguration
});

var ctx2 = document.getElementById("chart_week").getContext("2d");

gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
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
            data: [0, 0, 0, 0, 0, 0, 0]
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

var myChart2 = new Chart(ctx2, a);

var ctx3 = document.getElementById("chart_time").getContext("2d");

gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
gradientFill.addColorStop(1, hexToRGB('#2CA8FF', 0.6));

var a = {
    type: "bar",
    data: {
        labels: chart_lavel_time,
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
            data: chart_data
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

var myChart3 = new Chart(ctx3, a);

var auto_load;
var auto_load1;
var auto_load2;
var auto_load3;
var chart_year = '';
var chart_month = '';
var chart_day = '';
var post_data;
var selected_user ='';
var table_filter = 'time';
var card_update_time = 1;
var table_update_time = 1;

var datatable = null;
datatable = $(".status_table").DataTable({
    // paging: false,
    stateSave: true,
    searching: false,
    info: false
});

function update_card_time(){
    card_update_time ++;
    $('.card_update').text(card_update_time);
}

function update_table_time(){
    table_update_time ++;
    $('.table_update').text(table_update_time);
}

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

            myChart1.data.labels = data['month']['label'];
            myChart1.data.datasets.forEach((dataset) => {
                dataset.data = data['month']['data'];
            });
            myChart1.update();

            myChart2.data.labels = data['week']['label'];
            myChart2.data.datasets.forEach((dataset) => {
                dataset.data = data['week']['data'];
            });
            myChart2.update();

            myChart3.data.labels = data['time']['label'];
            myChart3.data.datasets.forEach((dataset) => {
                dataset.data = data['time']['data'];
            });
            myChart3.update();

            $('.bets_done').val(data['resume']['betcount']);
            $('.unsettled').val(data['resume']['Unsettled']);
            $('.settled').val(data['resume']['settled']);
            if(parseFloat(data['resume']['Stake']).toFixed(2) != 'NaN'){
              $('.instake').val(parseFloat(data['resume']['Stake']).toFixed(2));
            } else {
              $('.instake').val('0');
            }
            if((parseFloat(data['resume']['Profit']) - parseFloat(data['resume']['Stake'])).toFixed(2) != 'NaN'){
              $('.profit').val((parseFloat(data['resume']['Profit']) - parseFloat(data['resume']['Stake'])).toFixed(2));
            } else {
              $('.profit').val('0');
            }
            if(((parseFloat(data['resume']['Profit'])- parseFloat(data['resume']['Stake'])) / parseFloat(data['resume']['Stake']) * 100).toFixed(2) != 'NaN'){
              $('.roi').val('%'+ ((parseFloat(data['resume']['Profit'])- parseFloat(data['resume']['Stake'])) / parseFloat(data['resume']['Stake']) * 100).toFixed(2));
            } else {
              $('.roi').val('% 0');
            }
            // $('.profit').val((parseFloat(data['resume']['Profit']) - parseFloat(data['resume']['Stake'])).toFixed(2));
            // $('.roi').val(((parseFloat(data['resume']['Profit'])- parseFloat(data['resume']['Stake'])) / parseFloat(data['resume']['Stake']) * 100).toFixed(2)+"%");
            $('.frv').val(parseFloat(data['resume']['decimal']).toFixed(2));
            $('.mpe').val(parseFloat(data['resume']['event']).toFixed(2));
            $('.account_id').val(data['resume']['id']);

            clearInterval(auto_load2);
            card_update_time = 0;
            auto_load2 = setInterval(update_card_time, 60000);

        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    }).done(function () { });
}

function load_table() {
    var table_get_data = {
        'user_name': selected_user,
        'table_filter' : table_filter
    }
    $.ajax({
        url: '/get_table.php',
        type: 'post',
        data: table_get_data,
        dataType: 'json',
        cache: false,
        success: function (data, textStatus, jQxhr) {

            if(data['table']){
                draw_table(data['table']);
            }

            clearInterval(auto_load3);
            table_update_time = 0;
            auto_load3 = setInterval(update_table_time, 60000);
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    }).done(function () { });
}


function draw_table(data) {
    datatable.destroy();
    $("#status_table").html('');
    var txt = '';
    for (let i = 0; i < data.length; i++) {
        txt += '<tr>';
        var time = data[i]['TimeStamp'].split('.')[0];
        txt += '<td>'+time+"</td>";

        txt += '<td>'+data[i]['Teams']+"</td>";
        txt += '<td>'+data[i]['Stake']+"</td>";
        txt += '<td>'+data[i]['Evaluation']+"</td>";
        var temp = (""+data[i]['OddDecimal']).split('.').length;
        if(temp > 1) txt += '<td>'+data[i]['OddDecimal']+"</td>";
        else txt += '<td>'+data[i]['OddDecimal']+".00</td>";
        // txt += '<td>'+data[i]['OddDecimal']+"</td>";
        txt += '<td>'+data[i]['MarketInfo']+"</td>";
        // txt += '<td>'+data[i]['OutCome']+"</td>";
        if(data[i]['OutCome'] == 'unsettled') {
            txt += '<td style="color: blue">?</td>';
        } else if(data[i]['Profit'] == '.00'){
            txt += '<td style="color: red">0.00</td>';
        } else {
            txt += '<td style="color: green">'+data[i]['Profit']+'</td>';
        }

        txt += '</tr>';
    }
    $("#status_table").append(txt);

    datatable = $(".status_table").DataTable({
        // paging: false,
        stateSave: true,
        searching: false,
        info: false
    });


}

function show_userlist(data) {


    var txt = '';
    for (let i = 0; i < data.length; i++) {
        txt += '<li data-id="'+data[i].trim()+'" data-value="' + data[i] + '"><a href="#"><i class="now-ui-icons design_app"></i><p>'+data[i]+'</p></a></li>';
    }
    $(".user_list").append(txt);

    if(username){
      post_data = {
          'user_name': username
      }
      selected_user = username;
      $('.user_list li[data-id="'+username+'"]').click();
    } else {
      post_data = {
          'user_name': data[0]
      }
      selected_user = data[0];
      $('.user_list').find('li').first().next().click();
    }

    load_data();
    load_table();


}

$(document).ready(function () {

  var page_count = 0;
  var page_number = 0;

    $('.filter_button').click(function (){
        clearInterval(auto_load1);
        $('#date-range').val("");
        $('.filter_button').removeClass('btn-primary').addClass('btn-default');
        $(this).addClass('btn-primary');
        table_filter = $(this).data('value');
        load_table();
        auto_load1 = setInterval(load_table, 60000);
    })

    $('#date-range').dateRangePicker();

    $('#date-range').on('datepicker-apply', function(ev, picker) {
      clearInterval(auto_load1);
      $('.filter_button').removeClass('btn-primary').addClass('btn-default');
      table_filter = $(this).val();
      load_table();
      auto_load1 = setInterval(load_table, 60000);

    });

    $.ajax({
        url: '/get_user.php',
        type: 'post',
        dataType: 'json',
        cache: false,
        success: function (data, textStatus, jQxhr) {
            show_userlist(data);
        },
        error: function (jqXhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    }).done(function () { });

    // $("#user_select").change(function () {
    //     clearInterval(auto_load);
    //     post_data = {
    //         'user_name': $(this).val()
    //     }
    //     load_data();
    //     selected_user = $(this).val();
    //     load_table();
    //     auto_load = setInterval(load_data, 3600000);
    // })

    $(document).on('click' , '.user_list li' , function(){
        if($(this).data('value') !='All'){
          $('.user_list').find('li').removeClass('active');
          $(this).addClass('active');
          clearInterval(auto_load);
          clearInterval(auto_load1);
          post_data = {
              'user_name': $(this).data('value')
          }
          load_data();
          selected_user = $(this).data('value')
          load_table();
          auto_load = setInterval(load_data, 3600000);
          auto_load1 = setInterval(load_table, 60000);
        }

    })


})
