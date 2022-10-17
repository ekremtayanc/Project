<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStudentsRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        //
        $students = DB::select('CALL spStudentsList');
        return Datatables::of($students)->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-primary">Düzenle</a>
                        <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger">Sil</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostStudentsRequest $request
     * @return array
     */
    public function store(PostStudentsRequest $request)
    {
        //
        $student = DB::select('CALL spStudentsCreate(?,?,?,?,?)',
                [$request->identity_number, $request->student_name, $request->student_surname, $request->school_name, $request->student_number]);
        return ['success' => true, 'message' => 'Öğrenci Kaydı Eklendi.'];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
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
     * @return array
     */
    public function update($id, PostStudentsRequest $request)
    {
        //
        $student = DB::select('CALL spStudentsUpdate(?,?,?,?,?,?)',
            [$id, $request->identity_number, $request->student_name, $request->student_surname, $request->school_name, $request->student_number]);
        return ['success' => true, 'message' => 'Öğrenci Kaydı Güncellendi.'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return array
     */
    public function destroy(Request $request)
    {
        //
        $student = DB::select('CALL spStudentsDelete(' . $request->id . ')');
        return ['success' => true, 'message' => 'Öğrenci Kaydı Silindi.'];
    }
}
