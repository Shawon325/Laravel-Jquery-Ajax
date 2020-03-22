 @extends('layouts.app')


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Student List</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
      <br>
    <a href="{{route('teacher.create')}}"><button class="btn btn-warning">Add New</button></a>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Sl</th>
                    <th>Teacher Name</th>
                    <th>Department</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                  </tr>
                </thead>
                <tbody>
                  @php $sl=1;  @endphp
                  @foreach($informations as $information)
                  <tr>
                    <td>{{$sl++}}</td>
                    <td>{{$information->name}}</td>
                    <td>{{$information->department}}</td>
                    <td>{{$information->phone_number}}</td>
                    <td>{{$information->address}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <title>Teacher Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<br>
<a href="{{route('teacher.create')}}"><button class="btn btn-success">Add New</button></a>
  <h2>Teacher Info</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Sl</th>
        <th>Teacher Name</th>
        <th>Department</th>
        <th>Phone Number</th>
        <th>Address</th>
      </tr>
    </thead>
    <tbody>
    	@php $sl=1;  @endphp
    	@foreach($informations as $information)
      <tr>
        <td>{{$sl++}}</td>
        <td>{{$information->name}}</td>
        <td>{{$information->department}}</td>
        <td>{{$information->phone_number}}</td>
        <td>{{$information->address}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
 -->
