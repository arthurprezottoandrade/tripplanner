<html>    
    <head>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href="CSS/mostrar.css">
        <title>Locais - Tripp Planner</title>
        <link rel="icon" type="image/jpg" href="IMG/logo_icone.jpg"/>
    </head>
    <!-- CABEÇALHO -->
    <header class="cabecalho">
    <style>
                /* Estilos para o botão e o menu */
                .menu-btn {
                    position: fixed;
                    top: 2%;
                    right: 0;
                    transform: translate(-50%, -50%);
                    background-color: #f1f1f1;
                    cursor: pointer;
                }
                
                .menu {
                    position: fixed;
                    top: 50%;
                    right: -15%; /* Inicialmente, o menu estará oculto */
                    width: 300px;
                    padding: 10px;
                    border-radius: 185%;
                    transition: right 0.7s;
                }
                
                .menu a {
                    display: block;
                    margin-bottom: 5%;
                }

            </style>

            <div class="menu-btn" onclick="toggleMenu()">Menu</div>
            <div class="menu" id="menu">
                <a href="inicio.php">Inicio</a>
                <a href="cadastroUsuario.php">Cadastrar Usuário</a>
                <a href="mostrarLocal.php">Locais Cadastrados</a>
                <a href="cadastroLocal.php">Cadastrar Local</a>
            </div>
            
            <script>
                function toggleMenu() {
                    var menu = document.getElementById("menu");
                    
                    if (menu.style.right === "-13%") {
                        menu.style.right = "0";
                    } else {
                        menu.style.right = "-13%";
                    }
                }
            </script>

        <div>
            <img class="logo" src="IMG/logopng.png"/>
        </div>
        <div class="botao-cabecalho">
            <ul>
                <li>
                    <a href="">
                        <h3>MENU</h3>
                    </a>
                </li>
                <li>
                    <a href="">
                        <h3>SOBRE</h3>
                    </a>
                </li>
                <li>
                    <a href="">
                        <h3>CONTATO</h3>
                    </a>
                </li>
                <li>
                    <a href="cadastroCachorro.php">
                        <h3>CADASTRAR LOCAIS</h3>
                    </a>
                </li>
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

                        $sql = "SELECT l.id, l.Nome, l.cidade, l.rua, l.numero, l.bairro, l.estado FROM locais l";
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
                                    echo $row["Nome"];
                                    echo "</td><td>";
                                    echo $row["Cidade"];
                                    echo "</td><td>";
                                    echo $row["Rua"];
                                    echo "</td><td>";
                                    echo $row["Numero"];
                                    echo "</td><td>";
                                    echo $row["Bairro"];
                                    echo "</td><td>";
                                    echo $row["Estado"];
                                    echo "</td>";
                    ?>
                                <!-- Atualizar e Excluir cachorro -->
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
            <img class="img-rodape" src="IMG/logo_verticalpng.png">
            <p class="copyright">&copy; Copyright Tripp Planner - 2023</p>
        </footer>
    </body>
</html>