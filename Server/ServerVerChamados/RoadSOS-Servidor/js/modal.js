var url   = window.location.search.replace("?", "");//pega toda url depois do ?
var items = url.split("&");//pega itens deposi do &

var array = {//armazena array
  'lat' : items[1],
  'long' : items[2]
}
//guarda numeros variaveis

var lat = array.lat;
var long= array.long;
//alert(lat);
//alert(long);
///carrega mapa
            var map;
            var myCenter = new google.maps.LatLng(long, lat);
            var marker = new google.maps.Marker({
                position: myCenter
            });

            function initialize() {
                var mapProp = {
                    center: myCenter,
                    zoom: 14,
                    draggable: false,
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                map = new google.maps.Map(document.getElementById("map-canvas"), mapProp);
                marker.setMap(map);

                google.maps.event.addListener(marker, 'click', function () {

                    infowindow.setContent(contentString);
                    infowindow.open(map, marker);

                });
            }
            ;
            google.maps.event.addDomListener(window, 'load', initialize);

            google.maps.event.addDomListener(window, "resize", resizingMap());

            $('#myMapModal').on('show.bs.modal', function () {
                //Must wait until the render of the modal appear, thats why we use the resizeMap and NOT resizingMap!! ;-)
                resizeMap();
            })

            function resizeMap() {
                if (typeof map == "undefined")
                    return;
                setTimeout(function () {
                    resizingMap();
                }, 400);
            }

            function resizingMap() {
                if (typeof map == "undefined")
                    return;
                var center = map.getCenter();
                google.maps.event.trigger(map, "resize");
                map.setCenter(center);
            }
     
