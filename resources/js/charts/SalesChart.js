import { Bar } from 'vue-chartjs'

export default {
    name: 'SalesChart',  
    extends: Bar,
    props: {
        chartData: {
            type: Object
        }
    },
    data: () => ({
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    gridLines: {
                        display: true
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    gridLines: {
                        display: false
                    }
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: true,
                mode: 'single',
                callbacks: {
                    label: function(tooltipItems, data) {
                        return '$' + tooltipItems.yLabel;
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            height: 200
        }
    }),

    mounted () {
        console.log('Bar Chart!!!')
        this.renderChart(this.chartData, this.options)
    }
}

