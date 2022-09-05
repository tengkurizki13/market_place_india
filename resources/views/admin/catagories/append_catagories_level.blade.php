<div class="form-group">
    <label for="parent_id" >Select Catagory Level</label>
    <select name="parent_id" id="parent_id" class="form-control">
      <option value="0" @if(isset($catagory['parent_id']) && $catagory['parent_id'] == 0) selected @endif>Main Catagory</option>
      @if (!empty($getCatagories))
        @foreach ($getCatagories as $parentcatagory)
          <option value="{{ $parentcatagory['id'] }}" @if(isset($catagory['parent_id']) && $catagory['parent_id'] == $parentcatagory['id']) selected @endif>{{ $parentcatagory['catagory_name'] }}</option>
          @if (!empty($parentcatagory['subcatagories']))
          @foreach ($parentcatagory['subcatagories'] as $subcatagory)
            <option value="{{ $subcatagory['id'] }}" @if(isset($subcatagory['parent_id']) && $subcatagory['parent_id'] == $subcatagory['id']) selected @endif>&nbsp;&raquo;&nbsp;{{ $subcatagory['catagory_name'] }}</option>
          @endforeach
        @endif
        @endforeach
      @endif
    </select>
</div>