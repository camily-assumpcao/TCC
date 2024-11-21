<?php 
    include("database/conn.php");

    $CPFUsuario = $_GET['CPFUsuario'];

    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql1 = "SELECT * FROM tblsolicitacao WHERE idSolicitacao LIKE '%$data%' or nomeUsuario LIKE '%$data%' or ISBNLivro LIKE '%$data%' or idEmprestimo ORDER BY nomeUsuario";
    }
    else
    {
        $sql1 = "SELECT * FROM tblsolicitacao 
                 WHERE CPFUsuario = '$CPFUsuario' 
                 ORDER BY situacaoSolicitacao != 'Em andamento', situacaoSolicitacao DESC";
    }
    $result= $conn->query($sql1);
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS-->
    <link rel="stylesheet" href="css/registroUsuario.css">
    <!-- link bootstrap da tabela -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!--Logo-->
    <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script src="js/gerarPDF.js" defer></script>
    <title>Solicitações de Renovação</title>
  </head>
     <body style="background-color: #c1ffc1d3;">

        <a href="OficialMenuUsuario.php">
            <button class="btnVoltar">
                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024">
                    <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z">
                    </path>
                </svg>
            </button>
        </a>
        <div class="titulo">
                <center>
                <h1>Solicitações de renovações</h1>
                <br>
                </center>
        </div>
        <center>
        <form class="form">
            <div type="submit"class="btnSearch" onclick="searchData()">
                <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                    <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </div>
            <input class="input" id="pesquisar" name="search" placeholder="Pesquisar" required="" value="<?php if(isset($_GET['busca']))echo $_GET['busca'];?>" type="search">
        </form>
        </center>
        
        <div class="container-principal" id="content">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Código Solicitação</th>
                        <th scope="col">Nome Usuário</th>
                        <th scope="col">Código Empréstimo</th>
                        <th scope="col">ISBN Livro Emprestado</th>
                        <th scope="col">Situação da Solicitação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($notificacoes = $result->fetch_array())
                        {
                            echo "<tr>";
                            echo "<td>".$notificacoes['idSolicitacao']."</td>";
                            echo "<td>".$notificacoes['nomeUsuario']."</td>";
                            echo "<td>".$notificacoes['idEmprestimo']."</td>";
                            echo "<td>".$notificacoes['ISBNLivro']."</td>";
                            if ($notificacoes['situacaoSolicitacao'] =='Recusada') {
                                echo "<td> <span style='color:red;'>" . $notificacoes['situacaoSolicitacao'] . "</span></td>";
                            }
                            else if ($notificacoes['situacaoSolicitacao'] == 'Renovado'){
                                echo "<td> <span style='color:green;'>" . $notificacoes['situacaoSolicitacao'] . "</span></td>";
                            }
                            else{
                                echo "<td>".$notificacoes['situacaoSolicitacao']."</td>";
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
    <script>
        var search = document.getElementById('pesquisar');

        search.addEventListener("keydown", function(event){
            if(event.key==="Enter")
            {
                searchData();
            }
        });

        function searchData()
        {
            window.location='registroSolicitacaoUsuario.php?search='+search.value;
        }
    </script>
</html>