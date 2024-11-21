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
        $CPF = $conn->real_escape_string($_POST['cpf']);
        $senha = $conn->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM tblusuario WHERE  CPF = '$CPF' AND senha = '$senha'";
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

            header("Location: OficialMenuUsuario.php");
        }
        else
        {
            echo "<script>alert('Falha ao logar! CPF ou senha incorretos')</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <!--Logo-->
  <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SearchBook</title>
  <link rel="stylesheet" href="css/LoginUsuario.css">
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
        <font size="3px" color="red">Obs:</font>
        <font size="3px">Caso não esteja cadastrado, vá a sala de estudos! </font>
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
        <a href="esqueceuSenhaUser.php">Esqueci minha senha</a>
        <div class="entrar-button">
          <input type="submit" value="Entrar" name="login">
      </form>
    </div>
  </div>
</body>

</html>