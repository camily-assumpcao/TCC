<?php
    include("database/conn.php");

    //Código do empréstimo recebido por meio da URL
    $emprestimo = $_GET['idEmprestimo'];
    
    //Consulta que seleciona o ISBN do livro agendado
    $sqlSelect = "SELECT * FROM tblemprestimo WHERE codEmprestimo = '$emprestimo'";
    $result = $conn->query($sqlSelect);
    if($result->num_rows > 0)
    {
        while($dados = $result->fetch_array())
        {  
            $ISBNLivroEmprestado = $dados['ISBNLivro'];
        }
    }

    //Consulta que acrescenta +1 na quantidade do livro
    $sqlUpdateLivro = "UPDATE tbllivro SET quantidade = quantidade + 1 WHERE ISBN = '$ISBNLivroEmprestado'";
    $conn->query($sqlUpdateLivro);

    //Consulta que realiza a mudança da situação do empréstimo
    $sqlUpdateEmprestimo = "UPDATE tblemprestimo SET situacaoEmprestimo = 'Livro Entregue' WHERE codEmprestimo = '$emprestimo'";
    if($conn->query($sqlUpdateEmprestimo)==TRUE)
    {
        //echo "Dados inseridos com sucesso na tabela";
        echo '<script type="text/javascript">';
        echo 'alert("Empréstimo finalizado com sucesso!");';
        echo 'window.location.href ="javascript: history.go(-1)";';
        echo '</script>';
    }
    else
    {
        echo "Erro ao inserir dados na tabela";
    }
?>