<html>
    <head>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="CSS/cadastro.css">
    <title>Cadastro Adotante - Help Friend</title>
    <link rel="icon" type="image/jpg" href="IMG/logo_icone.jpg"/>

    </head>
	<header class="cabecalho">
        <div>
            <img class="logo" src="IMG/logopng.png"/>
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
    <body>
	
        <!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
        <div class="w3-main w3-container">

            <div class="w3-panel w3-padding-large w3-card-4 w3-light-brown">
        
                <h1>Registro do Adotante</h1>
                <?php require 'conectaBD.php'; ?>
                
                <?php
                            //dados que vao ser alocados na tabela adotante
                            $Nome    = $_POST['nome'];
                            $Senha = $_POST['senha'];
                            $Cpf = $_POST['cpf'];
                            $email = $_POST['email'];
            

                            //dados que vao ser alocados na tabela endereco
                            //id nao esta auto incement deve ser arrumado no banco
                            $Bairro = $_POST['bairro'];
                            $Cidade = $_POST['cidade'];
                            $Estado = $_POST['estado'];
                            $Logradouro = $_POST['logradouro'];
                            $Numero = $_POST['numero'];
                            $Complemento = $_POST['complemento'];

                            $sql = "INSERT INTO endereco(Bairro, Cidade, Estado,Logradouro,Numero,Complemento) 
                            VALUES ('$Bairro','$Cidade', '$Estado','$Logradouro','$Numero','$Complemento')";

                
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
                            echo "<div class='w3-responsive w3-card-4'>";

                            //inserindo na tabela endereco e pegando a id
                            if ($conn->query($sql) === TRUE) {
                                //armazenando a id do endereco
                                $id_endereco = $conn->insert_id;
                                
                                $sql = "INSERT INTO adotante(Nome, Senha, Cpf,id_endereco,email) 
                                VALUES ('$Nome','$Senha', '$Cpf','$id_endereco','$email')";
                                
                                if ($conn->query($sql) === TRUE) {
                                    echo "Adotante Adicionado com sucesso";
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }

                            } else {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }

                            $conn->close();

                    ?>
            </div>
        </div>
	</body>
</html>

 