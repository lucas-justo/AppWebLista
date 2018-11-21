<?php

class ProdutoDAO {
    
    public static function inserir($produto){
        $sql = "INSERT INTO produtos "
                . " ( nome, lote, "
                . "   foto, codCategoria) VALUES "
                . " ( '".$produto->getNome()."' , "
                . "   '".$produto->getLote()."' , "
                . "   '".$produto->getFoto()."' , "
                . "    ".$produto->getCategoria()->getId()."  "
                . "  ); ";
        
        Conexao::executar( $sql );
    }
    
    public static function editar($produto){
        $sql = "UPDATE produtos SET " 
                . " nome =     '".$produto->getNome()."' , "
                . " lote = '".$produto->getTelefone()."' , "
                . " foto  =    '".$produto->getFoto()."' , "
                . " codCategoria = ".$produto->getCategoria()->getId()."  "
                . " WHERE id = ".$produto->getId();
        
        Conexao::executar( $sql );
    }
    
    
    public static function excluir($produto){
        $sql = "DELETE FROM produtos "
             . " WHERE id =  ".$produto->getId();
        
        Conexao::executar( $sql );
    }
    
    public static function getProdutos(){
        $sql = " SELECT c.id, c.nome, c.lote, "
             . " c.foto, d.id, d.nome"
             . " FROM produtos c "
             . " INNER JOIN categorias d "
             . " ON c.codCategoria = d.id "
             . " ORDER BY c.nome ";
        
        $result = Conexao::consultar($sql);
        $lista = new ArrayObject();
        while( list( $cod, $nome, $lote,
            $foto, $codCat, $nomeCat) = mysqli_fetch_row($result) ){
            $categoria = new Categoria();
            $categoria->setId( $codCat );
            $categoria->setNome( $nomeCat );
            $produto = new Produto();
            $produto->setId($cod);
            $produto->setNome($nome);
            $produto->setLote($lote);
            $produto->setFoto($foto);
            $produto->setCategoria($categoria);           
  
            $lista->append($produto);
        }
        
        return $lista;
    }
    
    
   public static function getProdutoById( $id ){
        $sql = " SELECT c.id, c.nome, c.lote,"
             . " c.foto, d.id, d.nome, "
             . " FROM produtos c "
             . " INNER JOIN categorias d "
             . " ON c.codCategoria = d.id "
             . " WHERE c.id = ".$id 
             . " ORDER BY c.nome ";
        
        $result = Conexao::consultar($sql);
      
        list( $_id, $_nome, $_lote, 
            $_foto, $_codCat, $_nomeCat) = mysqli_fetch_row($result);
            $categoria = new Categoria();
            $categoria->setId( $_codCat );
            $categoria->setNome( $_nomeCat );
            $produto = new Produto();
            $produto->setId($_id);
            $produto->setNome($_nome);
            $produto->setLote($_lote);
            $produto->setFoto($_foto);
            $produto->setCategoria($categoria); 
            
        return $produto;
    }
  
    
   
    
}












