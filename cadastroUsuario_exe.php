<html>    
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
    <header class="linha-divisao"></header>

    <!-- Retângulo Principal: deslocado em 270 pixels para direita quando é visível -->
    <div class="w3-main w3-container" style="margin-left:10px;margin-top:50px;">

        <!-- Borda do Retângulo Principal -->
        <div class="w3-panel w3-padding-large w3-card-4 w3-light-brown">
            <h1>Registro de Usuario</h1>
            <?php require 'conectaBD.php'; ?>

            <?php
                $nome = $_POST['nome'];
                $sobrenome = $_POST['sobrenome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                


       
                $sql = "INSERT INTO usuario (nome, sobrenome, email, senha) VALUES ('$nome', '$sobrenome', '$email', '$senha')";
                

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

                // Executa o INSERT na base de dados
                echo "<div class='w3-responsive w3-card-4'>";
                if (mysqli_query($conn, $sql)) {
                    echo "Um registro adicionado!";
                } else {
                    echo "Erro executando INSERT: " . mysqli_error($conn);
                }
                echo "</div>";

                mysqli_close($conn);
            ?>
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
