<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
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
            <h1>Esqueceu senha</h1>
          </div>

          <div class="returnbutton">
            <button onclick="history.go(-1)">Retornar</button>
          </div>
        </div>

        <div class="input-group">
          <div class="input-box">
            <lable for="email">E-mail</lable>
            <input id="email" type="email" name="email" placeholder="Digite seu email" required>
          </div>
        </div>

        <div class="subtittle">
          <font size="2px">
            <font color="red">Obs</font>: Será enviado um link para o e-mail inserido acima, em que poderá redefinir sua
            senha.
          </font>
        </div>

        <div class="enviar-button">
          <input type="submit" value="Enviar link" name="renovarLivro">
      </form>
    </div>
  </div>
</body>

</html>