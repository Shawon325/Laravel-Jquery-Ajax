@csrf

<input type="hidden" class="form-control" name="id" value="{{$data->id}}">

<div class="form-group">
  <label>Student Name</label>
  <input type="text" class="form-control" placeholder="Enter Student name" name="student_name" value="{{$data->student_name}}">
</div>
<div class="form-group">
  <label>Roll</label>
  <input type="number" class="form-control" placeholder="Enter Roll" name="roll" value="{{$data->roll}}">
</div>
<div class="form-group">
  <label>Phone Number</label>
  <input type="number" class="form-control" placeholder="Enter Phone Number" name="phone_number" value="{{$data->phone_number}}">
</div>
<div class="form-group">
  <label>Address</label>
  <input type="text" class="form-control" placeholder="Enter Address" name="address" value="{{$data->address}}">
</div>
