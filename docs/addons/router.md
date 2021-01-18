# Router

## Initialize the Router

```
$router = new Router();
```

## Setup routes

```
// Basic routes
$router->add_route('/', function () {
    // Route callback
});

// Routes with variables
$router->add_route('/user/:userID', function () {
    // Route callback

    // Get the params:
    global $router;
    $params = $router->get_params();

    // User-ID:
    $userID = $params['userID'];
});

// Routes as catch-all
$router->add_route('/post/*', function () {
    // Route callback

    // Get the params:
    global $router;
    $params = $router->get_params();

    // Everything behind /post/:
    $postSlug = $params['*'];
});
```

## Trigger the router

```
$router->simulate_route('/'); // Pass route as argument
```

To automate this with e.g. your real URL, use:

```
$requestedURI = $_SERVER['REQUEST_URI'];
$router->simulate_route($requestedURI);
```

## 404 Pages

To create a 404 Page, simply create a route with the url `*`.