<?php
    include_once 'model/clsCategoria.php';
    include_once 'model/clsProduto.php';
    include_once 'dao/clsConexao.php';
    include_once 'dao/clsProdutoDAO.php';
?>
<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" href="styles.css">
        <meta charset="UTF-8">
        <title>Lista de Compras - Produtos</title>
    </head>
    <body>
        <?php
            require_once 'menu.php';
        ?>
        
        <h1 align="center">Produtos</h1>
        
        <br><br><br>
        
        <a href="frmProduto.php">
            <button>Cadastrar novo produto</button></a>
        
        <br><br>
        <?php
            $lista = ProdutoDAO::getProdutos();
            
            if( $lista->count() == 0 ){
                echo '<h3><b>Nenhum produto cadastrado!</b></h3>';
            } else {
echo           
'<div id="lista2"> <style> 

#lista2 {display: flex;
	justify-content: center;}

th {
padding: 14px;
color: #6b2e5e;
text-align: center;
background-color:#1c2635;
} </style>'		  ;
			  
			  
			  
        ?>
        <table border="1">
            <tr>
                <th>Código</th>
                <th>Foto</th>
                <th>Nome do Produto</th>
                <th>Lote</th>
                <th>Categoria</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            
            <?php
			
			
echo ' <style> td {

padding: 18px;
color: #cc76ba;
text-align: center;
background-color:#283344;
font-size: 18px;
font-family: "Consolas";
width: 350px;

} </style>';
                    foreach ($lista as $cli){
                        echo '<tr> ';
                        echo '   <td>'.$cli->getId().'</td>';
                        echo '   <td><img src="fotos_clientes/'.$cli->getFoto().'" width="30px" /></td>';
                        echo '   <td>'.$cli->getNome().'</td>';
                        echo '   <td>'.$cli->getLote().'</td>';
                        echo '   <td>'.$cli->getCategoria()->getNome().'</td>';
                        
                        
                        echo '   <td><a href="frmProduto.php?editar&idProduto='.$cli->getId().'" ><button>Editar</button></a></td>';
                        echo '   <td><a href="controller/salvarProduto.php?excluir&idProduto='.$cli->getId().'" ><button>Excluir</button></a></td>';
                        echo '</tr>';
                        
                    }
            ?>
            
        </table>
        
        <?php
        echo '</div>';
            }
            
        ?>
        
    </body>
</html>




