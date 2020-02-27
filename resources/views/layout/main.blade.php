<!DOCTYPE html>
<html lang="en">
 
<head>
 
  @include('layout.head')
 
</head>
 
<body id="page-top">
 
  <!-- Page Wrapper -->
  <div id="wrapper">
 
    @include('layout.sidebar')
 
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
 
      <!-- Main Content -->
      <div id="content">
 
          @include('layout.navbar')
 
        <!-- Begin Page Content -->
        <div class="container-fluid">
 
            @yield('content')
 
        </div>
        <!-- /.container-fluid -->
 
      </div>
      <!-- End of Main Content -->
 
      @include('layout.footer')
 
    </div>
    <!-- End of Content Wrapper -->
 
  </div>
  <!-- End of Page Wrapper -->
 
    @include('layout.js')
    

    <!-- Page level plugins -->
    
<script src="/vendor/chart.js/Chart.min.js"></script>


<!-- Page level custom scripts -->
<script src="/js/demo/chart-area-demo.js"></script>
<script src="/js/demo/chart-pie-demo.js"></script>
<script src="/js/demo/chart-bar-demo.js"></script>



<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>



</body>
 
</html>