<?php

//include './ConexaoBD.php';

class administrador {

    public $nome;
    public $senha;
    public $id;

    function inserir($idChamado) {
        $bd = new ConexaoBD();
        $sql = "UPDATE `Chamado` SET `idMec`='$this->id',`Atendimento`= 1 WHERE id='$idChamado'";
        $bd->conectar();
        $bd->query($sql);
        $bd->fechar();
    }

    function buscaUser($nomeAdm, $senhaAdm) {

        $bd = new ConexaoBD();
        $bd->conectar();
        $sql = "SELECT * FROM LoginMecanico WHERE nome='{$nomeAdm}' AND senha='{$senhaAdm}';";
        return $bd->query($sql);
        $bd->fechar();
    }

}

?>
