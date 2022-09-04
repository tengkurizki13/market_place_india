@extends('admin.layout.layout');
@section('content')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Update Vendor Details</h3>
            {{-- <h6 class="font-weight-normal mb-0">Update Admin Password</h6> --}}
          </div>
          <div class="col-12 col-xl-4">
           <div class="justify-content-end d-flex">
            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
              <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
               <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                <a class="dropdown-item" href="#">January - March</a>
                <a class="dropdown-item" href="#">March - June</a>
                <a class="dropdown-item" href="#">June - August</a>
                <a class="dropdown-item" href="#">August - November</a>
              </div>
            </div>
           </div>
          </div>
        </div>
      </div>
    </div>
     <!-- partial -->
         @if ($slug == 'personal') 
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Personal Information</h4>

                  @if (Session::has('error_massage'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> {{ Session::get('error_massage') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif


                  @if (Session::has('success_massage'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> {{ Session::get('success_massage') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                  @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                     @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                 @endif

                  <form class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" method="post" enctype="multipart/form-data">@csrf

                    <div class="form-group">
                      <label>Vendor Username/Email</label>
                      <input type="text" class="form-control"  value="{{ Auth::guard('admin')->user()->email }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="vendor_name" >Name</label>
                        <input type="text" class="form-control" id="vendor_name" name="vendor_name" value="{{ Auth::guard('admin')->user()->name }}"  placeholder="Enter Your Name" >
                    </div>

                    
                    <div class="form-group">
                        <label for="vendor_address" >Address</label>
                        <input type="text" class="form-control" id="vendor_address" name="vendor_address" value="{{ $vendorDetails['address'] }}"  placeholder="Enter Your Address" >
                    </div>

                    <div class="form-group">
                        <label for="vendor_city" >City</label>
                        <input type="text" class="form-control" id="vendor_city" name="vendor_city" value="{{ $vendorDetails['city'] }}"  placeholder="Enter Your City" >
                    </div>

                    <div class="form-group">
                        <label for="vendor_state" >State</label>
                        <input type="text" class="form-control" id="vendor_state" name="vendor_state" value="{{ $vendorDetails['state'] }}"  placeholder="Enter Your State" >
                    </div>

                    <div class="form-group">
                        <label for="vendor_country" >Country</label>
                        {{-- <input type="text" class="form-control" id="vendor_country" name="vendor_country" value="{{ $vendorDetails['country'] }}"  placeholder="Enter Your Contry" > --}}
                        <select class="form-control" name="vendor_country" id="vendor_country" style="color: #495057">
                          <option value="">Select Country</option>
                          @foreach ($countries as $country)
                          <option value="{{ $country['country_name'] }}" @if($country['country_name'] == $vendorDetails['country']) selected @endif>{{ $country['country_name'] }}</option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vendor_pincode" >Pincode</label>
                        <input type="text" class="form-control" id="vendor_pincode" name="vendor_pincode" value="{{ $vendorDetails['pincode'] }}"  placeholder="Enter Your Pincode" >
                    </div>

                    <div class="form-group">
                        <label for="vendor_mobile" >Mobile</label>
                        <input type="text" class="form-control" id="vendor_mobile" name="vendor_mobile" value="{{ Auth::guard('admin')->user()->mobile }}"placeholder="Enter Your Mobile"  maxlength="12" minlength="12">
                    </div>

                    <div class="form-group">
                        <label for="vendor_image" >Image</label>
                        <input type="file" class="form-control" id="vendor_image" name="vendor_image">
                        @if (!empty(Auth::guard('admin')->user()->image))
                      <a href="{{ url('admin/images/photos/'.Auth::guard('admin')->user()->image) }}" target="_blank" >Show Photos</a>
                      @endif
                      <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>





          @elseif ($slug == 'business') 
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Business Information</h4>

                  @if (Session::has('error_massage'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> {{ Session::get('error_massage') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif


                  @if (Session::has('success_massage'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> {{ Session::get('success_massage') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                  @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                     @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                 @endif

                  <form class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}" method="post" enctype="multipart/form-data">@csrf

                    <div class="form-group">
                      <label>Vendor Username/Email</label>
                      <input type="text" class="form-control"  value="{{ Auth::guard('admin')->user()->email }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="shop_name">Shop Name</label>
                        <input type="text" class="form-control" id="shop_name" name="shop_name" value="{{ $vendorDetails['shop_name'] }}"  placeholder="Enter Your Shop Name" >
                    </div>

                    
                    <div class="form-group">
                        <label for="shop_address" >Shop Address</label>
                        <input type="text" class="form-control" id="shop_address" name="shop_address" value="{{ $vendorDetails['shop_address'] }}"  placeholder="Enter Your Shop Address" >
                    </div>

                    <div class="form-group">
                        <label for="shop_city" >Shop City</label>
                        <input type="text" class="form-control" id="shop_city" name="shop_city" value="{{ $vendorDetails['shop_city'] }}"  placeholder="Enter Your Shop City" >
                    </div>

                    <div class="form-group">
                        <label for="shop_state" >Shop State</label>
                        <input type="text" class="form-control" id="shop_state" name="shop_state" value="{{ $vendorDetails['shop_state'] }}"  placeholder="Enter Your Shop State" >
                    </div>

                    <div class="form-group">
                        <label for="shop_country" >Shop Country</label>
                        {{-- <input type="text" class="form-control" id="shop_country" name="shop_country" value="{{ $vendorDetails['shop_country'] }}"  placeholder="Enter Your Shop Contry" > --}}
                        <select class="form-control" name="shop_country" id="shop_country" style="color: #495057">
                          <option value="">Select Country</option>
                          @foreach ($countries as $country)
                          <option value="{{ $country['country_name'] }}" @if($country['country_name'] == $vendorDetails['shop_country']) selected @endif>{{ $country['country_name'] }}</option>
                          @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="shop_pincode" >Shop Pincode</label>
                        <input type="text" class="form-control" id="shop_pincode" name="shop_pincode" value="{{ $vendorDetails['shop_pincode'] }}"  placeholder="Enter Your Shop Pincode" >
                    </div>

                    <div class="form-group">
                        <label for="shop_mobile" >Mobile</label>
                        <input type="text" class="form-control" id="shop_mobile" name="shop_mobile" value="{{ $vendorDetails['shop_mobile'] }}"placeholder="Enter Your Mobile"  maxlength="12" minlength="12">
                    </div>

                    <div class="form-group">
                      <label for="business_license_number" >Business License Number</label>
                      <input type="text" class="form-control" id="business_license_number" name="business_license_number" value="{{ $vendorDetails['business_license_number'] }}"  placeholder="Enter Your Shop Contry" >
                    </div>

                    <div class="form-group">
                      <label for="get_number" >GET Number</label>
                      <input type="text" class="form-control" id="get_number" name="get_number" value="{{ $vendorDetails['get_number'] }}"  placeholder="Enter Your Get Number" >
                   </div>

                   <div class="form-group">
                    <label for="pan_number" >PAN Number</label>
                    <input type="text" class="form-control" id="pan_number" name="pan_number" value="{{ $vendorDetails['pan_number'] }}"  placeholder="Enter Your Pan Number" >
                  </div>

                    <div class="form-group">
                      <label for="address_proof" >Address proof</label>
                      <select class="form-control" name="address_proof" id="address_proof">
                        <option value="Passport" @if ($vendorDetails['address_proof'] == 'passport')selected
                        @endif>Passport</option>
                        <option value="Voting Card" @if ($vendorDetails['address_proof'] == 'Voting Card')selected
                        @endif>Voting Card</option>
                        <option value="PAN" @if ($vendorDetails['address_proof'] == 'PAN')selected
                        @endif>PAN</option>
                        <option value="Driving License" @if ($vendorDetails['address_proof'] == 'Driving License')selected
                        @endif>Driving License</option>
                        <option value="Aadhar Card" @if ($vendorDetails['address_proof'] == 'Aadhar Card')selected
                        @endif>Aadhar Card</option>
                      </select>
                  </div>

                    <div class="form-group">
                        <label for="address_proof_image" >Address proof image</label>
                        <input type="file" class="form-control" id="address_proof_image" name="address_proof_image">
                        @if (!empty($vendorDetails['address_proof_image']))
                      <a href="{{ url('admin/images/proofs/'.$vendorDetails['address_proof_image']) }}" target="_blank" >Show Photos</a>
                      @endif
                      <input type="hidden" name="current_address_proof_image" value="{{ $vendorDetails['address_proof_image'] }}">
                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          @elseif ($slug == 'bank') 
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Bank Information</h4>

                  @if (Session::has('error_massage'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> {{ Session::get('error_massage') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif


                  @if (Session::has('success_massage'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> {{ Session::get('success_massage') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                  @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                     @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                 @endif

                  <form class="forms-sample" action="{{ url('admin/update-vendor-details/bank') }}" method="post" enctype="multipart/form-data">@csrf

                    <div class="form-group">
                      <label>Vendor Username/Email</label>
                      <input type="text" class="form-control"  value="{{ Auth::guard('admin')->user()->email }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="account_holder_name">Account Holder Name</label>
                        <input type="text" class="form-control" id="account_holder_name" name="account_holder_name" value="{{ $vendorDetails['account_holder_name'] }}"  placeholder="Enter Your Account Holder Name" >
                    </div>

                    
                    <div class="form-group">
                        <label for="bank_name" >Bank Name</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ $vendorDetails['bank_name'] }}"  placeholder="Enter Your Bank Name" >
                    </div>

                    <div class="form-group">
                        <label for="account_number" >Account Number</label>
                        <input type="text" class="form-control" id="account_number" name="account_number" value="{{ $vendorDetails['account_number'] }}"  placeholder="Enter Your Account Number" >
                    </div>

                    <div class="form-group">
                      <label for="bank_ifsc_code" >Bank IFSC Code</label>
                      <input type="text" class="form-control" id="bank_ifsc_code" name="bank_ifsc_code" value="{{ $vendorDetails['bank_ifsc_code'] }}"  placeholder="Enter Your Bank IFSC Code" >
                  </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          @endif
          

        </div>
        <!-- content-wrapper ends -->
      </div>
  </div>
  <!-- content-wrapper ends -->
      
@endsection