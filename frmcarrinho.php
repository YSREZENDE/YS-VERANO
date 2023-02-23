<?php
    

    require_once 'head.php';
    require 'menu.php';
    include_once 'conexao.php';


$totalcompra = 0;

$sql = "SELECT * from carrinho";
$resultado= $conn->prepare($sql);
$resultado->execute();

if(($resultado)and($resultado->RowCount()!=0)){

    ?>
  <form action="finalizacarrinho.php" method="post"> 
    <table class="table">
    <thead>
     <tr>
        <th scope="col">Imagem</th>
        <th scope="col">Nome</th>
        <th scope="col">Preço</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Tamanho</th>
        <th scope="col">Total</th>    
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
          <td><?php echo $NOME ?></td>
          <td><?php echo $VALOR ?></td>
          <td><?php echo $QUANTCOMPRA ?></td>
          <td><?php echo $TAMANHO ?></td>
          <td><?php echo $total = $QUANTCOMPRA * $VALOR; 
          $totalcompra += $total; ?></td>
         
        <td>                 
             <a href="finalizacarrinho.php"><button type="submit" class="btn btn-danger" name="excluir" value="<?php echo $CODIGOPRODUTO; ?>">Excluir</button></a>
          </td>
        </tr>        
         

<?php   
} ?>












<tr><td><?php echo "Total da Compra - R$ ".$totalcompra; ?></td></tr>
</tbody>
</table>

<?php $_SESSION["totalcompra"]=$totalcompra; ?>
<input type="submit" class="btn btn-primary" value="Finalizar Compra">
</form>
<?php
}
?>

<?php
require_once 'footer.php';
?>