<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBusinessDetails;
use App\Models\VendorsBankDetails;
use App\Models\Country;
use Auth;
use Hash;
use Image;
use Session;

class AdminController extends Controller
{
    public function dashboard()
    {
       Session::put('page','dashboard');
       return view('admin.dashboard');
    }



    public function updateAdminPassword(Request $request)
    {
          Session::put('page','update_admin_password');
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


    public function updateVendorDetails($slug,Request $request)
    {
      if ($slug == 'personal') {
         Session::put('page','update_personal_details');
         if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
               'vendor_name' => 'required|regex:/^[\pL\s\-]+$/u',
               'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
               'vendor_country' => 'required|regex:/^[\pL\s\-]+$/u',
               'vendor_state' => 'required|regex:/^[\pL\s\-]+$/u',
               'vendor_mobile' => 'required|numeric',
         ];
   
            $this->validate($request,$rules);
   
            // Upload vendor Photos
            if ($request->hasFile('vendor_image')) {
               $image_tmp = $request->file('vendor_image');
               if ($image_tmp->isValid()) {
                  // Get Image Extension
                  $extension = $image_tmp->getClientOriginalExtension();
                  // Generator New Image Name
                  $imageName = rand(111,9999).'.'.$extension;
                  $imagePath = 'admin/images/photos/'.$imageName;
   
                  // Upload the image
                  Image::make($image_tmp)->save($imagePath);
               }
            }elseif(!empty($data['current_vendor_image'])){
               $imageName = $data['current_vendor_image'];
            }else{
               $imageName = "";
            }
       
            // Update in admin table
            Admin::where('id',Auth::guard('admin')->user()->id)->update(['name' =>$data['vendor_name'],'mobile' =>$data['vendor_mobile'],'image' =>$imageName]);

            // Update in vendor table
            Vendor::where('id',Auth::guard('admin')->user()->vendor_id)->update(['name' =>$data['vendor_name'],'mobile' =>$data['vendor_mobile'],'address' =>$data['vendor_address'],'city' =>$data['vendor_city'],'state' =>$data['vendor_state'],'country' =>$data['vendor_country'],'pincode' =>$data['vendor_pincode']]);

            return redirect()->back()->with('success_massage',"Your vendor details is Updated");

         }
         $vendorDetails = vendor::where('id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();

      }elseif ($slug == 'business') {
         Session::put('page','update_business_details');

         if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
               'shop_name' => 'required|regex:/^[\pL\s\-]+$/u',
               'shop_city' => 'required|regex:/^[\pL\s\-]+$/u',
               'shop_mobile' => 'required|numeric',
               'address_proof' => 'required',
         ];
   
            $this->validate($request,$rules);
   
            // Upload vendor Photos
            if ($request->hasFile('address_proof_image')) {
               $image_tmp = $request->file('address_proof_image');
               if ($image_tmp->isValid()) {
                  // Get Image Extension
                  $extension = $image_tmp->getClientOriginalExtension();
                  // Generator New Image Name
                  $imageName = rand(111,9999).'.'.$extension;
                  $imagePath = 'admin/images/proofs/'.$imageName;
   
                  // Upload the image
                  Image::make($image_tmp)->save($imagePath);
               }
            }elseif(!empty($data['current_address_proof_image'])){
               $imageName = $data['current_address_proof_image'];
            }else{
               $imageName = "";
            }

            // Update in vendor_business table
            VendorsBusinessDetails::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update(['shop_name' =>$data['shop_name'],'shop_mobile' =>$data['shop_mobile'],'shop_address' =>$data['shop_address'],'shop_city' =>$data['shop_city'],'shop_state' =>$data['shop_state'],'shop_country' =>$data['shop_country'],'shop_pincode' =>$data['shop_pincode'],'address_proof' =>$data['address_proof'],'address_proof_image' =>$imageName,'business_license_number' =>$data['business_license_number'],'get_number' =>$data['get_number'],'pan_number' =>$data['pan_number']]);

            return redirect()->back()->with('success_massage',"Your vendor details is Updated");

         }
         $vendorDetails = VendorsBusinessDetails::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();
      }elseif ($slug == 'bank') {
         Session::put('page','update_bank_details');

         if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
               'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
               'bank_name' => 'required|regex:/^[\pL\s\-]+$/u',
               'account_number' => 'required|numeric',
               'bank_ifsc_code' => 'required|numeric',
         ];
   
            $this->validate($request,$rules);

            // Update in vendor_bank table
            VendorsBankDetails::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->update(['account_holder_name' =>$data['account_holder_name'],'bank_name' =>$data['bank_name'],'account_number' =>$data['account_number'],'bank_ifsc_code' =>$data['bank_ifsc_code']]);

            return redirect()->back()->with('success_massage',"Your vendor details is Updated");

         }
         $vendorDetails = VendorsBankDetails::where('vendor_id',Auth::guard('admin')->user()->vendor_id)->first()->toArray();
      }

      $countries = Country::where('status', 1)->get()->toArray();

      return view('admin.settings.update_vendor_details')->with(compact('slug','vendorDetails','countries'));

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
      Session::put('page','update_admin_details');
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
            $image_tmp = $request->file('admin_image');
            if ($image_tmp->isValid()) {
               // Get Image Extension
               $extension = $image_tmp->getClientOriginalExtension();
               // Generator New Image Name
               $imageName = rand(111,9999).'.'.$extension;
               $imagePath = 'admin/images/photos/'.$imageName;

               // Upload the image
               Image::make($image_tmp)->save($imagePath);
            }
         
         }elseif(!empty($data['current_admin_image'])){
            $imageName = $data['current_admin_image'];
         }else{
            $imageName = "";
         }

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



      public function admins($type = null)
      {
         $admins = Admin::query();
         if (!empty($type)) {
            $admins = $admins->where('type',$type);
            $title = ucfirst($type);
          Session::put('page','view_'.strtolower($title));

          }else{
            $title = "All Admins/SubAdmins/Vendors";
          Session::put('page','view_all');

          }

         $admins = $admins->get()->toArray();

         return view('admin.admins.admins')->with(compact('admins','title'));

        
      }


      public function viewVendorDetails($id)
      {
       $vendorDetails = Admin::with('vendorPersonal','vendorBusiness','vendorBank')->where('id',$id)->first();
       $vendorDetails = json_decode(json_encode($vendorDetails),true);

       return view('admin.admins.view_vendor_details')->with(compact('vendorDetails'));

      }

      public function updateAdminStatus(Request $request)
      {
         if ($request->ajax()) {
            $data  = $request->all();
         if ($data['status']== "Active") {
            $status = 1;
         }else{
            $status = 0;
         }

         Admin::where('id',$data['admin_id'])->update(["status" => $status]);

         return response()->json(["status" => $status , 'admin_id' => $data['admin_id']]);
         }
      }



      public function logout()
      {
         Auth::guard('admin')->logout();
         return redirect('admin/login');
      }

   }
