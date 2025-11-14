<?php
/**
 * Author: Joseph Juarez
 * Date: 9/25/25
 * File: StudentController.php
 * Description: Created in Module 5.
 */

namespace MyCollegeAPI\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use MyCollegeAPI\Models\Student;
use MyCollegeAPI\Controllers\ControllerHelper as Helper;
use MyCollegeAPI\Validation\Validator;

class StudentController
{
    //list all students
    public function index(Request $request, Response $response, array $args): Response
    {
        //Get querystring variables from url
        $params = $request->getQueryParams();
        $term = array_key_exists('q', $params) ? $params['q'] : "";
        //Call the model method to get students
        $results = ($term) ? Student::searchStudents($term) : Student::getStudents();
        return Helper::withJson($response, $results, 200);
    }

    //View a specific student
    public function view(Request $request, Response $response, array $args): Response
    {
        $results = Student::getStudentById($args['id']);
        return Helper::withJson($response, $results, 200);
    }

    //View all classes of a student
    public function viewStudentClasses(Request $request, Response $response, array $args) :
    Response {
        $id = $args['id'];
        $results = Student::getStudentClasses($id);
        return Helper::withJson($response, $results, 200);
    }

    //Create a student
    public function create(Request $request, Response $response, array $args) : Response
    {
        //Validate the request
        $validation = Validator::validateStudent($request);
        if (!$validation) {
            $results = [
                'status' => "Validation failed",
                'errors' => Validator::getErrors()
            ];
            return Helper::withJson($response, $results, 500);
        }

        // Now, actually create a new student!
        $student = Student::createStudent($request);
        $student = Student::createStudent($request);
        if(!$student) {
            $results['status']= "Student cannot been created.";
            return Helper::withJson($response, $results, 500);
        }

        $results = [
            'status' => "Student has been created.",
            'data' => $student
        ];

        return Helper::withJson($response, $results, 200);
    }

    //Update a student
    public function update(Request $request, Response $response, array $args) : Response {
        //Validate the request
        $validation = Validator::validateStudent($request);

        //if validation failed
        if(!$validation) {
            $results = [
                'status' => "Validation failed",
                'errors' => Validator::getErrors()
            ];
            return Helper::withJson($response, $results, 500);
        }

        $student = Student::updateStudent($request);

        if(!$student) {
            $results['status']= "Student cannot been updated.";
            return Helper::withJson($response, $results, 500);
        }

        $results = [
            'status' => "Student has been updated.",
            'data' => $student
        ];

            return Helper::withJson($response, $results, 200);
    }

    //Delete a student
    public function delete(Request $request, Response $response, array $args) : Response {
        $student = Student::deleteStudent($request);
        if(!$student) {
            $results['status']= "Student cannot been deleted.";
            return Helper::withJson($response, $results, 500);
        }
        $results['status'] = "Student has been deleted.";
        return Helper::withJson($response, $results, 200);
    }
}
