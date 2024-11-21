<?php
    include("database/conn.php");

    //Código do empréstimo para realizar a consulta de maneira precisa
    $emprestimo = $_GET['codEmprestimo'];

    //Consulta para pegar a situação da solicitação de renovação
    $sqlSelect1 = "SELECT * FROM tblsolicitacao WHERE idEmprestimo = '$emprestimo'";
    $result1 = $conn->query($sqlSelect1);

    if($result1->num_rows > 0)
    {
        while($solicitacao = $result1->fetch_array())
        {  
            $situacao = $solicitacao['situacaoSolicitacao'];
        }
    }
  
    //laço de repetição, caso a situação da solicitação esteja 'Recusada' exibe uma msg notificando, caso ao contrário realiza o renovamento do empréstimo solicitado
    if ($situacao === 'Recusada')
    {
        echo '<script type="text/javascript">';
        echo 'alert("Solicitação não excluída! A solicitação já foi recusada anteriormente...");';
        echo 'window.location.href ="notificacoesAdmin.php";';
        echo '</script>';
    }
      else{
          $sqlSolicitacao = "UPDATE tblsolicitacao SET situacaoSolicitacao = 'Recusada' WHERE idEmprestimo = '$emprestimo'";
          if($conn->query($sqlSolicitacao)==TRUE)
          {
              //echo "Dados inseridos com sucesso na tabela";
              echo '<script type="text/javascript">';
              echo 'alert("Empréstimo recusado com sucesso!");';
              echo 'window.location.href ="notificacoesAdmin.php";';
              echo '</script>';                            
          }
          else
          {
              //echo "Erro ao inserir dados na tabela";
          }
      }
?>
