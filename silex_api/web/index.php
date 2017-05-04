<?php

/**
 * Agora que você já desenvolveu uma aplicação que possui: Camada de Serviços e Interface utilizando o Twig, disponibilize uma API REST, para que softwares externos possam consumir.

 * Você deverá disponibilizar as seguintes funções: Listar tudo, listar apenas 1, criar, alterar e remover.
 */
use code\service\ProdutoService;
use Symfony\Component\HttpFoundation\Request;

require_once '../vendor/autoload.php';

$app = new \Silex\Application();
$app['debug'] = TRUE;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => '../views',
));

$app->register(new \Silex\Provider\RoutingServiceProvider());


$arrayProdutos = array(
    array('id' => '1', 'nome' => 'livro', 'descricao' => 'livro capa dura', 'valor' => 30.00),
    array('id' => '2', 'nome' => 'caderno', 'descricao' => 'scaderno 100 folhar', 'valor' => 20, 00),
    array('id' => '3', 'nome' => 'caneta', 'descricao' => 'caneta azul', 'valor' => 1.50),
    array('id' => '4', 'nome' => 'lapis', 'descricao' => 'labis 2.0', 'valor' => 1.20),
);


$app['produtoService'] = function () {
    return new ProdutoService();
};

$response = new Symfony\Component\HttpFoundation\Response();

$app->get('/api/produtos/criarTabela', function () use ($app, $arrayProdutos) {
    $criarTabela = $app['produtoService']->criarTabela($arrayProdutos);
    return $app->json($criarTabela);
});

$app->get('/api/produtos', function () use ($app) {
    $listaProdutos = $app['produtoService']->listarProdutos();
    return $app->json($listaProdutos);
});

$app->get('/api/produtos/{id}', function ($id) use ($app) {
    $listaProdutos = $app['produtoService']->buscarPorId($id);
    return $app->json($listaProdutos);
});


$app->post('/api/produtos', function (Request $request) use ($app) {
    $nome = $request->request->get('nome');
    $descricao = $request->request->get('descricao');
    $valor = $request->request->get('valor');

    $resultado = $app['produtoService']->inserirProduto($nome, $descricao, $valor);
    return $app->json($resultado);
});

$app->put('/api/produtos/{id}', function (Request $request, $id) use ($app) {
    $nome = $request->request->get('nome');
    $descricao = $request->request->get('descricao');
    $valor = $request->request->get('valor');

    $resultado = $app['produtoService']->alterarProduto($id, $nome, $descricao, $valor);
    return $app->json($resultado);
});

$app->delete('/api/produtos/{id}', function ($id) use ($app) {

    $resultado = $app['produtoService']->excluirProduto($id);
    return $app->json($resultado);
});

$app->run();

