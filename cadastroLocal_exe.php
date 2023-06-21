<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="CSS/cadastro.css">
    <title>Cadastro de Local - TripPlanner</title>
    <link rel="icon" type="image/jpg" href="IMG/logo_transparente.png"/>
</head>
<body>
    <header class="cabecalho">
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
            <img class="logo" src="IMG/logo_horizontal.png"/>
        </div>

        <div class="botao-cabecalho">
            <ul>
                <li>
                    <a href="inicio.php">
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

    <header class="linha-divisao"></header>

    <!-- Retângulo Principal: deslocado em 270 pixels para direita quando é visível -->
    <div class="w3-main w3-container"  style="margin-left:10px;margin-top:90px;">

        <!-- Borda do Retângulo Principal -->
        <div class="w3-panel w3-padding-large w3-card-4 w3-light-brown">
            <h1>Registro de Locais</h1>
            <?php require 'conectaBD.php'; ?>

            <?php
                $nome = $_POST['nome'];
                $rua = $_POST['rua'];
                $numero = $_POST['numero'];
                $bairro = $_POST['bairro'];
                $cidade = $_POST['cidade'];
                $preferencia = $_POST['preferencia'];
                $descricao = $_POST['descricao'];

                $name = $_FILES['Imagem']['name'];
                $target_dir = "IMG/";
                $target_file = $target_dir . basename($_FILES["Imagem"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $extensions_arr = array("jpg", "jpeg", "png", "gif");

                if (in_array($imageFileType, $extensions_arr)) {
                    // Upload do arquivo
                    if (move_uploaded_file($_FILES['Imagem']['tmp_name'], $target_dir . $name)) {
                        // Convertendo para base64
                        $image_base64 = base64_encode(file_get_contents('IMG/' . $name));
                        // Inserindo 
                        $sql = "INSERT INTO locais (nome, rua, numero, bairro, cidade, foto, tipopref, descricao) VALUES ('$nome', '$rua', '$numero', '$bairro', '$cidade', '$image_base64', '$preferencia', '$descricao')";
                    }
                } else {
                    $sql = "INSERT INTO locais (nome, rua, numero, bairro, cidade, tipopref, descricao) VALUES ('$nome', '$rua', '$numero', '$bairro', '$cidade', '$preferencia', '$descricao')";
                }

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
    <footer>
        <header class="linha-divisao"></header>
        <img class="img-rodape" src="IMG/logo_principal.png">
        <p class="copyright">&copy; Copyright TripPlanner - 2023</p>
    </footer>
</body>
</html>
