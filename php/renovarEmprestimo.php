<?php
    include("database/conn.php");

    //Código do empréstimo para realizar a consulta de maneira precisa
    $emprestimo = $_GET['idEmprestimo'];
    
    //Consulta para pegar a dataDevolucao e quantidade de renovacao do livro emprestado
    $sqlSelect = "SELECT * FROM tblemprestimo WHERE codEmprestimo = '$emprestimo'";
    $result = $conn->query($sqlSelect);

    if($result->num_rows > 0)
    {
        while($dados = $result->fetch_array())
        {  
            $dataDevolucao = $dados['dataDevolucao'];
            $qtdRenovacao = $dados['quantidadeRenovacao'];
        }
    }
    
    //Nova data de empréstimo (+7 dias após a data de devolução)
    $novaData = date('d-m-Y', strtotime($dataDevolucao . ' +7 days'));
    //echo $novaData . "<p>";
    //echo $qtdRenovacao;

    if($qtdRenovacao >= 2){
        echo '<script type="text/javascript">';
        echo 'alert("Não foi possível renovar o agendamento! A quantidade máxima de renovação foi atingida (2/2)");';
        echo 'window.location.href ="emprestimosPendentes.php";';
        echo '</script>';
    }
    else{
        //Consulta para renovar a data e acrescentar +1 na quantidadeRenovacao do empréstimo
        $sqlRenovacao = "UPDATE tblemprestimo SET dataDevolucao = '$novaData' ,quantidadeRenovacao =  $qtdRenovacao + 1  WHERE codEmprestimo = '$emprestimo' ";

        if($conn->query($sqlRenovacao)==TRUE)
        {
            //echo "Dados inseridos com sucesso na tabela";
            echo '<script type="text/javascript">';
            echo 'alert("Empréstimo renovado com sucesso!");';
            echo 'window.location.href ="emprestimosPendentes.php";';
            echo '</script>';
        }
        else
        {
            //echo "Erro ao inserir dados na tabela";
        }
    }
?>
