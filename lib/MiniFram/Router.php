<?php
namespace MiniFram;

class Router
{
    protected $routes = [];

    const NO_ROUTE = 1;

    public function addRoute(Route $route)
    {
        if (!in_array($route, $this->routes)) {
            $this->routes[] = $route;
        }
    }

    public function getRoute($url)
    {
        foreach ($this->routes as $route) {
            // If the route corresponds to the URL
            if (($varsValues = $route->match($url)) !== false) {
                // If the routes has some variables
                if ($route->hasVars()) {
                    $varsNames = $route->varsNames();
                    $listVars = [];

                    // We create an array key/value
                    // (key= name of the variable)
                    foreach ($varsValues as $key => $match) {
                        // We don't want the first key (see preg_match doc)
                        if ($key !== 0) {
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }

                    // We assgign the the array to the route
                    $route->setVars($listVars);
                }

                return $route;
            }
        }

        throw new \RuntimeException('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
    }
}
