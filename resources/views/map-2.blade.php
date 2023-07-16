<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">

    <title>Map</title>


</head>
<body>

    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script type='text/javascript' src='http://www.google.com/jsapi'></script>
    <script type='text/javascript'>
        function drawMap() {
            var data = google.visualization.arrayToDataTable([
                ['State Code', 'State', 'Code']
                , ['IN-UP', 'Uttar Pradesh', 780.1]
                , ['IN-MH', 'Maharashtra', 920.2]
                , ['IN-BR', 'Bihar', 510.3]
                , ['IN-WB', 'West Bengal', 620.4]
                , ['IN-MP', 'Madhya Pradesh', 700.5]
                , ['IN-TN', 'Tamil Nadu', 930.6]
                , ['IN-RJ', 'Rajasthan', 1030.7]
                , ['IN-KA', 'Karnataka', 1290.8]
                , ['IN-GJ', 'Gujarat', 1304.9]
                , ['IN-AP', 'Andhra Pradesh', 320.10]
                , ['IN-OR', 'Odisha', 133.11]
                , ['IN-TG', 'Telangana', 233.12]
                , ['IN-KL', 'Kerala', 311.13]
                , ['IN-JH', 'Jharkhand', 290.14]
                , ['IN-AS', 'Assam', 280.15]
                , ['IN-PB', 'Punjab', 300.16]
                , ['IN-CT', 'Chhattisgarh', 330.17]
                , ['IN-HR', 'Haryana', 300.18]
                , ['IN-JK', 'Jammu and Kashmir', 200.19]
                , ['IN-UT', 'Uttarakhand', 208.20]
                , ['IN-HP', 'Himachal Pradesh', 107.21]
                , ['IN-TR', 'Tripura', 301.22]
                , ['IN-ML', 'Meghalaya', 210.23]
                , ['IN-MN', 'Manipur', 220.24]
                , ['IN-NL', 'Nagaland', 201.25]
                , ['IN-GA', 'Goa', 1121.26]
                , ['IN-AR', 'Arunachal Pradesh', 343.27]
                , ['IN-MZ', 'Mizoram', 423.28]
                , ['IN-SK', 'Sikkim', 724.29]
                , ['IN-DL', 'Delhi', 231.30]
                , ['IN-PY', 'Puducherry', 233.31]
                , ['IN-CH', 'Chandigarh', 230.32]
                , ['IN-AN', 'Andaman and Nicobar Islands', 230.33]
                , ['IN-DN', 'Dadra and Nagar Haveli', 230.34]
                , ['IN-DD', 'Daman and Diu', 229.35]
                , ['IN-LD', 'Lakshadweep', 231.36]
            , ]);
            //console.log(data);
            var options = {
                region: 'IN'
                , domain: 'IN'
                , displayMode: 'regions'
                , resolution: 'provinces'
                , sizeAxis: {
                    minValue: 1
                    , maxValue: 1
                    , minSize: 10
                    , maxSize: 10
                }
                , colorAxis: {
                    colors: ['#008000', '#FFFF00', '#0000FF']
                }
                , width: 860
                , height: 600
                , legend: 'none',
                //backgroundColor: 'transparent',
                //datalessRegionColor: '#ffc801',//'transparent,#ffc801'
                mapArea: {
                    left: 10
                    , top: 20
                    , width: "50%"
                    , height: "50%"
                }
                , defaultColor: '#f5f5f5'
                , tooltip: {
                    textStyle: {
                        color: '#444444'
                    }
                    , trigger: 'focus'
                }
            };
            var container = document.getElementById('mapcontainer');
            var chart = new google.visualization.GeoChart(container);

            function myClickHandler() {
                var selection = chart.getSelection();
                console.clear();
                console.log(selection);
                if (selection.length > 0) {
                    console.log(data.getValue(selection[0].row, 0), data.getValue(selection[0].row, 1), data.getValue(selection[0].row, 2));
                }
            }
            google.visualization.events.addListener(chart, 'select', myClickHandler);
            // google.visualization.events.addListener(chart, 'ready', function () {
            //     var countries = container.getElementsByTagName('path');
            //     Array.prototype.forEach.call(countries, function (path) {
            //         path.setAttribute('stroke', '#d2b9df');
            //     });
            // });

            google.visualization.events.addListener(chart, 'ready', function() {
                // change inactive stroke color
                var countries = container.getElementsByTagName('path');
                Array.prototype.forEach.call(countries, function(path) {
                    path.setAttribute('stroke', '#d2b9df');
                });

                // change active stroke color, build mutation observer
                var observer = new MutationObserver(function(nodes) {
                    Array.prototype.forEach.call(nodes, function(node) {
                        // check for new nodes
                        if (node.addedNodes.length > 0) {
                            Array.prototype.forEach.call(node.addedNodes, function(addedNode) {
                                // the tooltip element will also be here, we only want the group elements
                                if (addedNode.tagName === 'g') {
                                    // find children of the group element
                                    Array.prototype.forEach.call(addedNode.childNodes, function(childNode) {
                                        // check for path element, change stroke
                                        if (childNode.tagName === 'path') {
                                            childNode.setAttribute('stroke', '#ff0000');
                                        }
                                    });
                                }
                            });
                        }
                    });
                });

                // activate mutation observer
                observer.observe(container, {
                    childList: true
                    , subtree: true
                });
            });

            chart.draw(data, options);
        }
        google.load('visualization', '1', {
            packages: ['geochart']
            , callback: drawMap
        });

    </script>

    <div id="wrapper">




        <div class="main">

            <div id="my_wrapper">

                <div id="mapcontainer"></div>



            </div>




        </div>



</body>
</html>
