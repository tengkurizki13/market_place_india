@extends('admin.layout.layout');
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Catalogue Management</h4>
            <h6 class="font-weight-normal mb-0">Sections</h6>
              {{-- <p class="card-description">
                Add class <code>.table-bordered</code>
              </p>--}}
                  <a style="max-width: 150px;float:right;display:inline-block;" href="{{ url('admin/add-edit-section') }}" class="btn btn-block btn-primary">Add Section</a>
                 @if (Session::has('success_massage'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> {{ Session::get('success_massage') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

              <div class="table-responsive pt-3">
                <table class="table table-bordered" id="sections">
                  <thead>
                    <tr>
                      <th>
                        ID
                      </th>
                      <th>
                        Name
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
                    @foreach ($sections as $section)
                   
                    <tr>
                      <td>
                        {{ $section['id'] }}
                      </td>
                      <td>
                        {{ $section['name'] }}
                      </td>
                      <td>
                        @if ($section['status'] == 0)
                            <a href="javascript:void(0)" class="updateSectionStatus" id="section-{{ $section['id'] }}" section_id="{{ $section['id'] }}"><i style="font-size: 25px" class="mdi mdi-bookmark-check" status="Active"></i></a>
                        @else
                        <a href="javascript:void(0)" class="updateSectionStatus" id="section-{{ $section['id'] }}" section_id="{{ $section['id'] }}"><i style="font-size: 25px" class="mdi mdi-bookmark-outline" status="Inactive"></i></a>
                        @endif
                      </td>
                      <td>
                            <a href="{{ url('admin/add-edit-section/'.$section['id']) }}"><i style="font-size: 25px" class="mdi mdi-pencil-box"></i></a>

                            {{-- <a title="section" class="confirmDelete" href="{{ url('admin/delete-section/'.$section['id']) }}"><i style="font-size: 25px" class="mdi mdi-file-excel-box"></i></a> --}}

                            <a class="confirmDelete" href="javascript:void(0)" module="section" moduleId="{{ $section['id'] }}"><i style="font-size: 25px" class="mdi mdi-file-excel-box"></i></a>
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