<?php
/**
 * Author: Joseph Juarez
 * Date: 9/18/25
 * File: CourseController.php
 * Description: This part was completed in module 4!
 */

namespace MyCollegeAPI\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use MyCollegeAPI\Controllers\ControllerHelper as Helper;
use MyCollegeAPI\Models\Course;

class CourseController {
    // Retrieve all courses
    public function index(Request $request, Response $response, array $args) : Response {
        $results = Course::getCourses($request);
        return Helper::withJson($response, $results, 200);
    }

    // View a specific course
    public function view(Request $request, Response $response, array $args) : Response {
        $number = $args['number'];
        $results = Course::getCourseByNumber($number);
        return Helper::withJson($response, $results, 200);
    }

    //view classes of a course
    public function viewClasses(Request $request, Response $response, array $args) :
    Response {
        $results = Course::getClassesByCourse($args['number']);
        return Helper::withJson($response, $results, 200);
    }
}
