<?php

require_once 'vendor' . DS . 'autoload.php';

use Scern\Lira\Application\{Application, Extensions};
use Scern\Lira\Application\Result\{Error, Json, Redirect, Success};
use Scern\Lira\Config\{Config, PhpFile};
use Scern\Lira\Extensions\{LoggerManager};
use Scern\Lira\Lexicon\{Lang, Lexicon};
use Scern\Lira\{Router, View, User};
use Scern\Lira\Access\AccessManager;
use \Scern\Lira\State\StateStrategy;
use Symfony\Component\HttpFoundation\{Request, JsonResponse, RedirectResponse, Response};

try {
    $request = Request::createFromGlobals();

    $stateManager = new \Scern\Lira\State\SessionState();

    $extensions = new Extensions();

    $config = new Config();
    $config->set('main', new PhpFile(ROOT_DIR . DS . 'config' . DS . 'main.php'));
    $logger = new LoggerManager();
    $logger->set(
        new \Monolog\Logger('Error',
            [new \Monolog\Handler\StreamHandler(LOG_DIR . DS . 'error.log', \Monolog\Level::Warning)]
        )
    );
    $extensions->setLoggerManager($logger);

    $defaultLanguage = $config->get('main')['default_language'] ?? null;
    $lexicon = new Lexicon(new Lang($defaultLanguage));

    $app = new Application(
        $stateManager,
        $config,
        $request,
        new Router(
            \Scern\Lira\Component\DefaultController::class,
            (new PhpFile(ROOT_DIR . DS . 'config' . DS . 'routes.php'))->getArray()
        ),
        new View($lexicon),
        $lexicon,
        new User(new AccessManager(),$stateManager),
        $extensions
    );
    $result = $app->execute($request->getPathInfo());
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