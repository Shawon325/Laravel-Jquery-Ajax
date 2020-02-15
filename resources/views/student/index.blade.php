<a href="{{route('student.create')}}">Add New</a>
<table>
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