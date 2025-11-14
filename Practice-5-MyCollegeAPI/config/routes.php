<?php
/**
 * Author: Joseph Juarez
 * Date: 9/18/25
 * File: routes.php
 * Description: This part was set up in module 4!
 */

use Slim\Routing\RouteCollectorProxy;

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use MyCollegeAPI\Authentication\{
    MyAuthenticator,
    BasicAuthenticator,
    BearerAuthenticator,
    JWTAuthenticator

};

return function (App $app) {
    // Add an app route
    $app->get('/', function (Request $request, Response $response, array $args) {
        $response->getBody()->write('Hello World!');
        return $response;
    });

    // Add another route
    $app->get('/api/hello/{name}', function (Request $request, Response $response, array $args) {
        $response->getBody()->write("Hola " . $args['name']);
        return $response;
    });

    // User route group
    $app->group('/api/v1/users', function (RouteCollectorProxy $group) {
        $group->get('', 'User:index');
        $group->get('/{id}', 'User:view');
        $group->post('', 'User:create');
        $group->put('/{id}', 'User:update');
        $group->delete('/{id}', 'User:delete');
        $group->post('/authBearer', 'User:authBearer');
        $group->post('/authJWT', 'User:authJWT');
    });

    //Route group api/v1 pattern
    $app->group('/api/v1', function(RouteCollectorProxy $group) {
        //Route group for /professors pattern
        $group->group('/professors', function (RouteCollectorProxy $group) {
            //Call the index method defined in the ProfessorController class
            //Professor is the container key defined in dependencies.php.
            $group->get('', 'Professor:index');
            $group->get('/{id}', 'Professor:view');
            $group->get('/{id}/classes', 'Professor:viewClasses');
        });

        //Route group for /courses pattern
        $group->group('/courses', function (RouteCollectorProxy $group) {
            //Call the index method defined in the CourseController class
            $group->get('', 'Course:index');
            //Call the view method defined in the CourseController class
            $group->get('/{number}', 'Course:view');

            //Added in Unit 2: Practice 6
            // Call the viewClasses method defined in the CourseController class
            $group->get('/{number}/classes', 'Course:viewClasses');
            //Call the view method defined in the ClassController class
            $group->get('/{number}/classes/{section}', 'Class:view');
        });

        //Route group for /courses pattern
        $group->group('/classes', function (RouteCollectorProxy $group) {
            //Call the index method defined in the ClassController class
            $group->get('', 'Class:index');
            //Call the view method defined in the ClassController class
            $group->get('/{section}', 'Class:view');
            $group->get('/{section}/students', 'Class:viewStudents');
        });

        //Route group for /students pattern
        $group->group('/students', function (RouteCollectorProxy $group) {
            $group->get('', 'Student:index');
            $group->get('/{id}', 'Student:view');
            $group->get('/{id}/classes', 'Student:viewStudentClasses');
            $group->post('', 'Student:create');
            $group->put('/{id}', 'Student:update');
            $group->delete('/{id}', 'Student:delete');
        });
//  });   // Without Authentication
//  })->add(new MyAuthenticator()); //  MyAuthentication
//  })->add(new BasicAuthenticator()); // BasicAuthentication
//  })->add(new BearerAuthenticator()); // BearerAuthentication
    })->add(new JWTAuthenticator()); // JWTAuthentication

    // Handle invalid routes
    $app->any('{route:.*}', function (Request $request, Response $response) {
        $response->getBody()->write("Page Not Found");
        return $response->withStatus(404);
    });

};
