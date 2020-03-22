@csrf

<input type="hidden" class="form-control" name="id" value="{{$data->id}}">
<div class="form-group">
  <label>Staff Name</label>
  <input type="text" class="form-control" placeholder="Enter Staff name" name="name" value="{{$data->name}}">
</div>
<div class="form-group">
  <label>Designation</label>
  <select class="form-control" name="designation">
    @foreach($des as $value)
    <option value="{{$value->id}}" {{$value->id==$data->designation ? 'selected' : ''}}>{{$value->designation_name}}</option>
    @endforeach
  </select>
</div>
<div class="modal-body">
  <label>Gender</label>
  <div class="form-group">
        <div>
          <label for="male">
            <input type="radio" name="gender" id="male" value="1" {{$data->gender==1 ? 'checked' : ''}}>Male</label>
        </div>
        <div>
          <label for="female">
            <input type="radio" name="gender" id="female" value="2" {{$data->gender==2 ? 'checked' : ''}}>Female</label>
        </div>
        <div>
          <label for="others">
            <input type="radio" name="gender" id="others" value="3" {{$data->gender==3 ? 'checked' : ''}}>Others</label>
        </div>
    </div>
</div>
<div class="form-group">
  <label>Email</label>
  <input type="text" class="form-control" placeholder="Enter Email" name="email" value="{{$data->email}}">
</div>
<div class="form-group">
  <label>Phone Number</label>
  <input type="number" class="form-control" placeholder="Enter Phone Number" name="number" value="{{$data->number}}">
</div>
<div class="form-group">
  <label>Address</label>
  <input type="text" class="form-control" placeholder="Enter Address" name="address" value="{{$data->address}}">
</div>
