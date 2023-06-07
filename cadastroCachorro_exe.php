<html>
    <head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="CSS/cadastro.css">
    <title>Cadastro de Cachorro - Help Friend</title>
    <link rel="icon" type="image/jpg" href="IMG/logo_icone.jpg"/>
    </head>
    <body>
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
                    <li>
                    <a href="mostrarCachorro.php">
                        <h3>MOSTRAR CACHORROS</h3>
                    </a>
                </li>
                </ul>
            </div>
        </header>
        <header class="linha-divisao"></header>

        <!-- Retângulo Principal: deslocado em 270 pixels para direita quando é visível -->
        <div class="w3-main w3-container">

            <!-- Borda do Retângulo Principal -->
            <div class="w3-panel w3-padding-large w3-card-4 w3-light-brown">
    
                <h1>Registro de Cachorros</h1>
                <?php require 'conectaBD.php'; ?>

                <?php
                    $nome    = $_POST['nome'];
                    $apelido = $_POST['apelido'];
                    $ano = $_POST['ano'];
                    $porte = $_POST['porte'];
                    $raca = $_POST['raca'];
                    $id_instituicao = $_POST['id_instituicao'];
                    $apto = $_POST['apto'];

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
                        // Inserindo 
                        $sql = "INSERT INTO cachorro(Nome, Ano_Nascimento, Porte, Id_Raca, Id_Instituicao, Adotado, Apto, apelido, Imagem) VALUES ('$nome','$ano', '$porte','$raca','$id_instituicao', '', '$apto', '$apelido', '$image_base64')";
                        } 
                    } else {
                        $sql = "INSERT INTO cachorro(Nome, Ano_Nascimento, Porte, Id_Raca, Id_Instituicao, Adotado, apelido, Apto) VALUES ('$nome','$ano', '$porte','$raca','$id_instituicao', '','$apelido', '$apto')";
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

                    // Faz Select na Base de Dados
                    echo "<div class='w3-responsive w3-card-4'>";
                    if ($result = mysqli_query($conn, $sql)) {
                        echo "Um registro adicionado!";
                    } else {
                        echo "Erro executando INSERT: " . mysqli_error($conn);
                    }
                    echo "</div>";
                    mysqli_close($conn);
                ?>
     
     </div>
        </div>
	</body>
</html>

