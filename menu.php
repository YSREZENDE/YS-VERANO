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
                <a class="dropdown-item" href="divercos.php">Diversos</a>
              
        
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
             <button type="button" class="btn"  data-target="#login">
             <a href="login.php">
             <i class="fa-solid fa-user"> 
            
             </i>
          </a>
             </i>
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
  
        </div>
        
      </nav>