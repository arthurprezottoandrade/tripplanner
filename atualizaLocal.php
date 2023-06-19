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

                $sql = "SELECT c.Id, c.Nome, r.Nome as Raca, c.apelido, c.Id_Raca as id_raca, c.Ano_nascimento, c.Porte, c.Imagem, c.apto, c.adotado FROM cachorro c, raca r where c.Id_Raca = r.Id and c.Id = $id";

        

            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id_cachorro = $row['Id'];
                        $nome      = $row['Nome'];
                        $apelido      = $row['apelido'];
                        $porte      = $row['Porte'];
                        $Ano_Nascimento  = $row['Ano_nascimento'];
                        $raca  = $row['Raca'];
                        $foto = $row['Imagem'];
                        $id_raca = $row['id_raca'];
                        $apto = $row['apto'];
                        $adotado = $row['adotado'];

                    }
                }
            ?>
            <!-- FORMULÁRIO -->
            <div class="formatualiza">
                <form id="cadastro" action="atualizaLocal_exe.php" method="post" onsubmit="return check(this.form)" enctype="multipart/form-data">
                    <input type="hidden" id="Id" name="Id" value="<?php echo $id_cachorro; ?>">
                    <div class="form">
                        <label for="text" style="color: black;"><b>ATUALIZAÇÃO DE CACHORRO</b></label>
                        <label for="name"> Nome 
                            <input type="text" name="nome" value="<?php echo $nome; ?>">
                        </label>
                        <label for="name"> Apelido 
                            <input type="text" name="apelido" value="<?php echo $apelido; ?>">
                        </label>
                        <label for="name"> Ano de Nascimento
                            <select name="ano">
                                <option value= "<?php echo $Ano_Nascimento ?>">Ano de Nascimento atual - <?php echo $Ano_Nascimento; ?></option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                                <option value="2015">2015</option>
                                <option value="2014">2014</option>
                                <option value="2013">2013</option>
                                <option value="2012">2012</option>
                                <option value="2011">2011</option>
                                <option value="2010">2010</option>
                                <option value="2009">2009</option>
                                <option value="2008">2008</option>
                                <option value="2007">2007</option>
                                <option value="2006">2006</option>
                                <option value="2005">2005</option>
                            </select>
                        </label>
                        <label for="name"> Porte <span> </span>
                            <select name="porte">
                                <option value= "<?php echo $porte; ?>">Porte Atual - <?php echo $porte; ?></option>
                                <option value="Pequeno"<?php echo $porte=='Selecione'?'selected':'';?> >Pequeno</option>
                                <option value="Médio"<?php echo $porte=='Selecione'?'selected':'';?> >Medio</option>
                                <option value="Grande"<?php echo $porte=='Selecione'?'selected':'';?> >Grande</option>
                            </select>
                        </label>

                        <label for="name"> Raça
                        <select name="raca" required>
                        <option value= " <?php echo $id_raca; ?>">Raça Atual - <?php echo $raca; ?></option>
                    <?php		
                        $sql2 = "SELECT Id, Nome from raca";

                        if ($result = mysqli_query($conn, $sql2)) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['Id'];
                                    $nome = $row['Nome'];
                    ?>

                            <option value="<?php echo $id ?>"><?php echo $nome ?></option>
                        <?php
                                    }
                                } else {
                                    //ENCERRA CONEXÃO COM O BANCO DE DADOS
                                    mysqli_close($conn);
                                }
                            }
                        ?>
                        <label for="name">
                                <input type="hidden" name="id_instituicao" value="<?php echo $id_instituicao; ?>">
                        </label>
                        <div class = "switchs">
                            <br>
                            <b>Apto</b>
                            <br>
                            <b>Não</b>
                            <label class="switch"> 
                                <input id= "apto" name = "apto" type="checkbox">
                                <span class="slider round"></span>
                            </label>
                            <b>Sim</b>
                            <br>
                            <b>Adotado</b> 
                            <br>
                            <b>Não</b>
                            <label class="switch"> 
                                <input id= "adotado" name = "adotado" type="checkbox">
                                <span class="slider round"></span>
                            </label>
                            <b>Sim</b>
                        </div>

                        <script>
                            var aptoPHP = '<?=$apto?>';
                            var adotadoPHP = '<?=$adotado?>';
                            var aptidao = document.getElementById("apto");
                            var adocao = document.getElementById("adotado");
                            if (aptoPHP=="on") {
                                aptidao.checked = true;
                            } else {
                                aptidao.checked = false;
                            }

                            if (adotadoPHP=="on") {
                                adocao.checked = true;
                            } else {
                                adocao.checked = false;
                            }
                        </script>
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
