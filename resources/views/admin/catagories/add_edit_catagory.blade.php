@extends('admin.layout.layout');
@section('content')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            <h3 class="font-weight-bold">Catalogue Management</h3>
            <h6 class="font-weight-normal mb-0">Catagories</h6>
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
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ $title }}</h4>

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

                  <form class="forms-sample" @if(empty($catagory['id'])) action="{{ url('admin/add-edit-catagory') }}" @else action="{{ url('admin/add-edit-catagory/'.$catagory['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf

                    <div class="form-group">
                        <label for="catagory_name" >Catagory Name</label>
                        <input type="text" class="form-control" id="catagory_name" name="catagory_name" @if(!empty($catagory['catagory_name'])) value="{{ $catagory['catagory_name'] }}"  @else value="{{ old('catagory_name') }}" @endif value=""  placeholder="Enter Your Catagory Name" required>
                    </div>

                    <div class="form-group">
                      <label for="section_id" >Select Section</label>
                      <select name="section_id" id="section_id" class="form-control">
                        <option value="">Select</option>
                        @foreach($getSections as $section)
                        <option value="{{ $section['id'] }}" @if(!empty($catagory['section_id']) && $catagory['section_id'] == $section['id']) selected @endif>{{ $section['name'] }}</option>
                        @endforeach
                      </select>
                  </div>

                   <div id="appendCatagoriesLevel">
                      @include('admin.catagories.append_catagories_level')
                   </div>

                      <div class="form-group">
                        <label for="catagory_image" >Catagory Image</label>
                        <input type="file" class="form-control" id="catagory_image" name="catagory_image">
                    </div>


                    <div class="form-group">
                      <label for="catagory_discount" >Catagory Discount</label>
                      <input type="text" class="form-control" id="catagory_discount" name="catagory_discount" @if(!empty($catagory['catagory_discount'])) value="{{ $catagory['catagory_discount'] }}"  @else value="{{ old('catagory_discount') }}" @endif value=""  placeholder="Enter Your Catagory Discount">
                  </div>

                    <div class="form-group">
                      <label for="description" >Catagory Description</label>
                      <textarea name="description" id="description" rows="3"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="url" >Catagory URL</label>
                    <input type="text" class="form-control" id="url" name="url" @if(!empty($catagory['url'])) value="{{ $catagory['url'] }}"  @else value="{{ old('url') }}" @endif value=""  placeholder="Enter Your Catagory URL">
                </div>

                <div class="form-group">
                  <label for="meta_title" >Meta Title</label>
                  <input type="text" class="form-control" id="meta_title" name="meta_title" @if(!empty($catagory['meta_title'])) value="{{ $catagory['meta_title'] }}"  @else value="{{ old('meta_title') }}" @endif value=""  placeholder="Enter Your Meta Title">
                  </div>

                  <div class="form-group">
                    <label for="meta_description" >Meta Description</label>
                    <input type="text" class="form-control" id="meta_description" name="meta_description" @if(!empty($catagory['meta_description'])) value="{{ $catagory['meta_description'] }}"  @else value="{{ old('meta_description') }}" @endif value=""  placeholder="Enter Your Catagory Meta Description">
                </div>
                <div class="form-group">
                  <label for="meta_keywords" >Meta Keywords</label>
                  <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" @if(!empty($catagory['meta_keywords'])) value="{{ $catagory['meta_keywords'] }}"  @else value="{{ old('meta_keywords') }}" @endif value=""  placeholder="Enter Your Meta Keywords">
              </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
  </div>
  <!-- content-wrapper ends -->
      
@endsection