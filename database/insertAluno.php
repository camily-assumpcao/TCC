<?php 
include_once "conn.php";

$RM = $_POST['RM'];
$aluno = $_POST['aluno'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$ddd = $_POST['DDD'];
$telefone = $_POST['telefone'];
$turma = $_POST['turma'];
$periodo = $_POST['periodo'];

//Inserindo dados na Primeira Tabela
$sql1 = "INSERT INTO tblaluno (nome,email,senha,turma,RM,periodo)
         VALUES ('$aluno','$email','$senha','$turma','$RM','$periodo')";

if($conn->query($sql1)==TRUE)
{
    echo "Dados inseridos com sucesso na tabela1";
}
else
{
    echo "Erro ao inserir dados na tebala1";
}

//Inserindo dados na segunda tabela
$sql2 = "INSERT INTO tbltelaluno (DDD,telefone,RMAluno)
        VALUES ('$ddd','$telefone','$RM')";
if($conn->query($sql2)==TRUE)
{
    echo "Dados inseridos com sucesso na tabela2";
}
else
{
   echo "Erro ao inserir dados na tebala2";
}
?>