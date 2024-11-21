<?php 
  include_once("database/conn.php");
  
  //Recebendo o código isbn por meio da URL
  $isbn_url = filter_input(INPUT_GET, "ISBNDeletar", FILTER_SANITIZE_NUMBER_INT);

  //Consulta que exclui o livro de acordo com o isbn recebido pela URL
  $sqlDeletar = "DELETE FROM tbllivro WHERE ISBN = $isbn_url";

  if($conn->query($sqlDeletar))
  {
    echo '<script type="text/javascript">';
    echo 'alert("Livro excluido com sucesso!");';
    echo 'window.location.href ="acervo.php";';
    echo '</script>';        
  }
  else
  {
    echo '<script type="text/javascript">';
    echo 'alert("Falha ao excluir livro!");';
    echo 'window.location.href ="javascript: history.go(-1)";';
    echo '</script>';
  }
?>