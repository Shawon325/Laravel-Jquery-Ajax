@extends('layout.index') 

@section('content')
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Student</h3>
            </div>
            <form method="post" action="{{route('teacher.store')}}">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Enter name" name="name">
                </div>
                <div class="form-group">
                  <label>Department</label>
                  <input type="text" class="form-control" placeholder="Enter Department" name="department">
                </div>
                <div class="form-group">
                  <label>Phone Number</label>
                  <input type="number" class="form-control" placeholder="Enter Phone Number" name="phone_number">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Address</label>
                  <input type="text" class="form-control" placeholder="Enter Address" name="address">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          </div>
        </div>
    </section>
@endsection



<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Teacher form</h2>
  <form method="post" action="{{route('teacher.store')}}">
  	@csrf
    <div class="form-group">
      <label class="control-label col-sm-2">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"placeholder="Enter Name" name="name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Department:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"placeholder="Enter Department" name="department">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Phone Number:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control"placeholder="Enter Phone Number" name="phone_number">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2">Address:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control"placeholder="Enter Address" name="address">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>
</html> -->