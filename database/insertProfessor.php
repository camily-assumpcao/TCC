<?php 
include_once "conn.php";

//Dados da Tabela Professor
$cpf = $_POST['cpf'];
$nome = $_POST['professor'];
$email = $_POST['email'];
$senha = $_POST['senha'];

//Dados da Tabela Telefone Professor
$ddd = $_POST['DDD'];
$telefone = $_POST['telefone'];

//Inserindo dados na Primeira Tabela
$sql1 = "INSERT INTO tblprof (nome,email,senha,CPF)
         VALUES ('$nome','$email','$senha','$cpf')";

if($conn->query($sql1)==TRUE)
{
    echo "Dados inseridos com sucesso na tabela1";
}
else
{
    echo "Erro ao inserir dados na tebala1";
}

//Inserindo dados na segunda tabela
$sql2 = "INSERT INTO tbltelprof (DDD,telefone,CPFProfessor)
        VALUES ('$ddd','$telefone','$cpf')";
if($conn->query($sql2)==TRUE)
{
    echo "Dados inseridos com sucesso na tabela2";
}
else
{
   echo "Erro ao inserir dados na tebala2";
}
?>