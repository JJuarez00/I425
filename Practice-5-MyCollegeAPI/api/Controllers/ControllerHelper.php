<?php
/**
 * Author: Joseph Juarez
 * Date: 9/18/25
 * File: ControllerHelper.php
 * Description: This part was done in module 4!
 */

namespace MyCollegeAPI\Controllers;

use Psr\Http\Message\ResponseInterface as Response;

class ControllerHelper {

    // This method sends a response of data in JSON format along with a status code
    public static function withJson(Response $response, $data, int $code) : Response {
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($code);
    }

    //view a course
    public function view(Request $request, Response $response, array $args) : Response {
        $number = $args['number'];
        $results = Course::getCourseByNumber($number);
        return Helper::withJson($response, $results, 200);
    }
}