<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // STORAGE PROCEDURES FOR students TABLE
        //SP list Students
        DB::unprepared("DROP PROCEDURE IF EXISTS spStudentsList");
        DB::unprepared("CREATE PROCEDURE spStudentsList()
        BEGIN
            SELECT * FROM students;
        END");
        //SP create a student
        DB::unprepared("DROP PROCEDURE IF EXISTS spStudentsCreate");
        DB::unprepared("CREATE PROCEDURE spStudentsCreate(IN identity_numberx varchar(11), IN namex varchar(50), IN surnamex varchar(50), IN school_namex varchar(100), IN numberx varchar(11))
        BEGIN
            INSERT INTO students (identity_number,student_name,student_surname,school_name,student_number) VALUES (identity_numberx,namex,surnamex,school_namex,numberx);
        END");
        //SP update a student information
        DB::unprepared("DROP PROCEDURE IF EXISTS spStudentsUpdate");
        DB::unprepared("CREATE PROCEDURE spStudentsUpdate(IN idx bigint, IN identity_numberx varchar(11), IN namex varchar(50), IN surnamex varchar(50), IN school_namex varchar(100), IN numberx varchar(11))
        BEGIN
            UPDATE students SET identity_number = identity_numberx, student_name = namex, student_surname = surnamex, school_name = school_namex, student_number = numberx WHERE id=idx;
        END");
        //SP delete a student
        DB::unprepared("DROP PROCEDURE IF EXISTS spStudentsDelete");
        DB::unprepared("CREATE PROCEDURE spStudentsDelete(IN idx bigint)
        BEGIN
            DELETE FROM students WHERE id=idx;
        END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
};
