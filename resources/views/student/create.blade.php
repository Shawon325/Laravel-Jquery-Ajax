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
			<form method="post" action="{{route('student.store')}}">
			  @csrf
              <div class="box-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" placeholder="Enter name" name="student_name">
                </div>
                <div class="form-group">
                  <label>Phone Number</label>
                  <input type="number" class="form-control" placeholder="Enter Phone Number" name="phone_number">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Status</label>
                  <input type="text" class="form-control" name="status">
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