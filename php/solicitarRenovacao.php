<?php 
  include_once ("database/conn.php");

  $codEmprestimo = $_GET['idEmprestimoSolicitacao'];

  $slqSelect = "SELECT * FROM tblemprestimo WHERE codEmprestimo = '$codEmprestimo'";
  $resultSelect = $conn->query($slqSelect);
  if($resultSelect->num_rows > 0)
  {
    while($detalhesSelect = $resultSelect->fetch_array())
    {  
      $CPFUsuario = $detalhesSelect['CPFusuario'];
      $ISBNLivro = $detalhesSelect['ISBNLivro'];
    }
  }
  
  $slqSelect2 = "SELECT * FROM tblusuario WHERE CPF = '$CPFUsuario'";
  $resultSelect2 = $conn->query($slqSelect2);
  if($resultSelect2->num_rows > 0)
  {
    while($detalhesSelect2 = $resultSelect2->fetch_array())
    {  
        $nomeUsuario = $detalhesSelect2['nome'];
        $idUsuario = $detalhesSelect2['id'];
    }
  }

  $sqlInsert = "INSERT INTO tblsolicitacao (CPFUsuario,nomeUsuario,ISBNLivro,idEmprestimo,situacaoSolicitacao) 
                VALUES ('$CPFUsuario','$nomeUsuario','$ISBNLivro','$codEmprestimo','Em andamento')";
  if($conn->query($sqlInsert))
  {
      echo '<script type="text/javascript">';
      echo 'alert("Solicitação realizada com sucesso! Aguarde e visualize seu empréstimo...");';
      echo 'window.location.href ="OficialMenuUsuario.php";';
      echo '</script>';        
  }
  else
  {
      echo '<script type="text/javascript">';
      echo 'alert("Falha ao solictar renovação!");';
      echo 'window.location.href ="OficialMenuUsuario.php";';
      echo '</script>';
  }

    /*echo $codEmprestimo . "<p>";
    echo $CPFUsuario . "<p>";
    echo $ISBNLivro . "<p>";
    echo $nomeUsuario;*/
?>