<?php
include_once '../model/clsProduto.php';
include_once '../model/clsCategoria.php';
include_once '../dao/clsProdutoDAO.php';
include_once '../dao/clsConexao.php';

if( isset($_REQUEST['inserir'])  ){
   
    
    if( $_POST['categoria'] == 0 ){
        echo "<body onload='window.history.back();'>";
    }else{
    
        $produto = new Produto();
        $produto->setNome( $_POST['txtNome'] );
        $produto->setLote( $_POST['txtLote'] );
        
        $cid = new Categoria();
        $cid->setId( $_POST['categoria']);
        $produto->setCategoria( $cid ); 
        
        $produto->setFoto( salvarFoto() );
        
        ProdutoDAO::inserir( $produto );
        
        header("Location: ../produtos.php");
    }   
}



if( isset($_REQUEST['editar'])){
    
    $id = $_REQUEST['idproduto'];
    $produto = ProdutoDAO::getProdutoById($id);
    
     if( isset( $_FILES['foto']['name']) && 
            $_FILES['foto']['name'] != "" ){
         $nova_foto = salvarFoto();
         if( $produto->getFoto() != "sem_foto.png"){
             unlink("../fotos_produtos/".$produto->getFoto());
         }
         $produto->setFoto($nova_foto);
     }
    
    $produto->setNome( $_POST['txtNome'] );
    $produto->setLote( $_POST['txtLote'] );
   
    $cid = new Categoria();
    $cid->setId( $_POST['categoria']);
    $produto->setCategoria( $cid );
    
    ProdutoDAO::editar($produto);
    
    header("Location: ../produtos.php");
    
}


function salvarFoto(){
    $nome_arquivo = "";
    if( isset( $_FILES['foto']['name']) && 
            $_FILES['foto']['name'] != "" ){
        $nome_arquivo = date('YmdHis').
              basename( $_FILES['foto']['name'] );
        $diretorio = "../fotos_produtos/";
        $caminho = $diretorio.$nome_arquivo;
        if( ! move_uploaded_file( $_FILES['foto']['tmp_name'] ,
                $caminho ) ){
            $nome_arquivo = "sem_foto.png";
        }
        
    } else {
        $nome_arquivo = "sem_foto.png";
    }
    return $nome_arquivo;
}


if( isset($_REQUEST['excluir'])){
    $id = $_REQUEST['idproduto'];
    $produto = ProdutoDAO::getprodutoById($id);
    echo '<br><br><hr> '
       . '<h3>Confirma a exclusão do produto  '
       .$produto->getNome(). '? </h3> '
       . '<br><hr>';
    echo  '<a href="?confirmaExcluir&idproduto='.$id.'">'
        . '    <button>SIM</button></a> ';
    echo '<a href="../produtos.php" ><button>NÃO</button></a>';
}

if( isset( $_REQUEST['confirmaExcluir'] ) ){
    $id = $_REQUEST['idproduto'];
    $produto = ProdutoDAO::getProdutoById($id);
    if( $produto->getFoto() != "" &&  
        $produto->getFoto() != "sem_foto.png" ){
        unlink("../fotos_produtos/".$produto->getFoto() );
    }
    ProdutoDAO::excluir($produto);
    header("Location: ../produtos.php");
}


