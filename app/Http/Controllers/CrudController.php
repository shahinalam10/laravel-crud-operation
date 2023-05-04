<?php

namespace App\Http\Controllers;

use App\Models\Crudoperation;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public $crudoperation,$image,$imageName,$directory,$imgUrl;

    public function index(){
        return view('welcome');
    }
    public function saveData(Request $request){
        $this->crudoperation = new Crudoperation();
        $this->crudoperation->name = $request->name;
        $this->crudoperation->number = $request->number;
        $this->crudoperation->company = $request->company;
        $this->crudoperation->image = $this->saveImage($request);
        $this->crudoperation->save();
        return redirect('/')->with('message','Insert data successfully');
    }
    private function saveImage($request){
        $this->image = $request->file('image');
        $this->imageName = rand().'.'.$this->image->getClientOriginalExtension();
        $this->directory = 'assets/register-data/';
        $this->imgUrl = $this->directory.$this->imageName;
        $this->image->move($this->directory,$this->imageName);
        return $this->imgUrl;
    }

    public function showData(){
        return view('show-data',[
            'crudoperation'=>Crudoperation::all()
        ]);
    }
    public function editData($id){
        return view('edit-data',[
            'crudoperation'=>Crudoperation::find($id)
        ]);
    }

    public function updateData(Request $request){
        $this->crudoperation = Crudoperation::find($request->crud_id);
        $this->crudoperation->name = $request->name;
        $this->crudoperation->number = $request->number;
        $this->crudoperation->company = $request->company;
        if ($request->file('image')){
            if ($this->crudoperation->image){
                unlink($this->crudoperation->image);
            }
            $this->crudoperation->image = $this->saveImage($request);
        }
        $this->crudoperation->save();
        return redirect('/')->with('message','Update data successfully');
    }
    public function deleteData(Request $request){
        $this->crudoperation = Crudoperation::find($request->crud_id);
        if ($this->crudoperation->image){
            unlink($this->crudoperation->image);
        }
        $this->crudoperation->delete();
        redirect('show-data')->with('message','Delete data successfully');
    }


}
