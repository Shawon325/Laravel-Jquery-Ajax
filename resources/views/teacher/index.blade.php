<!DOCTYPE html>
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


