<?php

/**
 * Nessa fase do projeto, você instalará o Silex e criará 1 rotas principal, 
 * apenas para garantir que tudo está configurado e funcionando.

  1)Rota: /clientes

  Com a rota /clientes, faça a simulação da listagem de clientes com Nome,
 * Email e CPF/CNPJ vindo de um array. O formato de exibição deve ser json.
 */
require_once '../vendor/autoload.php';

$app = new \Silex\Application();
$app['debug'] = TRUE;

$clientes = array(
    array('cpf' => '6575323', 'nome' => 'Alex', 'email' => 'alex@alex.com'),
    array('cpf' => '7859883', 'nome' => 'Sabrina', 'email' => 'sabrina@sabrina.com'),
    array('cpf' => '8482930', 'nome' => 'Gustavo', 'email' => 'gu@gustavo.com'),
    array('cpf' => '8940273', 'nome' => 'Ivo', 'email' => 'ivo@ivo.com'),
);
$response = new Symfony\Component\HttpFoundation\Response();

$app->get('/clientes', function () use($clientes, $response) {
    $response->setContent(json_encode($clientes));
    return $response;
});

$app->run();
