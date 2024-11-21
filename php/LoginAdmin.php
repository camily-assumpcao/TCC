<?php
include("database/conn.php");

if(isset($_POST['cpf']) || isset($_POST['senha']))
{
    if(strlen($_POST['cpf']) == 0)
    {
        echo "Preencha o campo CPF";
    }
    else if(strlen($_POST['senha']) == 0)
    {
        echo "Preencha o campo senha";
    }
    else
    {
        $cpf = $conn->real_escape_string($_POST['cpf']);
        $senha = $conn->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM tbladmin WHERE CPF = '$cpf' AND senha = '$senha'";
        $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

        $quantidade = $sql_query->num_rows;
        
        if($quantidade == 1)
        {
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION))
            {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];

            header("Location: OficialMenuAdmin.php");
            
        }
        else
        {
            echo "<script>alert('Falha ao logar! CPF ou senha incorretos.')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SearchBook</title>
  <!--Logo-->
  <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
  <link rel="stylesheet" href="css/LoginAdmin.css">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.min.css" rel="stylesheet">
  <style>
  body {
    font-family: 'Roboto', sans-serif;
  }
  </style>
</head>

<body>
  <div class="container">
    <div class="form-image">
      <img src="img/img.png">
    </div>
    <div class="form">
      <form action="" method="POST">
        <div class="form-header">
          <div class="tittle">
            <h1>Login</h1>
          </div>

          <div class="returnbutton">
            <button>
              <a href="TelaInicial.php">Retornar</a>
            </button>
          </div>
        </div>

        <div class="input-group">
          <div class="input-box">
            <lable for="cpf"> CPF: </lable>
            <input id="cpf" type="numeric" name="cpf" placeholder="Digite seu CPF" required>
          </div>

          <div class="input-box">
            <lable for="senha"> Senha: </lable>
            <input id="senha" type="password" name="senha" placeholder="Digite sua senha" required>
          </div>
        </div>

        <a href="esqueceuSenhaAdmin.php">Esqueci minha senha</a>

        <div class="entrar-button">
          <input type="submit" value="Entrar" name="login">
      </form>
    </div>
  </div>
</body>

<!-- <script>
        const btnEntrarLoginprof = document.querySelector('#btn-entrar-loginprof');
        btnEntrarLoginprof.addEventListener('click', function()
        {
            Swal.fire(
            'Falha ao logar!',
            'CPF ou senha incorretos.',
            'error'
            )
        });
    </script> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.31/dist/sweetalert2.all.min.js"></script>
<!-- <script>
        function alert()
        {
            Swal.fire(
            'Falha ao logar!',
            'CPF ou senha incorretos.',
            'error'
            )
        }
    </script> -->

</html>