<?php
/**
 * Author: Joseph Juarez
 * Date: 9/18/25
 * File: dependencies.php
 * Description: This part was set up in module 4!
 */

use DI\Container;
use MyCollegeAPI\Controllers\ProfessorController;
use MyCollegeAPI\Controllers\CourseController;
use MyCollegeAPI\Controllers\ClassController;
use MyCollegeAPI\Controllers\StudentController;
use MyCollegeAPI\Controllers\UserController;

return function (Container $container) {
    // Set a dependency called "Professor"
    $container->set('Professor', function () {
        return new ProfessorController();
    });

    // Set a dependency called "Course"
    $container->set('Course', function() {
        return new CourseController();
    });

    // Set a dependency called "Class"
    $container->set('Class', function() {
        return new ClassController();
    });

    // Set a dependency called "Student"
    $container->set('Student', function() {
        return new StudentController();
    });

    // Set a dependency called "User"
    $container->set('User', function() {
        return new UserController();
    });

};
