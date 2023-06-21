<html>    
    <head>
    <link rel="stylesheet" type="text/css" href="CSS/inicio.css">
    <title>Locais Cadastrados - TripPlanner</title>
    <link rel="icon" type="image/jpg" href="IMG/logo_transparente.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

        <style>
        .rating {
            unicode-bidi: bidi-override;
            direction: rtl;
            text-align: left;
        }
        .rating > span {
            display: inline-block;
            position: relative;
            width: 1.1em;
        }
        .rating > span:hover:before,
        .rating > span:hover ~ span:before {
            content: "\2605";
            position: absolute;
            color: gold;
        }

        .menu {
            position: fixed;
            top: 0;
            left: -100%;
            width: 10%;
            height: 100%;
            background-color: #5C4033;
            z-index: 9999;
            transition: left 0.3s;
            border-radius: 0; /* Remova esta propriedade */
        }

        .menu.show {
            left: 0;
        }

        .menu a {
            display: block;
            padding: 10px;
            color: #fff;
            text-decoration: none;
        }

        .menu a:hover {
            background-color: #3D291F;
        }
    </style>
</head>
<body>
    <!-- CONEXÃO COM O BANCO DE DADOS -->
    <?php require 'conectaBD.php'; ?>
    <!-- CABEÇALHO -->
    <header class="cabecalho">
        <div class="menu" id="menu">
            <a href="inicio.php">Inicio</a>
            <a href="cadastroUsuario.php">Cadastrar Usuário</a>
            <a href="mostrarLocal.php">Locais Cadastrados</a>
            <a href="cadastroLocal.php">Cadastrar Local</a>
        </div>

        <script>
            function toggleMenu() {
                var menu = document.getElementById("menu");

                menu.classList.toggle("show");
            }

            function openModal() {
                // Implemente aqui a lógica para abrir a janela modal
            }
        </script>

        <img class="logo" src="IMG/logo_horizontal.png"/>

        <div class="botao-cabecalho">
            <ul>
                <li><a href="#" onclick="toggleMenu()"><h3>MENU</h3></a></li>
                <li><a href=""><h3>SOBRE</h3></a></li>
                <li><a href=""><h3>CONTATO</h3></a></li>
            </ul>
        </div>
    </header>

    <!-- LINHA DE DIVISÃO -->
    <header class="linha-divisao"></header>
    <body>
        <!-- CONEXÃO COM O BANCO DE DADOS -->
        <?php require 'conectaBD.php'; ?>

        <!-- CONTEÚDO PRINCIPAL: deslocado para direita em 270 pixels quando a sidebar é visível -->
        <div class="w3-container">

            <div class="w3-panel w3-padding-large w3-card-4 w3-light-dark">
                <h1 class="w3-xxlarge"style="text-align: center">Locais</h1>

                <p class="w3-large"></p>

                <div class="w3-code cssHigh notranslate">  
                    <!-- Acesso ao BD-->
                    <?php

                    // Cria conexão
                    $conn = mysqli_connect($servername, $username, $password, $database);
                    
                    // Verifica conexão 
                    if (!$conn) {
                        echo "</table>";
                        echo "</div>";
                        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
                    }
                    // Configura para trabalhar com caracteres acentuados do português
                    mysqli_query($conn,"SET NAMES 'utf8'");
                    mysqli_query($conn,'SET character_set_connection=utf8');
                    mysqli_query($conn,'SET character_set_client=utf8');
                    mysqli_query($conn,'SET character_set_results=utf8');

                        $sql = "SELECT l.id, l.nome, l.cidade, l.rua, l.numero, l.bairro, l.estado,l.descricao FROM locais l";
                        echo "<div class='w3-responsive w3-card-4'>";
                        if ($result = mysqli_query($conn, $sql)) {
                            echo "<table class='w3-table-all'>";
                            echo "	<tr>";
                            echo "	  <th>Id</th>";
                            echo "	  <th>Nome</th>";
                            echo "	  <th>Cidade</th>";
                            echo "	  <th>Rua</th>";
                            echo "	  <th>Numero</th>";
                            echo "	  <th>Bairro</th>";
                            echo "	  <th>Estado</th>";
                            echo "	  <th> </th>";
                            echo "	</tr>";
                            if (mysqli_num_rows($result) > 0) {
                                // Apresenta cada linha da tabela
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $cod = $row["id"];
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $cod;
                                    echo "</td><td>";
                                    echo $row["nome"];
                                    echo "</td><td>";
                                    echo $row["descricao"];
                                    echo "</td><td>";
                                    echo $row["cidade"];
                                    echo "</td><td>";
                                    echo $row["rua"];
                                    echo "</td><td>";
                                    echo $row["numero"];
                                    echo "</td><td>";
                                    echo $row["bairro"];
                                    echo "</td><td>";
                                    echo $row["cidade"];
                                    echo "</td>";
                    ?>
                                <td>
                                <a href='atualizaLocal.php?id=<?php echo $cod; ?>'><img src='IMG/editar.png' title='Editar Local' width='32'></a>
                                </td><td>
                                <a href='deletarLocal.php?id=<?php echo $cod; ?>'><img src='IMG/excluir.png' title='Excluir Local' width='32'></a>
                                </td>
                                </tr>
                    <?php
                                }
                            }
                                echo "</table>";
                                echo "</div>";
                        } else {
                            echo "Erro executando SELECT: " . mysqli_error($conn);
                        }

                        mysqli_close($conn);

                    ?>
                </div>
            </div>
        </div>
        <!-- RODAPÉ -->
    <footer>
        <header class="linha-divisao"></header>
        <img class="img-rodape" src="IMG/logo_principal.png">
        <p class="copyright">&copy; Copyright TripPlanner - 2023</p>
    </footer>
    </body>
</html>
