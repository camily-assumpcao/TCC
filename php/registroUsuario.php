<?php 
    include("database/conn.php");


    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql1 = "SELECT * FROM tblusuario WHERE id LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ORDER BY nome";
    }
    else
    {
        $sql1 = "SELECT * FROM tblusuario ORDER BY nome";
    }
    $resultRegistroUsuario = $conn->query($sql1);


?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="img/img.png" />
        <link rel="stylesheet" href="css/registroUsuario.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300&family=Poppins&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
        <!-- link bootstrap da tabela -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer">
        </script>
        <script src="js/gerarPDF.js" defer></script>
        <title>Usuários cadastrados</title>
    </head>
    <body style="background-color: #c1ffc1d3;">

        <a href="OficialMenuAdmin.php">
            <button class="btnVoltar">
                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024">
                    <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z">
                    </path>
                </svg>
                
            </button>
        </a>
        <button class="btnPDF" id="generate-pdf"> Gerar PDF </button>
        <div class="titulo">
                <center>
                <h1>Usuários cadastrados</h1>
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
            <input class="input" id="pesquisar" name="search" placeholder="Pesquisar usuário" required="" value="<?php if(isset($_GET['busca']))echo $_GET['busca'];?>" type="search">
                <!-- <div class="reset" type="reset">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div> -->
        </form>
        </center>
        
        <div class="container-principal" id="content">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Usuário</th>
                        <th scope="col">...</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($registroUsuario = $resultRegistroUsuario->fetch_array())
                        {
                            echo "<tr>";
                            echo "<td>".$registroUsuario['id']."</td>";
                            echo "<td>".$registroUsuario['nome']."</td>";
                            echo "<td>".$registroUsuario['email']."</td>";
                            echo "<td>".$registroUsuario['telefone']."</td>";
                            echo "<td>".$registroUsuario['usuario']."</td>";

                            echo "<td>
                            <a class='btn btn-sm btn-danger' href='excluirUsuario.php?id=$registroUsuario[id]'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
                            </svg>
                            </a>
                            </td>";
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
            window.location='registroUsuario.php?search='+search.value;
        }
    </script>
</html>