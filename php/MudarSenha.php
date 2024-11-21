<?php
include("database/conn.php");

if(isset($_POST['senha']))
{
  $id = $_GET['id'];

    if(strlen($_POST['senha']) == 0)
    {
        echo "Preencha o campo senha";
    }
    else
    {
        $senha = $conn->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM tblusuario WHERE senha = '$senha'";
        $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

        $quantidade = $sql_query->num_rows;
        
        if($quantidade == 1)
        {
            $usuario = $sql_query->fetch_assoc();

            /*if(!isset($_SESSION))
            {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];*/

            header("Location: NovaSenhaUser.php?id=$id");
        }
        else
        {
            echo "<script>alert('Senha incorreta!')</script>";
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
  <link rel="stylesheet" href="css/esqueceuSenha.css">
</head>

<body>
  <div class="container">
    <div class="form-image">
      <img src="img/img.png">
    </div>
    <div class="form">
      <form action="" method="post">
        <div class="form-header">
          <div class="tittle">
            <h1>Modificação de senha</h1>
          </div>

          <div class="returnbutton">
            <button>
              <a href="Perfil.php?id=<?php echo $_SESSION['id'];?>"> Retornar </a>
            </button>
          </div>
        </div>

        <div class="input-group">
          <div class="input-box">
            <?php
              $usuario = "";
              if (isset($dados['senha'])) {
                $usuario = $dados['senha'];
              } ?>
            <lable for="senha">Digite senha atual:</lable>
            <input id="senha" type="password" name="senha" placeholder="Digite sua senha" required>
          </div>
        </div>

        <a href="esqueceuSenhaUser.php">Esqueci minha senha</a>
        <div class="entrar-button">

          <div class="enviar-button">
            <input type="submit" value="Próximo" name="Next">
      </form>
    </div>
  </div>
</body>

</html>