<?php

/**
 * Agora que você já possui os serviços criados e sendo persistidos no banco dados, 
 * faça uma interface HTML de um CRUD (Operações de Criar, Recuperar, Alterar e Remover) 
 * utilizando esses serviços utilizando o Twig.
 * Lembrando que você obrigatóriamente terá de utilizar: 
 * Layouts e o UrlGenerator para fazer o link entre as páginas. 
 * Para facilitar o design da aplicação, utilize um tema básico do Twitter Bootstrap.
 */
use code\service\ProdutoService;

require_once '../vendor/autoload.php';

$app = new \Silex\Application();
$app['debug'] = TRUE;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => '../views',
));

$app->register(new \Silex\Provider\RoutingServiceProvider());


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


$app->get('/', function () use($app, $response) {
    $listaProdutos = $app['produtoService']->listarProdutos();
    $response->setContent(json_encode($listaProdutos));
    return $app['twig']->render('listarProdutos.twig', ['produtos' => $listaProdutos]);
})->bind('listarProdutos');


$app->get('/cadastrarProduto/{id}', function ($id) use($app, $response) {
    $produto = $app['produtoService']->buscarPorId($id);
    if ($produto) {
        $response->setContent(json_encode($produto));
        return $app['twig']->render('formProduto.twig', ['id' => $produto->id, 'nome' => $produto->nome, 'descricao' => $produto->descricao, 'valor' => $produto->valor]);
    } else {
        return $app['twig']->render('formProduto.twig', ['id' => '', 'nome' => '', 'descricao' => '', 'valor' => '']);
    }
})->bind('cadastrarProduto');

$app->post('/salvarProduto/', function () use($app, $response) {
    $get = filter_input_array(INPUT_POST);
    if ($get['id']) {
        $app['produtoService']->alterarProduto($get['id'], $get['nome'], $get['descricao'], $get['valor']);
    } else {
        $app['produtoService']->inserirProduto($get['nome'], $get['descricao'], $get['valor']);
    }

    $listaProdutos = $app['produtoService']->listarProdutos();
    $response->setContent(json_encode($listaProdutos));
    return $app['twig']->render('listarProdutos.twig', ['produtos' => $listaProdutos]);
})->bind('salvarProduto');

$app->get('/excluirProduto/{id}', function ($id) use($app, $response) {
    $app['produtoService']->excluirProduto($id);
    $listaProdutos = $app['produtoService']->listarProdutos();
    $response->setContent(json_encode($listaProdutos));
    return $app['twig']->render('listarProdutos.twig', ['produtos' => $listaProdutos]);
})->bind('excluirProduto');

$app->run();

