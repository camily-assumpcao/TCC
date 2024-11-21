<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SearchBook</title>
  <link rel="stylesheet" href="css/renovarLivro.css">
</head>

<body>
  <div class="container">
    <div class="form-image">
      <img src="img/img.png">
    </div>
    <div class="form">
      <form action="back/backend.php" method="post">
        <div class="form-header">
          <div class="tittle">
            <h1>Renovar Livro</h1>
          </div>
          <div class="returnbutton">
            <button>
              <a href="OficialMenuAdmin.php"> Retornar </a>
            </button>
          </div>
        </div>

        <div class="input-group">
          <div class="input-box">
            <lable for="cpf"> CPF: </lable>
            <input id="cpf" type="numeric" name="cpf" placeholder="Digite o RM do aluno" required>
          </div>

          <div class="input-box">
            <lable for="isbn"> ISBN do livro: </lable>
            <input id="isbn" type="text" name="isbn" placeholder="Digite o ISBN do livro" required>
          </div>

          <div class="input-box">
            <lable for="emprestimo">Data de renovação: </lable>
            <input id="emprestimo" type="date" name="emprestimo" required>
          </div>

          <div class="input-box">
            <lable for="devolucao"> Nova data de devolução: </lable>
            <input id="devolucao" type="date" name="devolucao" required>
          </div>
        </div>

        <div class="renova-button">
          <input type="submit" value="Renovar" name="renovarLivro">
      </form>
    </div>
  </div>
</body>

</html>