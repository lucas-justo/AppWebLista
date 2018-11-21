<?php
include_once 'model/clsCategoria.php';
include_once 'dao/clsCategoriaDAO.php';
include_once 'dao/clsConexao.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lista de Compras - Categorias</title>
		<link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php
            require_once 'menu.php';
        ?>
        
        <h1 align="center">Categorias</h1>
        
        <br><br><br>
        
        <form action="controller/salvarCategoria.php?inserir" method="POST" >
            <label style="color: #cc76ba;">Nome: </label>
            <input type="text" name="txtNome" />
            <input type="submit" value="Salvar" />
        </form>
        
        <hr>
        
        <?php
            
            $lista = CategoriaDAO::getCategorias();
            
            if ( $lista->count()==0){
                echo '<h2><b>Nenhuma categoria cadastrada</b></h2>';
            }else {
                
            echo 
'<div id="lista"> <style> 

#lista {display: flex;
	justify-content: center;}

th {
padding: 14px;
color: #6b2e5e;
text-align: center;
background-color:#1c2635;
} </style>';

        ?>
        
        <table border="1">
            <tr>
                <th>Código</th>
                <th>Nome</th>
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
			
			
                foreach ($lista as $categoria) {
                    echo '
					<tr>
                        <td>'.$categoria->getId().'</td>
                        <td>'.$categoria->getNome().'</td>
                        <td> 
                            <a href="controller/salvarCategoria.php?editar&idCategoria='.$categoria->getId().'">
                            
                            <button>Editar</button></a>
                        </td>
                        <td>
                            <a href="controller/salvarCategoria.php?excluir&idCategoria='.$categoria->getId().'">
                            
                            <button>Excluir</button></a>
                            </td>
                          </tr> ';            
                }
            ?>
            
        </table>
        
        <br><br><br>
        <?php
		echo '</div>';
          }
        ?>
        
    </body>
</html>
