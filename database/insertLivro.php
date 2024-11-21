<?php 
    include_once "conn.php";

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

    //Verificando se foi inserido algum arquivo no input 'file'
    if (isset($_FILES["capaLivro"]) && !empty($_FILES["capaLivro"]))
    {
        //Carregando um arquivo de imagem com o $_FILE
        $arquivo = $_FILES['capaLivro'];

        //Definindo para onde o arquivo vai
        $pasta = "D:\wamp64\www\TCC\capaLivro\ ";

        //Definindo nomes para o arquivo
        $nomeArquivo = $arquivo["name"];
        $novoNomeArquivo = uniqid();

        //Extensão do arquivo selecionado
        $extensao = strtolower(pathinfo($nomeArquivo,PATHINFO_EXTENSION));

        //Novo caminho do arquivo
        $path = $pasta . $novoNomeArquivo . "." . $extensao;


        //Caso o tipo de arquivo não seja de imagem não será feito o uploud
        if ($extensao != 'jpg' && $extensao != 'png' && $extensao != 'jpeg')
        {
            die("Tipo de arquivo incorreto! Apenas imagens (jpg, png ou jpeg)");
        }
        else
        {
            //Inserindo o arquivo para a pasta local 'capaLivro'
            $upload = move_uploaded_file($arquivo["tmp_name"], $path);
        } 
    }

    else
    {
        echo "Erro, arquivo de imagem não selecionado";
    }

    $sql = "INSERT INTO tbllivro (titulo,autor,genero,idioma,editora,ano,quantidade,CDD,ISBN,sinopse,capaLivro)
              VALUES ('$titulo','$autor','$genero','$idioma','$editora','$ano','$quantidade','$cdd','$isbn','$sinopse','$path')";
    
    if($conn->query($sql)==TRUE)
    {
        echo "Dados inseridos com sucesso na tabela";
    }
    else
    {
        echo "Erro ao inserir dados na tebala";
    }






    
    /*Segunda versão - Teste
    Carregando um arquivo de imagem com o $_FILE
    $arquivo = $_FILES['capaLivro'];

    //Definindo para onde o arquivo vai
    $pasta = "http://localhost/TCC/arquivos/";

    //Definindo nomes para o arquivo
    $nomeArquivo = $arquivo["name"];
    $novoNomeArquivo = uniqid();

    //Extensão do arquivo selecionado
    $extensao = strtolower(pathinfo($nomeArquivo,PATHINFO_EXTENSION));


    //Caso o tipo de arquivo não seja de imagem não será feito o uploud
    if ($extensao != 'jpg' && $extensao != 'png')
    {
        die("Tipo de arquivo incorreto! Apenas imagens (jpg ou png)");
    }
    else
    {
        $upload = move_uploaded_file($arquivo["tmp_name"], $pasta . $novoNomeArquivo . "." . $extensao);
    } 

    // Verificando se o arquivo foi enviado corretamente
    if ($upload)
    {
        echo "Arquivo enviado com sucesso";
    }
    else
    {
        echo "Erro ao enviar arquivo";
    }
    */
    
?>