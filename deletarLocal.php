<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" type="text/css" href="CSS/deletar.css"/>
		<link rel="icon" type="image/jpg" href="IMG/logo_transparente.png"/>
		<title>Exclusão de Local - TripPlanner</title>
	</head>
	<!-- CABEÇALHO -->
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
			</ul>
		</div>
	</header>
	<!-- LINHA DE DIVISÃO -->
	<header class="linha-divisao"></header>

	<body>
		<!-- CONEXÃO COM O BANCO DE DADOS -->
		<?php require 'conectaBD.php'; ?>

		<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
		<div class="w3-main w3-container">

			<!-- Retângulo de Exclusão -->
			<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
				<h1 class="w3-xxlarge">Exclusão de Local</h1>

				<p class="w3-large">
					<div class="w3-code cssHigh notranslate">
						<!-- Acesso em:-->
						<?php

						date_default_timezone_set("America/Sao_Paulo");
						$data = date("d/m/Y H:i:s", time());
						echo "<p class='w3-small' > ";
						echo "Acesso em: ";
						echo $data;
						echo "</p> "
						?>

						<!-- Acesso ao BD-->
						<?php
			
						// Cria conexão
						$conn = mysqli_connect($servername, $username, $password, $database);

						// Verifica conexão
						if (!$conn) {
							die("Connection failed: " . mysqli_connect_error());
						}
						// Configura para trabalhar com caracteres acentuados do português
						mysqli_query($conn,"SET NAMES 'utf8'");
						mysqli_query($conn,'SET character_set_connection=utf8');
						mysqli_query($conn,'SET character_set_client=utf8');
						mysqli_query($conn,'SET character_set_results=utf8');

						$id=$_GET['id'];
						
						// Faz Select na Base de Dados
						$sql = "SELECT l.id,l.nome,l.descricao,l.rua,l.numero,l.bairro,l.cidade,l.estado FROM locais l where l.id = $id";
						echo "<div class='w3-responsive w3-card-4'>"; //Inicio form
						if ($result = mysqli_query($conn, $sql)) {
								if (mysqli_num_rows($result) > 0) {
								// Apresenta cada linha da tabela
									while ($row = mysqli_fetch_assoc($result)) {
										
						?>
										<!-- Título de Cachorro específico em 20px para a direita -->
										<div class="w3-theme">
											<h2>ID do Local: <?php echo $row['Id']; ?></h2>
										</div>
										<form class="w3-container" action="deletarLocal_exe.php" method="post" onsubmit="return check(this.form)">
											<input type="hidden" id="Id" name="id" value="<?php echo $row['id']; ?>">
											<p>
											<label class="label_exclusao"><b>Nome: </b> <?php echo $row['nome']; ?> </label></p>
											<p>
											<label class="label_exclusao"><b>Descrição: </b><?php echo $row['descricao']; ?></label></p>
											<p>
											<label class="label_exclusao"><b>Rua: </b><?php echo $row['rua'] ?></label></p>
											<p>
											<label class="label_exclusao"><b>Numero: </b><?php echo $row['numero']; ?></label></p>
											<p>
											<input type="submit" value="Excluir" class="w3-btn w3-red" >
											<input type="button" value="Cancelar" class="w3-btn" onclick="window.location.href='mostrarLocal.php'"></p>
										</form>
					<?php 
									}
								}
						}
						else {
							echo "Erro executando DELETE: " . mysqli_error($conn);
						}
						echo "</div>"; //Fim form
						mysqli_close($conn);  //Encerra conexao com o BD

					?>

					</div>
				</p>
			</div>
		<!-- FIM PRINCIPAL -->
		</div>
		<!-- RODAPÉ -->
		<footer>
			<header class="linha-divisao"></header>
			<img class="img-rodape" src="IMG/logo_principal.png">
			<p class="copyright">&copy; Copyright TripPlanner - 2023</p>
		</footer>
	</body>
</html>
