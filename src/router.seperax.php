<?php

/**
 * @version 1.0
 * @author Linus Benkner
 */

class Router
{

    private array $routes;
    private array $currentRoute = [];
    private array $params = [];

    public function __construct()
    {
        // Constructor
    }

    public function add_route(string $route, $callback): void
    {
        if (substr($route, 0, 1) !== "/") $route = '/' . $route;
        if (substr($route, -1, 1) !== "/") $route .= '/';
        $orig = $route;
        $route_count = strlen(preg_replace('/(:)([a-zA-Z]*)/', '', $route));
        if (substr($route, -3, 2) === '/*') {
            $route = substr($route, 0, strlen($route) - 2) . ')(.*)(' . '/';
        }
        $route = preg_replace('/(:)([a-zA-Z]*)/', ')([^\/]*)(', $route);
        $route = str_replace('/', '\/', $route);
        $route = '#^(' . $route . ')$#i';
        $this->routes[$route] = [
            'count'  => $route_count,
            'callback' => $callback,
            'original' => $orig
        ];
    }

    public function simulate_route(string $route): void
    {
        strtolower($route);
        if (substr($route, 0, 1) !== "/") $route = '/' . $route;
        if (substr($route, -1, 1) !== "/") $route .= '/';
        $currentRoute = null;
        $currentCount = 0;
        foreach ($this->routes as $pattern => $data) {
            if ($currentCount <= $data['count']) {
                if (preg_match($pattern, $route)) {
                    $currentRoute = $pattern;
                    $currentCount = $data['count'];
                }
            }
        }
        $this->currentRoute = $this->routes[$currentRoute];

        $this->parse_params($route);

        $callbackFunc = $this->routes[$currentRoute]['callback'];
        if (gettype($callbackFunc === 'Closure')) {
            $callbackFunc();
        } else if (gettype($callbackFunc === 'string')) {
            if (function_exists($callbackFunc)) {
                $callbackFunc();
            }
        }
    }

    public function parse_params(string $route): array
    {
        if (count($this->currentRoute) > 0) {
            $orig = substr($this->currentRoute['original'], 1, -1);
            $parts = explode('/', $orig);
            $variableIDs = [];
            $variableKeys = [];
            $pattern = "";
            foreach ($parts as $index => $part) {
                if ($part === '*') {
                    $pattern .= '(.*)';
                    $variableIDs[] = $index + 1;
                    $variableKeys[] = '*';
                } else if (substr($part, 0, 1) === ':') {
                    $pattern .= '(\/[^\/]*)';
                    $variableIDs[] = $index + 1;
                    $variableKeys[] = substr($part, 1);
                } else {
                    $pattern .= '(\/' . $part . ')';
                }
            }
            $pattern = '#^' . $pattern . '$#';
            preg_match($pattern, substr($route, 0, -1), $matches);
            $res = [];
            foreach ($variableIDs as $index => $id) {
                $res[$variableKeys[$index]] = substr($matches[$id], 1);
            }
            $this->params = $res;
        }
        return [];
    }

    public function get_params(): array
    {
        return $this->params;
    }
}
