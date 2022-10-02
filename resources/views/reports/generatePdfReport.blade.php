<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title>Deposit Report - <?php echo date('d M Y'); ?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    body {
      font-family: 'Arial';
      font-size: 14px;
      /* src: url('https://fonts.googleapis.com/css2?family=Mukta:wght@200&display=swap'); */
    }
    @page {
      margin: 15pt;
    }
  </style>
</head>

<body>
  <h4 class="text-center mt-3 mb-5">DIGITAL REPOSITORY FRAMEWOK - DEPOSIT REPORT (<?php echo date('d-m-Y'); ?>)</h4>
  <table class='table table-bordered table-condensed table-striped small'>
		<thead>
			<tr>
        <th style="width: 15px; vertical-align: middle;" class="text-center">#</th>
        <th style="width: 170px; vertical-align: middle;">Title</th>
        <th style="vertical-align: middle;">Category</th>
        <th style="vertical-align: middle;">Publisher</th>
        <th style="vertical-align: middle;">Division</th>
        <th style="width: 59px; vertical-align: middle;" class="text-center">Date</th>
        <th style="width: 60px; vertical-align: middle;">Language</th>
        <th style="width: 30px; vertical-align: middle;" class="text-center">Right Management</th>
        <th style="width: 30px; vertical-align: middle;" class="text-center">Status</th>
        <th style="width: 90px; vertical-align: middle;" class="text-center">Download - View</th>
			</tr>
		</thead>
		<tbody>
      @foreach ($upload_form as $datas)
			<tr>
        <td>{{$loop->iteration}}</td>
				<td>{{$datas->title}}</td>
        <td>{{$datas->category_name}}</td>
        <td>{{$datas->publisher}}</td>
        <td>{{$datas->division_name}}</td>
        <td>{{$datas->date}}</td>
        <td>{{$datas->language_name}}</td>
        <td class="text-center">{{$datas->right_management}}</td>
        <td class="text-center">{{$datas->status}}</td>
        <td class="text-center">{{$datas->total_download}}</td>
			</tr>
      @endforeach
		</tbody>
	</table>
</body>

</html>