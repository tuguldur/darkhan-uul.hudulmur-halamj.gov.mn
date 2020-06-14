
@if ($page === 'welcome_page')

<script type="text/javascript">
    $(document).ready(function () {
        //alert("please do news read counter on every menu item page");
        $.ajax({
            method: "POST",
            url: "/service/update/welcome-page/visit-count",
            data: {dataSwitch: "UWVC1264", "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            console.log(callBackData);
        }).fail(function (jqXHR, textStatus) {
            console.log("Request failed: welcome visitor count++ " + textStatus);
        }).always(function () {
            //alert("complete");
        });
    });

    // svg path for target icon
    var targetSVG = "M9,0C4.029,0,0,4.029,0,9s4.029,9,9,9s9-4.029,9-9S13.971,0,9,0z M9,15.93 c-3.83,0-6.93-3.1-6.93-6.93S5.17,2.07,9,2.07s6.93,3.1,6.93,6.93S12.83,15.93,9,15.93 M12.5,9c0,1.933-1.567,3.5-3.5,3.5S5.5,10.933,5.5,9S7.067,5.5,9,5.5 S12.5,7.067,12.5,9z";
    var currentObject;

    var wordlDataProvider = {
        mapVar: AmCharts.maps.worldLow,
        getAreasFromMap: true,
        developerMode: true
    };

    var imagesData = [
        {latitude: 47.918558, longitude: 106.917624, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 1912},
        {latitude: 48.004479, longitude: 91.640155, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12942},
        {latitude: 48.970176, longitude: 89.962571, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 3470},
        {latitude: 46.370404, longitude: 96.257921, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 3490},
        {latitude: 49.986017, longitude: 92.068118, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12941},
        {latitude: 47.740203, longitude: 96.847156, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12937},
        {latitude: 49.641064, longitude: 100.169007, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 2},
        {latitude: 48.819465, longitude: 103.534295, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 10586},
        {latitude: 49.028254, longitude: 104.057227, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12938},
        {latitude: 47.476766, longitude: 101.452145, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 3489},
        {latitude: 46.188482, longitude: 100.713744, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 3471},
        {latitude: 43.571725, longitude: 104.418530, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 3474},
        {latitude: 46.266775, longitude: 102.773634, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 9471},
        {latitude: 45.764920, longitude: 106.270052, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 3472},
        {latitude: 47.705496, longitude: 106.948199, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 1361},
        {latitude: 44.892510, longitude: 110.134325, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 3473},
        {latitude: 49.467812, longitude: 105.955691, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12872},
        {latitude: 50.237519, longitude: 106.210561, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12940},
        {latitude: 47.326103, longitude: 110.654945, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12944},
        {latitude: 48.077316, longitude: 114.526800, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12873},
        {latitude: 46.686614, longitude: 113.282479, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12939},
        {latitude: 46.357672, longitude: 108.366135, svgPath: targetSVG, color: "#EF4035", scale: 0.6, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12936}
    ];

    /*
     var imagesData = [
     {latitude: 47.918558, longitude: 106.917624, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 1912},
     {latitude: 48.004479, longitude: 91.640155, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12942},
     {latitude: 48.970176, longitude: 89.962571, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 3470},
     {latitude: 46.370404, longitude: 96.257921, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 3490},
     {latitude: 49.986017, longitude: 92.068118, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12941},
     {latitude: 47.740203, longitude: 96.847156, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12937},
     {latitude: 49.641064, longitude: 100.169007, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 2},
     {latitude: 48.819465, longitude: 103.534295, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 10586},
     {latitude: 49.028254, longitude: 104.057227, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12938},
     {latitude: 47.476766, longitude: 101.452145, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 3489},
     {latitude: 46.188482, longitude: 100.713744, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 3471},
     {latitude: 43.571725, longitude: 104.418530, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 3474},
     {latitude: 46.266775, longitude: 102.773634, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 9471},
     {latitude: 45.764920, longitude: 106.270052, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 3472},
     {latitude: 47.705496, longitude: 106.948199, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 1361},
     {latitude: 44.892510, longitude: 110.134325, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 3473},
     {latitude: 49.467812, longitude: 105.955691, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12872},
     {latitude: 50.237519, longitude: 106.210561, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12940},
     {latitude: 47.326103, longitude: 110.654945, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12944},
     {latitude: 48.077316, longitude: 114.526800, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12873},
     {latitude: 46.686614, longitude: 113.282479, scale: 0.5, label: "0", labelShiftY: 2, zoomLevel: 5, "myUrl": "https://www.amcharts.com/", "aimniisid": 12939}
     ];*/

    var map = AmCharts.makeChart("chartdiv", {
        "type": "map",
        "theme": "dark",
        "imagesSettings": {
            "rollOverColor": "#089282",
            //"rollOverScale": 3,
            "selectedScale": 3,
            "selectedColor": "#089282",
            "color": "#CC0000",
            "labelColor": "#000000"
        },

        "zoomControl": {
            //"buttonFillColor": "#15A892"
        },
        "areasSettings": {
            "autoZoom": true,
            "unlistedAreasColor": "#15A892",
            "selectedColor": "#A3AFC6",
            "rollOverColor": "#D3D8E8"
        },
        "smallMap": {
            "enabled": false
        },
        "dataProvider": {
            "mapVar": AmCharts.maps.mongoliaHigh,
            "getAreasFromMap": true,
            images: imagesData
        },

        "listeners": [{
                "event": "clickMapObject",
                "method": function (event) {
                    // check if the map is already at traget zoomLevel and go to url if it is

                    if ((currentObject) && (event.mapObject.id == currentObject.id) && (typeof currentObject.id !== "undefined")) {
                        //alert("sdfs dffsd-" + event.mapObject.id + " = " + currentObject.id +" url: " +currentObject.myurl);
                        //window.location.href = event.mapObject.myUrl;
                        window.location.href = "/view/province/active-jobs/" + currentObject.id;
                    }
                    currentObject = event.mapObject;
                }
            }]
    });

    //map.addListener("positionChanged", updateCustomMarkers);
    map.addListener("homeButtonClicked", function (event) {
        //alert('homeButtonClicked');
    });
    //map.addListener("zoomCompleted", updateCustomMarkers);

    // this function will take current images on the map and create HTML elements for them
    function updateCustomMarkers(event) {
        // get map object
        var map = event.chart;

        // go through all of the images
        for (var x in map.dataProvider.images) {
            // get MapImage object
            var image = map.dataProvider.images[ x ];

            // check if it has corresponding HTML element
            if ('undefined' == typeof image.externalElement)
                image.externalElement = createCustomMarker(image);

            // reposition the element accoridng to coordinates
            var xy = map.coordinatesToStageXY(image.longitude, image.latitude);
            image.externalElement.style.top = xy.y + 'px';
            image.externalElement.style.left = xy.x + 'px';
        }
        imagesData = map.dataProvider.images;
    }

    function reRenderCustomMarkers(images) {
        $(".map-marker").remove();
        for (var x in images) {
            // get MapImage object
            var image = images[ x ];

            // check if it has corresponding HTML element
            if ('undefined' == typeof image.externalElement)
                image.externalElement = createCustomMarker(image);

            // reposition the element accoridng to coordinates
            var xy = map.coordinatesToStageXY(image.longitude, image.latitude);
            image.externalElement.style.top = xy.y + 'px';
            image.externalElement.style.left = xy.x + 'px';
        }
    }

    // this function creates and returns a new marker element
    function createCustomMarker(image) {
        // create holder
        var holder = document.createElement('div');
        holder.className = 'map-marker';
        holder.title = image.title;
        holder.style.position = 'absolute';

        // maybe add a link to it?
        if (undefined != image.url) {
            holder.onclick = function () {
                window.location.href = image.url;
            };
            holder.className += ' map-clickable';
        }

        // create dot
        var dot = document.createElement('div');
        dot.className = 'dot';
        holder.appendChild(dot);

        // create pulse
        var pulse = document.createElement('div');
        pulse.className = 'pulse';
        holder.appendChild(pulse);

        // append the marker to the map container
        image.chart.chartDiv.appendChild(holder);

        return holder;
    }

    $(window).load(function () {
        $.ajax({
            method: "GET",
            url: "/service/load/mongolia/active-jobs",
            dataType: "json",
            async: true
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            var loadedJobsCountJson = JSON.parse(callBackData);
            for (imageIndex in imagesData) {
                for (jobCountIndex in loadedJobsCountJson) {
                    if (parseInt(loadedJobsCountJson[jobCountIndex]['sectorId']) === parseInt(imagesData[imageIndex].aimniisid)) {
                        imagesData[imageIndex].label = loadedJobsCountJson[jobCountIndex]['sectorJobCount'];
                    }
                }
            }
            //map.dataProvider.images = imagesData;
            map.validateData();
            //map.dataProvider.images = imagesData;
        }).fail(function (jqXHR, textStatus) {
            //alert("Request failed: " + textStatus);
            console.log("Request failed: " + textStatus);
        }).always(function () {
            //alert("complete");
        });
    });

    $(".amcharts-chart-div").css({"background": "red"});
</script>

@elseif ($page === 'menu_item_read_news')

<script type="text/javascript">
    $(document).ready(function () {

    });

    $(window).load(function () {
        $.ajax({
            method: "POST",
            url: "/service/update/menu-news/read-count",
            data: {dataSwitch: "UNRC8971", postID: "<?= $postID; ?>", menuID: "<?= $menuID; ?>", "_token": "{{ csrf_token() }}"}
        }).done(function (callBackData) {
            //alert("Data Saved: " + callBackData);
            console.log(callBackData);
        }).fail(function (jqXHR, textStatus) {
            console.log("Request failed: news read count++ " + textStatus);
        }).always(function () {
            //alert("complete");
        });
    });
</script>

@else

Include user javascript section anything

@endif