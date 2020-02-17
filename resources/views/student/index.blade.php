 @extends('layout.index')


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
    <a href="{{route('student.create')}}"><button class="btn btn-warning" style="text-align: right;">Add New</button></a>
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
					<th>Sl</th>
					<th>Student_name</th>
					<th>Phone</th>
					<th>Status</th>
				</thead>
                <tbody>
					@php $sl=1; @endphp
					@foreach($students as $student)
					<tr>
						<td>{{$sl++}}</td>
						<td>{{$student->student_name}}</td>
						<td>{{$student->phone_number}}</td>
						<td>{{$student->status}}</td>
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