<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Bootstrap CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/meuCSS.css" rel="stylesheet">
        <!-- Carregar API com KEY-->
        <script type="application/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9rEwjFmjmyfPDq5_5ukuwtjN13KcborA&amp;sensor=true"></script>
        <!-- jQuery (necessario para os plugins Javascript do Bootstrap) -->
        <script src="js/jquery-3.1.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/meuJS.js"></script>
        <script src="js/modal.js"></script>
    </head>
    <body>
            <?php
            $numero = $_GET["numero"];
            session_start();
            $_SESSION['idA'];
            $_SESSION['idChamado'];

            if ($numero == 1) {
                ?>
               <form method="post" action="Controller.php">

                <div class="modal fade" id="myMapModal">

                    <div class="modal-dialog">
                        <div class="modal-content">
                       
                            <div class="modal-body">
                                <div class="container">
                                    <div class="row">
                                        <div id="map-canvas" class=""></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                    <input class="btn btn-danger" type="submit" name="operacao" value="Atende Chamado">
                                    <input class="btn btn-default" type="submit" name="operacao" value="Voltar">
                                
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                    </form>

                <!-- /.modal -->
                <script>
                    $('document').ready(function () {
                        $('#myMapModal').modal('show');
                    })
                </script>            
                <?php
            }
            ?>

    </body>
</html>
