<?php
 include "db.php";
 if(isset($_POST['insert']))
 {
 $nome=$_POST['nome'];
 $senha=$_POST['senha'];
 $fone=$_POST['fone'];
 $q=mysqli_query($con,"INSERT INTO LoginCliente (nome, senha, fone) VALUES ('{$nome},'{$senha}','{$fone}');");
 if($q)
  echo "success";
 else
  echo "error";
 }
 ?>
