<table id="example2" class="table table-bordered table-hover dataTable">
  <thead>
    <th>Sl</th>
    <th class="sorting @if($sorting==1){{'sorting_'.$sortingOrder}}@endif" sorting="1">Student_name</th>
    <th class="sorting @if($sorting==2){{'sorting_'.$sortingOrder}}@endif" sorting="2">Roll</th>
    <th class="sorting @if($sorting==3){{'sorting_'.$sortingOrder}}@endif" sorting="3">Phone</th>
    <th class="sorting @if($sorting==4){{'sorting_'.$sortingOrder}}@endif" sorting="4">Address</th>
    <th>Action</th>
  </thead>
  <tbody>
    @foreach($data as $value)
    <tr>
      <td>{{$sl++}}</td>
      <td>{{$value->student_name}}</td>
      <td>{{$value->roll}}</td>
      <td>{{$value->phone_number}}</td>
      <td>{{$value->address}}</td>
      <td>
        <button class=" edit btn btn-primary btn-xs" data="{{$value->id}}">Edit</button>
          <button type="button" class="delete btn btn-danger btn-xs" data="{{$value->id}}">Delete</button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$data->links()}}
