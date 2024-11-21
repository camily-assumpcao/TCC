<?php 
include_once("database/conn.php");

if(isset($_FILES['capaLivro']))
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
    $arquivo = $_FILES['capaLivro'];


    $pasta = "capaLivro/";
    $nomeArquivo = $arquivo['name'];
    $novoNomeArquivo = uniqid();
    $extensao = strtolower(pathinfo($nomeArquivo,PATHINFO_EXTENSION));

    if($extensao != "jpg" && $extensao != "jpeg" && $extensao != "png" && $extensao != "" )
    {
        die("Tipo de Arquivo não aceito");
    }
    else
    {
        $path = $pasta . $novoNomeArquivo . "." . $extensao;
        $deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);
        $sql_query = "INSERT INTO tbllivro (titulo,autor,genero,quantidade,idioma,editora,anoPubli,CDD,ISBN,sinopse,capaLivro) 
        VALUES ('$titulo','$autor','$genero','$quantidade','$idioma','$editora','$ano','$cdd','$isbn','$sinopse','$path')";

        if($conn->query($sql_query))
        {
            echo '<script type="text/javascript">';
            echo 'alert("Livro cadastrado com sucesso!");';
            echo 'window.location.href ="";';
            echo '</script>';
            
        }
        else
        {
            echo '<script type="text/javascript">';
            echo 'alert("Falha ao cadastrar livro!");';
            echo 'window.location.href ="";';
            echo '</script>';
        }
    }
}
else
{
    //echo "Erro! Arquivo de imagem não selecionado";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <!--Logo-->
        <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar Livro</title>
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
                            <h1>Registro de Livros</h1>
                        </div>

                        <div class="returnbutton">
                            <a href="OficialMenuAdmin.php">Retornar</a>
                        </div>
                    </div>
                    
                    <div class="input-group">
                        <div class="input-box">
                            <lable for="titulo"> <font color ="red">* </font> Título do Livro</lable>
                            <input id="titulo" type="text" name="titulo" placeholder="Digite o título do Livro" required>
                        </div>

                        <div class="input-box">
                            <lable for="autor"> <font color ="red">* </font> Autor do Livro</lable>
                            <input id="autor" type="text" name="autor" placeholder="Digite o nome do autor" required>
                        </div>

                        <div class="input-box">
                            <lable for="ano">Ano do Livro</lable>
                            <input id="ano" type="text" name="ano" placeholder="Digite o ano de publicação">
                        </div>

                        <div class="input-box">
                            <lable for="idioma"><font color ="red">* </font> Idioma do Livro</lable>
                            <input id="idioma" type="text" name="idioma" placeholder="Digite o idioma" required>
                        </div>

                        <div class="input-box">
                            <lable for="quantidade"><font color ="red">* </font>Quantidade Disponível</lable>
                            <input id="quantidade" type="number" name="quantidade" placeholder="Digite a quantidade dísponivel" required>
                        </div>

                        <div class="input-box">
                            <lable for="genero"><font color ="red">* </font> Genero do Livro</lable>
                            <input id="genero" type="text" name="genero" placeholder="Digite o genero do Livro" required>
                        </div>

                        <div class="input-box">
                            <lable for="ISBN"><font color ="red">* </font>Código ISBN</lable>
                            <input id="ISBN" type="numeric" name="ISBN" placeholder="Digite o ISBN" required>
                        </div>

                        <div class="input-box">
                            <lable for="CDD">Código CDD</lable>
                            <input id="CDD" type="numeric" name="CDD" placeholder="Digite o código CDD">
                        </div>

                        <div class="input-box">
                            <lable for="editora">Editora do Livro</lable>
                            <input id="editora" type="text" name="editora" placeholder="Digite a editora">
                        </div>

                        <div class="input-box">
                            <lable for="sinopse">Sinopse do livro</lable>
                            <input id="sinopse" type="text" name="sinopse" placeholder="Digite a sinopse do livro">
                        </div>

                        <div class="input-box">
                            <lable for="capaLivro">Capa do Livro</lable>
                            <input id="capaLivro" type="file" name="capaLivro">
                        </div>
                    </div>

                    <div class="register-button">
                        <input type="submit" value="Registrar" name="registroLivro">
                    </div>
                  </form>
            </div>
        </div>
        <!-- <script>
            var formData = new FormData();

            $(document).ready(function()
            {
                $("#livro").submit(function(e)
                {
                    e.preventDefault();

                    var titulo = $("#titulo").val();
                    var autor = $("#autor").val();
                    var ano = $("#ano").val();
                    var idioma = $("#idioma").val();
                    var quantidade = $("#quantidade").val();
                    var genero = $("#genero").val();
                    var isbn = $("#ISBN").val();
                    var cdd = $("#CDD").val();
                    var editora = $("#editora").val();
                    var sinopse = $("#sinopse").val();

                    formData.append("titulo", titulo);
                    formData.append("autor", autor);
                    formData.append("ano", ano);
                    formData.append("idioma", idioma);
                    formData.append("quantidade", quantidade);
                    formData.append("genero", genero);
                    formData.append("ISBN", isbn);
                    formData.append("CDD", cdd);
                    formData.append("editora", editora);
                    formData.append("sinopse", sinopse);

                    $.ajax({
                        type:"POST", 
                        url: $(this).attr("action"),
                        data: formData, 
                        contentType: false,
                        processData: false,
                        success: function(response)
                        {
                            // swal({
                            //     title: "Livro cadastrado com sucesso",
                            //     icon: "success",
                            //     button: {confirm: true}, 
                            // }).then(value=>{
                            //     if (value)
                            //     {
                            //         window.location.href = "";
                            //     }
                            // });
                            console.log(titulo)
                            console.log(autor)
                            console.log(ano)
                            console.log(idioma)
                            console.log(quantidade)
                            console.log(genero)
                            console.log(isbn)
                            console.log(cdd)
                            console.log(editora)
                            console.log(sinopse)
                            console.log("registrou")
                        },
                        error: function()
                        {
                            swal({
                                title: "Falha ao cadastrar livro",
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