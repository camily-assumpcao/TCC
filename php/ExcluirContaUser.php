<?php
    include_once("database/conn.php");
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $del = "DELETE FROM tblusuario WHERE id = $id";
        
        if($conn->query($del)==TRUE)
        {
            echo '<script type="text/javascript">';
            echo 'alert("Conta excluida com Sucesso!");';
            echo 'window.location.href ="TelaInicial.php"';
            echo '</script>';
        }
        else {
            echo '<script type="text/javascript">';
            echo 'alert("Falha ao excluir conta!");';
            echo 'window.location.href ="Perfil.php?id=$id"';
            echo '</script>';
        }   
    }
?>