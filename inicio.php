<!DOCTYPE html>
    <head>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href="CSS/inicio.css"/>
        <title>Help Friend</title>
        <link rel="icon" type="image/jpg" href="IMG/logo_icone.jpg"/>
    </head>
    <body>
    <!-- CONEXÃO COM O BANCO DE DADOS -->
    <?php require 'conectaBD.php'; ?>
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
                <img class="logo" src="IMG/logopng.jpg"/>
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
                </ul>
            </div>
        </header>
        <!-- LINHA DE DIVISÃO -->
        <header class="linha-divisao"></header>

        <!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
        <div class="w3-main w3-container">

            <div class="w3-panel w3-padding-large w3-card-4 w3-light-dark">
                <h2 class="w3-xxlarge"style="text-align: center">Sua viagem está aqui</h2>

                <p class="w3-large">
                <div class="w3-code">
                <!-- ACESSO AO BANCO DE DADOS-->
                <?php

                    // Cria conexão
                    $conn = mysqli_connect($servername, $username, $password, $database);

                    // Verifica conexão 
                    if (!$conn) {
                        die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
                    }
                    // Configura para trabalhar com caracteres acentuados do português
                    mysqli_query($conn,"SET NAMES 'utf8'");
                    mysqli_query($conn,'SET character_set_connection=utf8');
                    mysqli_query($conn,'SET character_set_client=utf8');
                    mysqli_query($conn,'SET character_set_results=utf8');

                    // Faz Select na Base de Dados
                    $sql = "SELECT l.id as Id, l.Nome as Nome, l.rua as Rua, l.numero as Numero, l.bairro as Bairro, l.cidade as Cidade, l.estado as Estado, l.foto as Imagem FROM locais l";

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = $result -> fetch_assoc()) {
                            $id_local = $row['Id'];
                            $nome      = $row['Nome'];
                            $cidade = $row['Cidade'];
                            $rua      = $row['Rua'];
                            $numero  = $row['Numero'];
                            $bairro  = $row['Bairro'];
                            $foto = $row['Imagem'];
                ?>

                    <div class="card">
                        <div class="container">
                            <div class="sub-container" style="display:flex;">
                                <div class="fields">
                                    <h4><b><b>Id: </b><?php echo $id_local ?></b></h4> 
                                    <h4><b><b>Nome: </b><?php echo $nome ?></b></h4> 
                                    <h4><b><b>Cidade: </b><?php echo $cidade ?></b></h4>
                                    <h4><b><b>Rua: </b><?php echo $rua ?></b></h4> 
                                    <h4><b><b>Numero: </b><?php echo $numero ?></b></h4> 
                                    <h4><b><b>Bairro: </b><?php echo $bairro ?></b></h4>
                                    
                                </div>
                                <img class="fotoConvertida" src="data:image/png;base64,<?php echo $foto ?>">
                            </div>
                            <a href='avaliaLocal.php?id=<?php echo $id_local ?>'>
                                <button class="botao-reserva">Enviar</button>
                            </a>
                        </div>
                    </div>

                <?php
                        }
                    } else {
                        //ENCERRA CONEXÃO COM O BANCO DE DADOS
                        mysqli_close($conn);
                    }
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