<?php 
include_once("database/conn.php");

$dataAtual = date('d-m-Y');
$dataDevolu = date('d-m-Y', strtotime('+7 days'));

//Recebendo o código isbn por meio da URL
$isbn_url = filter_input(INPUT_GET, "ISBNAgendar", FILTER_SANITIZE_NUMBER_INT);

//Consulta que seleciona o codLivro que será utilizado no botão de voltar para detalhes do livro
$sqlSelect = "SELECT * FROM tblLivro WHERE ISBN = '$isbn_url'";
$resultSelect = $conn->query($sqlSelect);
if($resultSelect->num_rows > 0)
    {
        while($detalhesSelect = $resultSelect->fetch_array())
        {
            $idLivro = $detalhesSelect['codLivro'];
            $qtdLivro = $detalhesSelect['quantidade'];
        }
    }

//if(isset($_POST['cpf']))

if(isset($_POST['cpf']))
{
  if($qtdLivro > 0)
  {
    $CPF = $_POST['cpf'];
    $isbn = $_POST['isbn'];
    $dataEmprestimo = $_POST['emprestimo'];
    $dataDevolucao = $_POST['devolucao'];

    //Consulta que insere dados na tabela de empréstimo
    $sql_query = "INSERT INTO tblemprestimo (CPFUsuario,ISBNLivro,dataEmprestimo,dataDevolucao,situacaoEmprestimo)
    VALUES ('$CPF','$isbn','$dataEmprestimo','$dataDevolucao','Em andamento')";

    //Consulta que remove '-1' da quantidade do livro quando este for emprestado
    $sqlUpdateLivro = "UPDATE tbllivro SET quantidade = $qtdLivro - 1 WHERE ISBN = '$isbn' ";
    $conn->query($sqlUpdateLivro);  

    if($conn->query($sql_query)==TRUE)
    {
        // echo "Dados inseridos com sucesso na tabela";
        echo '<script type="text/javascript">';
        echo 'alert("Livro emprestado com sucesso!");';
        echo 'window.location.href ="javascript: history.go(-1)";';
        echo '</script>';
    }
    else
    {
        echo '<script type="text/javascript">';
        echo 'alert("Falha ao emprestar livro!");';
        echo 'window.location.href ="javascript: history.go(-1)";';
        echo '</script>';
        //echo "Erro ao inserir dados na tabela";
    }
  }
  else{
      echo '<script type="text/javascript">';
        echo 'alert("livro sem disponibilidade!");';
        echo 'window.location.href ="javascript: history.go(-1)";';
        echo '</script>';
        //echo "Erro ao inserir dados na tabela";
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
  <title>Empretar Livro</title>
  <link rel="stylesheet" href="css/agendarLivro.css">
  <script src="js/jquery.js"></script>
  <script src="js/sweetalert.js" type="module"></script>
</head>

<body>
  <div class="container">
    <div class="form-image">
      <img src="img/img.png">
    </div>
    <div class="form">
      <form id="agendarLivro" method="POST">
        <div class="form-header">
          <div class="tittle">
            <h1>Emprestar Livro</h1>
          </div>

          <div class="returnbutton">
            <button>
              <a href="detalhesLivro.php?id=<?php echo $idLivro ?>">Retornar</a>
            </button>
          </div>
        </div>

        <div class="input-group">
          <div class="input-box">
            <lable for="cpf"> CPF: </lable>
            <input id="cpf" type="numeric" name="cpf" placeholder="Digite o CPF" required>
          </div>

          <div class="input-box">
            <lable for="isbn"> ISBN do livro: </lable>
            <input id="isbn" type="text" name="isbn" placeholder="Digite o ISBN do livro" value = "<?php echo $isbn_url ?>" required>
          </div>

          <div class="input-box">
            <lable for="emprestimo">Data de empréstimo: </lable>
            <input id="emprestimo" type="text" name="emprestimo" value="<?php echo $dataAtual ?>" required>
          </div>

          <div class="input-box">
            <lable for="devolucao"> Data de devolução: </lable>
            <input id="devolucao" type="text" name="devolucao" value="<?php echo $dataDevolu ?>" required>
          </div>
        </div>

        <div class="agenda-button">
          <input type="submit" value="Agendar" name="agendarLivro">
        </div>
      </form>
    </div>
  </div>
  <!-- <script>
            var formData = new FormData();

            $(document).ready(function()
            {
                $("#agendarLivro").submit(function(e)
                {
                    e.preventDefault();

                    var CPF = $("#cpf").val();
                    var nome = $("#nome").val();
                    var dataEmprestimo = $("#emprestimo").val();
                    var dataDevolucao = $("#devolucao").val();
                
                    formData.append("cpf", CPF);
                    formData.append("nome", nome);
                    formData.append("emprestimo", dataEmprestimo);
                    formData.append("devolucao", dataDevolucao);

                    $.ajax({
                        type:"POST", 
                        url: $(this).attr("action"),
                        data: formData, 
                        contentType: false,
                        processData: false,
                        success: function(response)
                        {
                            swal({
                                title: "Livro agendado com sucesso",
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
                                title: "Falha ao agendar um livro",
                                icon: "error",
                                button: {confirm: true}, 
                            });
                        }
                    });
                });
            });
        </script> -->
</body>

</html>