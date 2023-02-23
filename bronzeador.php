<?php
    

    require_once 'head.php';
    require 'menu.php';
    include_once 'conexao.php';

    $pagatual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
	$pag = (!empty($pagatual)) ? $pagatual : 1;

    $limitereg = 6;

    $inicio = ($limitereg * $pag) - $limitereg;

    $busca= "SELECT  roupa.ID_PRODUTO,roupa.PRODUTO_NOME,roupa.VALOR,roupa.FOTO
    FROM roupa,categoria  WHERE 
 roupa.ID_CATEGORIA = categoria.ID_CATEGORIA and
   categoria.DESCRICAO = 'bronzeador' and
    roupa.QUANTIDADE > 0 LIMIT $inicio , $limitereg";

    $resultado = $conn->prepare($busca);
    $resultado->execute();  
       
       
?>

<div class="feito text-center">
    <H1>FEITO PRA VOCÊ</H1>

</div>
<!--categoria bnt-->
<button type="button" class="btn" ><i class="fa-solid fa-list"></i>Categorias</button>

<div class="vendidos text-center">
<p>Mais vendidos</p></div>

<!--cads biquinis-->
<div class="row">
      <div class="card preto">

        <?php
        if (($resultado) AND ($resultado->rowCount() != 0)){
        while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
           
            extract($linha);             
        
        ?>    


<img class="image" src="<?php echo $FOTO;?>" />        
        <h2><?php echo $PRODUTO_NOME; ?></h2>
        <h4>R$ <?php echo $VALOR; ?>,00</h4>
        <p>Em até 2x de  sem juros</p>
        <form action="carrinho.php" method="post">
                                       <!--quantidade-->
                            <label>Qnt</label>
                            <input type="number" name="QUANTCOMPRA" value="1" style=width:45px;>
                            <input type="hidden" name="$ID_PRODUTO" value="<?php echo $ID_PRODUTO; ?>">
                           <!--tamanho-->
                            <label>TM</label>
                            <input type="text" name="tamanho" value="1" style=width:45px;>
                            <input type="hidden" name="$TAMANHO" value="<?php echo $TAMANHO; ?>">
                            <!--button comprarp-->
                            <input type="submit" class="btn btn-primary" value="comprar"> 
                            </form> 
      </div>
        </div>
   

        <div class="card vermelho">
        <img class="image" src="<?php echo $FOTO;?>" />        
        <h2><?php echo $PRODUTO_NOME; ?></h2>
        <h4>R$ <?php echo $VALOR; ?>,00</h4>
        <p>Em até 2x de  sem juros</p>
        <form action="carrinho.php" method="post">
                                       <!--quantidade-->
                            <label>Qnt</label>
                            <input type="number" name="QUANTCOMPRA" value="1" style=width:45px;>
                     
                            <input type="hidden" name="$ID_PRODUTO" value="<?php echo $ID_PRODUTO; ?>">
                           <!--tamanho-->
                            <label>TM</label>
                            <input type="text" name="tamanho" value="1" style=width:45px;>
                            <input type="hidden" name="$TAMANHO" value="<?php echo $TAMANHO; ?>">
                            <!--button comprarp-->
                            <input type="submit" class="btn btn-primary" value="comprar"> 
                            </form> 
      </div>
      
        </div>
        <div class="card terceiro">
        <img class="image" src="<?php echo $FOTO;?>" />        
        <h2><?php echo $PRODUTO_NOME; ?></h2>
        <h4>R$ <?php echo $VALOR; ?>,00</h4>
        <p>Em até 2x de  sem juros</p>
        <form action="carrinho.php" method="post">
                                       <!--quantidade-->
                            <label>Qnt</label>
                            <input type="number" name="QUANTCOMPRA" value="1" style=width:45px;>
                     
                            <input type="hidden" name="$ID_PRODUTO" value="<?php echo $ID_PRODUTO; ?>">
                           <!--tamanho-->
                            <label>TM</label>
                            <input type="text" name="TAMANHO" value="1" style=width:45px;>
                            <input type="hidden" name="$TAMANHO" value="<?php echo $TAMANHO; ?>">
                            <!--button comprarp-->
                            <input type="submit" class="btn btn-primary" value="comprar"> 
                            </form> 
      </div>
      
        </div>
    <?php         
    } 
}
?>

</div>
</div>

<?php
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

      echo "<a href='relprodutos.php?page=1'>Primeira</a> ";
    // Chamar página anterior verificando a quantidade de páginas menos 1 e 
    // também verificando se já não é primeira página
    for ($anterior = $pag - $maximo; $anterior <= $pag - 1; $anterior++) {
        if ($anterior >= 1) {
            echo "  <a href='relprodutos.php?page=$anterior'>$anterior</a> ";
        }
    }

    //Mostrar a página ativa
    echo "$pag";

    //Chamar próxima página, ou seja, verificando a página ativa e acrescentando 1
    // a ela
    for ($proxima = $pag + 1; $proxima <= $pag + $maximo; $proxima++) {
        if ($proxima <= $qnt_pagina) {
            echo "<a href='relprodutos.php?page=$proxima'>$proxima</a> ";
        }
    }

    echo "<a href='relprodutos.php?page=$qnt_pagina'>Última</a> ";


?>

<?php
        require_once 'footer.php';

    ?>
 