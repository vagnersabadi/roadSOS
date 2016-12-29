<?php
   include './ConexaoBD.php';
    class cliente {        
   
        function mostrarTodos() {
            $bd = new ConexaoBD();
            $bd->conectar();
            $sql = "SELECT LoginCliente.nome,LoginCliente.fone,Chamado.id FROM "
                    . "LoginCliente, Chamado WHERE LoginCliente.id = Chamado.idUser "
                    . "AND Chamado.Atendimento=0;";
            return $bd->query($sql);
            $bd->fechar();
        }
        
        function buscaCoodenadas($id) {
            $bd = new ConexaoBD();
            $bd->conectar();
            $sql = "SELECT * FROM Chamado WHERE id='$id'";
            return $bd->query($sql);
            $bd->fechar();
        }
        function busca($id) {
            $bd = new ConexaoBD();
            $bd->conectar();
            $sql = "SELECT LoginCliente.nome,LoginCliente.fone,Chamado.id FROM "
                    . "Chamado, LoginCliente WHERE Chamado.idMec='$id' AND "
                    . "LoginCliente.id = Chamado.idUser";
            return $bd->query($sql);
            $bd->fechar();
        }
        
        function excluir($id) {
            $bd = new ConexaoBD();
            $sql = "DELETE FROM Chamado WHERE id='$id';";
            $bd->conectar();
            $bd->query($sql);
            $bd->fechar();
        }
       
      
}

?>
