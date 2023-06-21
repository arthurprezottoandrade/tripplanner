<html>    
    <head>
    <link rel="stylesheet" type="text/css" href="CSS/inicio.css">
    <title>Atualizar Local - TripPlanner</title>
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
                        <label for="text" style="color: black;"><b>ATUALIZAÇÃO DE LOCAL</b></label>
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
            <img class="img-rodape" src="IMG/logo_principal.png">
            <p class="copyright">&copy; Copyright Tripp Planner - 2023</p>
        </footer>
    </body>
</html>
