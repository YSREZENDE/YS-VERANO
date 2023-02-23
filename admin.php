<?php
require_once 'menu.php';
  require_once 'head.php';

    //session_start();
    ob_start();
  

?>  

<a  href="frmcliente.php"><button type="submit">Cadastro de Cliente</button></a>

<a href="relacliente.php"><button type="submit">Relatório de Cliente</button></a>

<a href="frmproduto.php"><button type="submit">Cadastro de Produto</button></a>
<a href="relaproduto.php"><button type="submit">Relatório de Produto</button></a>





<?php
require_once 'footer.php';
?>