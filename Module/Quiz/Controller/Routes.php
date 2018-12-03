<?php
    
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    
    $app->group('', function() use ($app) {
        $app->get('/', function (Request $request, Response $response, array $args) use ($app) {
            $home = new Module\Quiz\Controller\Home();
            
            $home->loadPage();
            
            return $response;
        });
    });
    
    $app->group('/admin', function() use ($app) {
        $app->group('/login', function() use ($app) {
            $app->get('/', function (Request $request, Response $response, array $args) use ($app) {
                $login = new Module\Quiz\Controller\Admin\Login();
                
                $login->loadPage();
                
                return $response;
            });
            
            $app->post('/', function (Request $request, Response $response, array $args) use ($app) {
                $login = new Module\Quiz\Controller\Admin\Login();
                
                $login->setUserName(isset($_POST['user_name']) ? $_POST['user_name'] : null);
                $login->setPassword(isset($_POST['password']) ? $_POST['password'] : null);
                
                $login->authenticate();
                
                return $response;
            });
        });
    });
