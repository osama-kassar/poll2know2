<?php


use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::extensions('xml');

Router::defaultRouteClass('DashedRoute');

Router::addUrlFilter(function ($params, $request) {
    if ($request->getParam('lang') && !isset($params['lang'])) {
        $params['lang'] = $request->getParam('lang');
    }
    return $params;
});

$basicRoutes = function (RouteBuilder $routes) {
    
    // search in polls and filter by category
    $routes->connect('/polls/:keyword/:category_id', ['controller' => 'Polls', 'action' => 'index'])->setPass(['keyword', 'category_id']);
    $routes->connect('/polls/:keyword/:category_id/:category_name', ['controller' => 'Polls', 'action' => 'index'])->setPass(['keyword', 'category_id', 'category_name']);
    $routes->connect('/poll/:slug', ['controller' => 'Polls', 'action' => 'view'])->setPass(['slug']);
    $routes->connect('/polls/save/:id', ['controller' => 'Polls', 'action' => 'save'])->setPass(['id']);
    
    //search in exams and filter by category
    $routes->connect('/exams/:keyword/:category_id', ['controller' => 'Exams', 'action' => 'index'])->setPass(['keyword', 'category_id']);
    $routes->connect('/exams/:keyword/:category_id/:category_name', ['controller' => 'Exams', 'action' => 'index'])->setPass(['keyword', 'category_id', 'category_name']);
    $routes->connect('/exam/:slug', ['controller' => 'Exams', 'action' => 'view'])->setPass(['slug']);
    $routes->connect('/exams/answer', ['controller' => 'Exams', 'action' => 'answer']);
    $routes->connect('/exams/save/:id', ['controller' => 'Exams', 'action' => 'save'])->setPass(['id']);
    $routes->connect('/exams/getpoll/:id', ['controller' => 'Exams', 'action' => 'getpoll'])->setPass(['id']);
    
    //games routes
    $routes->connect('/games', ['controller' => 'Exams', 'action' => 'games']);
    $routes->connect('/game/:slug', ['controller' => 'Exams', 'action' => 'game'])->setPass(['slug']);
    
    // exams and polls by category
    $routes->connect('/search/:keyword/:id', ['controller' => 'Categories', 'action' => 'index'])->setPass(['keyword', 'id']);

    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
	$routes->connect('/logout', [ 'controller' => 'Users', 'action' => 'logout']);
	$routes->connect('/register', ['controller' => 'Users', 'action' => 'register']);
	$routes->connect('/getpassword', ['controller' => 'Users', 'action' => 'getpassword']);
	$routes->connect('/dashboard', ['controller' => 'Users', 'action' => 'dashboard']);
    $routes->connect('/sharecounter', ['controller' => 'Configs', 'action' => 'sharecounter']);
    $routes->connect('/sitemap', ['controller' => 'Configs', 'action' => 'sitemap']);
    $routes->connect('/google7b28ba094589b3e4.html', ['controller' => 'Pages', 'action' => 'display', 'google7b28ba094589b3e4.html']);
        
    $routes->prefix('admin', function ($routes) {
        $routes->connect('/dashboard', ['controller' => 'Users', 'action'=>'dashboard']);
        $routes->connect('/', ['controller' => 'Users', 'action'=>'dashboard']);
        $routes->fallbacks('DashedRoute');
    });
    
    $routes->fallbacks('DashedRoute');
};

$realRoutes = function ($routes) use ($basicRoutes) {
    $routes->scope('/', $basicRoutes);

    return $routes;
};

Router::scope('/ar', ['lang' => 'ar'], $realRoutes);
Router::scope('/tr', ['lang' => 'tr'], $realRoutes);
Router::scope('/en', ['lang' => 'en'], $realRoutes);
Router::scope('/', $realRoutes);