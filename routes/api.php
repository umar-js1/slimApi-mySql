<?php


use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Factory\AppFactory;
$app->get('/', function(Request $request, Response $response) {
    $response_str = json_encode(['message' => 'Welcome to our  API']);
    $response->getBody()->write($response_str);
    return $response->withHeader('Content-Type', 'application/json');
});
$app->get('/users', function(Request $request, Response $response) {
    
    $queryBuilder = $this->get('DB')->getQueryBuilder();

    $queryBuilder
        ->select('id','name')
        ->from('users')
    ;
    
    $results = $queryBuilder->executeQuery()->fetchAll();

    $response->getBody()->write(json_encode($results));
    return $response
            ->withHeader('content-type', 'application/json');

});

//
/*
 Route to get a single player
*/

$app->get('/user/{id}', function(Request $request, Response $response, array $args) {
    
    $queryBuilder = $this->get('DB')->getQueryBuilder();

    $queryBuilder
        ->select('id', 'name')
        ->from('users')
        ->where('Id = ?')
        ->setParameter(1, $args['id'])
    ;
    
    $results = $queryBuilder->executeQuery()->fetchAssociative();

    $response->getBody()->write(json_encode($results));
    return $response
            ->withHeader('content-type', 'application/json');

});
/*
 Route to add a new player
*/

$app->post('/user/add', function(Request $request, Response $response) {
    $parsedBody = $request->getParsedBody();

    $queryBuilder = $this->get('DB')->getQueryBuilder();
    $queryBuilder
        ->insert('user')
        ->setValue('name', '?')
        ->setValue('email', '?')
        ->setParameter(1, $parsedBody['name'])
        ->setParameter(2, $parsedBody['email'])

    ;

    $results = $queryBuilder->executeQuery();//->fetchAssociative();

    $response->getBody()->write(json_encode($results));
    return $response;//->withHeader('content-type', 'application/json');
})//->add($dataValidator)->add($apiKeyVerifier)
;