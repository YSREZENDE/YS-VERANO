<?php
require_once 'head.php';
        include_once 'conexao.php';

    require_once 'menu.php';
?>

<?php

//echo "senha".password_hash(123, PASSWORD_DEFAULT);

$dadoslogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($dadoslogin);


if (!empty($dadoslogin['btnlogin'])) {

        $buscalogin = "SELECT ID_CLIENTE, NOME, EMAIL,SENHA
                                FROM cliente 
                                WHERE EMAIL =:usuario  
                                LIMIT 1";

        $resultado= $conn->prepare($buscalogin);
        $resultado->bindParam(':usuario', $dadoslogin['usuario'], PDO::PARAM_STR);
        $resultado->execute();



        
            

        if(($resultado) AND ($resultado->rowCount() != 0)){
            $resposta = $resultado->fetch(PDO::FETCH_ASSOC);
           //var_dump($resposta);
           

     


            if(password_verify($dadoslogin['senha'], $resposta['SENHA'])){
                
                $_SESSION['nome'] = $resposta['NOME'];
                if( $_SESSION["carrinho"]==true){ $_SESSION['ID_CLIENTE'] = $resposta['ID_CLIENTE'];
                
                header("Location: frmcarrinho.php");
            }
            else{
            header("Location: administrativo.php");
        }

    }
            else{
                $_SESSION['msg'] = "Erro: Usuário ou senha inválida!";
          
            }

        }
        else{
            $_SESSION['msg'] = "Erro: Usuário ou senha inválida!";
        
        }
}


if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}






?>
<div class="acesso-cliente text-center">
    <h1><br>Acesso ao sistema</br></h1>
</div>

<form id="login-form" class="form" action="" method="POST">
                            
                            <div class="form-group">
                   
                                <label for="username" class="text-info">Email Cadastrado:</label><br>
                                <input type="text" name="usuario" id="username" class="form-control">
                             
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Senha:</label><br>
                                <input type="password" name="senha" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                               
                           <input type="submit" class="btn btn-info btn-dark" value="Enviar" name="btnlogin">
                            <a href="frmcliente.php"><button type="button" class="btn btn-info btn-dark" value="Cadastre-se" name="cadastro">Cadastre-se</button></a>
                            </div>
                            
                        </form>
                        <?php
                        require_once 'footer.php';
                        
                        ?>