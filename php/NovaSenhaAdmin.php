<?php
include("database/conn.php");
$id = $_GET['id'];
if(isset($_POST['senha']) || isset($_POST['confirmarSenha']))
{
    if(strlen($_POST['senha']) == 0)
    {
        echo "Preencha o campo senha";
    }
    else if(strlen($_POST['confirmarSenha']) == 0)
    {
        echo "Preencha o campo confirmar senha";
    }
    else{
      $senha = $conn->real_escape_string($_POST['senha']);
      $confsenha = $conn->real_escape_string($_POST['confirmarSenha']);

      $sql = "SELECT * FROM tbladmin WHERE id = $id";
      $result = $conn->query($sql);
    
      if ($_POST['senha'] == $_POST['confirmarSenha']){
        
        $senha = $_POST['senha'];
        $senha = $_POST['confirmarSenha'];
        $sqlUpdate = "UPDATE tbladmin SET senha='$senha' WHERE id = '$id'";

        if($conn->query($sqlUpdate)==TRUE)
        {
          //echo "Dados inseridos com sucesso na tabela";
            echo '<script type="text/javascript">';
            echo 'alert("Senha alterada com sucesso!");';
            echo 'window.location.href ="PerfilAdmin.php?id=$id"';
            echo '</script>';
        }
        else
        {
         echo "<script>alert('Erro ao atualizar senha')</script>";   
        }
      }
      else{
        echo '<script type="text/javascript">';
        echo 'alert("Senhas diferentes!");';
        echo '</script>';
      }
    }
}
?>

<html>

<head>
  <meta charset="utf-8">
  <!--Logo-->
  <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
  <title>Nova Senha</title>
  <link rel="shortcut icon" type="image/x-icon" href="IMG/Logo2.png" />
  <link rel="stylesheet" type="text/css" href="css/AlteraAdmin.css">
</head>

<body>
  <div class="container">

    <div class="form-image">
      <div class="max-width">
        <div class="imageConteiner">
          <img src="img/img.png">
        </div>
      </div>
      <div class="input">
        <input type="file" id="flImage" name="flImage" accept="image/*">
      </div>
    </div>

    <div class="form">
      <form action="" method="post">
        <div class="form-header">
          <div class="tittle">
            <h1>Alterar Senha</h1>
          </div>
          <div class="returnbutton">
            <button>
              <a href="OficialMenuAdmin.php"> Retornar </a>
            </button>
          </div>
        </div>

        <div class="input-group">
          <div class="input-box">
            <lable for="senha">Senha</lable>
            <input id="senha" type="password" name="senha" placeholder="Digite uma nova senha" required>
          </div>

          <div class="input-box">
            <lable for="confirmarSenha">Confirmar Senha</lable>
            <input id="confirmarSenha" type="password" name="confirmarSenha" placeholder="Repita sua nova senha" required>
          </div>
        </div>

        <div class="altera-button">
          <input type="submit" value="Alterar" name="update" id="update">
        </div>
      </form>
    </div>

  </div>
</body>

</html>