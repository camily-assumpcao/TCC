<?php

if(!isset($_SESSION))
{
    session_start();
    include("database/conn.php");

    $id = $_SESSION['id'];
    $sql = "SELECT * FROM tblusuario WHERE id = $id";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
      while($usuario = $result->fetch_array())
      {  
         $nome = $usuario['nome'];
         $tipo = $usuario['usuario'];
         $CPFUsuario = $usuario['CPF'];
      }
    }
}

if(!isset($_SESSION['id']))
{
    die("Você não pode acessar essa página porque não está logado. <p> <a href=\"TelaInicial.php\">Ir para o site</a> </p>");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
  <title>SearchBook | Menu</title>
  <!--Logo-->
  <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
  <!--Estilo da Pagina-->
  <link rel="stylesheet" href="css/CSSCabecalhoMenu.css" />
  <!--Estilo da imagem de perfil-->
  <link rel="stylesheet" href="css/CSSPerfilMenu.css" />
  <!-- CSS dos icones do menu dentro do perfil -->
  <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <!-- CSS do conteúdo -->
  <link rel="stylesheet" href="css/CSSCorpoMenu.css">
  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="js/sweetalert.js" type="module"></script>
</head>

<body class="body">
  <!-- Chamar classe de estilizacao do cabecalho/menu horizontal-->
  <header class="cabecalho">

    <div class="dropdown">
      <div class="perfil">
        <div class="imgperfil">
          <button><img src="img/img.png" alt=".."></button>
          <br><br>
          <div class="dropdown-content">
            <a href="Perfil.php?id=<?php echo $_SESSION['id'];?>">
              <i class="bx bx-user"></i>
              <span>Perfil</span>
            </a>
            <!-- <a href="">
              <i class="bx bx-bell"></i>
              <span>Notificações</span>
            </a> -->
            </a>
            <a href="AlterarInfo_Usuario.php?id=<?php echo $_SESSION['id'];?>">
              <i class="bx bx-cog"></i>
              <span>Configurações</span>
            </a>
          </div>
        </div>
        <span class="perfil-nome"><?php echo $nome;?></span>
        <br>
        <span class="perfil-funcao"><?php echo $tipo;?></span>
        <script>
        console.log(<?php echo $id;?>)
        </script>
      </div>
    </div>

    <!--<div class="Logo"><img src="img/img.png" alt="Logo-img"></div>-->
    <div class="Logo">SearchBook</div>
    <nav class="cabecalho-menu">
      <!--<div class="dropdown">
        <button class="dropbtn">Cadastrar</button>
        <div class="dropdown-content">
          <a href="cadastroAluno.php">Cadastrar Aluno</a>
          <a href="cadastroLivro.php">Cadastrar Livro</a>
        </div>
      </div>-->
      <!-- <div class="dropdown">
        <button class="dropbtn">Precisa de mais tempo com um livro? </button>
        <div class="dropdown-content">
          <a href="agendarLivroUsuario.php">Agendar um Livro</a>
          <a href="SolicitarRenovacao.php">Solicitar Renovação</a> -->
      <!-- <a href="LivrosAgendadosUsuario.php">Livros Agendados</a> -->
      <!-- <a href="DevolucoesAtraso.php">Devoluções em Atraso</a>
          <a href="LivrosDevolvidos.php">Livros Devolvidos</a> -->
      </div>
      </div>
      <!-- <div class="dropdown">
        <button class="dropbtn">Registros</button>
        <div class="dropdown-content">
          <a href="acervoUsuario.php">Acervo</a>
          <a href="acervoUsuario.php">Recomendação de Livros</a>
        </div>
      </div> -->
      <!-- botao de logout -->
      <a onclick="Sair()">
        <button class="Btn">
          <div class="sign">
            <svg viewBox="0 0 512 512">
              <path
                d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
              </path>
            </svg>
          </div>
          <div class="text">Logout</div>
        </button>
      </a>
    </nav>
  </header>
  <script>
  function Sair() {
    swal
      ({
        title: "Deseja sair?",
        icon: "warning",
        buttons: ["Cancel", true],
      }).then(value => {
        if (value) {
          window.location.href = "logout.php";
        }
      })
    return false;
  }
  </script>
  <main>
    <section class="atalhos">
      <div class="interface">
        <div class="container">
          <a href="acervoUsuario.php">
            <div class="atalhos-box">
              <i class="bi bi-book"></i>
              <h3>Acervo Didático</h3>
              <p>Explore quais são os livros disponíveis na biblioteca escolar.</p>
            </div>
          </a>

          <a href="registroSolicitacaoUsuario.php?CPFUsuario=<?php echo $CPFUsuario ?>">
            <div class="atalhos-box">
              <i class="bi bi-journal-plus"></i>
              <h3>Acompanhar Solicitações</h3>
              <p>Acompanhe suas solicitações de renovação de empréstimo.</p>
            </div>
          </a>

          <a href="menuEmprestimosUsuario.php?id=<?php echo $id ?>">
            <div class="atalhos-box">
              <i class="bi bi-journal-check"></i>
              <h3>Empréstimos</h3>
              <p>Visualize quais livros você já agendou da sala de estudos.</p>
            </div>
          </a>
        </div>
      </div>
    </section>
    <main>
</body>

</html>