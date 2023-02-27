<?php

  require_once 'head.php';
  require_once 'menu.php';
  require_once 'conexao.php';

  $buscalogin = "SELECT ID_CLIENTE,NOME,DATANASC,TELEFONE,CEP,SENHA,FOTO FROM cliente  
  LIMIT 1";
//var_dump($resposta);
$resultado= $conn->prepare($buscalogin);
$resultado->bindParam(':usuario', $dadoslogin['usuario'], PDO::PARAM_STR);
$resultado->execute();
  
?>  
        
 
        <div><h1>Minha conta</h1><br></div>

  
        <table class="table">
        <thead>
         <tr>
       
            <th scope="col">FOTO</th>
            <th scope="col">Nome</th>
            <th scope="col">Data nascimento</th>
            <th scope="col">Telefone</th>
            <th scope="col">CEP</th>
            <th scope="col">Senha</th>
      
            <th scope="col">Editar Dados</th>
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
              <td><?php echo $NOME?></td>
              <td><?php echo $DATANASC ?></td>
              <td><?php echo $TELEFONE ?></td>
              <td><?php echo $CEP ?></td>
             <td><?php echo $SENHA?></td>
        
              <td>
                 <?php echo "<a href='editarprod.php?codigo=$ID_CLIENTE'>" ; ?>
                <input type="submit" class="btn btn-primary" name="editar" value="Editar">
              </td>
              <td>
                 <?php echo "<a href='excluirprod.php?codigo=$ID_CLIENTE'>" ; ?>
                 
                 <input type="submit" class="btn btn-danger" name="excluir" value="Excluir">
              </td>
            </tr>   
             
             
             

<?php         
    } 
?>
</tbody>
</table>








<?php
    echo "Bem vindo(a)" . $_SESSION['nome'];
    if(!isset($_SESSION['nome'])){
        $_SESSION['msg'] = "Erro: Necessário realizar o login para acessar a página!";
        header("Location: login.php");
    }
?>

<a href="sair.php"><button type="submit">Sair</button></a>