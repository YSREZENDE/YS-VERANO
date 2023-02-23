<?php
    
    session_start();
    ob_start();

    if(!isset($_SESSION["quant"])){
      $_SESSION["quant"] = 0;
    }

?>




<!--caebçalho-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
        <img src="img\logo1.png" alt="Bootstrap" width="50" height="45"> Ys Verano</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(página atual)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#footer2">Contato</a>
            </li>
            
     
                <!--fim-->      
           <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Produtos</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="maio.php">Maiôs</a>
                <a class="dropdown-item" href="biquini.php">Biquínis</a>
                <a class="dropdown-item" href="divercos.php">Diverços</a>
              
        
              </div>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="O que você procura?" aria-label="Pesquisar">
            <button class="btn btn-outline-light my-2 my-sm-0 " type="submit">Pesquisar</button>
            
           
          </form>

  



         
           <!--area c-->
         <form class="form-inline my-2 my-lg-0">
             <!-- Botão para acionar modal -->
             <button type="button" class="btn" data-toggle="modal" data-target="#login">
             <i class="fa-solid fa-user"> </i>
            </button>
            <button type="button" class="btn" >
            <a href="frmcarrinho.php">
            <i class="fa-solid fa-cart-shopping"  >
            <?php 
              if($_SESSION["quant"]>0){
                 echo $_SESSION["quant"]; 
              }
            ?>
         
            </i>
          </a>
          </button>
          
          </form>
        </div>
    </nav>


   <!-- Modal login -->
   <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center text-info" id="exampleModalLabel">Acesso </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="login">
       
        <div class="container-fluid">
            <div id="login-row" class="row justify-content-center">
               
                   
                        <form id="login-form" class="form" action="login.php" method="post">
                            
                            <div class="form-group">
                                <label for="username" class="text-info">Nome de Usuário:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Senha:</label><br>
                                <input type="text" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Lembrar</span> <span><input id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <a href="administrativo.php">  <button  class="btn btn-info btn-md" value="Enviar" name="btnlogin">Entrar</button></a>
        
                                <a href="frmcliente.php"><button type="button" name="cadastro" class="btn btn-info  btn-dark">Cadastre-se</button> </a>
                            </div>
                            
                        </form>
                   
               
            </div>
        </div>
    </div>
            
      </div>
     
    </div>
  </div>
</div>
<!--end login-->
      
        </div>
        
      </nav>