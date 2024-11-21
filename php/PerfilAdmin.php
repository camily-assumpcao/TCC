<?php 
if (!empty($_GET['id']))
{
    include_once("database/conn.php");

    $id = $_GET['id'];

    $sql = "SELECT * FROM tbladmin WHERE id = '$id'";
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
        header('Location: OficialMenuAdmin.php');
    }
}
?>

<html>

<head>
  <meta charset="utf-8">
  <title>Perfil</title>
  <!--Logo-->
  <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
  <link rel="shortcut icon" type="image/x-icon" href="IMG/Logo2.png" />
  <link rel="stylesheet" type="text/css" href="css/Perfil.css">
  <!-- CSS dos icones do perfil -->
  <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="js/sweetalert.js" type="module"></script>
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
    <!-- ARRUMAR CSS -->
    <div class="form">
        <div class="form-header">
          <div class="tittle">
            <h1>Perfil</h1>
          </div>
          <div class="returnbutton">
            <button>
              <a href="OficialMenuAdmin.php"> Retornar </a>
            </button>
          </div>
        </div>

        <div class="input-group">
          <div class="input-box">
            <lable for="nome"><strong>Nome:</strong></lable>
            <lable for="nomebd"><?php echo $nome?></lable>
          </div>

          <div class="input-box">
            <lable for="email"><strong>E-mail:</strong></lable>
            <lable for="emailbd"><?php echo $email ?></lable>
          </div>

          <div class="input-box">
            <lable for="telefone"><strong>Telefone:</strong></lable>
            <lable for="telefonebd"><?php echo $telefone ?></lable>
          </div>

          <div class="input-box">
            <lable for="usuario"><strong>Senha:</strong></lable>
            <lable for="usuariobd">********</lable>
            <a href="MudarSenhaAdmin.php?id=<?php echo $id?>">
              <i class="bx bx-pencil"></i>
            </a>
          </div>
          <div class="exclui-button">
            <a onclick="Delete()">
              <button>Excluir Conta<i class="bx bx-trash"></i></button>
            </a>
          </div>
        </div>
        <div class="altera-button">
          <a href="AlterarInfo_Admin.php?id=<?php echo $id?>">
            <input type="submit" value="Alterar Informações" name="Alterar" id="Alterar">
          </a>
        </div>
        </div>
          <script>
          function Delete() {
            swal
              ({
                title: "Deseja deletar conta?",
                icon: "warning",
                buttons: ["Cancel", true],
              }).then(value => {
                if (value) {
                  window.location.assign("ExcluirContaAdmin.php?id=<?=$id ?>");
                }
              })
            return false;
          }
          </script>
        </div>
      </form>
    </div>

  </div>
</body>

</html>