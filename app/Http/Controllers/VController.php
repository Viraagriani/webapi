<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Institution;
use Illuminate\Http\Request;

class VController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $intitutions = Institution::all();
      return response()->json($intitutions);
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
        return Institution::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($institution)
    {
        $data = Institution::where('id', $institution)->first();
        if (!empty($data)){
            return $data;
        }
        return response()->json(['message'=>'Data tidak ditemukan'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$institution)
    {

        $data = Institution::where('id',$institution)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(),[
                'name' => 'required',
                'description' => 'required'
            ]);

            if ($validate->passes()) {
                $data->update($request->all());
                return response()->json([
                    'message'=>'Data Berhasil Update',
                    'data' => $data
                ], 200);
            }else{
                return response()->json([
                    'message'=>'Data gagal Update',
                    'data' => $validate->errors()->all()
                    ]);
            }
            
        }
        return response()->json(['message'=>'Data tidak ditemukan'] ,404);

        
       // $institution->update($request->all());
       // return response()->json([
         //   'message' =>'Data Berhasil diupdate',
          //  'data' => $institution
       // ])
    }

    
    public function destroy($institution)
    {
        $data = Institution::where('id',$institution)->first();
        if (empty($data)){
            return response()->json(['message'=>'Data tidak ditemukan'] ,404);

        }
       $data->delete();
       return response()->json(['message'=>'Data Berhasil Dihapus'], 200);
    }
}
