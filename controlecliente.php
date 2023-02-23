<?php
require_once 'head.php';
require_once 'menu.php';    
    include_once 'conexao.php';
    

    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }    


    try{

    $dadoscad = filter_input_array(INPUT_POST, FILTER_DEFAULT);
var_dump($dadoscad);


    if(isset($_FILES['foto'])){
        $arquivo = ($_FILES['foto']);
        

        if($arquivo['error']){
            echo 'Erro ao carregar arquivo';
            header ("Location: frmcliente.php");
        }

        $pasta = "foto/";
        $nomearquivo = $arquivo['name'];
        $novonome = uniqid();
        $extensao = strtolower(pathinfo($nomearquivo, PATHINFO_EXTENSION));

        if($extensao!="jpg" && $extensao!="png"){
            die("Tipo não aceito");
        }
        else{
            $salvaimg = move_uploaded_file($arquivo['tmp_name'], $pasta . $novonome . "." . $extensao);

             if($salvaimg){
                 $path = $pasta . $novonome . "." . $extensao;
                 echo "ok";
             }

        }


    }


   if (!empty($dadoscad['btncad'])) {

        $vazio = false;

        $dadoscad = array_map('trim', $dadoscad);
        if (in_array("", $dadoscad)) {
            $vazio = true;
           
            echo "<script>
        alert('Preencher todos os campos!!!');
        parent.location = 'frmcliente.php';
        </script>";

        } else if(!filter_var($dadoscad['email'], FILTER_VALIDATE_EMAIL)) {
            $vazio = true;

            echo "<script>
            alert('Informe um e-mail válido!!');
            parent.location = 'frmcliente.php';
            </script>";
            
            
        }
    

if (!$vazio) {

$status = "A";
    $senha = password_hash($dadoscad['senha'], PASSWORD_DEFAULT);

    $sql = "insert into cliente(NOME,DATANASC,CPF,TELEFONE,EMAIL,CEP,NUMEROCASA,COMPLEMENTO,SENHA,FOTO,STATUS)
    values(:NOME,:DATANASC,:CPF,:TELEFONE,:EMAIL,:CEP,:NUMEROCASA,:COMPLEMENTO,:SENHA,:FOTO,:STATUS)";

    $salvar= $conn->prepare($sql);
    $salvar->bindParam(':NOME', $dadoscad['nome'], PDO::PARAM_STR);
    $salvar->bindParam(':DATANASC', $dadoscad['dn'], PDO::PARAM_STR);
    $salvar->bindParam(':CPF', $dadoscad['cpf'], PDO::PARAM_STR);
    $salvar->bindParam(':TELEFONE', $dadoscad['telefone'], PDO::PARAM_STR);
    $salvar->bindParam(':EMAIL', $dadoscad['email'], PDO::PARAM_STR);
    $salvar->bindParam(':CEP', $dadoscad['cep'], PDO::PARAM_INT);
    $salvar->bindParam(':NUMEROCASA', $dadoscad['numero'], PDO::PARAM_STR);
    $salvar->bindParam(':COMPLEMENTO', $dadoscad['complemento'], PDO::PARAM_STR);
    $salvar->bindParam(':SENHA', $senha, PDO::PARAM_STR);
    $salvar->bindParam(':FOTO',  $path, PDO::PARAM_STR);
    $salvar->bindParam(':STATUS',$status, PDO::PARAM_STR);

    $salvar->execute();

    if ($salvar->rowCount()) {
        
        echo "<script>
        alert('Usuário cadastrado com sucesso!!');
        parent.location = 'frmcliente.php';
        </script>";

        unset($dadoscad);
    } else {
        echo "<script>
        alert('Não foi possível cadastrar Usuário.');
        parent.location = 'frmcliente.php';
        </script>";
        
    }

}

}


if (!empty($dadoscad['btneditar'])) {

    $dadoscad = array_map('trim', $dadoscad);

    if(!filter_var($dadoscad['email'], FILTER_VALIDATE_EMAIL)) {
        $vazio = true;

        echo "<script>
        alert('Informe um e-mail válido!!');
        parent.location = 'frmcliente.php';
        </script>";
        
        
    }

    $sql = "UPDATE cliente set NOME=:NOME,DATANASC=:DATANASC,CPF=:CPF,TELEFONE=:TELEFONE,EMAIL=:EMAIL,CEP=:CEP,NUMEROCASA=:NUMEROCASA,
  COMPLEMENTO=:COMPLEMENTO,FOTO=:FOTO, WHERE ID_CLIENTE = :ID_CLIENTE";

    $salvar= $conn->prepare($sql);
    $salvar->bindParam(':NOME', $dadoscad['NOME'], PDO::PARAM_STR);
    $salvar->bindParam(':DATANASC', $dadoscad['DATANASC'], PDO::PARAM_STR);
    $salvar->bindParam(':CPF', $dadoscad['CPF'], PDO::PARAM_STR);
    $salvar->bindParam(':TELEFONE', $dadoscad['TELEFONE'], PDO::PARAM_STR);
    $salvar->bindParam(':EMAIL', $dadoscad['EMAIL'], PDO::PARAM_STR);
    $salvar->bindParam(':CEP', $dadoscad['CEP'], PDO::PARAM_STR);
    $salvar->bindParam(':NOMEROCASA', $dadoscad['NUMEROCASA'], PDO::PARAM_STR);
    $salvar->bindParam(':COMPLEMENTO', $dadoscad['COMPLEMENTO'], PDO::PARAM_STR);
    $salvar->bindParam(':FOTO', $path , PDO::PARAM_STR);
    $salvar->bindParam(':ID_CLIENTE', $dadoscad['ID_CLIENTE'], PDO::PARAM_INT);
    $salvar->execute();

    if ($salvar->rowCount()) {
        
        echo "<script>
        alert('Cliente Atualizado com sucesso!!');
        parent.location = 'relaclientes.php';
        </script>";

        unset($dadoscad);
    } else {
        echo "<script>
        alert('Cliente não cadastrado!');
        parent.location = 'relaclientes.php';
        </script>";
        
    }





}

}
catch(PDOException $erro){
    echo $erro;

}

?>


<?php
require_once 'footer.php';
?>