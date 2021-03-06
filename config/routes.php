<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

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
Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
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
});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Router::scope('/', function ($routes) {
    $routes->extensions(['json']);
    $routes->resources('servicios', [
        'map' => [
            'getByTipo/:id' => [
                'action' => 'getByTipo',
                'method' => 'GET'
            ],
            'getReporte/:tipo_id' => [
                'action' => 'getReporte',
                'method' => 'GET'
            ],
            'search/:texto' => [
                'action' => 'search',
                'method' => 'GET'
            ],
            'searchMany/:search' => [
                'action' => 'searchMany',
                'method' => 'GET'
            ]
        ]
    ]);
    $routes->resources('recibos', [
        'map' => [
            'getByServicio/:id' => [
                'action' => 'getByServicio',
                'method' => 'GET'
            ],
            'getByServicioNoPagados/:id' => [
                'action' => 'getByServicioNoPagados',
                'method' => 'GET'
            ],
            'getByDates/:fecha_inicio/:fecha_cierre' => [
                'action' => 'getByDates',
                'method' => 'GET'
            ],
            'getByDatesPagos/:fecha_inicio/:fecha_cierre' => [
                'action' => 'getByDatesPagos',
                'method' => 'GET'
            ],
            'getPendientesPago' => [
                'action' => 'getPendientesPago',
                'method' => 'GET'
            ],
            'cancelarPago' => [
                'action' => 'cancelarPago',
                'method' => 'POST'
            ],
            'pagarMany' => [
                'action' => 'pagarMany',
                'method' => 'POST'
            ],
            'saveMany' => [
                'action' => 'saveMany',
                'method' => 'POST'
            ],
            'getEstadisticas' => [
                'action' => 'getEstadisticas',
                'method' => 'GET'
            ],
            'getChartBarData/:anio' => [
                'action' => 'getChartBarData',
                'method' => 'GET'
            ]
        ]
    ]);
    $routes->resources('Tipos', [
        'map' => [
            'getReporte' => [
                'action' => 'getReporte',
                'method' => 'GET'
            ]
        ]
    ]);
    $routes->resources('Controllers');
    $routes->resources('RolUsers');
    $routes->resources('Roles', [
        'map' => [
            'getAdmin' => [
                'action' => 'getAdmin',
                'method' => 'GET'
            ]
        ]
    ]);
    $routes->resources('Users', [
        'map' => [
            'getPersonas' => [
                'action' => 'getPersonas',
                'method' => 'GET'
            ],
            'getAdmin' => [
                'action' => 'getAdmin',
                'method' => 'GET'
            ],
            'token' => [
                'action' => 'token',
                'method' => 'POST'
            ]
        ]
    ]);
});

Plugin::routes();
