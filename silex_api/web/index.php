<?php

/**
 * Utilizando os mesmos conceitos apresentados sobre a criação de novos serviços, 
 * crie um serviço que seja capaz de administrar uma simples table de produtos 
 * com o seguintes campos: (id, nome, descrição e valor).

 * Após a criação do serviço, faça o registro do mesmo no container de serviço do 
 * Silex.
 */
use code\service\ProdutoService;

require_once '../vendor/autoload.php';

$app = new \Silex\Application();
$app['debug'] = TRUE;

$produtos = array(
    array('id' => '1', 'nome' => 'livro', 'descricao' => 'livro capa dura', 'valor' => 30.00),
    array('id' => '2', 'nome' => 'caderno', 'descricao' => 'scaderno 100 folhar', 'valor' => 20, 00),
    array('id' => '3', 'nome' => 'caneta', 'descricao' => 'caneta azul', 'valor' => 1.50),
    array('id' => '4', 'nome' => 'lapis', 'descricao' => 'labis 2.0', 'valor' => 1.20),
);


$app['produtoService'] = function () {
    return new ProdutoService();
};

$response = new Symfony\Component\HttpFoundation\Response();

$app->get('/produtos/inserir', function () use($produtos, $app) {
    $mensagem = '';
    foreach ($produtos as $produto) {
        $app['produtoService']->inserirProduto($produto);
        $mensagem .= "Produto {$produto['nome']} inserido <br>";
    }
    echo $mensagem;
});


$app->get('/produtos/listar', function () use($app, $response) {
    $lista = $app['produtoService']->listarProdutos();
    $response->setContent(json_encode($lista));
    return $response;
});

$app->get('/produtos/criarTabela', function () use($app) {
    $app['produtoService']->criarTabela();
    echo 'Tabela criada com sucesso!';
});

$app->run();

