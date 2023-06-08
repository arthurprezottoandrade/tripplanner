<!DOCTYPE html>
<html> 
    <head>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">    
        <link rel="stylesheet" type="text/css" href="CSS/reservar.css">
        <title>Reserva de Cachorro - Help Friend</title>
        <link rel="icon" type="image/jpg" href="IMG/logo_icone.jpg"/>
    </head>
    <body>
    <!-- CONEXÃO COM O BANCO DE DADOS -->
    <?php require 'conectaBD.php'; ?>
        <!-- CABEÇALHO -->
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
                </ul>
            </div>
        </header>
        <!-- LINHA DE DIVISÃO -->
        <header class="linha-divisao"></header>
        <div>
            <div>
                <!-- ACESSO AO BANCO DE DADOS-->
                <?php
                    //Pega o id do cachorro que foi selecionado para reservar		
                    $id=$_GET['id'];

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

                    // Faz Select na Base de Dados

                    $sql = "SELECT Id, email, Nome, Senha from adotante where Id = '$id'";

                    if ($result = mysqli_query($conn, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['Id'];
                                $nome = $row['nome'];
                                $senha = $row['Senha'];
                        }
                    }
                ?>
                <!-- FORMULÁRIO -->
                <div class="formconfirma">
                    <form id="cadastro" action="reservaCachorro_exe.php" method="post" onsubmit="return check(this.form)" enctype="multipart/form-data">
                        <input type="hidden" id="Id" name="Id" value="<?php echo $id; ?>">  
                        <div class="form">
                            <label for="text" class="titulo-form" ><b>CONFIRMAÇÃO DE LOGIN</b></label>
                            <!-- ARRUMAR ESTÁ LABEL -->
                            <label class="invisivel">
                                <input type="text" name="id_cachorro" value="<?php echo $id; ?>">
                            </label>
                            <label class="label" for="name"> Nome 
                                <input type="text" name="nome" value="<?php echo $nome; ?>">
                            </label>
                            <label class="label" for="password"> Senha 
                                <input type="password" name="senha" value="<?php echo $senha; ?>">
                            </label>
                            <label class="label" for="submit"> 
                                <button class="botao-confirma" type="submit" style="max-width: 125px"><b>Confirmar</b></button>
                            </label>
                            <label class="label2" > Não possui uma conta?
                                <a class="a-cadastro" href="cadastroAdotante.php" for="submit">Crie uma!</a>
                            </label>
                        </div>
                    </form>
                <?php     
                        
                    }else {
                        echo "Erro executando UPDATE: " . mysqli_error($conn);
                    }
                    //FIM DA DIV FORM
                    echo "</div>";
                    //ENCERRA CONEXÃO COM O BANCO DE DADOS
                    mysqli_close($conn); //Encerra conexao com o BD
                ?>
                </div>
            </div>
        </div>
        <!-- RODAPÉ -->
        <footer>
            <header class="linha-divisao"></header>
            <img class="img-rodape" src="IMG/logo_verticalpng.png">
            <p class="copyright" style="text-align: center;">&copy; Copyright Help Friend - 2022</p>
        </footer>
    </body>
</html>