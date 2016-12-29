<?php
 include "db.php";

switch ($request['acao']) {

	case "LoginWeb":
		$usuario = addslashes($_POST['usuario']);
		$senha = addslashes($_POST['senha']);

		$erro = "";
		$erro .= empty($usuario) ? "Informe o seu usuario \n" : "";
		$erro .= empty($senha) ? "Informe a sua senha \n" : "";

		$arr = array();

		if(empty($erro)){
			$query = "select * from LoginCliente where nome = '{$usuario}' and senha = '{$senha}'";
			$result = $Mysqli->query($query);

			if($result->num_rows > 0){
				//usuario logado
				$obj = $result->fetch_object();

				$arr['result'] = true;
				$arr['dados']['nome'] = $obj->nome;
				$arr['dados']['id'] = $obj->id;
			}else{
				$arr['result'] = false;
				$arr['msg'] = "Usuário ou senha incorreto";
			}
		}else{
			$arr['result'] = false;
			$arr['msg'] = $erro;
		}

		echo json_encode($arr);
	break;
	case "BuscaId":
		$usuario = addslashes($_POST['usuario']);

		$erro = "";
		$erro .= empty($usuario) ? "Informe o seu usuario \n" : "";

		$arr = array();

		if(empty($erro)){
			$query = "select id from LoginCliente where nome = '{$usuario}';";
			$result = $Mysqli->query($query);

			if($result->num_rows > 0){
				//usuario logado
				$obj = $result->fetch_object();

				$arr['result'] = true;
				$arr['dados']['id'] = $obj->id;
			}else{
				$arr['result'] = false;
				$arr['msg'] = "Usuário incorreto";
			}
		}else{
			$arr['result'] = false;
			$arr['msg'] = $erro;
		}

		echo json_encode($arr);
	break;
}
