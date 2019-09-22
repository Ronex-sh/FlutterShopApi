<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class UnitController extends Controller
{


public function index(){
    $units=Unit:: paginate(env('PAGINATION_COUNT'));

    return view('admin.units.units')->with([
        'units'=> $units,
        'showLinks'=>true,

    ]);

}
private function unitNameExists($unitName){
      $unit=Unit::where(
       'unit_name','=',$unitName
      )->first();

      if ($unit){
          session::flash('message','Unit name already exists');
          return true;
      }
      return false;
}
private  function  unitCodeExists($unitCode){

    $unit=Unit::where(
        'unit_code','=',$unitCode

    )->first();


    if ($unit){
        session::flash('message','Unit code already exists');
        return true;
    }
    return false;
}

public  function store(Request $request){

$request->validate([
    'unit_name'=>'required',
    'unit_code'=>'required'
]);

$unitName=$request->input('unit_name');
$unitCode=$request->input('unit_code');

if($this->unitNameExists($unitName)){
    return redirect()->back();
};
if($this->unitCodeExists($unitCode)){
    return redirect()->back();
};

$unit=new Unit();
$unit->unit_name=$request->input('unit_name');
$unit->unit_code=$request->input('unit_code');
$unit->save();
session::flash('message','Unit '  .$unit->unit_name. ' has been added');
return redirect()->back();

}

public  function delete(Request $request){
//         if (is_null($request->input('unit_id'))||empty($request->input('unit_id')))
//             session::flash('message' , 'Unit id require');
//        return redirect()->back();
//

  $id=$request->input('unit_id');
  Unit::destroy($id);
    session::flash('message' , 'Unit has been deleted');
    return redirect()->back();
}
public  function update(Request $request){
 $request->validate([
  'unit_code'=>'required',
   'unit_id'=>'required',
     'unit_name'=>'required'
 ]);
    $unitName=$request->input('unit_name');
    $unitCode=$request->input('unit_code');

    if($this->unitNameExists($unitName)){
        return redirect()->back();
    };
    if($this->unitCodeExists($unitCode)){
        return redirect()->back();
    };
$unitId=$request->input('unit_id');
$unit=Unit::find($unitId);
$unit->unit_name=$request->input('unit_name');
$unit->unit_code=$request->input('unit_code');
$unit->save();
    session::flash('message' , 'Unit'.$unit->unit_name.'has been updated');
    return redirect()->back();
}

public  function  search(Request $request){
$request->validate([
    'unit_search'=>'required'
]);
$searchTerm=$request->input('unit_search');
$units=Unit::where(
'unit_name','LIKE','%'.$searchTerm.'%'
)->orWhere(
    'unit_code','LIKE','%'.$searchTerm.'%'
)->get();

if (count($units)>0){
    return view('admin.units.units')->with(
         ['units'=>$units,
          'showLinks'=>false,
         ]
    );
}
    session::flash('message' , 'Unit not found !!');
    return redirect()->back();
}

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  \App\Unit  $unit
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(Unit $unit)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Unit  $unit
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Unit $unit)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \App\Unit  $unit
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request, Unit $unit)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  \App\Unit  $unit
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy(Unit $unit)
    // {
    //     //
    // }
}
