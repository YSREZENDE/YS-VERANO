<?php
require_once 'head.php';
        include_once 'conexao.php';
        include_once 'menu.php';

       
?>

<?php

//echo "senha".password_hash(123, PASSWORD_DEFAULT);

$dadoslogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($dadoslogin['btnlogin'])) {

        $buscalogin = "SELECT ID_VENDEDOR, NOME, EMAIL,SENHA
                                FROM vendedor
                                WHERE EMAIL =:usuario  
                                LIMIT 1";

        $resultado= $conn->prepare($buscalogin);
        $resultado->bindParam(':usuario', $dadoslogin['usuario'], PDO::PARAM_STR);
        $resultado->execute();

        if(($resultado) AND ($resultado->rowCount() != 0)){
            $resposta = $resultado->fetch(PDO::FETCH_ASSOC);
            //var_dump($resposta);
            //var_dump($dadoslogin);

            if(password_verify($dadoslogin['senha'], $resposta['senha'])){
                
                $_SESSION['nome'] = $resposta['nome'];
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
 <div class="text-center">
<div class="title">
    <h1><br>Administrativo</br></h1>
</div>
 </div>

<form id="login-form" class="form" action="" method="POST">
                            
                            <div class="form-group">
                                <label for="username" class="text-info">Nome de Usuário:</label><br>
                                <input type="text" name="usuario" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Senha:</label><br>
                                <input type="password" name="senha" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                            <button  class="btn btn-info btn-md" value="Enviar" name="btnlogin"><a href="admin.php"></a>Entrar</button>
        
                            </div>
                            
                        </form>



































<?php
require_once 'footer.php';
                        ?>