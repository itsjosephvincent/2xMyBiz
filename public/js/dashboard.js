var options = {
    chart: {
        height: 350,
        type: "bar",
    },
    series: [
        {
            data: [
                {
                    x: '',
                    y: data_count[0],
                    fillColor: '#000084',
                },
                {
                    x: '',
                    y: data_count[1],
                    fillColor: '#2E0696',
                },
                {
                    x: '',
                    y: data_count[2],
                    fillColor: '#4B10A7',
                },
                {
                    x: '',
                    y: data_count[3],
                    fillColor: '#641AB8',
                },
                {
                    x: '',
                    y: data_count[4],
                    fillColor: '#7E2fCA',
                },
                {
                    x: '',
                    y: data_count[5],
                    fillColor: '#972FDB',
                },
                {
                    x: '',
                    y: data_count[6],
                    fillColor: '#B039EC',
                },
                {
                    x: '',
                    y: data_count[7],
                    fillColor: '#FF09A0',
                },
                {
                    x: '',
                    y: data_count[8],
                    fillColor: '#FF3F83',
                },
                {
                    x: '',
                    y: data_count[9],
                    fillColor: '#FF6D6A',
                },
                {
                    x: '',
                    y: data_count[10],
                    fillColor: '#FF965B',
                },
                {
                    x: '',
                    y: data_count[11],
                    fillColor: '#FFBD5A',
                },
                {
                    x: '',
                    y: data_count[12],
                    fillColor: '#FFDF6A',
                },
                {
                    x: '',
                    y: data_count[13],
                    fillColor: '#FFFF8B',
                },
                {
                    x: '',
                    y: data_count[14],
                    fillColor: '#1A2334',
                },
            ]
        }
    ],
    legend: {
        show: true,
        showForSingleSeries: true,
        customLegendItems: data,
        markers: {
            fillColors: [
                '#000084',
                '#2E0696',
                '#4B10A7',
                '#641AB8',
                '#7E2fCA',
                '#972FDB',
                '#B039EC',
                '#FF09A0',
                '#FF3F83',
                '#FF6D6A',
                '#FF965B',
                '#FFBD5A',
                '#FFDF6A',
                '#FFFF8B',
                '#1A2334'
            ]
        }
    }
};

var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();

var data1 = (data_count[0] / total_data) * 100;
var data2 = (data_count[1] / total_data) * 100;
var data3 = (data_count[2] / total_data) * 100;
var data4 = (data_count[3] / total_data) * 100;
var data5 = (data_count[4] / total_data) * 100;
var data6 = (data_count[5] / total_data) * 100;
var data7 = (data_count[6] / total_data) * 100;
var data8 = (data_count[7] / total_data) * 100;
var data9 = (data_count[8] / total_data) * 100;
var data10 = (data_count[9] / total_data) * 100;
var data11 = (data_count[10] / total_data) * 100;
var data12 = (data_count[11] / total_data) * 100;
var data13 = (data_count[12] / total_data) * 100;
var data14 = (data_count[13] / total_data) * 100;
var data15 = (data_count[14] / total_data) * 100;

var options2 = {
    series: [{
        data: [
            data1.toFixed(2),
            data2.toFixed(2),
            data3.toFixed(2),
            data4.toFixed(2),
            data5.toFixed(2),
            data6.toFixed(2),
            data7.toFixed(2),
            data8.toFixed(2),
            data9.toFixed(2),
            data10.toFixed(2),
            data11.toFixed(2),
            data12.toFixed(2),
            data13.toFixed(2),
            data14.toFixed(2),
            data15.toFixed(2),
        ]
    }],
    chart: {
        type: 'bar',
        height: 350
    },
    plotOptions: {
        bar: {
            barHeight: '100%',
            distributed: true,
            horizontal: true,
            dataLabels: {
                position: 'bottom'
            },
        }
    },
    legend: {
        show: false
    },
    colors: [
        '#000084',
        '#2E0696',
        '#4B10A7',
        '#641AB8',
        '#7E2fCA',
        '#972FDB',
        '#B039EC',
        '#FF09A0',
        '#FF3F83',
        '#FF6D6A',
        '#FF965B',
        '#FFBD5A',
        '#FFDF6A',
        '#FFFF8B',
        '#1A2334'
    ],
    dataLabels: {
        enabled: true,
        textAnchor: 'start',
        style: {
            colors: ['#fff']
        },
        formatter: function (val, opt) {
            return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val + "%"
        },
        offsetX: 0,
        dropShadow: {
            enabled: true
        }
    },
    stroke: {
        width: 1,
        colors: ['#fff']
    },
    xaxis: {
        categories: [
            data[0], data[1], data[2], data[3], data[4], data[5], data[6],
            data[7], data[8], data[9], data[10], data[11], data[12], data[13], data[14]
        ],
    },
    yaxis: {
        labels: {
            show: false
        }
    },
    tooltip: {
        theme: 'light',
        x: {
            show: true
        },
        y: {
            title: {
                formatter: function () {
                    return ''
                }
            }
        }
    }
};

var percentage = new ApexCharts(document.querySelector('#percentage'), options2);

percentage.render();


var options3 = {
    series: [{
        data: [notQualified, costHigh, notRightTime, notInterested, notNeeded, haveGuy, tooLong, noBusiness, other]
    }],
    chart: {
        type: 'bar',
        height: 350
    },
    plotOptions: {
        bar: {
            horizontal: true,
        }
    },
    dataLabels: {
        enabled: true
    },
    colors: [
        '#f5af19'
    ],
    xaxis: {
        categories: [
            'Not a Qualified Lead',
            'Cost Was Too High',
            'Not the Right Time',
            'Not Interested',
            'Not Needed',
            'They Already Have a “Guy”',
            'Took Too Long to Respond',
            'No Longer in Business',
            'Other'
        ],
    },
    grid: {
        xaxis: {
            lines: {
                show: false
            }
        }
    },
    yaxis: {
        reversed: true,
        axisTicks: {
            show: true
        }
    }
};

var reason = new ApexCharts(document.querySelector("#reasons"), options3);
reason.render();
