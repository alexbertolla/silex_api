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

    public function inserirProduto(array $produtoArray) {
        $produto = new Produto();
        $produto->setId($produtoArray['id']);
        $produto->setNome($produtoArray['nome']);
        $produto->setDescricao($produtoArray['descricao']);
        $produto->setValor($produtoArray['valor']);

        $produtoMapper = new ProdutoMapper();
        $result = $produtoMapper->inserirProduto($produto);
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

}
