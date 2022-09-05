@extends('admin.layout.layout');
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Catalogue Management</h4>
              <h6 class="font-weight-normal mb-0">Catagories</h6>
              {{-- <p class="card-description">
                Add class <code>.table-bordered</code>
              </p>--}}
                  <a style="max-width: 150px;float:right;display:inline-block;" href="{{ url('admin/add-edit-catagory') }}" class="btn btn-block btn-primary">Add Catagories</a>
                 @if (Session::has('success_massage'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> {{ Session::get('success_massage') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

              <div class="table-responsive pt-3">
                <table class="table table-bordered" id="catagories">
                  <thead>
                    <tr>
                      <th>
                        ID
                      </th>
                      <th>
                        Catagory
                      </th>
                      <th>
                        Parent Catagory
                      </th>
                      <th>
                        Section
                      </th>
                      <th>
                        URL
                      </th>
                      <th>
                        Status
                      </th>
                      <th>
                        Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($catagories as $catagory)
                    @if (isset($catagory['parentcatagory']['catagory_name'])&&!empty($catagory['parentcatagory']['catagory_name']))
                    @php $parent_catagory= $catagory['parentcatagory']['catagory_name']; @endphp
                    @else
                    @php $parent_catagory= "Root"; @endphp
                    @endif
                    <tr>
                      <td>
                        {{ $catagory['id'] }}
                      </td>
                      <td>
                        {{ $catagory['catagory_name'] }}
                      </td>
                      <td>
                        {{ $parent_catagory }}
                      </td>
                      <td>
                        {{ $catagory['section']['name'] }}
                      </td>
                      <td>
                        {{ $catagory['url'] }}
                      </td>
                      <td>
                        @if ($catagory['status'] == 0)
                            <a href="javascript:void(0)" class="updateCatagoryStatus" id="catagory-{{ $catagory['id'] }}" catagory_id="{{ $catagory['id'] }}"><i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i></a>
                        @else
                        <a href="javascript:void(0)" class="updateCatagoriesStatus" id="catagory-{{ $catagory['id'] }}" catagory_id="{{ $catagory['id'] }}"><i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i></a>
                        @endif
                      </td>
                      <td>
                            <a href="{{ url('admin/add-edit-catagory/'.$catagory['id']) }}"><i style="font-size: 25px" class="mdi mdi-pencil-box"></i></a>

                            {{-- <a title="catagory" class="confirmDelete" href="{{ url('admin/delete-catagory/'.$catagory['id']) }}"><i style="font-size: 25px" class="mdi mdi-file-excel-box"></i></a> --}}

                            <a class="confirmDelete" href="javascript:void(0)" module="catagory" moduleId="{{ $catagory['id'] }}"><i style="font-size: 25px" class="mdi mdi-file-excel-box"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial -->
  </div>
      
@endsection