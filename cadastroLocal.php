<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="CSS/cadastro.css">
    <title>Cadastro de Local - Tripp Planner</title>
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
<!-- FORMULÁRIO -->
<div class="formcadastro">
    <form id="cadastro" action="cadastroLocal_exe.php" enctype="multipart/form-data" method="post">
        <div class="form">
            <label class="titulo-form" for="text"><b>CADASTRO DE LOCAL</b></label>
            <label for="nome">Nome
                <input type="text" name="nome" required>
            </label>
            <label for="rua">Rua
                <input type="text" name="rua" required>
            </label>
            <label for="numero">Número
                <input type="text" name="numero" required>
            </label>
            <label for="bairro">Bairro
                <input type="text" name="bairro" required>
            </label>
            <label for="cidade">Cidade
                <input type="text" name="cidade" required>
            </label>
            <p>
                        <label class="w3-text-deep-brown"><b>Imagem:</b></label>
                        <label class="w3-btn w3-theme"><b>Selecione uma imagem</b>
                        <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                        <input type="file" style="display:none;background-color:brown;" id="Imagem" name="Imagem" accept="imagem/*" onchange="previewImagem();"></label>
                    </p>
                    <img id="imgCamp" style="width:20vw;height:auto;">
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
                <button class="botao-cadastro" type="submit"><b>Cadastrar</b></button>
            </label>
        </div>
    </form>
</div>
<!-- RODAPÉ -->
<footer>
    <header class="linha-divisao"></header>
    <img class="img-rodape" src="IMG/logo_verticalpng.png">
    <p class="copyright">&copy; Copyright Tripp Planner - 2023</p>
</footer>
<?php 
    //FIM DA DIV FORM
    echo "</div>";
    //ENCERRA CONEXÃO COM O BANCO DE DADOS
    mysqli_close($conn);
?>
</body>
</html>
