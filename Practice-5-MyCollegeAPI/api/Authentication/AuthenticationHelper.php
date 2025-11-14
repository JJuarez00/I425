<?php
/**
 * Author: Joseph Juarez
 * Date: 10/23/25
 * File: AuthenticationHelper.php
 * Description: This part was completed in module 9!
 */

namespace MyCollegeAPI\Authentication;

use Slim\Psr7\Response;

class AuthenticationHelper {
    public static function withJson($data, int $code) : Response {
        $response = new Response();
        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($code);
    }
}
