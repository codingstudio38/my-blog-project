<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">

    <title>Map</title>

    <style>
        #container {
            height: 500px;
            min-width: 310px;
            max-width: 800px;
            margin: 0 auto;
        }

        .loading {
            margin-top: 10em;
            text-align: center;
            color: gray;
        }
.highcharts-credits
{
  display:none;
}


    </style>
</head>

<body>
    <script src="{{ url('/') }}/js/highmaps.js"></script>
    <script src="{{ url('/') }}/js/exporting.js"></script>
    <script type='text/javascript'>
        (async () => {
            const topology = await fetch(`{{ url('/') }}/in-all.topo.json`
            ).then(response => response.json());

            const data = [
                ['in-py', 10],
                ['in-ld', 11],
                ['in-wb', 12],
                ['in-or', 13],
                ['in-br', 14],
                ['in-sk', 15],
                ['in-ct', 16],
                ['in-tn', 17],
                ['in-mp', 18],
                ['in-2984', 19],
                ['in-ga', 20],
                ['in-nl', 21],
                ['in-mn', 22],
                ['in-ar', 23],
                ['in-mz', 24],
                ['in-tr', 25],
                ['in-3464', 26],
                ['in-dl', 27],
                ['in-hr', 28],
                ['in-ch', 29],
                ['in-hp', 30],
                ['in-jk', 31],
                ['in-kl', 32],
                ['in-ka', 33],
                ['in-dn', 34],
                ['in-mh', 35],
                ['in-as', 36],
                ['in-ap', 37],
                ['in-ml', 38],
                ['in-pb', 39],
                ['in-rj', 40],
                ['in-up', 41],
                ['in-ut', 42],
                ['in-jh', 43]
            ];

            Highcharts.mapChart('container', {
                chart: {
                    map: topology
                },

                title: {
                    text: null
                },

                subtitle: {
                    //text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/in/in-all.topo.json">India</a>'
                },

                mapNavigation: {
                    enabled: true,
                    buttonOptions: {
                        verticalAlign: 'bottom'
                    }
                },
              exporting: { enabled: false },

                colorAxis: {
                    min: 0
                },
                legend: 'none',
                plotOptions: {
                    series: {
                        cursor: 'pointer',
                        point: {
                            events: {
                                click: function() {
                                    console.clear();
                                    console.log(this.options,this.name, this.index,this.value);
                                }
                            }
                        }
                    }
                },

                series: [{
                    data: data,
                    name: 'State',
                    states: {
                        hover: {
                            color: '#BADA55'
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                }]


            });



        })();
    </script>

    <div id="container" ></div>




</body>

</html>
