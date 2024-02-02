<?php

require_once 'vendor' . DS . 'autoload.php';

use Scern\Lira\{Router,View};
use \Scern\Lira\Application\{Application};
use \Scern\Lira\Application\Results\{Success,Error,Json,Redirect};
use \Scern\Lira\Config\{Manager,PhpFile};
use Symfony\Component\HttpFoundation\{Request,Response,JsonResponse,RedirectResponse};
use \Scern\Lira\Component\DefaultController;
use \Scern\Lira\Lexicon\{Lexicon,Lang};

$configDir = ROOT_DIR.DS.'config';

$request = Request::createFromGlobals();

$config = new Manager();
$config->set('main',new PhpFile($configDir.DS.'main.php'));

$router = new Router(DefaultController::class,new PhpFile($configDir.DS.'routes.php'));

$lexicon = new Lexicon(new Lang($config->main->defaultLanguage),$config->main->languagesList);
$view = new View($lexicon);
$app = new Application(
    $request,
    new \Scern\Lira\Session(),
    $config,
    $router,
    $view,
    new \Scern\Lira\Access\User(),
    $lexicon,
    new \Scern\Lira\Database\Manager(),
    new \Scern\Lira\Cache\Manager(),
    new \Scern\Lira\Logger\Manager()
);

$result = $app->execute($request->getPathInfo());

$response = match ($result::class){
    Success::class,Error::class=>new Response($result->content,$result->statusCode,$result->headers),
    Json::class=>new JsonResponse($result->data,$result->statusCode,$result->headers),
    Redirect::class=>new RedirectResponse($result->url,$result->statusCode,$result->headers),
    default=>new Response('Server error',Response::HTTP_INTERNAL_SERVER_ERROR)
};

$response->send();