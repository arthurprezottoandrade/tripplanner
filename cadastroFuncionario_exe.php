<html>
	<head>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="CSS/cadastro.css">
		<title>Cadastro de Funcionário - Help Friend</title>
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
						<a href="" >
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

		<!-- Retângulo Principal: deslocado em 270 pixels para direita quando é visível -->
		<div class="w3-main w3-container">

			<!-- Borda do Retângulo Principal -->
			<div class="w3-panel w3-padding-large w3-card-4 w3-light-brown">

				<h1>Registro de Funcionario</h1>
				<?php require 'conectaBD.php'; ?>
				
				<?php
					$nome    = $_POST['nome'];
					$email = $_POST['email'];
					$senha = $_POST['senha'];
					$cpf = $_POST['cpf'];
					$cargo = $_POST['cargo'];
					$telefone = $_POST['telefone'];
					$id_instituicao = $_POST['id'];
					$idade = $_POST['idade'];
					$salario = $_POST['salario'];

					$sql = "INSERT INTO funcionario(Nome, email, Senha,Id_Instituicao,cargo,cpf,idade,salario) VALUES ('$nome','$email', '$senha','$id_instituicao','$cargo','$cpf','$idade','$salario')";

					// Cria conexão
					$conn = mysqli_connect($servername, $username, $password, $database);

					// Verifica conexão 
					if (!$conn) {
						echo "</table>";
						echo "</div>";
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
					mysqli_close($conn);  //Encerra conexao com o BD
				?>
			</div>
		</div>
	</body>
</html>
