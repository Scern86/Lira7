<?php

require_once 'vendor' . DS . 'autoload.php';

use Scern\Lira\Application\{Application, Extensions};
use Scern\Lira\Application\Result\{Error, Json, Redirect, Success};
use Scern\Lira\Config\{Config, PhpFile};
use Scern\Lira\Extensions\{LoggerManager};
use Scern\Lira\Lexicon\{Lang, Lexicon};
use Scern\Lira\{Router, View,User};
use Symfony\Component\HttpFoundation\{Request, JsonResponse, RedirectResponse, Response};

$request = Request::createFromGlobals();

$extensions = new Extensions();

$config = new Config();
$config->set('routes', new PhpFile(ROOT_DIR . DS . 'config' . DS . 'routes.php'));
$config->set('main', new PhpFile(ROOT_DIR . DS . 'config' . DS . 'main.php'));
$logger = new LoggerManager();
$logger->set(new \Monolog\Logger('Error', [new \Monolog\Handler\StreamHandler(LOG_DIR . DS . 'error.log', \Monolog\Level::Warning)]));
$extensions->setLoggerManager($logger);

$lexicon = new Lexicon(new Lang($config->get('main')['default_language']));

$user = new User();

$app = new Application(
    $config,
    $request,
    new Router(\Scern\Lira\Component\DefaultController::class, $config->get('routes')),
    new View($lexicon),
    $lexicon,
    $user,
    $extensions
);


$result = $app->execute($request->getPathInfo());
try {
    $response = match ($result::class) {
        Success::class, Error::class => new Response($result->content, $result->statusCode, $result->headers),
        Json::class => new JsonResponse($result->data, $result->statusCode, $result->headers),
        Redirect::class => new RedirectResponse($result->url, $result->statusCode, $result->headers),
        default => new Exception('Invalid result')
    };
} catch (Throwable $e) {
    $response = new Response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
}

$response->send();