<?php
    include_once("database/conn.php");

    if(isset($_POST['update']))
    {
        $id = $_GET['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        $sqlUpdate = "UPDATE tblusuario SET nome='$nome',email='$email',telefone='$telefone' WHERE id = '$id'";

        $result = $conn->query($sqlUpdate);
        
        if($conn->query($result)==TRUE)
        {
            echo "<script>alert('Erro ao cadastrar administrador')</script>";
        }
        else
        {
            //echo "Dados inseridos com sucesso na tabela3";
            echo '<script type="text/javascript">';
            echo 'alert("Administrador cadastrado com sucesso!");';
            echo 'window.location.href ="OficialMenuUsuario.php";';
            echo '</script>';
        }
    }
    else
    {
        die("Erro ao alterar os dados");
    }
?>