<?php
require_once 'head.php';
        include_once 'conexao.php';

        session_start();
	    ob_start();
?>

<?php

//echo "senha".password_hash(123, PASSWORD_DEFAULT);

$dadoslogin = filter_input_array(INPUT_POST, FILTER_DEFAULT);
//var_dump($dadoslogin);


if (!empty($dadoslogin['btnlogin'])) {

        $buscalogin = "SELECT  NOME SENHA,EMAIL
                                FROM vendedor
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
                if( $_SESSION["carrinho"]==true){ $_SESSION['ID_VENDEDOR'] = $resposta['ID_VENDEDOR'];
                
                header("Location: frmcarrinho.php");
            }
            else{
            header("Location: admin.php");
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
                               
                           <input type="submit" class="btn btn-info btn-md" value="Enviar" name="btnlogin">
                        
                            </div>
                            
                        </form>