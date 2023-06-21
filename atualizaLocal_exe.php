<html>    
    <head>
    <link rel="stylesheet" type="text/css" href="CSS/inicio.css">
    <title>Atualizar Local - TripPlanner</title>
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
    <header class="linha-divisao"></header>
    <body>
        <div class="w3-main w3-container" style="margin-left:10px;margin-top:60px;">

            <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
                <h1 class="w3-xxlarge">Atualização de Local</h1>

                    <p class="w3-large">
                        <div class="w3-code cssHigh notranslate">

                            <?php require 'conectaBD.php'; ?>
                            <?php

                                $id = $_POST['id'];
                                $nome      = $_POST['nome'];
                                $descricao  = $_POST['descricao'];
                                $rua      = $_POST['rua'];
                                $numero  = $_POST['numero'];
                                $bairro  = $_POST['bairro'];
                                $cidade = $_POST['cidade'];
                                $Imagem = $_POST['Imagem'];

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

                                $name = $_FILES['Imagem']['name'];
                                $target_dir = "IMG/";
                                $target_file = $target_dir . basename($_FILES["Imagem"]["name"]);
                                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                                $extensions_arr = array("jpg","jpeg","png","gif");
                            
                                if( in_array($imageFileType,$extensions_arr) ){

                                // Upload do arquivo
                                    if(move_uploaded_file($_FILES['Imagem']['tmp_name'],$target_dir.$name)){
                                        // Convertendo para base 64
                                        $image_base64 = base64_encode(file_get_contents('IMG/'.$name) );
                                        $imagem = 'data:image/'.$imageFileType.';base64,'.$image_base64;
                                        // Inserindo 
                                        $sql = "UPDATE locais SET nome = '$nome', descricao = '$descricao', rua = '$rua', numero = '$numero' , bairro = '$bairro', cidade = '$cidade', foto = '$image_base64' WHERE id = '$id'";
                                    }
                                } else {
                                    $sql = "UPDATE locais SET nome = '$nome', descricao = '$descricao', rua = '$rua', numero = '$numero' , bairro = '$bairro', cidade = '$cidade' WHERE id = '$id'";
                                }
                                
                                // Faz o Upadate na Base de Dados
                                echo "<div id='resultado'>";
                                if ($result = mysqli_query($conn, $sql)) {
                                    echo "Um registro atualizado!";
                                } else {
                                    echo "Erro executando a atualização: " . mysqli_error($conn);
                                }
                                echo "</div>";
                                mysqli_close($conn);  //Encerra conexao com o BD


                            ?>
                        </div>
                    </p>
            </div>
        </div>
        <footer>
            <header class="linha-divisao"></header>
            <img class="img-rodape" src="IMG/logo_principal.png">
            <p class="Copyright">&copy; Copyright TripPlanner - 2023</p>
        </footer>
    </body>
</html>
