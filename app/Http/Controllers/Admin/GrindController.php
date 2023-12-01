<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grind;
use Session;

class GrindController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Grind::orderby('id', 'DESC')->get();

            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('Actions', function ($data) {
                    $btn = '<a href="'. url('admin/grind', $data->id ) .'" class="btn btn-sm btn-success">edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="' . $data->id . '" class="delete-queries btn btn-sm btn-danger">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['Actions'])
                ->make(true);
        }else{
        
            return view('admin.grind.index');
        }

     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.grind.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $create=[
            'name' => $request->name
        ];
        Grind::create($create);
        return redirect()->back()->with('success', 'Grind  added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $grind= Grind::find($id);
        return view('admin.grind.edit', compact('grind'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $update=[ 'name' => $request->name
          ];
        $grind= Grind::find($id)->update($update);
       
        return redirect()->back()->with('success', 'Grind updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Grind::destroy($id);
        return response()->json(['success' => true]);
    }
}
