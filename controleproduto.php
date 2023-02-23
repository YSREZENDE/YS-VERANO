<?php
require_once 'menu.php';
    include_once 'conexao.php';
    

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }  

   try{    
            
    $dadosprod = filter_input_array(INPUT_POST, FILTER_DEFAULT);

   // var_dump($dadosprod);


    if(isset($_FILES['foto'])){
        $arquivo = ($_FILES['foto']);


        if($arquivo['error']){
            echo 'Erro ao carregar arquivo';
            header ("Location: frmproduto.php");
        }

        $pasta = "roupas/";
        $nomearquivo = $arquivo['name'];
        $novonome = uniqid();
        $extensao = strtolower(pathinfo($nomearquivo, PATHINFO_EXTENSION));

        if($extensao!="jpg" && $extensao!="png"){
            die("Tipo não aceito");
        }       

        $salvaimg = move_uploaded_file($arquivo['tmp_name'], $pasta . $novonome . "." . $extensao);

        if($salvaimg){
            $path = $pasta . $novonome . "." . $extensao;
            echo "ok";
        }


     }

    
    if (!empty($dadosprod['btncad'])) {

        $vazio = false;

        $dadosprod = array_map('trim', $dadosprod);
        if (in_array("", $dadosprod)) {
            $vazio = true;
           
            echo "<script>
        alert('Preencher todos os campos!!!');
        parent.location = 'frmproduto.php';
        </script>";

        }     

    if (!$vazio) {

            $sql = "INSERT INTO roupa(PRODUTO_NOME,QUANTIDADE,TAMANHO,COR,CUSTO,VALOR,ID_FORNECEDOR,FOTO,ID_CATEGORIA)
        VALUES(:PRODUTO_NOME,:QUANTIDADE,:TAMANHO,:COR,:CUSTO,:VALOR,:ID_FORNECEDOR,:FOTO,:ID_CATEGORIA)";

     $salvar= $conn->prepare($sql);
    $salvar->bindParam(':PRODUTO_NOME', $dadosprod['nome'], PDO::PARAM_STR);
    $salvar->bindParam(':QUANTIDADE', $dadosprod['quantidade'], PDO::PARAM_STR);
    $salvar->bindParam(':TAMANHO', $dadosprod['tamanho'], PDO::PARAM_STR);
    $salvar->bindParam(':COR', $dadosprod['cor'], PDO::PARAM_STR);
    $salvar->bindParam(':CUSTO', $dadosprod['custo'], PDO::PARAM_STR);
    $salvar->bindParam(':VALOR', $dadosprod['valor'], PDO::PARAM_STR);   
    $salvar->bindParam(':ID_FORNECEDOR', $dadosprod['fornecedor'], PDO::PARAM_STR); 
    $salvar->bindParam(':FOTO', $path, PDO::PARAM_STR);
    $salvar->bindParam(':ID_CATEGORIA', $dadosprod['categoria'], PDO::PARAM_STR); 


    
    $salvar->execute();

    if ($salvar->rowCount()) {
        
        echo "<script>
        alert('Produtocadastrado com sucesso!!');
        parent.location = 'frmproduto.php';
        </script>";

        unset($dadoscad);
    } else {
        echo "<script>
        alert('Produto não cadastrado!');
        parent.location = 'frmproduto.php';
        </script>";
        
    }

}

}


if (!empty($dadosprod['btneditar'])) {


    var_dump($dadosprod);

    $dadosprod = array_map('trim', $dadosprod);

    $sql = "UPDATE roupa set PRODUTO_NOME=:PRODUTO_NOME,QUANTIDADE=:QUANTIDADE,TAMANHO=:TAMANHO,COR=:COR,CUSTO=:CUSTO,VALOR=:VALOR,ID_FORNECEDOR=:ID_FORNECEDOR,FOTO=:FOTO,ID_CATEGORIA=:ID_CATEGORIA
     WHERE ID_PRODUTO =:codigoproduto";

 $salvar= $conn->prepare($sql);
$salvar->bindParam(':PRODUTO_NOME', $dadosprod['nome'], PDO::PARAM_STR);
$salvar->bindParam(':QUANTIDADE', $dadosprod['quantidade'], PDO::PARAM_STR);
$salvar->bindParam(':TAMANHO', $dadosprod['tamanho'], PDO::PARAM_STR);
$salvar->bindParam(':COR', $dadosprod['cor'], PDO::PARAM_STR);
$salvar->bindParam(':CUSTO', $dadosprod['custo'], PDO::PARAM_STR);
$salvar->bindParam(':VALOR', $dadosprod['valor'], PDO::PARAM_STR);   
$salvar->bindParam(':ID_FORNECEDOR', $dadosprod['fornecedor'], PDO::PARAM_STR); 
$salvar->bindParam(':FOTO', $path, PDO::PARAM_STR);
$salvar->bindParam(':ID_CATEGORIA', $dadosprod['categoria'], PDO::PARAM_STR); 

$salvar->execute();

    if ($salvar->rowCount()) {
        
        echo "<script>
        alert('Dados Atualizados com sucesso!!');
        parent.location = 'relproduto.php';
        </script>";

        unset($dadoscad);
    } else {
        echo "<script>
        alert('Não foi possível cadastrar produto!');
        parent.location = 'relproduto.php';
        </script>";
        
    }

  



}

}
catch(PDOException $erro){
    echo $erro;

}

?>