<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
     
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
     
        <li  class="active">
          <a href="<?php echo base_url('index.php/Main/') ?>">
            <i class="fa fa-dashboard"></i> <span>Utama</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Outlet</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('index.php/Main/allstore') ?>"><i class="fa fa-circle-o"></i>Semua</a></li>
            <li><a href="<?php echo base_url('index.php/Main/waiting') ?>"><i class="fa fa-circle-o"></i>Menunggu Verifikasi</a></li>
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
        Selamat datang di Portal Admin, <?php echo "$loggedin"; ?>!
        </b>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
        
<!-- ============================================== Main content ================================================ -->

  <div class="row">
    <div class="col-xs-12">
      <!--<div class="box box-primary">-->
        <!--<div class="box-header">-->
        <!--  <h3 class="box-title">Data Outlet</h3>-->
        <!--</div>-->
        <!-- /.box-header -->
      <!--  <div class="box-body">-->
          
          <!-- Small boxes (Stat box) -->
          <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa  fa-user-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pengguna</span>

              <h3><b>
               <?php echo $juser->row()->jusers; ?>
                </b>
              </h3>
             
            </div>
             
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-group"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pemilik Outlet</span>
              <h3><b>
               <?php echo $jklien->row()->jklien; ?>
                </b>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

    <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-check-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Outlet Aktif</span>
              <h3><b>
              <?php echo $jaktif->row()->jaktif; ?>
                </b>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-archive"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Outlet Nonaktif</span>
              <h3><b>
               <?php echo $jnonaktif->row()->jnonaktif; ?>
                </b>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
       
    
    
    <div class="col-md-13">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#user" data-toggle="tab">Pengguna</a></li>
              <li><a href="#klien" data-toggle="tab">Pemilik Outlet</a></li>
              <li><a href="#aktif" data-toggle="tab">Outlet Aktif</a></li>
               <li><a href="#nonaktif" data-toggle="tab">Outlet Nonaktif</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="user">
                <!-- Post -->
             <h4 class="page-header">Data pengguna aplikasi KLOP hingga saat ini</h4>

                <!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Telepon</th>
                      <th>Email</th>
                      <th>Mendaftar</th>
                      <th>Diubah</th>
                
                    </tr>
                    </thead>
                    <tbody>
                    
                     <?php 
                        $n=1;
                            foreach ($users->result() as $i){
                           ?>     
                            
                         <tr>
                            <td><?php echo $n; ?></td>
                            <td><?php echo $i->FULL_NAME; ?></td>
                            <td><?php echo $i->PHONE; ?></td>
                            <td><?php  
                            
                                if(empty($i->email)){
                                    echo "-";
                                } else echo $i->EMAIL; 
                                
                            ?></td>
                            <td><?php 
                                    $origin = $i->CREATED;
                                    $newDate = date("d/m/Y H:m:s", strtotime($origin));
                                    echo $newDate; 
        
                            ?></td>
                            <td><?php 
                                if($i->UPDATED == "0000-00-00 00:00:00"){
                                    echo "-";
                                } else{
                                    $origin = $i->UPDATED;
                                    $newDate = date("d/m/Y H:m:s", strtotime($origin));
                                    echo $newDate; 
                                }
                            ?></td>
                        
                        </tr>
                        <? $n++; } ?>
                    
                    </tbody>
                  </table>
                 
                </div>
                <!-- /.box-body -->

 
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="klien">
                <!-- The timeline -->
                 <h4 class="page-header">Data pengguna yang telah bergabung menjadi Klien (pemilik outlet)</h4>
 <!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                     
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama</th>
                      <th>Telepon</th>
                      <th>Email</th>
                      <th>Mendaftar</th>
                      <th>Diubah</th>
                      <th>Jumlah Outlet</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                    
                     <?php 
                        $n=1;
                            foreach ($klien->result() as $i){
                           ?>     
                            
                         <tr>
                            <td><?php echo $n; ?></td>
                            <td><?php echo $i->FULL_NAME; ?></td>
                            <td><?php echo $i->PHONE; ?></td>
                            <td><?php  
                            
                                if(empty($i->email)){
                                    echo "-";
                                } else echo $i->EMAIL; 
                                
                            ?></td>
                            <td><?php 
                                    $origin = $i->CREATED;
                                    $newDate = date("d/m/Y H:m:s", strtotime($origin));
                                    echo $newDate; 
        
                            ?></td>
                            <td><?php 
                                if($i->UPDATED == "0000-00-00 00:00:00"){
                                    echo "-";
                                } else{
                                    $origin = $i->UPDATED;
                                    $newDate = date("d/m/Y H:m:s", strtotime($origin));
                                    echo $newDate; 
                                }
                            ?></td>
                             <td><?php echo $i->OUTLET; ?></td>
                        
                        </tr>
                        <? $n++; } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="aktif">
                <h4 class="page-header">Data outlet terverifikasi dan aktif beroperasi</h4>
                            <!-- /.box-header -->
               <div class="box-body">
                  <table id="example3" class="table table-bordered table-hover">
                
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Outlet</th>
                      <th>Alamat</th>
                      <th>Telp.</th>
                      <th>Didaftarkan</th>
                      <th>Didaftarkan oleh</th>
                      <th>Diverifikasi</th>
                      <th>Diverifikasi oleh</th>
                    
                    
                    </tr>
                    </thead>
                    <tbody>
                    
                     <?php 
                        $n=1;
                            foreach ($outlet->result() as $i){
                           ?>     
                            
                         <tr>
                            <td><?php echo $n; ?></td>
                            <td><?php echo $i->NAME_STORE; ?></td>
                            <td><?php echo $i->ADDRESS_STORE; ?></td>
                            <td><?php echo $i->PHONE_STORE; ?></td>
                            <td><?php 
                                    $origin = $i->CREATED;
                                    $newDate = date("d/m/Y H:m:s", strtotime($origin));
                                    echo $newDate; 
                                ?>
                            </td>
                            <td><?php echo $i->NamaU; ?></td>
                            <td><?php  
                            
                                if($i->CONFIRMED == "0000-00-00 00:00:00"){
                                    echo "-";
                                } else {
                                    $origin = $i->CONFIRMED;
                                    $newDate = date("d/m/Y H:m:s", strtotime($origin));
                                    echo $newDate; 
                                    
                                }
                                
                            ?></td>
                            <td><?php echo $i->NamaA; ?></td>
                            
                        
                         </tr>
                        <? $n++; } ?>
                    
                    </tbody>
                  </table>
                 
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.tab-pane -->
              
              
              <div class="tab-pane" id="nonaktif">
                <h4 class="page-header">Data outlet yang telah dinonaktifkan</h4>
                            <!-- /.box-header -->
               <div class="box-body">
                  <table id="example4" class="table table-bordered table-hover">
                
                    <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nama Outlet</th>
                      <th>Alamat</th>
                      <th>Telp.</th>
                      <th>Didaftarkan</th>
                      <th>Dinonaktifkan</th>
                     
                    
                    </tr>
                    </thead>
                    <tbody>
                    
                     <?php 
                        $n=1;
                            foreach ($outletnon->result() as $i){
                           ?>     
                            
                         <tr>
                            <td><?php echo $n; ?></td>
                            <td><?php echo $i->NAME_STORE; ?></td>
                            <td><?php echo $i->ADDRESS_STORE; ?></td>
                            <td><?php echo $i->PHONE_STORE; ?></td>
                            <td><?php 
                                    $origin = $i->CREATED;
                                    $newDate = date("d/m/Y H:m:s", strtotime($origin));
                                    echo $newDate; 
                                ?>
                            </td>
                            <td><?php  
                            
                                if($i->DELETED == "0000-00-00 00:00:00"){
                                    echo "-";
                                } else {
                                    $origin = $i->DELETED;
                                    $newDate = date("d/m/Y H:m:s", strtotime($origin));
                                    echo $newDate; 
                                    
                                }
                                
                            ?></td>
                        
                        
                         </tr>
                        <? $n++; } ?>
                    
                    </tbody>
                  </table>
                 
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.tab-pane -->
              
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    

      
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
 </section>
    <!-- /.content -->
     </div>
  <!-- /.content-wrapper -->
  
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
            $('#example3').DataTable({
              'paging'      : true,
              'lengthChange': true,
              'searching'   : true,
              'ordering'    : true,
              'info'        : true,
              'showNEntries': true,
              'autoWidth'   : false
            });
            $('#example4').DataTable({
              'paging'      : true,
              'lengthChange': true,
              'searching'   : true,
              'ordering'    : true,
              'info'        : true,
              'showNEntries': true,
              'autoWidth'   : false
            });
          });
        </script>