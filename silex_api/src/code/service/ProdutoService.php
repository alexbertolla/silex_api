<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace code\service;

use code\entity\Produto;
use code\mapper\ProdutoMapper;

/**
 * Description of ProdutoService
 *
 * @author alex
 */
class ProdutoService {

    public function inserirProduto($nome, $descricao, $valor) {
        $produto = new Produto();
        $produto->setNome($nome);
        $produto->setDescricao($descricao);
        $produto->setValor($valor);

        $produtoMapper = new ProdutoMapper();
        $result = $produtoMapper->inserirProduto($produto);
        return $result;
    }

    public function alterarProduto($id, $nome, $descricao, $valor) {
        $produto = new Produto();
        $produto->setId($id);
        $produto->setNome($nome);
        $produto->setDescricao($descricao);
        $produto->setValor($valor);

        $produtoMapper = new ProdutoMapper();
        $result = $produtoMapper->alterarProduto($produto);
        return $result;
    }
    
    public function excluirProduto($id){
        $produtoMapper = new ProdutoMapper();
        $result = $produtoMapper->excluirProduto($id);
        return $result;
    }

    public function listarProdutos() {
        $produtoMapper = new ProdutoMapper();
        return $produtoMapper->listarProdutos();
    }

    public function criarTabela() {
        $produtoMapper = new ProdutoMapper();
        return $produtoMapper->cirarTabela();
    }

    public function buscarPorId($id) {
        $produtoMapper = new ProdutoMapper();
        return $produtoMapper->buscarPorId($id);
    }

}
