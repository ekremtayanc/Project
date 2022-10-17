<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStudentsRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = DB::select('CALL spStudentsList');
        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostStudentsRequest $request
     * @return Response
     */
    public function store(PostStudentsRequest $request)
    {
        //
        $student = DB::select('CALL spStudentsCreate(?,?,?,?,?)',array($request->identity_number,$request->student_name,$request->student_surname,$request->school_name,$request->student_number));
        return response()->json($student,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostStudentsRequest $request
     * @param int $id
     * @return Response
     */
    public function update(PostStudentsRequest $request, $id)
    {
        //
        $student = DB::select('CALL spStudentsUpdate(?,?,?,?,?,?)',array($id,$request->identity_number,$request->student_name,$request->student_surname,$request->school_name,$request->student_number));
        return response()->json($student,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $student = DB::select('CALL spStudentsDelete('.$id.')');
        return response()->json($student,204);
    }
}
