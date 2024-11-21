<?php 
    include_once("database/conn.php");

    //Recebendo o código isbn por meio da URL
    $isbn_url = filter_input(INPUT_GET, "ISBNEditar", FILTER_SANITIZE_NUMBER_INT);

    //Consulta que seleciona informações do livro de acordo com o isbn recebido pela URL
    $sql_infoLivro = "SELECT * FROM tbllivro WHERE ISBN = $isbn_url";
    $result_infoLivro = $conn->query($sql_infoLivro);
    if($result_infoLivro->num_rows > 0)
    {
        while($infoLivro = $result_infoLivro->fetch_array())
        {  
            $tituloLivro = $infoLivro['titulo'];
            $autorLivro = $infoLivro['autor'];
            $anoLivro = $infoLivro['anoPubli'];
            $idiomaLivro = $infoLivro['idioma'];
            $qtdLivro = $infoLivro['quantidade'];
            $generoLivro = $infoLivro['genero'];
            $cddLivro = $infoLivro['CDD'];
            $editoraLivro = $infoLivro['editora'];
            $sinopseLivro = $infoLivro['sinopse'];
            $ISBNLivro = $infoLivro['ISBN'];
        }
    }

    //Consulta que seleciona o codLivro que será utilizado no botão de voltar para detalhes do livro
    $sqlSelect = "SELECT codLivro FROM tblLivro WHERE ISBN = '$isbn_url'";
    $resultSelect = $conn->query($sqlSelect);
    if($resultSelect->num_rows > 0)
        {
            while($detalhesSelect = $resultSelect->fetch_array())
            {
                $idLivro = $detalhesSelect['codLivro'];
            }
        }

    if(isset($_POST['titulo']))
    {
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $ano = $_POST['ano'];
        $idioma = $_POST['idioma'];
        $quantidade = $_POST['quantidade'];
        $genero = $_POST['genero'];
        $isbn = $_POST['ISBN'];
        $cdd = $_POST['CDD'];
        $editora = $_POST['editora'];
        $sinopse = $_POST['sinopse'];

        $sqlUpdateLivro = "UPDATE tbllivro SET titulo='$titulo' ,autor='$autor' ,genero='$genero', quantidade='$quantidade', idioma='$idioma', editora='$editora', anoPubli='$ano', CDD='$cdd', ISBN='$isbn', sinopse='$sinopse' WHERE ISBN = '$isbn_url'";

        if($conn->query($sqlUpdateLivro))
        {
            echo '<script type="text/javascript">';
            echo 'alert("Informações editas com sucesso!");';
            echo 'window.location.href ="acervo.php";';
            echo '</script>';
                
        }
        else
        {
            echo '<script type="text/javascript">';
            echo 'alert("Falha ao cadastrar livro!");';
            echo 'window.location.href ="editLivro.php";';
            echo '</script>';
        }
    }
    else
    {
        //echo "Erro!";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Logo-->
        <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
        <title>Editar Informações do Livro</title>
        <link rel="stylesheet" href="css/CSScadLivro.css">
        <script src="js/jquery.js"></script>
        <script src="js/sweetalert.js" type="module"></script>
    </head>
    <body>
        <div class="container">
            <div class="form-image">
                <img src="img/img.png">
            </div>
            
            <div class="form">
                <form id="livro" action="" method="POST" enctype="multipart/form-data">
                    <div class="form-header">
                        <div class="tittle">
                            <h1>Editar informações do Livro</h1>
                        </div>

                        <div class="returnbutton">
                            <a href="detalhesLivro.php?id=<?php echo $idLivro ?>">Retornar</a>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <div class="input-box">
                            <lable for="titulo">Título do Livro</lable>
                            <input id="titulo" type="text" name="titulo" placeholder="Digite o título do Livro" value="<?php echo $tituloLivro ?>" required>
                        </div>

                        <div class="input-box">
                            <lable for="autor">Autor do Livro</lable>
                            <input id="autor" type="text" name="autor" placeholder="Digite o nome do autor" value="<?php echo $autorLivro ?>" required>
                        </div>

                        <div class="input-box">
                            <lable for="ano">Ano do Livro</lable>
                            <input id="ano" type="text" name="ano" placeholder="Digite o ano de publicação" value="<?php echo $anoLivro ?>">
                        </div>

                        <div class="input-box">
                            <lable for="idioma">Idioma do Livro</lable>
                            <input id="idioma" type="text" name="idioma" placeholder="Digite o idioma" value="<?php echo $idiomaLivro ?>" required>
                        </div>

                        <div class="input-box">
                            <lable for="quantidade">Quantidade Disponível</lable>
                            <input id="quantidade" type="number" name="quantidade" placeholder="Digite a quantidade dísponivel" value="<?php echo $qtdLivro ?>" required>
                        </div>

                        <div class="input-box">
                            <lable for="genero">Genero do Livro</lable>
                            <input id="genero" type="text" name="genero" placeholder="Digite o genero do Livro" value="<?php echo $generoLivro ?>" required>
                        </div>

                        <div class="input-box">
                            <lable for="ISBN">Código ISBN</lable>
                            <input id="ISBN" type="numeric" name="ISBN" placeholder="Digite o ISBN" value="<?php echo $ISBNLivro ?>" required>
                        </div>

                        <div class="input-box">
                            <lable for="CDD">Código CDD</lable>
                            <input id="CDD" type="numeric" name="CDD" placeholder="Digite o código CDD" value="<?php echo $cddLivro ?>">
                        </div>

                        <div class="input-box">
                            <lable for="editora">Editora do Livro</lable>
                            <input id="editora" type="text" name="editora" placeholder="Digite a editora" value="<?php echo $editoraLivro ?>">
                        </div>

                        <div class="input-box">
                            <lable for="sinopse">Sinopse do livro</lable>
                            <input id="sinopse" type="text" name="sinopse" placeholder="Digite a sinopse do livro" value="<?php echo $sinopseLivro ?>">
                        </div>
                    </div>

                    <div class="register-button">
                        <input type="submit" value="Registrar" name="registroLivro">
                    </div>
                  </form>
            </div>
        </div>
    </body>
</html>