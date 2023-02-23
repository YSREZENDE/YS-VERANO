<?php
require_once 'head.php';
require_once 'menu.php';
include_once 'conexao.php';

$pagatual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
$pag = (!empty($pagatual)) ? $pagatual : 1;

  $limitereg = 6;

  $inicio = ($limitereg * $pag) - $limitereg;

  $busca= "SELECT  roupa.ID_PRODUTO,roupa.PRODUTO_NOME,roupa.VALOR,roupa.FOTO
  FROM roupa,categoria  WHERE 
roupa.ID_CATEGORIA = categoria.ID_CATEGORIA and
 categoria.DESCRICAO = 'b_firebody' and
  roupa.QUANTIDADE > 0 LIMIT $inicio , $limitereg";

  $resultado = $conn->prepare($busca);
  $resultado->execute();  
     
?>
    <wrap>
      <div class="verano text-center">
            <h1 id="verano">YS Verano</h1>
            <P>Desde 2022</P>

      </div>
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="img\desconto.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <!--ver com a prof-->
    <a href="biquini.php#arpoador" ><img class="d-block w-100" src="img\colecaoarpoadorbanner.png" alt="Second slide"></a> 
      <!---->
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img\FRETEGRATIS.png" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</div>
</wrap>

<!--linkando imagens das estampas-->


<div class="text-center colorido">
<a href="#">
<!--link 1--> <a href="medidas.php"> <img class="stamp" src="img\medidas.png" width="160" height="155"></a> <!--link 4--><a href="#"><img class="stamp" src="img\monteseubiquini.png" width="160" height="155"></a></div>



<div class=" text-center">
            <h1 id="tema">NOVA COLEÇÃO</h1>
            <p id="fire">Coleção Fire Body</p>
    

      </div>
      
<!-- VISITAR CANAL GIRL CODING PRA TENTAR DEIXAR RESPONSIVO-->

 <!-- cards-->


 <?php
    
    $busca= "SELECT  roupa.ID_PRODUTO,roupa.PRODUTO_NOME,roupa.VALOR,roupa.FOTO
    FROM roupa,categoria  WHERE 
 roupa.ID_CATEGORIA = categoria.ID_CATEGORIA and
   categoria.DESCRICAO = 'b_firebody' and
    roupa.QUANTIDADE > 0 LIMIT $inicio , $limitereg";

    $resultado = $conn->prepare($busca);
    $resultado->execute();  
       
       
?>


<!--categoria bnt-->


<div class="container-fluid imagens">
        <div class="row">
        
        <?php
        if (($resultado) AND ($resultado->rowCount() != 0)){
        while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
           
            extract($linha);             
        
        ?>    
       
                <div class="card" style="width: 25rem;">
                    <img class="card-img-top" src="<?php echo $FOTO; ?>">
                    <div class="card-body text-center">
                        <h3 class="card-text"><?php echo $PRODUTO_NOME; ?></h3>
                        <h4>Preço R$ <?php echo $VALOR; ?>,00</h4>
                       <form action="carrinho.php" method="post">
                            <h5>
                            <label>Quant</label>
                            <input type="number" name="QUANTCOMPRA" value="1" style=width:45px;>
                            </h5>
                            <input type="hidden" name="ID_PRODUTO" value="<?php echo $ID_PRODUTO; ?>">
                            <input type="submit" class="btn btn-dark" value="comprar">                               

                        </form>
                    </div>
                </div> 
         
        
    <?php         
    } 
}
?>
        </div>
</div>

<div class=" text-center">
      <h1 id="tema">OUTLET</h1>
      
<?php
$busca= "SELECT  roupa.ID_PRODUTO,roupa.PRODUTO_NOME,roupa.VALOR,roupa.FOTO
  FROM roupa,categoria  WHERE 
roupa.ID_CATEGORIA = categoria.ID_CATEGORIA and
 categoria.DESCRICAO = 'm_promocao' and

  roupa.QUANTIDADE > 0 LIMIT $inicio , $limitereg";

  $resultado = $conn->prepare($busca);
  $resultado->execute();  

     
?>
<div class="container-fluid imagens">
        <div class="row">

    <?php
        if (($resultado) AND ($resultado->rowCount() != 0)){
        while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
           
            extract($linha);             
        
        ?>    


           
           <div class="card" style="width: 25rem; hight: 30px;">
                    <img class="card-img-top" src="<?php echo $FOTO; ?>">
                    <div class="card-body text-center">
                        <h3 class="card-text"><?php echo $PRODUTO_NOME; ?></h3>
                        <h4> R$ <?php echo $VALOR; ?>,00</h4>
            
                       <form action="carrinho.php" method="post">
                            <h5>
                            <label>Quant</label>
                            <input type="number" name="QUANTIDADE" value="1" style=width:45px;>
                            <label>Tamanho</label>
                            <select name="TAMANHO" value="1" style=width:45px;>
                            <input type="hidden" name="TAMANHO" value="<?php echo $TAMANHO; ?>"></select>
                            </h5>
                            <input type="hidden" name="ID_PRODUTO" value="<?php echo $ID_PRODUTO; ?>">
                            <input type="submit" class="btn btn-dark" value="comprar">                               

                        </form>
                    
                </div> 
      
                </div>

    <?php         
    } 
}
?>
<?php
$busca= "SELECT  roupa.ID_PRODUTO,roupa.PRODUTO_NOME,roupa.VALOR,roupa.FOTO
  FROM roupa,categoria  WHERE 
roupa.ID_CATEGORIA = categoria.ID_CATEGORIA and
 categoria.DESCRICAO = 'b_promocao' and

  roupa.QUANTIDADE > 0 LIMIT $inicio , $limitereg";

  $resultado = $conn->prepare($busca);
  $resultado->execute();  

     
?>


    <?php
        if (($resultado) AND ($resultado->rowCount() != 0)){
        while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
           
            extract($linha);             
        
        ?>    


           
           <div class="card" style="width: 25rem; hight: 30px;">
                    <img class="card-img-top" src="<?php echo $FOTO; ?>">
                    <div class="card-body text-center">
                        <h3 class="card-text"><?php echo $PRODUTO_NOME; ?></h3>
                        <h4> R$ <?php echo $VALOR; ?>,00</h4>
            
                       <form action="carrinho.php" method="post">
                            <h5>
                            <label>Quant</label>
                            <input type="number" name="QUANTIDADE" value="1" style=width:45px;>
                            <label>Tamanho</label>
                            <select name="TAMANHO" value="1" style=width:45px;>
                            <input type="hidden" name="TAMANHO" value="<?php echo $TAMANHO; ?>"></select>
                            </h5>
                            <input type="hidden" name="ID_PRODUTO" value="<?php echo $ID_PRODUTO; ?>">
                            <input type="submit" class="btn btn-dark" value="comprar">                               

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



<div class="vermais text-center">
  <h1>YS VERANO MODA PRAIA</h1>
  <p>A Ys Verano é uma da Marcas de Moda Praia que tem uma dais maiores empresas do setor têxtil do mundo. Está em destaque no cenário da moda desdde que entrou no mercado.</p>
  <a  href="vermais.php" class="btn  mais">Ver mais+</a>
</div>

<?php
        require_once 'footer.php';

    ?>
 


