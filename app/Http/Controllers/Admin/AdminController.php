<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use Hash;
use Image;

class AdminController extends Controller
{
    public function dashboard()
    {
       return view('admin.dashboard');
    }



    public function updateAdminPassword(Request $request)
    {
         if ($request->isMethod('post')) {
            $data = $request->all();
            
            // check if current password is incorrect 
         if (Hash::check($data['current_password'],Auth::guard('admin')->user()->password)) {
            if ($data['confirm_password']==$data['new_password']) {
               Admin::where('id',Auth::guard('admin')->user()->id)->update(['password' =>bcrypt($data['new_password'])]);
               return redirect()->back()->with('success_massage',"Your New Password is Updated");
            }else{
               return redirect()->back()->with('error_massage',"Your New Password is not Matching");
            }
            
         }else{
            return redirect()->back()->with('error_massage',"Your current Password is Incorrect");
         }
         
      
      }



      $adminDetails = Admin::where('email',Auth::guard('admin')->user()->email)->first()->toArray();
      return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }





    public function checkAdminPassword(Request $request)
    {
      $data = $request->all();
         
      if (Hash::check($data['current_password'],Auth::guard('admin')->user()->password)) {
         return true;
      }else{
         return false;
      }

    }

    public function updateAdminDetails(Request $request)
    {
      if ($request->isMethod('post')) {
         $data = $request->all();

         $rules = [
            'admin_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'admin_mobile' => 'required|numeric',
      ];

         // $customMassage = [
         //    'email.required' => 'Diisi Bro Emailnya',
         //    'password.required' => 'Diisi Bro passwordnya',
         // ];

         $this->validate($request,$rules);

         // Upload Admin Photos
         if ($request->hasFile('admin_image')) {

         }elseif(!empty($data['current_admin_image'])){
            $imageName = $data['current_admin_image'];
         }else{
            $imageName = "";
         }
            // $image_tmp = $request->file('admin_image');
            // if ($image_tmp->isValid()) {
            //    // Get Image Extension
            //    $extension = $image_tmp->getClientOriginalExtension();
            //    // Generator New Image Name
            //    $imageName = rand(111,9999).'.'.$extension;
            //    $imagePath = 'admin/images/photos/'.$imageName;

            //    // Upload the image
            //    Image::make($image_tmp)->save($imagePath);
            // }
         // }

         // Update Admin Details
         Admin::where('id',Auth::guard('admin')->user()->id)->update(['name' =>$data['admin_name'],'mobile' =>$data['admin_mobile'],'image' =>$imageName]);
         return redirect()->back()->with('success_massage',"Your admin details is Updated");

      }

      return view('admin.settings.update_admin_details');

    }



    public function login(Request $request)
    {
      if ($request->isMethod('post')) {
         $data = $request->all();

      //    $validated = $request->validate([
      //       'email' => 'required|unique:admins|email|max:255',
      //       'password' => 'required',
      //   ]);

      // CUSTOM MASSAGE

            $rules = [
                     'email' => 'required|email|max:255',
                     'password' => 'required',
               ];

            $customMassage = [
               'email.required' => 'Diisi Bro Emailnya',
               'password.required' => 'Diisi Bro passwordnya',
            ];

            $this->validate($request,$rules,$customMassage);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'],'status' => 0 ])) {
               return redirect('admin/dashboard');
            }else{
               return redirect()->back()->with('error_massage',"Invalid Email or Password");

            }

         }

         return view('admin.login');
      }

      public function logout()
      {
         Auth::guard('admin')->logout();
         return redirect('admin/login');
      }

   }
