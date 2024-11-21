<?php
session_start();
ob_start();
include_once ("database/connSenha.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <!--Logo-->
  <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atualizar Senha</title>
  <link rel="stylesheet" href="css/atualizarSenha.css">
</head>

<body>
  <?php
        $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);


        if (!empty($chave)) {
            //var_dump($chave);

            $query_usuario = "SELECT id 
                                FROM tblusuario
                                WHERE recuperar_senha =:recuperar_senha  
                                LIMIT 1";
            $result_usuario = $connSenha->prepare($query_usuario);
            $result_usuario->bindParam(':recuperar_senha', $chave, PDO::PARAM_STR);
            $result_usuario->execute();

            if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
                $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
                $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                //var_dump($dados);
                if (!empty($dados['SendNovaSenha'])) {
                    $senha = $dados['senha'];
                    $recuperar_senha = 'NULL';

                    $query_up_usuario = "UPDATE tblusuario
                            SET senha =:senha, recuperar_senha =:recuperar_senha
                            WHERE id =:id 
                            LIMIT 1";
                    $result_up_usuario = $connSenha->prepare($query_up_usuario);
                    $result_up_usuario->bindParam(':senha', $senha, PDO::PARAM_STR);
                    $result_up_usuario->bindParam(':recuperar_senha', $recuperar_senha);
                    $result_up_usuario->bindParam(':id', $row_usuario['id'], PDO::PARAM_INT);

                    if ($result_up_usuario->execute()) {
                        $_SESSION['msg'] = "<p style='color: green'>Senha atualizada com sucesso!</p>";
                        header("Location: LoginUsuario.php");
                    } else {
                        echo "<p style='color: #ff0000'>Erro: Tente novamente!</p>";
                    }
                }
            } else {
                $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
                header("Location: recuperar_senha.php");
            }
        } else {
            $_SESSION['msg_rec'] = "<p style='color: #ff0000'>Erro: Link inválido, solicite novo link para atualizar a senha!</p>";
            header("Location: recuperar_senha.php");
        }

        ?>
  <div class="container">
    <div class="form-image">
      <img src="img/img.png">
    </div>
    <div class="form">
      <form action="" method="post">
        <div class="form-header">
          <div class="tittle">
            <h1>Atualizar Senha</h1>
          </div>

          <div class="returnbutton">
            <button>
              <a href="TelaInicial.php">Retornar</a>
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
            <div class="input-box">
              <lable for="senha">Senha</lable>
              <input id="senha" type="password" name="senha" placeholder="Digite a nova senha"
                value="<?php echo $usuario;?>">
            </div>
            <div class="enviar-button">
              <input type="submit" value="Atualizar" name="SendNovaSenha">
      </form>
    </div>
  </div>

</body>

</html>