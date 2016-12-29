<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Road SOS</title>
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
            <div class="container">

        <?php
        session_start();
        $nomeAdm = $_SESSION['nome'];
        $senhaAdm = $_SESSION['senha'];
        $idAdm = $_SESSION['idA'];


        if (isset($nomeAdm) and isset($senhaAdm)) {
            ?>
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                    <ul class="nav nav-tabs">              
                        <li role="presentation" class="active"><a href="#"> Chamados Disponiveis</a></li>
                        <li role="presentation" ><a href="andamento.php">Chamados em Andamento</a></li>
                        <div  class="pull-right">
                            <div class="btn-group" role="group">


                                <a class="dropdown-toggle" data-toggle="dropdown" >
                                    <div class="glyphicon glyphicon-user  ">
                                        <strong><?php echo $_SESSION['nome']; ?></strong>
                                    </div>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Logoff</a></li>
                                </ul>                                        
                            </div>
                        </div>
                      </ul>
                  </div><!-- /.container-fluid -->
             </nav>

                <div class="panel-body" style="background-color: #f5f5f5;">

                    <?php
                    include 'ClienteDAO.php';

                    $cli = new cliente();

                    $res = $cli->mostrarTodos($idAdm);
                    if ($res->num_rows > 0) {//verifiaca se possui funcionarios
                        ?>
                        <form action="Controller.php" method="post">

                            <div class="table-responsive col-md-12">
                                <table class="table table-striped" cellspacing="0" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th>Nome Solicitante</th>
                                            <th>Telefone</th>
                                            <th>Localização</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $codigo = $row['id'];
                                            ?> 
                                        <input type="hidden" id="codigo" name="codigo" value="<?php echo $codigo ?>">
                                        <tr>
                                            <td><?php echo $row['nome'] ?></td>
                                            <td><?php echo $row['fone'] ?></td>
                                            <td>
                                               <input type="submit" class="btn btn-primary" name="operacao" value="Ver"> 

                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>

                            </div>

                        </form>
                                      </div>


                        <?php
                    } else {
                        ?>
                        <h1>
                            <div class="alert alert-info">
                                <strong>Info!</strong> Não há Chamadas Disponíveis
                            </div>
                        </h1>
                        <?php
                    }
                    ?>
                    <?php
                } else {
                    ?>
                    <h1>
                        <div class="alert alert-info">
                            <strong>Erro Login!</strong> <a href="login.php">Click aqui</a> para fazer login
                        </div>
                    </h1>

                    <?php
                }
                ?>
              </div>

    </body>
</html>
