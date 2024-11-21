<?php 
include_once ("database/conn.php");

if(isset($_POST['cpf']))
{
    $CPF = $_POST['cpf'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    // $ddd = $_POST['DDD'];
    $telefone = $_POST['telefone'];
    $usuario = $_POST['usuario'];

    //Inserindo dados na Primeira Tabela
    $sql1 = "INSERT INTO tblusuario (nome,email,senha,CPF,telefone,usuario)
    VALUES ('$nome','$email','$senha','$CPF','$telefone','$usuario')";

    if($conn->query($sql1)==TRUE)
    {
        //echo "Dados inseridos com sucesso na tabela2";
        echo '<script type="text/javascript">';
        echo 'alert("Usuário cadastrado com sucesso!");';
        echo 'window.location.href ="OficialMenuAdmin.php";';
        echo '</script>';
    }
    else
    {
        //echo "Erro ao inserir dados na tebala2";
        echo '<script type="text/javascript">';
        echo 'alert("Falha ao cadastrar usuário!");';
        echo 'window.location.href ="";';
        echo '</script>';
    }


    //Inserindo dados na tabela login 
    $sql3 = "INSERT INTO tblloginusuario (CPFusuario,senhaUsuario) VALUES ('$CPF','$senha')";
    if($conn->query($sql3)==TRUE)
    {
        // echo "Dados inseridos com sucesso na tabela3";
    }
    else
    {
        //echo "Erro ao inserir dados na tebala3";
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
        <title>Cadastrar Usuário</title>
        <link rel="stylesheet" href="css/CSScadUsuario.css">
        <script src="js/jquery.js"></script>
        <script src="js/sweetalert.js" type="module"></script>
        </head>
    <body>
        <div class="container">
            <div class="form-image">
                <img src="img/img.png">
            </div>
            <div class="form">
                <form id="usuario" method="POST">
                    <div class="form-header">
                        <div class="tittle">
                            <h1>Cadastre um usuário</h1>
                        </div>

                        <div class="returnbutton">
                            <button>
                                <a href="OficialMenuAdmin.php"> Retornar </a>
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
                            <input id="nome" type="text" name="nome" placeholder="Digite o nome" required>
                        </div>

                        <div class="input-box">
                            <lable for="email">E-mail</lable>
                            <input id="email" type="email" name="email" placeholder="Digite o email" required>
                        </div>

                        <div class="input-box">
                            <lable for="telefone">Telefone</lable>
                            <input id="telefone" type="tel" name="telefone" placeholder="ex: (11) 99999-9999" required>
                        </div>

                        <div class="input-box">
                            <lable for="senha">Crie uma senha</lable>
                            <input id="senha" type="password" name="senha" placeholder="Crie uma senha">
                        </div>

                        <div class="input-box">
                            <lable for="usuario">Tipo de Usuário</lable>
                            <select id="TipoUsuario" name="usuario">
                                <option value="Professor(a)">Professor(a)</option>
                                <option value="Aluno(a)">Aluno(a)</option>
                            </select>
                            <!-- <input id="usuario" type="text" name="usuario" placeholder="ex: Professor(a) ou Aluno(a)"> -->
                        </div>
                    </div>

                    <div class="cadastro-button">
                        <input type="submit" value="Cadastrar" name="cadUsuario"></input>
                    </div>
                  </form>
            </div>
        </div>
        <script>
            var formData = new FormData();

            $(document).ready(function()
            {
                $("#usuario").submit(function(e)
                {
                    e.preventDefault();

                    var CPF = $("#cpf").val();
                    var nome = $("#nome").val();
                    var email= $("#email").val();
                    var senha = $("#senha").val();
                    var telefone = $("#telefone").val();
                    var usuario = $("#TipoUsuario").val(); 

                    formData.append("cpf", CPF);
                    formData.append("nome", nome);
                    formData.append("email", email);
                    formData.append("telefone", telefone);
                    formData.append("senha", senha);
                    formData.append("usuario", usuario);

                    $.ajax({
                        type:"POST", 
                        url: $(this).attr("action"),
                        data: formData, 
                        contentType: false,
                        processData: false,
                        success: function(response)
                        {
                            swal({
                                title: "Usuário cadastrado com sucesso",
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
                                title: "Falha ao cadastrar usuário",
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