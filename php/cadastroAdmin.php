<?php 
session_start();
include_once ("database/conn.php");

if(isset($_POST['cpf'])){
    //Dados da Tabela Professor
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $_SESSION['nome'] = $nome;

    //Dados da Tabela Telefone Professor
    // $ddd = $_POST['DDD'];
    $telefone = $_POST['telefone'];


    //Inserindo dados na Primeira Tabela
    $sql1 = "INSERT INTO tbladmin (nome,email,senha,CPF,telefone) VALUES ('$nome','$email','$senha','$cpf','$telefone')";

    if($conn->query($sql1)==TRUE)
    {
         //echo "Dados inseridos com sucesso na tabela1";
        echo '<script type="text/javascript">';
        echo 'alert("Administrador cadastrado com sucesso!");';
        echo 'window.location.href ="";';
        echo '</script>';
    }
    else
    {
        //  echo "Erro ao inserir dados na tebala1";
        echo '<script type="text/javascript">';
        echo 'alert("Falha ao cadastrar administrador!");';
        echo 'window.location.href ="";';
        echo '</script>';
    }

    //Inserindo dados na segunda tabela
    // $sql2 = "INSERT INTO tbltelprof (DDD,telefone,CPFProfessor) VALUES ('$ddd','$telefone','$cpf')";
    
    // if($conn->query($sql2)==TRUE)
    // {
    //     //echo "Dados inseridos com sucesso na tabela2";
    // }
    // else
    // {
    //     echo "Erro ao inserir dados na tebala2";
    // }

    //Inserindo dados na tabela login 
    $sql3 = "INSERT INTO tblloginadmin (CPFadmin,senhaAdmin) VALUES ('$cpf','$senha')";
    if($conn->query($sql3)==TRUE)
    {
        //echo "Dados inseridos com sucesso na tabela3";
        // echo '<script type="text/javascript">';
        // echo 'alert("Administrador cadastrado com sucesso!");';
        // echo '</script>';
    }
    else
    {
        // echo "<script>alert('Erro ao cadastrar administrador')</script>";
    }
}
else
{
    //echo "Erro ao enviar dados para o banco de dados";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <!--Logo-->
        <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar Administrador</title>
        <link rel="stylesheet" href="css/CSScadAdmin.css">
        <script src="js/jquery.js"></script>
        <script src="js/sweetalert.js" type="module"></script>
    </head>
    <body>
        <div class="container">
            <div class="form-image">
                <img src="img/img.png">
            </div>
            <div class="form">
                <form id="admin" method="POST">
                    <div class="form-header">
                        <div class="tittle">
                            <h1>Cadastre um novo administrador</h1>
                        </div>

                        <div class="returnbutton">
                            <button>
                                <a href="OficialMenuAdmin.php">Retornar</a>
                            </button>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <div class="input-box">
                            <lable for="cpf">CPF</lable>
                            <input id="cpf" type="numeric" name="cpf" placeholder="Digite o CPF" required>
                        </div>

                        <div class="input-box">
                            <lable for="nome">Nome Completo</lable>
                            <input id="nome" type="text" name="nome" placeholder="Digite seu nome" required>
                        </div>

                        <div class="input-box">
                            <lable for="email">E-mail</lable>
                            <input id="email" type="email" name="email" placeholder="Digite o email do aluno" required>
                        </div>

                        <div class="input-box">
                            <lable for="telefone">Telefone</lable>
                            <input id="telefone" type="tel" name="telefone" placeholder="ex: (11) 99999-9999" required>
                        </div>

                        <div class="input-box">
                            <lable for="senha">Crie uma senha</lable>
                            <input id="senha" type="password" name="senha" placeholder="Crie uma senha">
                        </div>
                    </div>

                        <div class="cadastro-button">
                            <input type="submit" value="Cadastrar" name="cadUsuario" href="TelaInicial.php">
                        </div>
                </form>
            </div>
        </div>

        <script>
            var formData = new FormData();

            $(document).ready(function()
            {
                $("#admin").submit(function(e)
                {
                    e.preventDefault();

                    var cpf = $("#cpf").val();
                    var nome = $("#nome").val();
                    var email= $("#email").val();
                    var senha = $("#senha").val();
                    var telefone = $("#telefone").val(); 

                    formData.append("cpf", cpf);
                    formData.append("nome", nome);
                    formData.append("email", email);
                    formData.append("telefone", telefone);
                    formData.append("senha", senha);

                    $.ajax({
                        type:"POST", 
                        url: $(this).attr("action"),
                        data: formData, 
                        contentType: false,
                        processData: false,
                        success: function(response)
                        {
                            swal({
                                title: "Administrador cadastrado com sucesso",
                                icon: "success",
                                button: {confirm: true}, 
                            }).then(value=>{
                                if (value)
                                {
                                    window.location.href = "javascript: history.go(-1)";
                                }
                            });
                        },
                        error: function()
                        {
                            swal({
                                title: "Falha ao cadastrar administrador",
                                icon: "error",
                                button: {confirm: true}, 
                            });
                        }
                    });
                });
            });
        </script>
    </body>
</html>