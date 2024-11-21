<?php 
include_once("database/conn.php");
$detalhes = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

//var_dump($detalhes);
//echo $detalhes;

$detalhesLivro = "SELECT * FROM tbllivro WHERE codLivro = $detalhes";
$resultDetalhes = $conn->query($detalhesLivro);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
    <link rel="stylesheet" href="css/detalhesLivroUsuario.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&family=Poppins&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <title>Detalhes do livro</title>
</head>
<body>

<a href="acervoUsuario.php">
    <button class="btnVoltar">
        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024">
            <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z">
            </path>
        </svg>
    </button>
</a>
    <div class="container-principal">
        <div class="titulo">
            <h1>Detalhes do livro</h1>
        </div>
    <?php
     while($detalhes = $resultDetalhes->fetch_array())
     {
    ?>
    <div class="capalivro">
        <img height="320" src="<?php echo $detalhes['capaLivro']; ?>" alt="100">
    </div>  
        <br>
        <div class="detalhes">
            <strong>Título do Livro:</strong> <?php echo $detalhes['titulo'];?><p>
            <strong>Autor do livro:</strong>  <?php echo $detalhes['autor'];?><p>
            <strong>Gênero do Livro:</strong> <?php echo $detalhes['genero'];?><p>
            <strong>ISBN do Livro:</strong> <?php echo $detalhes['ISBN'];?><p>
            <strong>Idioma do Livro:</strong>  <?php echo $detalhes['idioma'];?><p>
            <strong>Quantidade Dísponível:</strong> <?php echo $detalhes['quantidade'];?><p>
            <strong>Sinopse do Livro:</strong> <?php echo $detalhes['sinopse'];?><p>
        </div>
    <?php 
    } 
    ?>
</body>
</html>