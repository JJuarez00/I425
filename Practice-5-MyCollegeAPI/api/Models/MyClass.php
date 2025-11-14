<?php
/**
 * Author: Joseph Juarez
 * Date: 9/18/25
 * File: MyClass.php
 * Description: This part was completed in module 4!
 */

namespace MyCollegeAPI\Models;
use Illuminate\Database\Eloquent\Model;
class MyClass extends Model {

    //The table associated with this model
    protected $table = 'classes';
    //The primary key of the table
    protected $primaryKey = 'section';
    //The PK is non-numeric
    public $incrementing = false;
    //If the PF is not an integer, set its type
    protected $keyType = 'char';
    //If the created_at and updated_at columns are not used
    public $timestamps = false;

    //Retrieve all classes
    public static function getClasses() {
        $classes = self::with(['professor', 'course'])->get();
        return $classes;
    }

    //Retrieve a specific class by a section number
    public static function getClassBySection(int $section) {
        $class = self::findOrFail($section);
        $class->load('professor')->load('course');
        return $class;
    }

    // Define the one to many (inverse) relationship between Professor and MyClass
    public function professor() {
        return $this->belongsTo(Professor::class, 'professor');
    }

    // Define the one to many (inverse) relationship between Course and MyClass
    public function course() {
        return $this->belongsTo(Course::class, 'course');
    }

    /* Define the many-to-many relationship between Student and MyClass model classes.
    * The third intermediate table linking the students and classes tables in DB is
    * enrollments. In the enrollment table, section and student are the foreign keys.
    */
    public function students() {
        return $this->belongsToMany(Student::class, 'enrollments', 'section', 'student')
            ->withPivot('grade');
    }

    // Retrieve students enrolled in a class section
    public static function getStudentBySection(int $section) {
        return self::findOrFail($section)->students;
    }

}