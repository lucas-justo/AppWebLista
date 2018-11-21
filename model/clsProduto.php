<?php


/**
 * Description of clsCliente
 *
 * @author assparremberger
 * 25/10/2018
 */
class Produto {
    private $id, $nome, $lote, 
           $categoria, $foto;
    
    function __construct($id = NULL, $nome = NULL, $lote = NULL, 
            $categoria = NULL, $foto = NULL) {
        $this->id = $id;
        $this->nome = $nome;
        $this->lote = $lote;
        $this->categoria = $categoria;
        $this->foto = $foto;
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getLote() {
        return $this->lote;
    }

    
    function getCategoria() {
        return $this->categoria;
    }

    function getFoto() {
        return $this->foto;
    }


    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setLote($lote) {
        $this->lote = $lote;
    }

    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    function setFoto($foto) {
        $this->foto = $foto;
    }

}











