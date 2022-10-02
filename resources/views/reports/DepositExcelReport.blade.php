<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="charset=UTF-8">
	<title>Report <?php echo date('d M Y'); ?></title>
</head>

<body>
  <h4>Deposit Report</h4>
  <table>
		<thead>
			<tr>
        <th>Id</th>
        <th>Title</th>
        <th>Category</th>
        <th>Description</th>
        <th>Publisher</th>
        <th>Date</th>
        <th>Language</th>
        <th>Relation</th>
        <th>Right Management</th>
         
        <th>Creator</th>
          
        <th>Subject</th>
        <th>Type</th>
        <th>Format</th>
        <th>Contributor</th>
        <th>Identifier</th>
        <th>Source</th>
        <th>Coverage</th>
        <!-- <th>Division Information</th> -->
        <th>File</th>

			</tr>
		</thead>
		<tbody>
      @foreach ($upload_form as $datas)
			<tr>
        <td>{{$datas->id}}</td>
				<td>{{$datas->title}}</td>
        <td>{{$datas->category_name}}</td>
        <td>{!! $datas->description !!}</td>
        <td>{{$datas->publisher}}</td>
        <td>{{$datas->date}}</td>
        <td>{{$datas->language_name}}</td>
        <td>{{$datas->relation}}</td>
        <td>{{$datas->right_management}}</td>
        <td>{{$datas->creator}}</td>
        <td>{{$datas->subject}}</td>
        <td>{{$datas->type}}</td>
        <td>{{$datas->format}}</td>
        <td>{{$datas->contributor}}</td>
        <td>{{$datas->identifier }}</td>
        <td>{{$datas->source }}</td>
        <td>{{$datas->coverage }}</td>
        <!-- <td>{{$datas->division }}</td> -->
        <td>{{$datas->file}}</td>
          
     
			</tr>
      @endforeach
		</tbody>
	</table>
</body>

</html>