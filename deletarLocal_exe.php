<html>    
    <head>
    <link rel="stylesheet" type="text/css" href="CSS/inicio.css">
    <title>Deletar Local - TripPlanner</title>
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

	<body>
		<!-- CONEXÃO COM O BANCO DE DADOS -->
		<?php require 'conectaBD.php'; ?>

		<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
		<div class="w3-main w3-container" style="margin-left:10px;margin-top:40px;">

			<!-- Retângulo de Exclusão -->
			<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
			<h1 class="w3-xxlarge">Exclusão de Locais</h1>

			<p class="w3-large">
				<div class="w3-code cssHigh notranslate">
				<!-- Acesso em:-->
					<?php

					date_default_timezone_set("America/Sao_Paulo");
					$data = date("d/m/Y H:i:s",time());
					echo "<p class='w3-small' > ";
					echo "Acesso em: ";
					echo $data;
					echo "</p> "
					?>

					<!-- Acesso ao BD-->
					<?php
								
						// Cria conexão
						$conn = mysqli_connect($servername, $username, $password, $database);

						// ID do registro a ser excluído
						$id = $_POST['Id'];

						// Verifica conexão
						if (!$conn) {
							die("Connection failed: " . mysqli_connect_error());
						}

						// Faz DELETE na Base de Dados
						$sql = "DELETE FROM cachorro WHERE Id = $id";

						echo "<div id='resultado'>";
						if ($result = mysqli_query($conn, $sql)) {
								echo "Um cachorro excluído!";
						} else {
							echo "Erro executando DELETE: " . mysqli_error($conn);
						}
						echo "</div>";
						mysqli_close($conn);  //Encerra conexao com o BD

					?>
				</div>
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