<?php
    include_once 'model/clsCategoria.php';
    include_once 'model/clsProduto.php';
    include_once 'dao/clsCategoriaDAO.php';
    include_once 'dao/clsProdutoDAO.php';
    include_once 'dao/clsConexao.php';
    
    $nome = "";
    $telefone = "";
    $email = "";
    $cpf = "";
    $sexo = "";
    $filhos = 0;
    $idCidade = 0;
    $foto = "sem_foto.png";
    $action = "inserir";
    
    if( isset($_REQUEST['editar']) ){
        $id = $_REQUEST['idProduto'];
        $produto = ProdutoDAO::getProdutoById($id);
        $nome = $produto->getNome();
        $lote = $produto->getLote();
        $foto = $produto->getFoto();
        $idCategoria = $produto->getCategoria()->getId();
        $action = "editar&idProduto=".$produto->getId();
    }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lista de Compras - Cadastrar Produto</title>
		<link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <?php
            require_once 'menu.php';
        ?>
        
         <h1 align="center">Cadastrar Produto</h1>
        
        <br><br><br>
        
        <form action="controller/salvarProduto.php?<?php echo $action; ?>" method="POST" 
              enctype="multipart/form-data">
            <label>Nome: </label>
            <input type="text" name="txtNome" value="<?php echo $nome; ?>" required maxlength="100" /> <br><br>
            <label>Lote: </label>
            <input type="text" name="txtLote" value="<?php echo $telefone; ?>" maxlength="30" /> <br><br>
            
            <label>Categoria: </label>
            <select name="categoria" >
                <option value="0"  >Selecione...</option>
                <?php
                    $lista = CategoriaDAO::getCategorias();
                    
                    foreach ($lista as $cid){
                        $selecionar = "";
                        if( $idCategoria == $cid->getId() ){
                            $selecionar = " selected ";
                        }
                        
                        echo '<option '.$selecionar.' value="'.$cid->getId().'" >'.
                                $cid->getNome().'</option>';
                    }
                ?>
                
            </select>
            
            
            <label>Foto: </label>
            
            <?php 
                if( isset($_REQUEST['editar'])){
                    echo '<img src="fotos_produtos/'.$foto.'" width="30px" />';
                }
            ?>
            
            <input type="file" name="foto" /> <br><br>
            <?php
                if( !isset( $_REQUEST['editar'] )){
            ?>
                
            <?php 
                }
            ?>
            <input type="submit" value="Salvar" />
            <input type="reset" value="Limpar" />
            
            
        </form>
        
        
    </body>
</html>
