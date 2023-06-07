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
                </ul>
            </div>
        </header>
        <!-- LINHA DE DIVISÃO -->
        <header class="linha-divisao"></header>

        <!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
        <div class="w3-main w3-container">

            <div class="w3-panel w3-padding-large w3-card-4 w3-light-dark">
                <h2 class="w3-xxlarge"style="text-align: center">Seu novo melhor amigo está aqui</h2>

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
                    $sql = "SELECT c.id as Id, c.Nome as Nome, r.Nome as Raca, c.Ano_nascimento as Ano_nascimento, c.Porte as Porte, c.Imagem as Imagem FROM cachorro c, raca r where c.Id_Raca = r.Id and c.Apto = 'on' and (Adotado = '' or Adotado = 'off')";

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = $result -> fetch_assoc()) {
                            $id_cachorro = $row['Id'];
                            $nome      = $row['Nome'];
                            $porte      = $row['Porte'];
                            $Ano_Nascimento  = $row['Ano_nascimento'];
                            $raca  = $row['Raca'];
                            $foto = $row['Imagem'];
                ?>

                    <div class="card">
                        <div class="container">
                            <div class="sub-container" style="display:flex;">
                                <div class="fields">
                                    <h4><b><b>Id: </b><?php echo $id_cachorro ?></b></h4> 
                                    <h4><b><b>Nome: </b><?php echo $nome ?></b></h4> 
                                    <h4><b><b>Porte: </b><?php echo $porte ?></b></h4> 
                                    <h4><b><b>Ano Nascimento: </b><?php echo $Ano_Nascimento ?></b></h4> 
                                    <h4><b><b>Raça: </b><?php echo $raca ?></b></h4>
                                </div>
                                <img class="fotoConvertida" src="data:image/png;base64,<?php echo $foto ?>">
                            </div>
                            <a href='reservaCachorro.php?id=<?php echo $id_cachorro ?>'>
                                <button class="botao-reserva">Reservar</button>
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
            <p class="copyright">&copy; Copyright Help Friend - 2022</p>
        </footer>
    </body>
</html>