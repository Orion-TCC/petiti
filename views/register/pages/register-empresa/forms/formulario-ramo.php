<?php
require_once("/xampp/htdocs/projeto-petiti/classes/TipoUsuario.php");
$tipoUsuario = new TipoUsuario();
$listaTipos = $tipoUsuario->listar();

?>
<form action="controllers/controller-ramo-empresa.php" method="post">
    <select name="slRamo" id="slRamo">
        <option value="0">Selecione</option>
        <?php
        foreach ($listaTipos as $linha) { ?>
            <option value="<?php echo $linha['idTipoUsuario'] ?>"><?php echo $linha['tipoUsuario'] ?></option>
        <?php   }
        ?>
    </select>
</form>