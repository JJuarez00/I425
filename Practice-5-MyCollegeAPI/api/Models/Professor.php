<?php
/**
 * Author: Joseph Juarez
 * Date: 9/18/25
 * File: Professor.php
 * Description: This part was set up in module 4!
 */


namespace MyCollegeAPI\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    // The table associated with this model
    protected $table = 'professors';

    // The primary key of the table
    protected $primaryKey = 'id';

    // The PK is non-numeric
    public $incrementing = false;

    // If the PK is not an integer, set its type
    protected $keyType = 'char';

    // If the created_at and updated_at columns are not used
    public $timestamps = false;

    // Retrieve all professors
    public static function getProfessors()
    {
        $professors = self::with('classes')->get();
        return $professors;
    }

    // View a specific professor by id
    public static function getProfessorById(string $id)
    {
        $professor = self::findOrFail($id);
        $professor->load('classes');
        return $professor;
    }

    // Define the one to many relationship between Professor and MyClass model classes
    // The first para is the model class name; the second parameter is the foreign key.
    public function classes() {
        return $this->hasMany(MyClass::class, 'professor');
    }

    //View all classes taught by a professor.
    public static function getClassesByProfessorId(string $id) {
        $classes = self::findOrFail($id)->classes;
        return $classes;
    }
}
