<?php

if(!isset($_SESSION))
{
    session_start();
    include("database/conn.php");

    $id = $_SESSION['id'];
    $sql = "SELECT * FROM tbladmin WHERE id = $id";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
      while($usuario = $result->fetch_array())
      {  
         $nome = $usuario['nome'];
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
    <link rel="stylesheet" href="css/CSSCorpoMenu.css" >
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
          <a href="PerfilAdmin.php?id=<?php echo $_SESSION['id'];?>">
              <i class="bx bx-user"></i>
              <span>Perfil</span>
            </a>
          <a href="notificacoesAdmin.php">
              <i class="bx bx-bell"></i>
              <span>Notificações</span>
            </a>
          </li></a>
          <a href="AlterarInfo_Admin.php?id=<?php echo $_SESSION['id']?>">
            <i class="bx bx-cog"></i>
              <span>Configurações</span>
          </a>
        </div>
      </div>

      <span class="perfil-nome"><?php echo $nome?></span>
      <br>
      <span class="perfil-funcao">Administrador(a)</span>
    </div>
    </div>

    <div class="Logo">SearchBook</div>
    <nav class="cabecalho-menu">
      <div class="dropdown">
        <button class="dropbtn">Cadastrar</button>
        <div class="dropdown-content">
          <a href="cadastroUsuario.php">Cadastrar Usuario</a>
          <a href="cadastroLivro.php">Cadastrar Livro</a>
          <a href="cadastroAdmin.php">Cadastrar Administrador</a>
        </div>
      </div>
      <!-- <div class="dropdown">
        <button class="dropbtn">Agendamentos</button>
        <div class="dropdown-content">
          <a href="agendarLivro.php">Agendar um Livro</a>
        </div>
      </div> -->

      <!-- botao de logout -->
      <a  onclick="Sair()">
        <button class="Btn">
          <div class="sign">
            <svg viewBox="0 0 512 512">
              <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
            </svg>
          </div>
            <div class="text">Logout</div>
        </button>   
      </a>            
    </nav>
  </header>
  <script>
    function Sair()
    {
      swal
      ({
        title: "Deseja sair?",
        icon: "warning",
        buttons: ["Cancel", true],
      }).then(value => 
      {
        if (value) 
        {
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
          <a href="acervo.php">
            <div class="atalhos-box">
              <i class="bi bi-book"></i>
              <h3>Acervo Didático</h3>
              <p>Descubra os livros disponíveis no acervo da biblioteca escolar.</p>
            </div>
          </a>

          <a href="registroUsuario.php">
            <div class="atalhos-box">
              <i class="bi bi-person-check"></i>
              <h3>Usuários Cadastrados</h3>
              <p>Acesse as informações dos usuários já cadastrados no site.</p>
            </div>
          </a>

          <a href="MenuEmprestimos.php">
            <div class="atalhos-box">
              <i class="bi bi-journal-check"></i>
              <h3>Empréstimos</h3>
              <p>Visualize quais livros estão emprestados e quem os pegou.</p>
            </div>
          </a>
        </div>
      </div>
    </section>
  </main>
</body>
</html>