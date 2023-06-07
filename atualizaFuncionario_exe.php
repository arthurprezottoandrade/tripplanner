
<html>
	<head>
	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" type="text/css" href="CSS/atualizar.css"/>
      <link rel="icon" type="image/jpg" href="IMG/logo_icone.jpg"/>
      <title>Atualização de Funcionário - Help Friend</title>
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
						<a href="mostrarFuncionario.php" >
							<h3>MOSTRAR FUNCIONARIO</h3>
						</a>
					</li>
                </ul>
            </div>
    </header>
    <header class="linha-divisao"></header>
    <body>
        <div class="w3-main w3-container" style="margin-left:10px;margin-top:117px;">

            <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
                <h1 class="w3-xxlarge">Atualização de Funcionários</h1>

                    <p class="w3-large">
                        <div class="w3-code cssHigh notranslate">
                            <?php require 'conectaBD.php'; ?>
                            <?php
                                $id =  $_POST['Id'];
                                $nome    = $_POST['nome'];
                                $senha = $_POST['senha'];
                                $cpf = $_POST['cpf'];
                                $cargo = $_POST['cargo'];
                                $telefone = $_POST['telefone'];
                                $id_email = $_POST['email'];
                                $id_instituicao = $_POST['id_instituicao'];

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

                                $sql = "UPDATE funcionario SET Nome = '$nome', Senha = '$senha', cpf = '$cpf', Cargo = '$cargo', email = '$id_email', Id_Instituicao = '$id_instituicao' WHERE Id = $id";

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
            <p class="copyright">&copy; Copyright Help Friend - 2022</p>
        </footer>
    </body>
</html>