<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .text-center {
            text-align: center;
        }

        #map {
            width: 100%;
            height: 400px;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Laravel Google Maps</h1>
    <div id="map"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key= AIzaSyCYddn7Fe5R_WwcrLSjoHrytGnz1kvARIg&callback=initMap" async></script>
    <script>
        let map, activeInfoWindow, markers = [];

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 28.626137,
                    lng: 79.821603
                },
                zoom: 15
            });

            map.addListener("click", function(event) {
                mapClicked(event);
            });

            initMarkers();
        }

        function initMarkers() {
            const initialMarkers = {!! json_encode($initialMarkers) !!};

            for (let index = 0; index < initialMarkers.length; index++) {
                const markerData = initialMarkers[index];

                const marker = new google.maps.Marker({
                    position: markerData.position,
                    label: markerData.label,
                    draggable: markerData.draggable,
                    map: map
                });

                markers.push(marker);

                const infowindow = new google.maps.InfoWindow({
                    content: `<b>${markerData.position.lat}, ${markerData.position.lng}</b>`,
                });

                marker.addListener("click", () => {
                    if (activeInfoWindow) activeInfoWindow.close();

                    infowindow.open({
                        anchor: marker,
                        shouldFocus: false,
                        map
                    });
                    activeInfoWindow = infowindow;
                    markerClicked(marker, index);
                });

                marker.addListener("dragend", (event) => {
                    markerDragEnd(event, index);
                });
            }
        }

        function mapClicked(event) {
            console.log("Map Clicked at:", event.latLng.lat(), event.latLng.lng());
        }

        function markerClicked(marker, index) {
            console.log("Marker Clicked:", marker.position.lat(), marker.position.lng());
        }

        function markerDragEnd(event, index) {
            console.log("Marker Dragged To:", event.latLng.lat(), event.latLng.lng());
        }

        
        function addMarker() {
            const marker = new google.maps.Marker({
                position: { lat: 28.625043, lng: 79.810135 },
                label: { color: "white", text: "P4" },
                draggable: true,
                map: map
            });
            markers.push(marker);
        }

        
        function removeMarker() {
            const index = markers.findIndex(m => m.getLabel()?.text === "P4");
            if (index !== -1) {
                markers[index].setMap(null);
                markers.splice(index, 1);
            }
        }

       
        function updateMarker() {
            const index = markers.findIndex(m => m.getLabel()?.text === "P4");
            if (index !== -1) {
                markers[index].setOptions({
                    position: { lat: 28.625043, lng: 79.810135 }
                });
            }
        }
    </script>
</body>
</html>
