@csrf

<div class="form-group">
  <label>Student Name</label>
  <input type="text" class="form-control" placeholder="Enter Student name" name="name">
</div>
<div class="form-group">
  <label>Department</label>
  <select class="form-control" name="department">
    <option class="default">--Select Department--</option>
    @foreach($data as $value)
    <option value="{{$value->id}}">{{$value->department_name}}</option>
    @endforeach
  </select>
</div>
<div class="form-group">
<label>Cource</label>
  <div class="form-check">
    <label class="form-check-label">
      @foreach($cor as $value)
      <input type="checkbox" class="form-check-input" name="cource[]" value="{{$value->id}}">{{$value->cource_name}}
      <br>
      @endforeach
    </label>
  </div>
</div>
