<?php 
    include("database/conn.php");

    $sql_query = "SELECT * FROM tbllivro";
    $result = $conn->query($sql_query);

     if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql1 = "SELECT * FROM tbllivro WHERE titulo LIKE '%$data%' or autor LIKE '%$data%' or genero  LIKE '%$data%' or idioma LIKE '%$data%' or editora LIKE '%$data%' or ISBN LIKE '%$data%' ";
    }
    else
    {
        $sql1 = "SELECT * FROM tbllivro";
    }
    $result = $conn->query($sql1);
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
  <link rel="stylesheet" href="css/acervo.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&family=Poppins&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
  <a href="OficialMenuAdmin.php">
    <button class="btnVoltar">
      <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024">
          <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z">
          </path>
      </svg>
    </button>
  </a>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
    integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
  </script>
  <script src="js/gerarPDFacervo.js" defer></script>
  <title>Acervo</title>
</head>

<body>
  <div class="container-principal" id="content">
    <button class="btnPDF" id="generate-pdf"> Gerar PDF </button>
    <center>
      <div class="titulo">
        <h1>Acervo - SearchBook</h1>
        <br>
      </div>
      <form class="form">
        <div type="submit" class="btnSearch" onclick="searchData()">
          <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img"
            aria-labelledby="search">
            <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9"
              stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
        <input class="input" id="pesquisar" name="search" placeholder="Pesquisar Livro" required=""
          value="<?php if(isset($_GET['busca']))echo $_GET['busca'];?>" type="search">

      </form>
    </center>

    <div class="container-image">
      <?php 
      while($livros = $result->fetch_array())
    {
                    ?>
      <div class="image">
        <img src="<?php echo $livros['capaLivro']; ?>" alt="100">
        <br>
        <h3><?php echo $livros['titulo'];?></h3>
        <br>
        <br>
        <a href="detalhesLivro.php?id=<?php echo $livros['codLivro'];?>">
          <button class="detalhes">Detalhes</button>
        </a>
      </div>
      <?php 
                        } 
                    ?>
    </div>
  </div>
</body>
<script>
var search = document.getElementById('#pesquisar');

search.addEventListener("keydown", function(event) {
  if (event.key === "Enter") {
    searchData();
  }
});

function searchData() {
  window.location = 'acervo.php?search=' + search.value;
}
</script>

</html>