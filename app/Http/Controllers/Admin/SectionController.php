<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Session;

class SectionController extends Controller
{
    public function sections()
    {
        Session::put('page','sections');

        $sections = Section::get()->toArray();
        return view('admin.sections.sections')->with(compact('sections'));
    }

    public function updateSectionStatus(Request $request)
    {
       if ($request->ajax()) {
          $data  = $request->all();
       if ($data['status']== "Active") {
          $status = 1;
       }else{
          $status = 0;
       }

       Section::where('id',$data['section_id'])->update(["status" => $status]);

       return response()->json(["status" => $status , 'section_id' => $data['section_id']]);
       }
    }

    public function deleteSection($id)
    {
        Section::where('id',$id)->delete();
        $message = "Section has been deleted!";
        return redirect()->back()->with("success_massage",$message);
    }

    public function addEditSection(Request $request,$id=null)
    {
      Session::put('page','sections');
       if ($id=="") {
         $title = "Add Section";
         $section = new Section;
         $massage = "Section added successfully";
      }else {
         $title = "Edti Section";
         $section = Section::find($id);
         $massage = "Section updated successfully";
       }
       if ($request->isMethod('post')) {
         $data = $request->all();

         $rules = [
            'section_name' => 'required|regex:/^[\pL\s\-]+$/u',
         ];

         $this->validate($request,$rules);

         $section->name = $data['section_name'];
         $section->status = 0;
         $section->save();

         return redirect('admin/sections')->with("success_massage",$massage);
       }
       return view('admin.sections.add_edit_section')->with(compact('section','title'));

    }

}
