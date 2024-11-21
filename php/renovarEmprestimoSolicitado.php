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
    
    //Consulta para pegar a dataDevolucao e quantidade de renovacao do livro emprestado
    $sqlSelect2 = "SELECT * FROM tblemprestimo WHERE codEmprestimo = '$emprestimo'";
    $result2 = $conn->query($sqlSelect2);

    if($result2->num_rows > 0)
    {
        while($dados = $result2->fetch_array())
        {  
            $dataDevolucao = $dados['dataDevolucao'];
            $qtdRenovacao = $dados['quantidadeRenovacao'];
        }
    }

    //laço de repetição, caso a situação da solicitação esteja 'Renovado' exibe uma msg notificando, caso ao contrário realiza o renovamento do empréstimo solicitado
    if ($situacao === 'Renovado')
    {
        echo '<script type="text/javascript">';
        echo 'alert("Emprestimo não renovado! A solicitação já foi atendida anteriormente...");';
        echo 'window.location.href ="notificacoesAdmin.php";';
        echo '</script>';
    }
    else
    {
      //Nova data de empréstimo (+7 dias após a data de devolução)
      $novaData = date('d-m-Y', strtotime($dataDevolucao . ' +7 days'));
      //echo $novaData . "<p>";
      //echo $qtdRenovacao;

      if($qtdRenovacao >= 2){
          echo '<script type="text/javascript">';
          echo 'alert("Não foi possível renovar o agendamento! A quantidade máxima de renovação foi atingida (2/2)");';
          echo 'window.location.href ="notificacoesAdmin.php";';
          echo '</script>';
      }
      else{
          //Consulta para renovar a data e acrescentar +1 na quantidadeRenovacao do empréstimo
          $sqlRenovacao = "UPDATE tblemprestimo SET dataDevolucao = '$novaData' ,quantidadeRenovacao =  $qtdRenovacao + 1  WHERE codEmprestimo = '$emprestimo' ";
          $conn->query($sqlRenovacao);

          $sqlSolicitacao = "UPDATE tblsolicitacao SET situacaoSolicitacao = 'Renovado' WHERE idEmprestimo = '$emprestimo' ";
          if($conn->query($sqlSolicitacao)==TRUE)
          {
              //echo "Dados inseridos com sucesso na tabela";
              echo '<script type="text/javascript">';
              echo 'alert("Empréstimo renovado com sucesso!");';
              echo 'window.location.href ="notificacoesAdmin.php";';
              echo '</script>';
          }
          else
          {
              //echo "Erro ao inserir dados na tabela";
          }
      }
    }
?>
