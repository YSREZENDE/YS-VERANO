<?php
    session_start();
    ob_start();

    require_once 'conexao.php';

   
    if(isset($_POST["excluir"])){

        $CODIGOPRODUTO = $_POST["excluir"]; 

        $sqlexcluir = "DELETE from carrinho where CODIGOPRODUTO = $CODIGOPRODUTO";
        $resulexcluir=$conn->prepare($sqlexcluir);
        $resulexcluir->execute();
        $_SESSION["quant"]-=1;
    }else{
        if(!isset($_SESSION['nome'])){
            $_SESSION["carrinho"] = true;
            echo "<script>
            alert('Faça Login para Finalizar sua Compra!');
            parent.location = 'login.php';
            </script>";
        }
        else{
            //acessar pagamento;
            $DATA = date('y-m-d');
            $VALOR = $_SESSION['totalcompra'];            
            $ID_CLIENTE = $_SESSION["cliente"];
          
            $sqlvenda = "INSERT into venda(ID_VENDA,DATA,VALOR,FORMA_PAGAMENTO,PARCELAS,ID_VENDEDOR,ID_CLIENTE)values
            (:ID_VENDA,:DATA,:VALOR,:FORMA_PAGAMENTO,:PARCELAS,:ID_VENDEDOR,:ID_CLIENTE)";
            $salvarvenda= $conn->prepare($sqlvenda);
            $salvarvenda->bindParam(':ID_VENDA', $ID_VENDA, PDO::PARAM_STR);
            $salvarvenda->bindParam(':DATA', $DATA, PDO::PARAM_STR);
            $salvarvenda->bindParam(':VALOR', $VALOR, PDO::PARAM_STR);
            $salvarvenda->bindParam(':FORMA_PAGAMENTO', $FORMA_PAGAMENTO, PDO::PARAM_STR);
            $salvarvenda->bindParam(':PARCELAS', $PARCELAS, PDO::PARAM_STR);
            $salvarvenda->bindParam(':ID_VENDEDOR', $ID_VENDEDOR, PDO::PARAM_STR);
            $salvarvenda->bindParam(':ID_CLIENTE',$ID_CLIENTE , PDO::PARAM_STR);        
            $salvarvenda->execute();

            $venda = "Select LAST_INSERT_ID()";
            $resulvenda=$conn->prepare($venda);
            $resulvenda->execute();

            $linhavenda = $resulvenda->fetch(PDO::FETCH_ASSOC);     
           
            $idvenda = ($linhavenda["LAST_INSERT_ID()"]);

        $busca = "select * from carrinho";
        $resulbusca=$conn->prepare($busca);
        $resulbusca->execute();

        if(($resulbusca) && ($resulbusca->rowCount()!=0)){
            while ($linha = $resulbusca->fetch(PDO::FETCH_ASSOC)) {
                extract($linha);
                

               $sqlitem = "INSERT into roupa (ID_PRODUTO,PRODUTO_NOME,QUANTIDADE,TAMANHO,COR,VALOR)
                values(:ID_PRODUTO,:PRODUTO_NOME,:QUANTIDADE,:TAMANHO,:COR,:VALOR)";
                $salvaritem= $conn->prepare($sqlitem);
                $salvaritem->bindParam(':ID_PRODUTO', $ID_PRODUTO, PDO::PARAM_INT);
                $salvaritem->bindParam(':PRODUTO_NOME',$PRODUTO_NOME, PDO::PARAM_INT);
                $salvaritem->bindParam(':QUANTIDADE', $QUANTIDADE, PDO::PARAM_INT);
                $salvaritem->bindParam(':TAMANHO', $TAMANHO, PDO::PARAM_INT);
                $salvaritem->bindParam(':COR', $COR, PDO::PARAM_INT);
                $salvaritem->bindParam(':VALOR', $VALOR, PDO::PARAM_STR);
                $salvaritem->execute();

                $estoque = "UPDATE roupa set quantidade=(QUANTIDADE- $QUANTIDADE)
				where ID_PRODUTO = $ID_PRODUTO";
				$atualiza=$conn->prepare($estoque);
				$atualiza->execute();
            }

    }

    $sqllimpa = "delete from carrinho";
    $limpa= $conn->prepare($sqllimpa);
    $limpa->execute();
    $_SESSION["quant"] = 0;                                                                      


    header("Location:index.php");
    
    }

   
    }


    ?>