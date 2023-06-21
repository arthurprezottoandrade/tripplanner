<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href="CSS/cadastro.css">
        <title>Cadastro de Usuário - TripPlanner</title>
        <link rel="icon" type="image/jpg" href="IMG/logo_transparente.png"/>
    </head>
    <body>
    <!-- CONEXÃO COM O BANCO DE DADOS -->
    <?php require 'conectaBD.php'; ?>
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

            <img class="logo" src="IMG/logo_horizontal.png"/>
            <div class="botao-cabecalho">
                <ul>
                    <li><a href=""><h3>MENU</h3></a></li>
                    <li><a href=""><h3>SOBRE</h3></a></li>
                    <li><a href=""><h3>CONTATO</h3></a></li>
                </ul>
            </div>
        </header>
        <!-- LINHA DE DIVISÃO -->
        <header class="linha-divisao"></header>
        <!-- FORMULÁRIO -->
        <header>
                <div class="formcadastro">
                    <form id="cadastro" action="cadastroUsuario_exe.php" method="post" onsubmit="return check(this.form)">
                        <div class="form">
                            <label class="titulo-form" for="text"><b>CADASTRO DE USUÁRIO</b></label>
                            <label for="name"> Nome 
                                <input type="text" name="nome" required>
                            </label>
                            <label for="sobrenome"> Sobrenome 
                                <input type="text" name="sobrenome" required>
                            </label>

                            <label for="email"> E-mail
                                <input type="email" name="email"required>
                            </label>
                            <label for="senha"> Senha 
                                <input type="password" name="senha"required>
                            </label>

                            <label for="submit"> 
                                <button class="botao-cadastro" type="submit"><b>Cadastrar</b></button>
                            </label>
                        </div>
                    </form>
                </div>
            </header>
        <!-- RODAPÉ -->
        <footer>
            <header class="linha-divisao"></header>
            <img class="img-rodape" src="IMG/logo_principal.png">
            <p class="copyright">&copy; Copyright TripPlanner - 2023</p>
        </footer>
        <?php 
            //FIM DA DIV FORM
            echo "</div>";
            //ENCERRA CONEXÃO COM O BANCO DE DADOS
            mysqli_close($conn);
        ?>
    </body>
</html>
