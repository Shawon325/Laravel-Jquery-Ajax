<table id="example2" class="table table-bordered table-hover dataTable">
  <thead>
    <tr>
      <th>Sl</th>
      <th class="sorting @if($sorting==1){{'sorting_'.$sortingOrder}} @endif" sorting="1">Teacher Name</th>
      <th class="sorting @if($sorting==2){{'sorting_'.$sortingOrder}} @endif" sorting="2">Department</th>
      <th class="sorting @if($sorting==3){{'sorting_'.$sortingOrder}} @endif" sorting="3">Gender</th>
      <th class="sorting @if($sorting==4){{'sorting_'.$sortingOrder}} @endif" sorting="4">Email</th>
      <th class="sorting @if($sorting==5){{'sorting_'.$sortingOrder}} @endif" sorting="5">Phone Number</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $value)
    <tr>
      <td>{{$sl++}}</td>
      <td>{{$value->name}}</td>
      <td>{{$value->department_name}}</td>
      <td>{{$value->gender_name}}</td>
      <td>{{$value->email}}</td>
      <td>{{$value->phone_number}}</td>
      <td>
        <button class="edit btn btn-info btn-xs" data="{{$value->id}}">Edit</button>
        <button type="button" class="delete btn btn-danger btn-xs" data="{{$value->id}}">Delete</button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$data->links()}}
