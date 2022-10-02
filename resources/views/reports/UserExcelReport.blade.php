<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="charset=UTF-8">
	<title>User <?php echo date('d M Y'); ?></title>
</head>

<body>
  <table>
		<thead>
			<tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Phone Number</th>
        <th>Email Address</th>
        <th>Place of Birth</th>
        <th>Date of Birth</th>
        <th>Gender</th>
        <th>Address</th>
        <th>Department</th>
        <th>Faculty</th>
        <th>Year</th>
        <th>Role</th>
        <th>Approved</th>
			</tr>
		</thead>
		<tbody>
      @foreach ($user as $datas)
			<tr>
				<td>{{$datas->id}}</td>
        <td>{{$datas->name}}</td>
        <td>{{$datas->phone}}</td>
        <td>{{$datas->email}}</td>
        <td>{{$datas->place_of_birth}}</td>
        <td>{{$datas->date_of_birth}}</td>
        <td>{{$datas->gender}}</td>
        <td>{{$datas->address}}</td>
        <td>{{$datas->department_name}}</td>
        <td>{{$datas->faculty_name}}</td>
        <td>{{$datas->years}}</td>
        <td>{{$datas->role}}</td>
        <td>{{$datas->approved == 1 ? 'Yes' : 'No'}}</td>
			</tr>
      @endforeach
		</tbody>
	</table>
</body>

</html>