<?php 
if (!empty($_GET['id']))
{
    include_once("database/conn.php");

    $id = $_GET['id'];
    //$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT * FROM tblusuario WHERE id = $id";
    $result = $conn->query($sql);

    if($result->num_rows>0)
    {
        while($dados = $result->fetch_array())
        {  
            $nome = $dados['nome'];
            $email = $dados['email'];
            $telefone = $dados['telefone'];
        }
    }
    else
    {
        header('Location: OficialMenuUsuario.php');
    }
}
?>

<html>

<head>
  <meta charset="utf-8">
  <title>Alterar Informações</title>
  <!--Logo-->
  <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
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
      <form action="SaveEditUsuario.php?id=<?php echo $id?>" method="post">
        <div class="form-header">
          <div class="tittle">
            <h1>Alterar informações</h1>
          </div>
          <div class="returnbutton">
            <button>
              <a href="OficialMenuUsuario.php"> Retornar </a>
            </button>
          </div>
        </div>

        <div class="input-group">
          <div class="input-box">
            <lable for="nome">Nome completo</lable>
            <input id="nome" type="text" name="nome" placeholder="Digite o nome" value="<?php echo $nome ?>">
          </div>

          <div class="input-box">
            <lable for="email">E-mail</lable>
            <input id="email" type="email" name="email" placeholder="Digite o email" value="<?php echo $email ?>">
          </div>

          <div class="input-box">
            <lable for="telefone">Telefone</lable>
            <input id="telefone" type="tel" name="telefone" placeholder="Digite o telefone"
              value="<?php echo $telefone ?>">
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