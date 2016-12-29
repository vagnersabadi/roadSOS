
<?php
include './ClienteDAO.php';
include './AdministradorDAO.php';

$operacao = $_POST["operacao"];

$cliente = new cliente();
$adm = new administrador();

$arr = array();
switch ($operacao) {
    case "Ver":
        session_start();
        $_SESSION['idA'];
        $id = $_POST["codigo"];
        $_SESSION['idChamado'] = $id;
        $res = $cliente->buscaCoodenadas($id);

        while ($row = mysqli_fetch_assoc($res)) {
            $lat = $row['latitude'];
            $long = $row['longitude'];
        }
        echo "<meta http-equiv='refresh'content='0;url=mapa.php?numero=1&$lat&$long'>";

        break;

    default:
        break;

    case "logar":
        $senhaA = $_POST["senhaA"];
        $nomeA = $_POST["nomeA"];
        $nomeBanco = null;
        $senhaBanco = null;
        $idBanco = null;

        $resutado = $adm->buscaUser($nomeA, $senhaA);

        while ($linha = mysqli_fetch_assoc($resutado)) {
            $nomeBanco = $linha['nome'];
            $senhaBanco = $linha['senha'];
            $idBanco = $linha['idMec'];
        }
        if ($nomeA == $nomeBanco) {
            if ($senhaA == $senhaBanco) {
                session_start();
                $_SESSION['nome'] = $nomeBanco;
                $_SESSION['senha'] = $senhaBanco;
                $_SESSION['idA'] = $idBanco;
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=index.php'>";
            } else {
                ?>
                <h1>
                    <div class="alert alert-info">
                        <strong>Senha Errada!</strong> 
                        <a href="login.php">Clique aqui</a> para fazer login
                    </div>
                </h1>"
                <?php
            }
        } else {
            ?>
            <h1>
                <div class="alert alert-info">
                    <strong>Nome Errado!</strong> 
                    <a href="login.php">Clique aqui</a> para fazer login
                </div>
            </h1>
            <?php
        }

        break;

    case "Voltar":
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=index.php'>";
        break;

    case "Atende Chamado":
        session_start();
        $id = $_SESSION['idA'];
        $idChamado = $_SESSION['idChamado'];
        $adm->id = $id;

        $adm->inserir($idChamado);
        echo 'Inserido com sucess';
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=index.php'>";
        break;
    
    case "Sim":
        $codigo = $_POST["codigo"];
        $cliente->excluir($codigo);
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='0;URL=andamento.php'>";
        break;
}
?>
 
