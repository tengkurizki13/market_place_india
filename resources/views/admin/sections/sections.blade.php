@extends('admin.layout.layout');
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Sections</h4>
              <p class="card-description">
                Add class <code>.table-bordered</code>
              </p>
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

                            <a href="{{ url('admin/delete-section/'.$section['id']) }}"><i style="font-size: 25px" class="mdi mdi-file-excel-box"></i></a>
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