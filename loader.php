<?php

require_once 'vendor' . DS . 'autoload.php';

use Scern\Lira\Application\{Application, Extensions};
use Scern\Lira\Application\Result\{Error, Json, Redirect, Success};
use Scern\Lira\Config\{Config, PhpFile};
use Scern\Lira\Extensions\{LoggerManager};
use Scern\Lira\Lexicon\{Lang,Lexicon};
use Scern\Lira\{Router,View};
use Symfony\Component\HttpFoundation\{Request,JsonResponse, RedirectResponse, Response};

$request = Request::createFromGlobals();

$extensions = new Extensions();

$config = new Config();
$config->set('routes',new PhpFile(ROOT_DIR.DS.'config'.DS.'routes.php'));
$config->set('main',new PhpFile(ROOT_DIR.DS.'config'.DS.'main.php'));
//$extensions->setConfig($config);

$logger = new LoggerManager();
$logger->set(new \Monolog\Logger('Error',[new \Monolog\Handler\StreamHandler(LOG_DIR.DS.'error.log',\Monolog\Level::Warning)]));
$extensions->setLoggerManager($logger);

$lexicon = new Lexicon(new Lang($config->get('main')['default_language']));

$app = new Application(
    $config,
    $request,
    new Router(\Scern\Lira\Component\DefaultController::class, $config->get('routes')),
    new View($lexicon),
    $lexicon,
    $extensions
);

$result = $app->execute($request->getPathInfo());
try{
    switch ($result::class) {
        case Success::class:
        case Error::class:
            $response = new Response($result->content, $result->statusCode, $result->headers);
            break;
        case Json::class:
            $response = new JsonResponse($result->data, $result->statusCode, $result->headers);
            break;
        case Redirect::class:
            $response = new RedirectResponse($result->url, $result->statusCode, $result->headers);
            break;
        default:
            throw new Exception('Invalid result');
    }
}catch (Throwable $e){
    $error = new Error('Server error',Response::HTTP_INTERNAL_SERVER_ERROR);
    $response = new Response($error->content, $error->statusCode, $error->headers);
}


$response->send();