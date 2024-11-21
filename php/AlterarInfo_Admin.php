<?php 
if (!empty($_GET['id']))
{
    include_once("database/conn.php");

    $id = $_GET['id'];
    //$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT * FROM tbladmin WHERE id = $id";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
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
        <!--Logo-->
        <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
        <title>Alterar Informações</title>
        <link rel="shortcut icon" type="image/x-icon" href="IMG/Logo2.png" />
		<link rel="stylesheet" type="text/css" href="css/AlteraAdmin.css">
        <script src="js/sweetalert.js" type="module"></script>
	</head>
    <body>
		<div class="container">

            <div class="form-image">
                <div class= "max-width">
                    <div class = "imageConteiner">
                        <img src="img/img.png">
                    </div>
                </div>
                <div class="input">
                    <input type="file" id="flImage" name="flImage" accept="image/*">
                </div>
            </div>

            <div class="form">
                <form action="SaveEditAdmin.php?id=<?php echo $id?>" method="post">
                    <div class="form-header">
                        <div class="tittle">
                            <h1>Alterar informações</h1>
                        </div>
                        <div class="returnbutton">
                            <button>
                                <a href="OficialMenuAdmin.php"> Retornar </a>
                            </button>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <div class="input-box">
                            <lable for="nome">Nome completo</lable>
                            <input id="nome" type="text" name="nome" placeholder="Digite o nome" value = "<?php echo $nome ?>">
                        </div>

                        <div class="input-box">
                            <lable for="email">E-mail</lable>
                            <input id="email" type="email" name="email" placeholder="Digite o email" value = "<?php echo $email ?>">
                        </div>

                        <div class="input-box">
                            <lable for="telefone">Telefone</lable>
                            <input id="telefone" type="tel" name="telefone" placeholder="Digite o telefone" value = "<?php echo $telefone ?>">
                        </div>
                    </div>

                    <!-- <a onclick="Alterar()"> -->
                    <div class="altera-button">
                        <input type="submit" value="Alterar" name="update" id="update">
                    </div>
                    <!-- <a> -->
                </form>
            </div>
        </div>
        <!-- <script>
    function Alterar()
    {
      swal
      ({
        title: "Deseja realmente alterar informações?",
        icon: "warning",
        buttons: ["Cancel", true],
      }).then(value => 
      {
        if (value) 
        {
          window.location.href = "SaveEditAdmin.php?id=<?php echo $id?>";
        } 
      })
      return false;
    }
  </script> -->
	</body>
</html>