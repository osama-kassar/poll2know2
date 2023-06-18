<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('DashedRoute');

Router::addUrlFilter(function ($params, $request) {
    if ($request->getParam('lang') && !isset($params['lang'])) {
        $params['lang'] = $request->getParam('lang');
    }
    return $params;
});

$basicRoutes = function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    // search in polls and filter by category
    $routes->connect('/polls/:keyword/:category_id', ['controller' => 'Polls', 'action' => 'index'])->setPass(['keyword', 'category_id']);
    //search in exams and filter by category
    $routes->connect('/exams/:keyword/:category_id', ['controller' => 'Exams', 'action' => 'index'])->setPass(['keyword', 'category_id']);
    
    $routes->connect('/poll/:slug', ['controller' => 'Polls', 'action' => 'view'])->setPass(['slug']);
    $routes->connect('/exam/:slug', ['controller' => 'Exams', 'action' => 'view'])->setPass(['slug']);
    
    $routes->connect('/exams/answer', ['controller' => 'Exams', 'action' => 'answer']);
    $routes->connect('/exams/getpoll/:id', ['controller' => 'Exams', 'action' => 'getpoll'])->setPass(['id']);
    
    // exams and polls by category
    $routes->connect('/categories/:keyword/:id', ['controller' => 'Categories', 'action' => 'index'])->setPass(['keyword', 'id']);
    
    // exams and polls by tag
    $routes->connect('/tags/:keyword', ['controller' => 'Tags', 'action' => 'index'])->setPass(['keyword']);

    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
    $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
	$routes->connect('/logout', [ 'controller' => 'Users', 'action' => 'logout']);
	$routes->connect('/register', ['controller' => 'Users', 'action' => 'register']);
	$routes->connect('/getpassword', ['controller' => 'Users', 'action' => 'getpassword']);
	$routes->connect('/dashboard', ['controller' => 'Users', 'action' => 'dashboard']);
    $routes->connect('/sharecounter', ['controller' => 'Polls', 'action' => 'sharecounter']);

    $routes->connect('/polls/request/{id}/{target}', ['controller' => 'Polls', 'action' => 'request'])->setPass(['id', 'target']);
    
    $routes->prefix('admin', function ($routes) {
        $routes->connect('/dashboard', ['controller' => 'Users', 'action'=>'dashboard']);
        $routes->connect('/', ['controller' => 'Users', 'action'=>'dashboard']);
        $routes->fallbacks('DashedRoute');
    });

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
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