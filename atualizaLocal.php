<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href="CSS/atualizar.css">
        <title>Atualização de Usuário - Tripp Planner</title>
        <link rel="icon" type="image/jpg" href="IMG/logo_icone.jpg"/>
    </head>
    <body>
    <!-- CONEXÃO COM O BANCO DE DADOS -->
    <?php require 'conectaBD.php'; ?>
        <!-- CABEÇALHO -->
        <header class="cabecalho">
        <style>
                /* Estilos para o botão e o menu */
                .menu-btn {
                    position: fixed;
                    top: 2%;
                    right: 0;
                    transform: translate(-50%, -50%);
                    background-color: #f1f1f1;
                    cursor: pointer;
                }
                
                .menu {
                    position: fixed;
                    top: 50%;
                    right: -15%; /* Inicialmente, o menu estará oculto */
                    width: 300px;
                    padding: 10px;
                    border-radius: 185%;
                    transition: right 0.7s;
                }
                
                .menu a {
                    display: block;
                    margin-bottom: 5%;
                }

            </style>

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

                $sql = "SELECT l.id, l.nome, l.descricao, l.rua, l.numero, l.bairro, l.cidade, l.foto FROM locais l where l.id = $id";

        

            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id_local = $row['id'];
                        $nome      = $row['nome'];
                        $descricao      = $row['descricao'];
                        $rua      = $row['rua'];
                        $numero  = $row['numero'];
                        $bairro  = $row['bairro'];
                        $cidade = $row['cidade'];
                        $foto = $row['foto'];
                    
                    }
                }
            ?>
            <!-- FORMULÁRIO -->
            <div class="formatualiza">
                <form id="cadastro" action="atualizaLocal_exe.php" method="post" onsubmit="return check(this.form)" enctype="multipart/form-data">
                    <input type="hidden" id="Id" name="id" value="<?php echo $id_local; ?>">
                    <div class="form">
                        <label for="text" style="color: black;"><b>ATUALIZAÇÃO DE local</b></label>
                        <label for="name"> Nome 
                            <input type="text" name="nome" value="<?php echo $nome; ?>">
                        </label>
                        <label for="name"> descricao 
                            <input type="text" name="descricao" value="<?php echo $descricao; ?>">
                        </label>
                        <label for="name"> Rua
                            <input type="text" name="rua" value="<?php echo $rua; ?>">
                        </label>
                        <label for="name"> numero 
                            <input type="text" name="numero" value="<?php echo $numero; ?>">
                        </label>
                        <label for="name"> bairro 
                            <input type="text" name="bairro" value="<?php echo $bairro; ?>">
                        </label>
                        <label for="name"> cidade 
                            <input type="text" name="cidade" value="<?php echo $cidade; ?>">
                        </label>
                        <p>
                            <label class="w3-text-deep-brown"><b>Imagem:</b></label>
                            <label class="w3-btn w3-theme"><b>Selecione uma imagem</b>
                            <input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
                            <input type="file" style="display:none;background-color:brown;" id="Imagem" name="Imagem" accept="imagem/*" onchange="previewImagem();"></label>
                        </p>
                        <img id="imgCamp" src="data:image/png;base64,<?php echo $foto ?>" style="width:20vw;height:20vw;">
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                        <script>
                            function previewImagem(){
                                var imagem = document.querySelector('input[name=Imagem]').files[0];
                                var preview = document.getElementById('imgCamp');

                                var reader = new FileReader();
                                reader.onload = function(e){
                                    preview.src = e.target.result;
                                }
                                if(imagem){
                                    reader.readAsDataURL(imagem);
                                }else{
                                    preview.src = "";
                                }
                            }
                        </script>
                        <label for="submit"> 
                                <button class="botao-atualiza" type="submit" style="max-width: 100px;"><b>Atualizar</b></button>
                        </label>
                    </div>
                </form>
                <div id='teste'></div>
            </div>   

            <?php 
                            
                }else {
                    echo "Erro executando UPDATE: " . mysqli_error($conn);
                }
                //FIM DA DIV FORM
                echo "</div>";
                //ENCERRA CONEXÃO COM O BANCO DE DADOS
                mysqli_close($conn);

            ?>
        </div>
        <!-- RODAPÉ -->
        <footer>
            <header class="linha-divisao"></header>
            <img class="img-rodape" src="IMG/logo_verticalpng.png">
            <p class="copyright">&copy; Copyright Tripp Planner - 2023</p>
        </footer>
    </body>
</html>
