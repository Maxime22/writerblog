<?php
namespace MiniFram;

abstract class Application
{
    protected $httpRequest;
    protected $httpResponse;
    protected $name;
    protected $user;
    protected $config;

    public function __construct()
    {
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);
        $this->name = '';
        $this->user = new User($this);
        $this->config = new Config($this);
    }

    abstract public function run();

    public function httpRequest()
    {
        return $this->httpRequest;
    }

    public function httpResponse()
    {
        return $this->httpResponse;
    }

    public function name()
    {
        return $this->name;
    }

    public function getController()
    {
        $router = new Router;

        $xml = new \DOMDocument;
        $xml->load(__DIR__ . '/../../App/' . $this->name . '/Config/routes.xml');

        $routes = $xml->getElementsByTagName('route');

        // We run the file xml associated to the name of the module
        foreach ($routes as $route) {
            $vars = [];

            // We check if there are some variables in the module
            if ($route->hasAttribute('vars')) {
                $vars = explode(',', $route->getAttribute('vars'));
            }

            // We add all the routes of the XML to the router
            $router->addRoute(new Route($route->getAttribute('url'), $route->getAttribute('module'), $route->getAttribute('action'), $vars));
        }

        try
        {
            // We get the route corresponding to the URL (now the router has all the routes)
            $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
        } catch (\RuntimeException $e) {
            if ($e->getCode() == Router::NO_ROUTE) {
                // If there are no routes => Error 404
                $this->httpResponse->redirect404();
            }
        }

        // We add the variables of the URL the the $_GET table
        $_GET = array_merge($_GET, $matchedRoute->vars());

        // We create the controller due to our structure
        $controllerClass = 'App\\' . $this->name . '\\Modules\\' . $matchedRoute->module() . '\\' . $matchedRoute->module() . 'Controller';
        return new $controllerClass($this, $matchedRoute->module(), $matchedRoute->action());
    }
}
