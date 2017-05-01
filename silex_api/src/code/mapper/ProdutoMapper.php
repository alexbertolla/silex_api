<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace code\mapper;

use code\entity\Produto;
use code\dao\ProdutoDao;

/**
 * Description of ProdutoMapper
 *
 * @author alex
 */
class ProdutoMapper {

    public function inserirProduto(Produto $produto) {
        $conn = ProdutoDao::setConn();
        $produtoDao = new ProdutoDao();
        $resultado = $produtoDao->inserirProduto($produto, $conn);
        return $resultado;
    }
    
    public function alterarProduto(Produto $produto){
        $conn = ProdutoDao::setConn();
        $produtoDao = new ProdutoDao();
        $resultado = $produtoDao->alterarProduto($produto, $conn);
        return $resultado;
    }
    
    public function excluirProduto($id){
        $conn = ProdutoDao::setConn();
        $produtoDao = new ProdutoDao();
        $resultado = $produtoDao->excluirProduto($id, $conn);
        return $resultado;
    }

    public function listarProdutos() {
        $conn = ProdutoDao::setConn();
        $produtoDao = new ProdutoDao();
        $resultado = $produtoDao->listarProdutos($conn);
        return $resultado;
    }

    public function cirarTabela() {
        $conn = ProdutoDao::setConn();
        $produtoDao = new ProdutoDao();
        $resultado = $produtoDao->criarTabela($conn);
        return $resultado;
    }

    public function buscarPorId($id) {
        $conn = ProdutoDao::setConn();
        $produtoDao = new ProdutoDao();
        $resultado = $produtoDao->buscarPorId($id, $conn);
        return $resultado;
    }

}
