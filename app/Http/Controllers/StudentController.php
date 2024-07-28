<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\HelperService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Student::query();

            return DataTables::eloquent($query)
                ->addColumn('aksi', function ($builder) {
                    return '<a href="#" class="btn btn-xs btn-primary px-2 edit" title="Edit" data-id="' . $builder->id . '"><i class="fas fa-edit"></i></a> <a href="#" class="btn btn-xs btn-danger px-2 delete" title="Hapus" data-id="' . $builder->id . '"><i class="fas fa-trash-alt"></i></a>';
                })
                ->rawColumns(['aksi'])
                ->make();
        }

        return view('admin.students.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:m,f'],
            'tanggal_lahir' => ['nullable', 'date'],
            'nis' => ['nullable', 'string', 'max:255'],
        ]);

        $data['nama'] = Str::title(Str::lower($data['nama']));

        try {
            $student = Student::create($data);

            return response()->json($this->helper->successWrapper('Simpan', "{$student->nama} berhasil disimpan", $student));
        } catch (\Throwable $th) {
            $this->helper->errorResponse($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
