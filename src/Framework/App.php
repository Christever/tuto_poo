<?php

namespace Framework;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class App

{
    // private $modules = array;
    // /**
    //  * App constructor
    //  * @param string[] $modules Liste des modules à charger
    //  */
    // public function __construct(array $modules)
    // {
    // }


    public function run(ServerRequestInterface $request): ResponseInterface
    {
        $uri = $request->getUri()->getPath();
        if (!empty($uri) && $uri[-1] === "/") {
            return (new Response())
                ->withStatus(301)
                ->withAddedHeader("Location", substr($uri, 0, -1));
        }
        if ($uri === "/blog") {
            return new Response(200, [], "<h1>Bienvenue sur mon blog</h1>");
        }

        return new Response(404, [], "<h1>Page non trouvée</h1>");
    }
}
