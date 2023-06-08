<html>
	<head>
	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" type="text/css" href="CSS/atualizar.css"/>
      <link rel="icon" type="image/jpg" href="IMG/logo_icone.jpg"/>
      <title>Atualização de Local - Tripp Planner</title>
	</head>
    <header class="cabecalho">
        <div>
            <img class="logo" src="IMG/logopng.png"/>
        </div>
        <div class="botao-cabecalho">
            <ul>
                <li><a href="">
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
                        <h3>MOSTRAR LOCAIS</h3>
                    </a>
                </li>
            </ul>
        </div>
    </header>
    <header class="linha-divisao"></header>
    <body>
        <div class="w3-main w3-container" style="margin-left:10px;margin-top:117px;">

            <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
                <h1 class="w3-xxlarge">Atualização de Local</h1>

                    <p class="w3-large">
                        <div class="w3-code cssHigh notranslate">

                            <?php require 'conectaBD.php'; ?>
                            <?php
                                $id =  $_POST['Id'];
                                $nome    = $_POST['nome'];
                                $apelido    = $_POST['apelido'];
                                $ano = $_POST['ano'];
                                $porte = $_POST['porte'];
                                $raca = $_POST['raca'];
                                $apto = $_POST['apto'];
                                $adotado = $_POST['adotado'];

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
                                        $sql = "UPDATE cachorro SET Nome = '$nome', apelido = '$apelido', Ano_Nascimento = '$ano', Porte = '$porte' , Id_Raca = '$raca', Adotado = '$adotado', Apto = '$apto', Imagem = '$image_base64' WHERE Id = '$id'";
                                    }
                                } else {
                                    $sql = "UPDATE cachorro SET Nome = '$nome', apelido = '$apelido', Ano_Nascimento = '$ano', Porte = '$porte' , Id_Raca = '$raca', Adotado = '$adotado', Apto = '$apto' WHERE Id = '$id'";
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
            <img class="img-rodape" src="IMG/logo_verticalpng.png">
            <p class="copyright">&copy; Copyright Tripp Planner - 2023</p>
        </footer>
    </body>
</html>