<table id="example2" class="table table-bordered table-hover dataTable">
	<thead>
		<th>Sl</th>
		<th class="sorting @if($sorting==1){{'sorting_'.$sortingOrder}}@endif" sorting="1">Staff name</th>
		<th class="sorting @if($sorting==2){{'sorting_'.$sortingOrder}}@endif" sorting="2">Department</th>
		<th>Action</th>
	</thead>
	<tbody>
		@foreach($data as $value)
		<tr>
				<td>{{$sl++}}</td>
				<td>{{$value->name}}</td>
				<td>{{$value->department_name}}</td>
			  <td>
	          <button class="edit btn btn-primary btn-xs" data="{{$value->id}}">Edit</button>
	          <button type="button" class="delete btn btn-danger btn-xs" data="{{$value->id}}">Delete</button>
	      </td>
		</tr>
		@endforeach
	</tbody>
</table>
{{$value->links}}
