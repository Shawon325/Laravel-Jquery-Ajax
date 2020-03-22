@csrf

<div class="form-group">
  <label>Staff Name</label>
  <input type="text" class="form-control" placeholder="Enter Staff name" name="name">
</div>
<div class="form-group">
  <label>Designation</label>
  <select class="form-control" name="designation">
    @foreach($data as $value)
    <option value="{{$value->id}}">{{$value->designation_name}}</option>
    @endforeach
  </select>
</div>
<label>Gender</label>
<div class="form-group">
      <div>
        <label for="male">
          <input type="radio" name="gender" id="male" value="1">Male</label>
      </div>
      <div>
        <label for="female">
          <input type="radio" name="gender" id="female" value="2">Female</label>
      </div>
      <div>
        <label for="others">
          <input type="radio" name="gender" id="others" value="3">Others</label>
      </div>
  </div>
<div class="form-group">
  <label>Email</label>
  <input type="text" class="form-control" placeholder="Enter Email" name="email">
</div>
<div class="form-group">
  <label>Phone Number</label>
  <input type="number" class="form-control" placeholder="Enter Phone Number" name="number">
</div>
<div class="form-group">
  <label>Address</label>
  <input type="text" class="form-control" placeholder="Enter Address" name="address">
</div>
