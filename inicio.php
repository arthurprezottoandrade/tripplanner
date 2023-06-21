<head>
    <link rel="stylesheet" type="text/css" href="CSS/inicio.css">
    <title>Cadastro Usuário - TripPlanner</title>
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

    <!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
    <div class="w3-main w3-container">
        <div class="w3-panel w3-padding-large w3-card-4 w3-light-dark">

            <title>Filtros</title>
            <style>
            .modal {
                display: none;
                position: fixed;
                visibility: hidden;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .modal.show {
                display: flex;
                visibility: visible;
            }

            .modal-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .modal-content {
                background-color: #fefefe;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                max-height: 80vh;
                overflow-y: auto;
                display: grid;
                grid-template-columns: auto 1px auto;
                align-items: center;
                justify-content: center;
                grid-column-gap: 20px; /* Adiciona um espaçamento de 20px entre as colunas */
            }

            .cidade-filters {
                grid-column: 1 / 2;
            }

            .separator {
                grid-column: 2 / 3;
                margin: 0 10px;
                border-left: 1px solid #ccc;
                height: 100%;
            }

            .local-filters {
                grid-column: 3 / 4;
            }

            .form-grid {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 0px; /* Adiciona um espaçamento de 20px entre as divs */
            }
                        
            .close {
                color: #aaa;
                font-size: 28px;
                font-weight: bold;
                cursor: pointer;
            }

            .center {
            text-align: center;
            position: relative;
            }
            .checkbox-label {
                display: flex;
                align-items: center;
            }

            .brown-button {
            background-color: #5c4033;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transform: translateX(-120%);
            }

            .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 100px;
            }

            .submit-button {
            display: flex;
            justify-content: center;
            }

            .submit-button input[type="submit"] {
            background-color: #5c4033;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            }

            </style>

            <div id="myModal" class="modal">
            <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h2>Selecione as opções:</h2>
                    <span class="close" onclick="closeModal()">&times;</span> 
                </div>
                <div class="form-grid">
                    <div class="cidade-filters">
                    <h3>Cidades</h3>
                    <label for="cidade1" class="checkbox-label">
                        <input type="checkbox" name="cidade1" value="a"> Opção 1
                    </label>
                    <label for="cidade2" class="checkbox-label">
                        <input type="checkbox" name="cidade2" value="b"> Opção 2
                    </label>
                    <label for="cidade3" class="checkbox-label">
                        <input type="checkbox" name="cidade3" value="c"> Opção 3
                    </label>
                    <label for="cidade4" class="checkbox-label">
                        <input type="checkbox" name="cidade4" value="d"> Opção 4
                    </label>
                    <label for="cidade5" class="checkbox-label">
                        <input type="checkbox" name="cidade5" value="e"> Opção 5
                    </label>
                    </div>
                    <div class="separator"></div>
                    <div class="local-filters">
                    <h3>Locais</h3>
                    <label for="local1" class="checkbox-label">
                        <input type="checkbox" name="local1" value="1"> Opção 6
                    </label>
                    <label for="local2" class="checkbox-label">
                        <input type="checkbox" name="local2" value="2"> Opção 7
                    </label>
                    <label for="local3" class="checkbox-label">
                        <input type="checkbox" name="local3" value="3"> Opção 8
                    </label>
                    <label for="local4" class="checkbox-label">
                        <input type="checkbox" name="local4" value="4"> Opção 9
                    </label>
                    <label for="local5" class="checkbox-label">
                        <input type="checkbox" name="local5" value="5"> Opção 10
                    </label>
                    </div>
                </div>
                <br><br>
                <div class="submit-button">
                    <input type="submit" value="Enviar">
                </div>
                </form>
            </div>
            </div>
            <script>
                function openModal() {
                    document.getElementById("myModal").classList.add("show");
                }

                function closeModal() {
                    document.getElementById("myModal").classList.remove("show");
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

                $cidade1 = 'a';
                $cidade2 = 'b';
                $cidade3 = 'c';
                $cidade4 = 'd';
                $cidade5 = 'e';

                $local1 = '1';
                $local2 = '2';
                $local3 = '3';
                $local4 = '4';
                $local5 = '5';


                $sql = "SELECT l.id as Id, l.Nome as Nome, l.rua as Rua, l.numero as Numero, l.bairro as Bairro, l.cidade as Cidade, l.estado as Estado, l.foto as Imagem FROM locais l";

                $cidadeSelecionada = [];
                $localSelecionado = [];
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Armazenar os números selecionados
                    $cidade1 = $_POST['cidade1'] ?? '';
                    $cidade2 = $_POST['cidade2'] ?? '';
                    $cidade3 = $_POST['cidade3'] ?? '';
                    $cidade4 = $_POST['cidade4'] ?? '';
                    $cidade5 = $_POST['cidade5'] ?? '';
                    // ... outros filtros de cidade

                    // Filtros de local
                    $local1 = $_POST['local1'] ?? '';
                    $local2 = $_POST['local2'] ?? '';
                    $local3 = $_POST['local3'] ?? '';
                    $local4 = $_POST['local4'] ?? '';
                    $local5 = $_POST['local5'] ?? '';
    
                    // Fazer o que desejar com as variáveis $opcao1, $opcao2, $opcao3
                    // Neste exemplo, vamos apenas armazená-las em uma variável
                    $cidadeSelecionada = array($cidade1, $cidade2, $cidade3, $cidade4, $cidade5);
                    $localSelecionado = array($local1, $local2, $local3, $local4, $local5);
                       // Verificar se o array está vazio
                    $cidadeSelecionada = array_filter($cidadeSelecionada);
                    $localSelecionado = array_filter($localSelecionado);

                    // Verificar se o array está vazio
                    if (empty($cidadeSelecionada)) {
                        $buscaCidade = ''; // Valor padrão quando todos os valores estão vazios
                    } else {
                        $cidadeSelecionadaQuoted = array_map(function($cidade) {
                            return "'" . $cidade . "'";
                        }, $cidadeSelecionada);
                        $buscaCidade = implode(', ', $cidadeSelecionadaQuoted);
                    }

                    if (empty($localSelecionado)) {
                        $buscaLocal = ''; // Valor padrão quando todos os valores estão vazios
                    } else {
                        $buscaLocal = implode(', ', array_map('intval', $localSelecionado));
                    }


                    if(empty($buscaCidade) && empty($buscaLocal)) {
                        $sql = "SELECT l.id as Id, l.Nome as Nome, l.rua as Rua, l.numero as Numero, l.bairro as Bairro, l.cidade as Cidade, l.estado as Estado, l.foto as Imagem FROM locais l";
                    } else if(empty($buscaCidade)) {
                        $sql = "SELECT l.id as Id, l.Nome as Nome, l.rua as Rua, l.numero as Numero, l.bairro as Bairro, l.cidade as Cidade, l.estado as Estado, l.foto as Imagem FROM locais l where tipopref in ($buscaLocal)";
                    } else if(empty($buscaLocal)) {
                        $sql = "SELECT l.id as Id, l.Nome as Nome, l.rua as Rua, l.numero as Numero, l.bairro as Bairro, l.cidade as Cidade, l.estado as Estado, l.foto as Imagem FROM locais l where cidade in ($buscaCidade)";
                    } else {
                        $sql = "SELECT l.id as Id, l.Nome as Nome, l.rua as Rua, l.numero as Numero, l.bairro as Bairro, l.cidade as Cidade, l.estado as Estado, l.foto as Imagem FROM locais l where cidade in ($buscaCidade) and tipopref in ($buscaLocal)";
                    }
                }
                
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id_local = $row['Id'];
                        $nome = $row['Nome'];
                        $descricao = $row['Descricao'];
                        $cidade = $row['Cidade'];
                        $rua = $row['Rua'];
                        $numero = $row['Numero'];
                        $bairro = $row['Bairro'];
                        $foto = $row['Imagem'];
                        ?>
                        <div class="card">
                            <div class="container">
                                <div class="sub-container">
                                    <img class="fotoConvertida" src="data:image/png;base64,<?php echo $foto ?>">
                                    <div class="fields">
                                        <h4><b><?php echo $nome ?></b></h4>
                                        <h4><b><?php echo $descricao ?></b></h4>
                                        <div class="rating">
                                            <h4>23 Avaliações</h4>
                                        
                                            <span>&#x2606;</span>
                                            <span>&#x2606;</span>
                                            <span>&#x2606;</span>
                                            <span>&#x2606;</span>
                                            <span>&#x2606;</span>
                                        </div>

                                    </div>
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
