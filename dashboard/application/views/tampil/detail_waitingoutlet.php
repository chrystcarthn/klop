 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="<?php echo base_url('index.php/Main/') ?>">
            <i class="fa fa-dashboard"></i> <span>Utama</span>
          </a>
        </li>
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-table"></i> <span>Outlet</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('index.php/Main/allstore') ?>"><i class="fa fa-circle-o"></i>Semua</a></li>
            <li   class="active"><a href="<?php echo base_url('index.php/Main/waiting') ?>"><i class="fa fa-circle-o"></i>Menunggu Verifikasi</a></li>
            <li><a href="<?php echo base_url('index.php/Main/rejected') ?>"><i class="fa fa-circle-o"></i>Ditolak</a></li>
          </ul>
        </li>
    
        <li>
          <a href="<?php echo base_url('index.php/Main/category') ?>">
            <i class="fa fa-th"></i> <span>Pengelolaan Kategori</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url('index.php/Main/facility') ?>">
            <i class="fa fa-th"></i> <span>Pengelolaan Fasilitas</span>
          </a>
        </li>
         <li>
          <a href="<?php echo base_url('index.php/Main/admin') ?>">
            <i class="fa fa-th"></i> <span>Pengelolaan Admin</span>
          </a>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>



<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><b>
        Detail Outlet :  <td><?php echo $outlet->row()->NAME_STORE; ?></td>
        </b>
      </h1>
      
    </section> 
 
 <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
            <div class="col-sm-20 invoice-col">
          <h2 class="page-header">
            <i></i> Informasi Umum
            <i><small class="pull-right">Didaftarkan: <?php 
                $origin = $outlet->row()->CREATED;
                $newDate = date("d/m/Y H:m:s", strtotime($origin));
                echo $newDate; 
           ?></small></i>
          </h2>
          </div>
           
            
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
       <div class="row invoice-info">
            <!-- /.col -->
        <div class="col-sm-4 invoice-col">
           <strong><i class="fa fa-phone margin-r-5"></i> Telepon</strong>
          <address>
          <?php echo $outlet->row()->PHONE_STORE; ?>
          </address>
        </div>
      </div>
       <div class="row invoice-info">
            <!-- /.col -->
        <div class="col-sm-10 invoice-col">
           <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
          <address>
          <?php echo $outlet->row()->ADDRESS_STORE; ?>
          </address>
        </div>
      </div>
      <div class="row invoice-info">
        
        <div class="col-sm-4 invoice-col">
           <strong><i class="fa fa-map margin-r-5"></i> Kordinat Google Maps</strong>
          <address>
          <?php echo $outlet->row()->LATITUDE; ?>, <?php echo $outlet->row()->LONGITUDE; ?>
          <div id="map" style="width:300px;height:200px;background:primary"></div>
          </address>
        </div>
         
      </div>
      
     
      <!-- /.row -->

    <h2 class="page-header">
            <i></i> Informasi Detil
    </h2>
  
     <div class="row invoice-info">
        <!-- /.col -->
        <div class="col-sm-2 invoice-col">
          <strong><i class="fa fa-info margin-r-5"></i> Kategori</strong>
          <address>
              <?php 
                $n=1;
                    foreach ($category->result() as $i){
                       echo $i->name_category; 
                       ?> <br> <?php
                    }
                   ?>     
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         <strong><i class="fa fa-info margin-r-5"></i> Fasilitas</strong>
           <address>
              <?php 
                $n=1;
                    foreach ($facility->result() as $i){
                       echo $i->name_facility; 
                       ?> <br> <?php
                    }
                   ?>     
          </address>
        </div>
      </div>
     
     
      <strong><i class="fa fa-calendar margin-r-5"></i> Jadwal</strong>
      <!-- Table row -->
      <div class="row">
          
        <div class="col-xs-4 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>No.</th>
              <th>Hari</th>
              <th>Jam Buka</th>
              <th>Jam Tutup</th>

            </tr>
            </thead>
            <tbody>
            <?php 
                $n=1;
                    foreach ($schedule->result() as $i){
                   ?>     
                    
                 <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $i->DAYS; ?></td>
                    <td><?php echo $i->TIME_OPEN; ?></td>
                    <td><?php echo $i->TIME_OPEN; ?></td>

                </tr>
                <? $n++; } ?>
            
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->



      <div class="row">   
    
    <div class="col-sm-6">
        
          <div class="row">
            <div class="col-sm-10">
                <strong><i class="fa fa-calendar margin-r-5"></i> Logo</strong>
                 <hr>
              <img class="img-responsive" src="<?php echo $outlet->row()->LOGO_STORE; ?>" alt="Photo">
              <br>
              <strong><i class="fa fa-calendar margin-r-5"></i> Foto Sampul</strong>
               <hr>
              <img class="img-responsive" src="<?php echo $outlet->row()->BANNER; ?>" alt="Photo">
              <br>
              <br>
            </div>
            <!-- /.col -->
            
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.col -->
     </div>
     
    
     
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa"></i> Kembali</a>
          <a href="<?php echo base_url('index.php/Main/reject2/'.$outlet->row()->ID_STORE)?>" class="btn btn-danger pull-right"><i class="fa  fa-close"></i> Tolak</a>
          
          <a href="<?php echo base_url('index.php/Main/approve2/'.$outlet->row()->ID_STORE)?>" class="btn btn-success pull-right margin-r-5"><i class="fa fa-check"></i> Terima</a>
          
        </div>
      </div>
    </section>
    <!-- /.content -->
 
 
 
 <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

         
    </section>
    <!-- /.content -->
    </div>
  <!-- /.content-wrapper -->
  
  <script>
      function initMap() {
        var uluru = {lat:  <?php echo $outlet->row()->LATITUDE; ?>, lng:  <?php echo $outlet->row()->LONGITUDE; ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
      
    </script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1fONMuvK7uVdh96SCmgY_lGVVxowX7lc&callback=initMap"></script>

<script>
          $(function () {
            $('#example1').DataTable({
              'paging'      : true,
              'lengthChange': true,
              'searching'   : true,
              'ordering'    : true,
              'info'        : true,
              'showNEntries': true,
              'autoWidth'   : false
            });
            $('#example2').DataTable({
              'paging'      : true,
              'lengthChange': true,
              'searching'   : true,
              'ordering'    : true,
              'info'        : true,
              'showNEntries': true,
              'autoWidth'   : false
            });
            $('#example5').DataTable({
              'paging'      : true,
              'lengthChange': true,
              'searching'   : false,
              'ordering'    : true,
              'info'        : true,
              'showNEntries': true,
              'autoWidth'   : false
            });
          
          });
        </script>
        
        <script type="text/javascript">

            function approve(param){
                document.location='<?php echo base_url('index.php/Main/approve2/') ?>'+param;
            }
            function reject(param){
                 document.location='<?php echo base_url('index.php/Main/reject2/') ?>'+param;
            }
            
            </script>
 