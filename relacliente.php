<?php

require_once 'head.php';
require_once 'menu.php';
include_once 'conexao.php';


$pagatual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
$pag = (!empty($pagatual)) ? $pagatual : 1;


    $limitereg = 3;

    $inicio = ($limitereg * $pag) - $limitereg;

    $busca= "SELECT ID_CLIENTE,CPF,NOME,TELEFONE,EMAIL,CEP
    FROM cliente  WHERE status = 'A' LIMIT $inicio , $limitereg";

$resultado = $conn->prepare($busca);
$resultado->execute();

    if (($resultado) AND ($resultado->rowCount() != 0)){
       
        echo "<h1><br>Relatório de Clientes</br></h1>";



?>
 <table class="table">
        <thead>
         <tr>
            <th scope="col">ID_CLIENTE</th>
            <th scope="col">Cpf</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Email</th>
            <th scope="col">CEP</th>
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
              <td scope="row"><?php echo $ID_CLIENTE?></td>
              <td><?php echo $CPF ?></td>
              <td><?php echo $NOME ?></td>
              <td><?php echo $TELEFONE ?></td>
              <td><?php echo $EMAIL ?></td>
              <td><?php echo $CEP ?></td>
              <td>
             
                 <?php echo "<a href='editarcliente.php?ID_CLIENTE=$ID_CLIENTE'>" ; ?>
                <input type="submit" class="btn btn-primary" name="editar" value="Editar">
              </td>
              <td>
                 <?php echo "<a href='excluircliente.php?ID_CLIENTE=$ID_CLIENTE'>" ; ?>
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
     $qtregistro = "SELECT COUNT(ID_CLIENTE) AS registros FROM cliente
     WHERE status = 'A'";
     $resultado = $conn->prepare($qtregistro);
     $resultado->execute();
     $resposta = $resultado->fetch(PDO::FETCH_ASSOC);

     //Quantidade de página que serão usadas - quantidade de registros
     //dividido pela quantidade de registro por página
     $qnt_pagina = ceil($resposta['registros'] / $limitereg);

      // Maximo de links      
      $maximo = 2;

      echo "<a href='relaclientes.php?page=1'>Primeira</a> ";
    // Chamar página anterior verificando a quantidade de páginas menos 1 e 
    // também verificando se já não é primeira página
    for ($anterior = $pag - $maximo; $anterior <= $pag - 1; $anterior++) {
        if ($anterior >= 1) {
            echo "  <a href='relacliente.php?page=$anterior'>$anterior</a> ";
        }
    }

    //Mostrar a página ativa
    echo "$pag";

    //Chamar próxima página, ou seja, verificando a página ativa e acrescentando 1
    // a ela
    for ($proxima = $pag + 1; $proxima <= $pag + $maximo; $proxima++) {
        if ($proxima <= $qnt_pagina) {
            echo "<a href='relacliente.php?page=$proxima'>$proxima</a> ";
        }
    }

    echo "<a href='relacliente.php?page=$qnt_pagina'>Última</a> ";


?>
<?php
require_once 'footer.php';
?>