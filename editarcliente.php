<?php

    require_once 'head.php';
    include_once 'conexao.php';
    session_start();
    ob_start();

    $id = filter_input(INPUT_GET, "ID_CLIENTE", FILTER_SANITIZE_NUMBER_INT);

    if (empty($id)) {
        $_SESSION['msg'] = "Erro: Cliente não encontrado!";
        header("Location: relacliente.php");
        exit();
    }

    $sql = "SELECT * from cliente where ID_CLIENTE = $id LIMIT 1";
    $resultado= $conn->prepare($sql);
    $resultado->execute();

    if(($resultado) AND ($resultado->rowCount() != 0)){
        $linha = $resultado->fetch(PDO::FETCH_ASSOC);
        //var_dump($linha);
        extract($linha);
    }
    else{
        $_SESSION['msg'] = "Erro: Cliente não encontrado!";
        header("Location: relacliente.php");
    }


?>


<form method="POST" action="controlecliente.php" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
                <div class="col-md-12 text-center">
                    <h3>Controle de Cliente</h3>
                </div>
        </div>

        <div class="row">

            <div class="col-md-1">
                <div class="form-group">
                    <label for="ID_CLIENTE">ID_CL</label>
                    <input type="text" class="form-control" name="ID_CLIENTE"
                    value="<?php echo $ID_CLIENTE;?>"
                    >    
                </div>
            </div>   

            <div class="col-md-4">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome"
                    value="<?php echo $NOME;?>"
                    >       
                </div>
            </div>           

            <div class="col-md-2">
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" class="form-control" onkeypress="$(this).mask('(00)00000-0000')"
                    value="<?php echo $TELEFONE;?>"                    
                    >
                </div>
            </div>

           
            <div class="col-md-2">        
              <div class="form-group">            
                  <label for="dn">Data de Nascimento</label>
                  <input type="date" class="form-control" name="dn"
                  value="<?php echo $DATANASC;?>"                    
                    >
              </div>
           </div>
        </div>
        
        <div class="row">
           
            <div class="col-md-3">        
                <div class="form-group">            
                    <label for="cpf">Cpf</label>
                    <input type="text" name="CPF" class="form-control" onkeypress="$(this).mask('000.000.000-00');"
                    value="<?php echo $CPF;?>"                    
                    >
                </div>
            </div>

        

            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Endereço de email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Seu email"
                    value="<?php echo $EMAIL;?>"                    
                    >                   
                </div>
            </div>


        </div>

        <div class="row">
            
            <div class="col-md-2">            
                <div class="form-group">
                    <label for="cep">Cep</label>
                    <input type="text" name="CEP" class="form-control" id="cep" onblur="pesquisacep(this.value);"
                    value="<?php echo $CEP;?>"                    
                    >                   
                </div>
            </div>

            <div class="col-md-6">            
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" class="form-control" id="rua" name="rua">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control" name="NUMERO"
                    value="<?php echo $NUMEROCASA;?>"                    
                    >    
                </div>
            </div> 
            
            <div class="col-md-2">
                <div class="form-group">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" name="COMPLEMENTO"
                    value="<?php echo $COMPLEMENTO;?>"                    
                    >
                </div>
            </div>
        </div>
        
        <div class="row">   

        <div class="col-md-5  ">
              <div class="form-group">
                 <label for="foto">Foto</label><p>
                 <input type="file" class="form-control" name="FOTO">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                   
                    <input type="submit" class="btn btn-primary" value="Enviar" name="btneditar">
                </div>  
            </div>
        </div>
    </div>
    </form>

<?php
    require_once 'footer.php';
?>




