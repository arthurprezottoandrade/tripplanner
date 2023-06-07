<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" type="text/css" href="CSS/cadastro.css">
        <title>Cadastro de Adotante - Help Friend</title>
        <link rel="icon" type="image/jpg" href="IMG/logo_icone.jpg"/>
    </head>
    <body>
    <!-- CONEXÃO COM O BANCO DE DADOS -->
    <?php require 'conectaBD.php'; ?>
        <!-- CABEÇALHO -->
        <header class="cabecalho">
            <main>
                <div>
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
                </div>
            </main>
        </header>
        <!-- LINHA DE DIVISÃO -->
        <header class="linha-divisao"></header>
        <!-- FORMULÁRIO -->
        <header>
                <div class="formcadastro">
                    <form id="cadastro" action="cadastroAdotante_exe.php" method="post" onsubmit="return check(this.form)">
                        <div class="form">
                            <label class="titulo-form" for="text"><b>CADASTRO DE ADOTANTE</b></label>
                            <label for="name"> Nome 
                                <input type="text" name="nome" required>
                            </label>
                            <label for="password"> Senha 
                                <input type="password" name="senha"required>
                            </label>

                            <label for="cpf"> CPF
                                <input type="text" name="cpf"required>
                            </label>

                            <label for="email"> E-mail
                                <input type="email" name="email"required>
                            </label>

                            <label for="logradouro"> Logradouro 
                                <input type="text" name="logradouro"required>
                            </label>               

                            <label for="numero"> Numero 
                                <input type="text" name="numero"required>
                            </label>

                            <label for="complemento"> Complemento
                                <input type="text" name="complemento"required>
                            </label>

                            <label for="bairro"> Bairro
                                <input type="text" name="bairro"required>
                            </label>

                            <label for="cidade"> Cidade
                                <input type="text" name="cidade"required>
                            </label>

                            <label for="estado"> Estado 
                                <input type="text" name="estado"required>
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
            <img class="img-rodape" src="IMG/logo_verticalpng.png">
            <p class="copyright">&copy; Copyright Help Friend - 2022</p>
        </footer>
        <?php 
            //FIM DA DIV FORM
            echo "</div>";
            //ENCERRA CONEXÃO COM O BANCO DE DADOS
            mysqli_close($conn);
        ?>
    </body>
</html>