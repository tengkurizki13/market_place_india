<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\Section;
use Image;
use Session;

class CatagoryController extends Controller
{
    public function catagories()
    {
        Session::put('page','catagories');
        $catagories = Catagory::with(['section','parentcatagory'])->get()->toArray();
        // dd($catagories);
        return view('admin.catagories.catagories')->with(compact('catagories'));

    }

    public function updateCatagoryStatus(Request $request)
    {
       if ($request->ajax()) {
          $data  = $request->all();
       if ($data['status']== "Active") {
          $status = 1;
       }else{
          $status = 0;
       }

       Catagory::where('id',$data['catagory_id'])->update(["status" => $status]);

       return response()->json(["status" => $status , 'catagory_id' => $data['catagory_id']]);
       }
    }

    public function appendCatagoryLevel(Request $request)
    {
       if ($request->ajax()) {
          $data = $request->all();
          $getCatagories = Catagory::with('subcatagories')->where(['parent_id' => 0, 'section_id' => $data['section_id']])->get()->toArray();
     
          
         return view('admin.catagories.append_catagories_level')->with(compact('getCatagories'));
      }
    }


    public function addEditCatagory(Request $request,$id=null)
    {
      Session::put('page','catagories');
       if ($id=="") {
         $title = "Add Catagory";
         $catagory = new Catagory;
         $getCatagories = array();
         $massage = "Catagory added successfully";
      }else {
         $title = "Edit Catagory";
         $catagory = Catagory::find($id);
         $getCatagories = Catagory::with('subcatagories')->where(['parent_id' => 0, 'section_id' => $catagory['section_id']])->get();
         $massage = "Catagory updated successfully";
       }
       if ($request->isMethod('post')) {
         $data = $request->all();

         if ($data['catagory_discount']=='') {
            $data['catagory_discount']= 0;
         }


          // Upload catagory image
          if ($request->hasFile('catagory_image')) {
            $image_tmp = $request->file('catagory_image');
            if ($image_tmp->isValid()) {
               // Get Image Extension
               $extension = $image_tmp->getClientOriginalExtension();
               // Generator New Image Name
               $imageName = rand(111,9999).'.'.$extension;
               $imagePath = 'front/images/catagory_images/'.$imageName;

               // Upload the image
               Image::make($image_tmp)->save($imagePath);
               $catagory->catagory_image = $imageName;
            }
         }else{
            $catagory->catagory_image = "";
         }

         $catagory->section_id = $data['section_id'];
         $catagory->parent_id = $data['parent_id'];
         $catagory->catagory_name = $data['catagory_name'];
         $catagory->catagory_discount = $data['catagory_discount'];
         $catagory->description = $data['description'];
         $catagory->url = $data['url'];
         $catagory->meta_title = $data['meta_title'];
         $catagory->meta_description = $data['meta_description'];
         $catagory->meta_keywords = $data['meta_keywords'];
         $catagory->status = 0;
         $catagory->save();

         return redirect('admin/catagories')->with('success_massage',$massage);

         $rules = [
            'section_name' => 'required|regex:/^[\pL\s\-]+$/u',
         ];

         $this->validate($request,$rules);

         $section->name = $data['section_name'];
         $section->status = 0;
         $section->save();

         return redirect('admin/sections')->with("success_massage",$massage);
       }
    $getSections = Section::get()->toArray();
       return view('admin.catagories.add_edit_catagory')->with(compact('catagory','title','getSections','getCatagories'));

    }
}
