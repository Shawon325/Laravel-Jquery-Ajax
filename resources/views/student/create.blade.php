<form method="post" action="{{route('student.store')}}">
	@csrf
	<table>
		<tr>
			<td>Name</td>
			<td>:</td>
			<td><input type="text" name="student_name"></td>
		</tr>
		<tr>
			<td>Phone Number</td>
			<td>:</td>
			<td><input type="number" name="phone_number"></td>
		</tr>
		<tr>
			<td>Status</td>
			<td>:</td>
			<td><input type="text" name="status"></td>
		</tr>
		<td><button type="submit">Submit</button></td>
	</table>
</form>