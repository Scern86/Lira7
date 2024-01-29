<?php

require_once 'vendor' . DS . 'autoload.php';

use Scern\Lira\{Router, User, View};
use Scern\Lira\Access\AccessManager;
use Scern\Lira\Application\{Application, Extensions};
use Scern\Lira\Application\Result\{Error, Json, Redirect, Success};
use Scern\Lira\Config\{Config, PhpFile};
use Scern\Lira\Extensions\{LoggerManager};
use Scern\Lira\Extensions\Database\DatabaseManager;
use Scern\Lira\Lexicon\{Lang, Lexicon};
use Scern\Lira\State\SessionState;
use Symfony\Component\HttpFoundation\{JsonResponse, RedirectResponse, Request, Response};

try {
    $request = Request::createFromGlobals();

    $stateManager = new SessionState();

    $extensions = new Extensions();

    $config = new Config();
    $config->set('main', new PhpFile(ROOT_DIR . DS . 'config' . DS . 'main.php'));
    $config->set('database', new PhpFile(ROOT_DIR . DS . 'config' . DS . 'database.php'));

    $logger = new LoggerManager();
    $logger->set(
        new \Monolog\Logger('Error',
            [new \Monolog\Handler\StreamHandler(LOG_DIR . DS . 'error.log', \Monolog\Level::Warning)]
        )
    );
    $extensions->setLoggerManager($logger);

    $dbManager = new DatabaseManager();

    $extensions->setDatabaseManager($dbManager);

    $defaultLanguage = $config->get('main')['default_language'] ?? null;
    $lexicon = new Lexicon(new Lang($defaultLanguage),$config->get('main')['languages_list']);

    $app = new Application(
        $stateManager,
        $config,
        $request,
        new Router(
            \Scern\Lira\Component\DefaultController::class,
            (new PhpFile(ROOT_DIR . DS . 'config' . DS . 'routes.php'))->getArray()
        ),
        new View($lexicon, new \Scern\Lira\Seo\Seo($lexicon,new \Scern\Lira\Seo\Robots())),
        $lexicon,
        new User(new AccessManager([],true),$stateManager),
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