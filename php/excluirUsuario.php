<?php

include_once("database/conn.php");
  
  //Recebendo o id por meio da URL
  $id_url = $_GET['id'];

  //Consulta que exclui o usuario de acordo com o id recebido pela URL
  $sqlDeletar = "DELETE FROM tblusuario WHERE id = $id_url";

  if($conn->query($sqlDeletar) == true)
  {
    echo '<script type="text/javascript">';
    echo 'alert("Usuário excluido com sucesso!");';
    echo 'window.location.href ="registroUsuario.php";';
    echo '</script>';        
  }
  else
  {
    echo '<script type="text/javascript">';
    echo 'alert("Falha ao excluir usuário!");';
    echo 'window.location.href ="registroUsuario.php";';
    echo '</script>';
  }
?>