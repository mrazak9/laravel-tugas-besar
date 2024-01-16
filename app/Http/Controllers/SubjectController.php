<?php

namespace App\Http\Controllers;

use App\Imports\SubjectsImport;
use App\Models\Subject;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SubjectController extends Controller
{
    //index
    public function index()
    {

        $subjects = Subject::paginate(10);
        return view('pages.subjects.index', compact('subjects'));
    }

    //create
    public function create()
    {
        return view('pages.subjects.create');
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:subjects,name',
            'description' => 'required',
            'lecturer_id' => 'required|exists:users,id',
        ]);

        Subject::create($request->all());
        return redirect()->route('pages.subjects.index')->with('success', 'Subject created successfully.');
    }

    public function import(Request $request)
    {
        // return $request->file_excel;
        Excel::import(new SubjectsImport, $request->file_excel);

        return redirect()->back();
    }
}
