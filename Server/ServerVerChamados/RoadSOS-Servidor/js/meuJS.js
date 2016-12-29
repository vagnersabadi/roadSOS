var idCliente = null;
(function ()
{
    "use strict";

    function register_event_handlers()
    {

        function carregaMapa(lat,long)
        {
            var map;
            var myCenter = new google.maps.LatLng(lat, long);
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
        }
        
        $(document).on("click", "#btnLogar", function (e)
        {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "http://localhost:86/www/RoadSOS-Servidor/Controller.php",
                data: {
                    operacao: "Ver",
                    codigo: $("#codigo").val(),
                    //senha: $("#txtSenha").val()
                },
                async: false,
                dataType: "json",
                success: function (json) {
              
                            lat=json.dados.latitude; 
                            log=json.dados.longitude;

                            carregaMapa(lat,log);//chama localização

                   
                }, error: function (xhr, e, t) {
                    console.log(xhr.responseText);
                }
            });
            return false;
        });
    }
    document.addEventListener("app.Ready", register_event_handlers, false);
})();
