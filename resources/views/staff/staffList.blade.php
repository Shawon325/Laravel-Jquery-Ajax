
<table id="example2" class="table table-bordered table-hover dataTable">
	<thead>
		<th>Sl</th>
		<th class="sorting @if($sorting==1){{'sorting_'.$sortingOrder}}@endif" sorting="1">Staff name</th>
		<th class="sorting @if($sorting==2){{'sorting_'.$sortingOrder}}@endif" sorting="2">Designation</th>
	  <th class="sorting @if($sorting==3){{'sorting_'.$sortingOrder}}@endif" sorting="3">Gender</th>
		<th class="sorting @if($sorting==4){{'sorting_'.$sortingOrder}}@endif" sorting="4">Email</th>
		<th class="sorting @if($sorting==5){{'sorting_'.$sortingOrder}}@endif" sorting="5">Number</th>
		<th class="sorting @if($sorting==6){{'sorting_'.$sortingOrder}}@endif" sorting="6">Address</th>
		<th>Action</th>
	</thead>
	<tbody>
		@foreach($data as $value)
		<tr>
				<td>{{$sl++}}</td>
				<td>{{$value->name}}</td>
				<td>{{$value->designation_name}}</td>
	    	<td>
					{{$value->gender==1 ? 'Male' : ''}}
					{{$value->gender==2 ? 'Female' : ''}}
					{{$value->gender==3 ? 'Others' : ''}}
				</td>
	    	<td>{{$value->email}}</td>
	    	<td>{{$value->number}}</td>
	    	<td>{{$value->address}}</td>
			  <td>
	          <button class="edit btn btn-primary btn-xs" data="{{$value->id}}">Edit</button>
	          <button type="button" class="delete btn btn-danger btn-xs" data="{{$value->id}}">Delete</button>
	      </td>
		</tr>
		@endforeach
	</tbody>
</table>
{{$data->links()}}
