<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Digital Repository</title>
    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link href="{{ asset('admin-template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link href="{{ asset('admin-template/css/sb-admin-2.min.css')}} " rel="stylesheet">
</head>

<body id="page-top" style="font-family: Calibri;">

<div id="app">
  <router-view></router-view>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js')}}"></script>
    <!-- Bootstrap core JavaScript-->
    <!-- <script src="{{ asset('admin-template/vendor/jquery/jquery.min.js')}}"></script> -->
    <script src="{{ asset('admin-template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin-template/vendor/jquery-easing/jquery.easing.min.js')}} "></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin-template/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <!-- <script src="{{ asset('admin-template/vendor/chart.js/Chart.min.js')}}"></script> -->

    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('admin-template/js/demo/chart-area-demo.js')}}"></script> -->
    <!-- <script src="{{ asset('admin-template/js/demo/chart-pie-demo.js')}}"></script> -->

</body>

</html>