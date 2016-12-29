/* Criar url global*/
//ip servidor
var ip='192.168.1.116:86';

var idCliente=null;
(function()
{
  "use strict";

  function register_event_handlers()
  {
            
      /* button  #btnChamaCadastro */
    $(document).on("click", "#btnChamaCadastro", function(evt)
    {
         activate_page("#ClienteCadastro");
         return false;
    });
      
        /* a  #btVoltaIndex */
    $(document).on("click", "#btVoltaIndex", function(evt)
    {
        activate_page("#mainpage");
         return false;
    });
         
        /* button  #btnCadastar  */
    $(document).on("click", "#btnCadastar", function(e)
    {
        //impede de seguir a url
         e.preventDefault();

         $.ajax({
            type: "POST",
            url: "http://"+ip+"/www/App/CRUD/insert.php",
            data: {
                acao: 'Cadastro',
                nome: $("#txtCadNome").val(),
                senha: $("#txtCadSenha").val(),
                fone: $("#txtFone").val(),
            },
            async: true,
            dataType: "json",
            success: function (json) {

                if(json.result === true){

                    //navigator.notification.alert("Inserido com sucesso",0,"OK")
                    navigator.notification.alert("Usuario inserido com sucesso:", "INFORMAÇÃO");
                    //alert("Inserido com sucesso");
                    //limpa campos
                    $("#txtCadNome").val(''); 
                    $("#txtCadSenha").val(''); 
                    $("#txtFone").val(''); 
                    activate_page("#mainpage");
                }
                else if(json.result === false){
                    navigator.notification.alert("Dados já cadastrados:", "INFORMAÇÃO");
                    $("#txtCadNome").val(''); 
                    $("#txtCadSenha").val(''); 
                    $("#txtFone").val(''); 
                    activate_page("#ClienteCadastro");
                }
                else{
                    alert(json.msg);
                }
            },error: function(xhr,t){
                console.log(xhr.responseText);
            }
        });
         return false;
    });
      
        /*funcao mostra no mapa*/
    function carregaMapa()
    {
         // Resultado para quando conseguir capturar a posição GPS...
                    var fnCapturar = function(position){

                    // Gravar dados da posição capturada em uma variável...
                    var coords = position.coords;

                    // Exibir dados das coordenadas capturadas...
                    //navigator.notification.alert(JSON.stringify(coords),"COORDENADAS");

                    // GOOGLE MAPS: Mostrar marcador no mapa...
                    var map = new google.maps.Map(
                                    document.getElementById("map"),
                                    {
                                      center : new google.maps.LatLng( coords.latitude, coords.longitude ),
                                      zoom : 15,
                                      mapTypeId : google.maps.MapTypeId.ROADMAP
                                    }
                            );
                    //MOSTAR O PONTO EM VERMELHO     
                    var marker = new google.maps.Marker({
                                        title : "VOCÊ ESTÁ AQUI: "+coords.latitude+", "+coords.longitude,
                                        position : new google.maps.LatLng(coords.latitude, coords.longitude)
                                 });
                    marker.setMap(map);
                    //MOSTRAR CIRCULO     
                    var circl = new google.maps.Circle({
                                map: map,
                                strokeColor: '#FF0000',
                                  strokeOpacity: 0.8,
                                  strokeWeight: 2,
                                  fillColor: '#FF0000',
                                  fillOpacity: 0.35,
                                center : new google.maps.LatLng(coords.latitude, coords.longitude),
                                radius: 500
                         });
                        circl.setMap(map);

                }

                // Caso falhe na captura, faça isso...
                var fnFalhar = function(error){

                    navigator.notification.alert("Erro ao capturar posição: "+error.message, "INFORMAÇÃO");

                }

                // Opções para acessar o GPS...
                var opcoes = { maximumAge: 3000, timeout: 5000, enableHighAccuracy: true };

                // CAPTURAR POSIÇÃO: Chamada a API de Geolocalização (GPS) via Apache Cordova
                navigator.geolocation.getCurrentPosition(fnCapturar, fnFalhar, opcoes);

    }
      
        /* button  #btnLogar */
    $(document).on("click", "#btnLogar", function(e)
    {
         e.preventDefault();

         $.ajax({
            type: "POST",
            url: "http://"+ip+"/www/App/CRUD/buscaLogin.php",
            data: {
                acao: 'LoginWeb',
                usuario: $("#txtNome").val(),
                senha: $("#txtSenha").val()
            },
            async: false,
            dataType: "json",
            success: function (json) {
                 //limpa campos
                //  $("#txtNome").val(''); 
                 //  $("#txtSenha").val(''); 
                                  
                if(json.result === true){
                   //redireciona o usuario para pagina
                  $("#usuario_nome").html(json.dados.nome);
                    idCliente=json.dados.id;     
                    
                    carregaMapa();//chama localização
                   
                 //chama tela de chamado
                  activate_page("#Chamado");
                   //$.mobile.changePage("#ClienteCadastro", {
                     //   transition : "slidefade"
                   // });

                }else{
                   alert(json.msg);
                }
            },error: function(xhr,e,t){
                console.log(xhr.responseText);
            }
        });
         return false;
    });
    
        /* button  #btnFazChamado */
    $(document).on("click", "#btnFazChamado", function(evt)
    {
        //carregaMapa();
        //impede de seguir a url
         evt.preventDefault();
       
                    // Resultado para quando conseguir capturar a posição GPS...
                    var fnCapturar = function(position){

                    // Gravar dados da posição capturada em uma variável...
                    var coords = position.coords;                              
                    
                             $.ajax({
                                type: "POST",
                                url: "http://"+ip+"/www/App/CRUD/insert.php",
                                data: {
                                    acao: 'CadastroChamado',
                                    longitude: coords.longitude,
                                    latitude: coords.latitude,
                                    idCliente: idCliente,
                                },
                                async: true,
                                dataType: "json",
                                success: function (json) {

                                    if(json.result === true){

                                    navigator.notification.alert("Chamado inserido:", "INFORMAÇÃO");

                                    }else{
                                    
                                    navigator.notification.alert("Chamado atualizado:", "INFORMAÇÃO");
                                      // alert(json.msg);
                                    }
                                    activate_page("#Chamado");

                                },error: function(xhr,t){
                                    console.log(xhr.responseText);
                                }
                            });

                }

                // Caso falhe na captura, faça isso...
                var fnFalhar = function(error){

                    navigator.notification.alert("Erro ao capturar posição: "+error.message, "INFORMAÇÃO");

                }

                // Opções para acessar o GPS...
                var opcoes = { maximumAge: 3000, timeout: 5000, enableHighAccuracy: true };

                // CAPTURAR POSIÇÃO: Chamada a API de Geolocalização (GPS) via Apache Cordova
                navigator.geolocation.getCurrentPosition(fnCapturar, fnFalhar, opcoes);
                   

         return false;
   
    });
    
    }
  document.addEventListener("app.Ready", register_event_handlers, false);
})();
