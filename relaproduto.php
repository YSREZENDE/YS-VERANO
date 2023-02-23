<?php

    require_once 'head.php';
    include_once 'conexao.php';
    include_once 'menu.php';


    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }    


    $pagatual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
	$pag = (!empty($pagatual)) ? $pagatual : 1;

    $limitereg = 6;

    $inicio = ($limitereg * $pag) - $limitereg;

    $busca= "SELECT roupa.ID_PRODUTO,roupa.PRODUTO_NOME,roupa.QUANTIDADE,roupa.TAMANHO,roupa.COR,roupa.CUSTO,roupa.VALOR,roupa.ID_FORNECEDOR,
    roupa.FOTO,categoria.DESCRICAO
    FROM roupa,categoria WHERE QUANTIDADE > 0 and
    categoria.ID_CATEGORIA = roupa.ID_CATEGORIA
     LIMIT $inicio , $limitereg";

    $resultado = $conn->prepare($busca);
    $resultado->execute();

    if (($resultado) AND ($resultado->rowCount() != 0)){
       
        echo "<h1>Produtos em Estoque</h1><br>";
?>
        <table class="table">
        <thead>
         <tr>
            <th scope="col">Foto</th>
            <th scope="col">Nome</th>
            <th scope="col">Valor</th>
            <th scope="col">Custo</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Cor</th>
            <th scope="col">Tamanho</th>
            <th scope="col">Categoria</th>
            <th scope="col"></th>
            <th scope="col"></th>

         </tr>
        </thead>
     <tbody>

<?php
        while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
           
            extract($linha);             
        
?>        
            <tr>
              <td scope="row"><img src="<?php echo $FOTO ?>"style=widht:100px;height:100px;></td>
              <td><?php echo $PRODUTO_NOME?></td>
              <td><?php echo $VALOR ?></td>
              <td><?php echo $CUSTO ?></td>
              <td><?php echo $QUANTIDADE ?></td>
              <td><?php echo $COR ?></td>
              <td><?php echo $TAMANHO ?></td>
            
              <td><?php echo $DESCRICAO ?></td>
              <td>
                 <?php echo "<a href='editarprod.php?codigo=$ID_PRODUTO'>" ; ?>
                <input type="submit" class="btn btn-primary" name="editar" value="Editar">
              </td>
              <td>
                 <?php echo "<a href='excluirprod.php?codigo=$ID_PRODUTO'>" ; ?>
                 
                 <input type="submit" class="btn btn-danger" name="excluir" value="Excluir">
              </td>
            </tr>   
             
             
             

<?php         
    } 
?>
</tbody>
</table>
<?php    
        
    }else{
        echo "Não tem registros";
    }




     //Contar os registros no banco
     $qtregistro = "SELECT COUNT(ID_PRODUTO) AS registros FROM roupa";
     $resultado = $conn->prepare($qtregistro);
     $resultado->execute();
     $resposta = $resultado->fetch(PDO::FETCH_ASSOC);

     //Quantidade de página que serão usadas - quantidade de registros
     //dividido pela quantidade de registro por página
     $qnt_pagina = ceil($resposta['registros'] / $limitereg);

      // Maximo de links      
      $maximo = 2;

      echo "<a href='relproduto.php?page=1'>Primeira</a> ";
    // Chamar página anterior verificando a quantidade de páginas menos 1 e 
    // também verificando se já não é primeira página
    for ($anterior = $pag - $maximo; $anterior <= $pag - 1; $anterior++) {
        if ($anterior >= 1) {
            echo "  <a href='relproduto.php?page=$anterior'>$anterior</a> ";
        }
    }

    //Mostrar a página ativa
    echo "$pag";

    //Chamar próxima página, ou seja, verificando a página ativa e acrescentando 1
    // a ela
    for ($proxima = $pag + 1; $proxima <= $pag + $maximo; $proxima++) {
        if ($proxima <= $qnt_pagina) {
            echo "<a href='relproduto.php?page=$proxima'>$proxima</a> ";
        }
    }

    echo "<a href='relproduto.php?page=$qnt_pagina'>Última</a> ";


?>



<?php
    require_once 'footer.php';
?>