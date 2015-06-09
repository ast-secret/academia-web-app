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
 * If no call is made to `Router::defaultRouteClass`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('Route');

Router::addUrlFilter(function ($params, $request) {
    if (isset($request->params['gym_slug']) && !isset($params['gym_slug'])) {
        $params['gym_slug'] = $request->params['gym_slug'];
    }
    return $params;
});

Router::scope('/:gym_slug', function ($routes) {
	$routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
});
Router::scope('/:gym_slug/caixa-de-sugestoes', function ($routes) {
	$routes->connect('/', ['controller' => 'Suggestions', 'action' => 'index']);
	$routes->connect('/sugestao/*', ['controller' => 'Suggestions', 'action' => 'view']);
	$routes->extensions(['json']);
	$routes->connect('/toggle-is-star', ['controller' => 'Suggestions', 'action' => 'toggleIsStar']);
	$routes->connect('/toggle-is-read', ['controller' => 'Suggestions', 'action' => 'toggleIsRead']);
});

Router::scope('/:gym_slug/usuarios', function ($routes) {
	$routes->connect('/', ['controller' => 'Users', 'action' => 'index']);
	$routes->connect('/criar', ['controller' => 'Users', 'action' => 'add']);
	$routes->connect('/editar/*', ['controller' => 'Users', 'action' => 'edit']);
	$routes->connect('/deletar/*', ['controller' => 'Users', 'action' => 'delete']);
});

Router::scope('/:gym_slug/comunicados', function ($routes) {
    $routes->connect('/', ['controller' => 'Releases', 'action' => 'index']);
    $routes->connect('/criar', ['controller' => 'Releases', 'action' => 'add']);
    $routes->connect('/editar/*', ['controller' => 'Releases', 'action' => 'edit']);
    $routes->connect('/deletar/*', ['controller' => 'Releases', 'action' => 'delete']);
});


Router::scope('/:gym_slug/aulas', function ($routes) {
    $routes->connect('/', ['controller' => 'Services', 'action' => 'index']);
    $routes->connect('/criar', ['controller' => 'Services', 'action' => 'add']);
    $routes->connect('/editar/*', ['controller' => 'Services', 'action' => 'edit']);
    $routes->connect('/deletar/*', ['controller' => 'Services', 'action' => 'delete']);
});

Router::scope('/:gym_slug/aulas/horarios', function ($routes) {
    $routes->connect('/*', ['controller' => 'Times', 'action' => 'edit']);
});

Router::scope('/', function ($routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `InflectedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'InflectedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'InflectedRoute']);`
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
    $routes->fallbacks('InflectedRoute');
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
