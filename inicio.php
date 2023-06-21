<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="CSS/inicio.css">
    <title>TripPlanner</title>
    <link rel="icon" type="image/jpg" href="IMG/logo_transparente.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

</head>
<body>
    <!-- CONEXÃO COM O BANCO DE DADOS -->
    <?php require 'conectaBD.php'; ?>
    <!-- CABEÇALHO -->
    <header class="cabecalho">
        <div class="menu-btn" onclick="toggleMenu()">MENU</div>
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

        <img class="logo" src="IMG/logo_horizontal.png"/>

        <div class="botao-cabecalho">
            <ul>
                <li><a href=""><h3>MENU</h3></a></li>
                <li><a href=""><h3>SOBRE</h3></a></li>
                <li><a href=""><h3>CONTATO</h3></a></li>
            </ul>
        </div>
    </header>

    <!-- LINHA DE DIVISÃO -->
    <header class="linha-divisao"></header>

    <!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
    <div class="w3-main w3-container">
        <div class="w3-panel w3-padding-large w3-card-4 w3-light-dark">




            <title>Filtros</title>
            <style>
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.4);
            }

            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
            }

            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
                cursor: pointer;
            }

            .center {
                text-align: center;
            }

            .brown-button {
                background-color: brown;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                font-size: 16px;
                cursor: pointer;
            }
            </style>
            <div class="center">
                <button class="brown-button" onclick="openModal()">Filtros</button>
            </div>

            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <form method="POST">
                        <h2>Selecione as opções:</h2>
                        <label for="opcao1">
                            <input type="checkbox" name="opcao1" value="1"> Opção 1
                        </label>
                        <br>
                        <label for="opcao2">
                            <input type="checkbox" name="opcao2" value="2"> Opção 2
                        </label>
                        <br>
                        <label for="opcao3">
                            <input type="checkbox" name="opcao3" value="3"> Opção 3
                        </label>
                        <br><br>
                        <input type="submit" value="Enviar">
                    </form>
                </div>
            </div>

            <script>
                function openModal() {
                    document.getElementById("myModal").style.display = "block";
                }

                function closeModal() {
                    document.getElementById("myModal").style.display = "none";
                }
            </script>
        </body>
        </html>



            <h2 class="w3-xxlarge" style="text-align: center">Ajudamos você a encontrar sua próxima viagem!</h2>

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
                mysqli_query($conn, "SET NAMES 'utf8'");
                mysqli_query($conn, 'SET character_set_connection=utf8');
                mysqli_query($conn, 'SET character_set_client=utf8');
                mysqli_query($conn, 'SET character_set_results=utf8');

                // Faz Select na Base de Dados

                $opcao1 = '';
                $opcao2 = '';
                $opcao3 = '';

                $sql = "SELECT l.id as Id, l.Nome as Nome, l.rua as Rua, l.numero as Numero, l.bairro as Bairro, l.cidade as Cidade, l.estado as Estado, l.foto as Imagem FROM locais l";

    
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Armazenar os números selecionados
                    $opcao1 = $_POST[1] ?? '';
                    $opcao2 = $_POST[2] ?? '';
                    $opcao3 = $_POST[3] ?? '';
    
                    // Fazer o que desejar com as variáveis $opcao1, $opcao2, $opcao3
                    // Neste exemplo, vamos apenas armazená-las em uma variável
                    $opcoesSelecionadas = array($opcao1, $opcao2, $opcao3);
                    
                    $sql = "SELECT l.id as Id, l.Nome as Nome, l.rua as Rua, l.numero as Numero, l.bairro as Bairro, l.cidade as Cidade, l.estado as Estado, l.foto as Imagem FROM locais l where tipopref in ($opcoesSelecionadas)";

                    
                }
                
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id_local = $row['Id'];
                        $nome = $row['Nome'];
                        $cidade = $row['Cidade'];
                        $rua = $row['Rua'];
                        $numero = $row['Numero'];
                        $bairro = $row['Bairro'];
                        $foto = $row['Imagem'];
                        ?>
                        <div class="card">
                            <div class="container">
                                <div class="sub-container">
                                    <div class="fields">
                                        <h4><b>Nome: <?php echo $nome ?></b></h4>
                                        <h4><b>Cidade: <?php echo $cidade ?></b></h4>
                                        <h4><b>Rua: <?php echo $rua ?></b></h4>
                                        <h4><b>Numero: <?php echo $numero ?></b></h4>
                                        <h4><b>Bairro: <?php echo $bairro ?></b></h4>
                                    </div>
                                    <img class="fotoConvertida" src="data:image/png;base64,<?php echo $foto ?>">
                                </div>
                                <a href='avaliaLocal.php?id=<?php echo $id_local ?>'>
                                    <button class="botao-visitado">Marcar local como visitado</button>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    // ENCERRA CONEXÃO COM O BANCO DE DADOS
                    mysqli_close($conn);
                }
                ?>
            </div>
        </div>
    </div>

    <!-- RODAPÉ -->
    <footer>
        <!-- LINHA DE DIVISÃO -->
        <header class="linha-divisao"></header>
        <img class="img-rodape" src="IMG/logo_principal.png">
        <p class="copyright">&copy; Copyright TripPlanner - 2023</p>
    </footer>
</body>
</html>
