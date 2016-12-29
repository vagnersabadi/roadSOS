<?php

include "db.php";

switch ($request['acao']) {

	case "Cadastro":
		$usuario = addslashes($_POST['nome']);
		$senha = addslashes($_POST['senha']);
		$fone = addslashes($_POST['fone']);

		$erro = "";
		$erro .= empty($usuario) ? "Informe o seu usuario \n" : "";
		$erro .= empty($senha) ? "Informe a sua senha \n" : "";
		$erro .= empty($fone) ? "Informe a seu telefone \n" : "";

		$arr = array();

		if(empty($erro)){
			$query = "SELECT * FROM LoginCliente WHERE  nome='{$usuario}' AND senha='{$senha}'";
			$result = $Mysqli->query($query);
			if ($result->num_rows>0) {
				$arr['result'] = false;
			}else{
				$query = "INSERT INTO LoginCliente (`nome`, `senha`, `fone`) VALUES ('$usuario','$senha',$fone);";
				$result = $Mysqli->query($query);
				$arr['result'] = true;
			}
		}else{
			$arr['result'] = er;
			$arr['msg'] = $erro;
		}

		echo json_encode($arr);
	break;
	case "CadastroChamado":
	
		$longitude = addslashes($_POST['longitude']);
		$latitude = addslashes($_POST['latitude']);
		$idCliente = addslashes($_POST['idCliente']);

		$erro = "";
		$erro .= empty($longitude) ? "Informe longitude \n" : "";
		$erro .= empty($latitude) ? "Informe latitude \n" : "";
		$erro .= empty($idCliente) ? "Informe idCliente \n" : "";


		$arr = array();

		if(empty($erro)){
			$query = "SELECT id FROM Chamado WHERE  idUser='{$idCliente}'";
			$result = $Mysqli->query($query);

			if($result->num_rows>0){
				
				$arr['result'] = false;

 				$query ="UPDATE`Chamado` SET `latitude`='{$latitude}',`longitude`='{$longitude}' WHERE `idUser`={$idCliente};";
				 $result = $Mysqli->query($query);
				 $arr['msg'] = "Usuário atualizado";

			}else{
				$query ="INSERT INTO `Chamado`(`latitude`, `longitude`, `idUser`,Atendimento) VALUES ($longitude,$latitude,$idCliente,0);";
	   			$result = $Mysqli->query($query);
				$arr['msg'] = "Usuário Inserido";
								$arr['result'] = true;

			}
		}else{
			//$arr['result'] = false;
			$arr['msg'] = $erro;
		}
		echo json_encode($arr);
		
	break;
	/*
	case "Cadastro":
		$usuario = addslashes($_POST['nome']);
		$senha = addslashes($_POST['senha']);
		$fone = addslashes($_POST['fone']);

		$erro = "";
		$erro .= empty($usuario) ? "Informe o seu usuario \n" : "";
		$erro .= empty($senha) ? "Informe a sua senha \n" : "";
		$erro .= empty($fone) ? "Informe a seu telefone \n" : "";

		$arr = array();

		if(empty($erro)){
			$query = "INSERT INTO LoginCliente (`nome`, `senha`, `fone`) VALUES ('$usuario','$senha',$fone);";

			$result = $Mysqli->query($query);
			if ($result>0) {

				$arr['result'] = true;
			}else{
				$arr['result'] = false;
				$arr['msg'] = "Usuario ou senha incorreto";
			}
		}else{
			$arr['result'] = false;
			$arr['msg'] = $erro;
		}

		echo json_encode($arr);
	break; */



}
?>

