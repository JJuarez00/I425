<?php
/**
 * Author: Joseph Juarez
 * Date: 9/18/25
 * File: ProfessorController.php
 * Description: This part was done in module 4!
 */

namespace MyCollegeAPI\Controllers;
use MyCollegeAPI\Controllers\ControllerHelper as Helper;
use MyCollegeAPI\Models\Professor;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProfessorController {
    // Get the path to image url. Images are stored inside public/images folder.
    private function getImageBaseUrl(Request $request): string {
        $uri = $request->getUri();
        $port = $uri->getPort() ? ':' . $uri->getPort() : '';
        $base = rtrim(\Slim\Routing\RouteContext::fromRequest($request)->getBasePath(), '/');
        return $uri->getScheme() . '://' . $uri->getHost() . $port . $base . '/images/';
    }


    //list all professors
    public function index(Request $request, Response $response, array $args) : Response {
        $results = Professor::getProfessors();
        //Modify the image field to prepend the base url
        foreach ($results as $result) {
            $result["image"] = $this->getImageBaseUrl($request) . $result["image"];
        }
        return Helper::withJson($response, $results, 200);
    }

    //view a specific professor
    public function view(Request $request, Response $response, array $args) : Response {
        $id = $args['id'];
        $results = Professor::getProfessorById($id);
        //Modify the image field to prepend the base url
        $results["image"] = $this->getImageBaseUrl($request) . $results["image"];
        return Helper::withJson($response, $results, 200);
    }

    //view all classes taught by a professor
    public function viewClasses(Request $request, Response $response, array $args) : Response {
        $id = $args['id'];
        $results = Professor::getClassesByProfessorId($id);
        return Helper::withJson($response, $results, 200);
    }

}