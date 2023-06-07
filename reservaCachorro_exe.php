<html>
	<head>
	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" type="text/css" href="CSS/reservar.css"/>
      <link rel="icon" type="image/jpg" href="IMG/logo_icone.jpg"/>
      <title>Reserva de Cachorro - Help Friend</title>
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
                </ul>
            </div>
    </header>
    <header class="linha-divisao"></header>
    <body>
        <div class="w3-main w3-container" style="margin-left:10px;margin-top:117px;">

            <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
                <h1 class="w3-xxlarge">Reserva de Cachorro</h1>

                    <p class="w3-large">
                        <div class="w3-code cssHigh notranslate">
                            <?php require 'conectaBD.php'; ?>
                            <?php
                                $id_cachorro =  $_POST['id_cachorro'];
                                $nome = $_POST['nome'];
                                $senha = $_POST['senha'];

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

                                $sql = "SELECT Id FROM adotante WHERE Nome = '$nome' AND Senha = '$senha'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id_adotante = $row['Id'];
                                 
                                $reservar = "INSERT into reserva(id_adotante, id_cachorro, status) values ('$id_adotante','$id_cachorro','Reservado')";
                                $confirmaReserva = "UPDATE cachorro SET Apto = '' WHERE Id = '$id_cachorro'";
                                    }
                                }
                                // Faz o Upadate na Base de Dados
                                
                                if (mysqli_num_rows($result) > 0) {
                                    $result2 = mysqli_query($conn, $reservar);
                                    $result3 = mysqli_query($conn, $confirmaReserva);
                                    echo "Cachorro Reservado";
                                    if(!$conn){
                                        echo "Erro executando a reserva: " . mysqli_error($conn);
                                    }
                                } else if (mysqli_num_rows($result) == 0){
                                    echo "O cadastro não existe no banco";
                                } else {
                                    echo "Erro executando a reserva: " . mysqli_error($conn);
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
            <p class="copyright">&copy; Copyright Help Friend - 2022</p>
        </footer>
    </body>
</html>