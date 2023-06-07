<!DOCTYPE html>
<html> 
    <head>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">    
        <link rel="stylesheet" type="text/css" href="CSS/atualizar.css">
        <title>Atualização de Funcionário - Help Friend</title>
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

                    $sql = "SELECT Id, Nome, Senha, cpf, cargo, Id_Instituicao, email from funcionario where Id = $id";

                    if ($result = mysqli_query($conn, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $id = $row['Id'];
                                $nome      = $row['Nome'];
                                $senha      = $row['Senha'];
                                $cpf  = $row['cpf'];
                                $cargo  = $row['cargo'];
                                $id_instituicao  = $row['Id_Instituicao'];
                                $id_email = $row['email'];
                        }
                    }
                ?>
                <!-- FORMULÁRIO -->
                <div class="formatualiza">
                    <form id="cadastro" action="atualizaFuncionario_exe.php" method="post" onsubmit="return check(this.form)" enctype="multipart/form-data">
                    <input type="hidden" id="Id" name="Id" value="<?php echo $id; ?>">  
                    <div class="form">
                            <label for="text" class="titulo-form" ><b>ATUALIZAÇÃO DE FUNCIONÁRIO</b></label>
                            <label for="name"> Nome 
                                <input type="text" name="nome" value="<?php echo $nome; ?>" required>
                            </label>
                            <label for="email">Email 
                                <input type="text" name="email" value="<?php echo $id_email; ?>" required>
                            </label>

                            <label for="password"> Senha 
                                <input type="password" name="senha" value="<?php echo $senha; ?>" required>
                            </label>

                            <label for="number"> CPF
                                <input type="number" name="cpf" value="<?php echo $cpf; ?>" required>
                            </label>

                            <label for="name"> Cargo 
                                <input type="text" name="cargo" value="<?php echo $cargo; ?>" required>
                            </label>

                            <label for="name"> ID Instituição 
                                <input type="text" name="id_instituicao" value="<?php echo $id_instituicao; ?>" required>
                            </label>

                            <label for="submit"> 
                                <button class="botao-atualiza" type="submit"><b>Atualizar</b></button>
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
        <!-- RODAPÉ -->
        <footer>
            <header class="linha-divisao"></header>
            <img class="img-rodape" src="IMG/logo_verticalpng.png">
            <p class="copyright" style="text-align: center;">&copy; Copyright Help Friend - 2022</p>
        </footer>
    </body>
</html>