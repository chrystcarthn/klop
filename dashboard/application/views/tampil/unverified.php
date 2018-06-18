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
            <li class="active"><a href="<?php echo base_url('index.php/Main/waiting') ?>"><i class="fa fa-circle-o"></i>Menunggu Verifikasi</a></li>
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
      
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><b>
        Outlet Menunggu Verifikasi
        </b>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
<!-- Main content -->

  <div class="row">
    <div class="col-xs-12">
       <div class="box box-primary">
        <!--<div class="box-header">-->
        <!--  <h3 class="box-title">Data Outlet</h3>-->
        <!--</div>-->
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
           <!--<table id="example1" class="table table-bordered table-striped">-->
            <thead>
            <tr>
              <th>No.</th>
              <th>Nama Outlet</th>
              <th>Didaftarkan</th>
              <th>Didaftarkan oleh</th>
              <th>Aksi</th>
            
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
                    <td><?php 
                    
                        $origin = $i->CREATED;
                        $newDate = date("d/m/Y H:m:s", strtotime($origin));
                        echo $newDate; 
                    
                    ?></td>
                    <td><?php echo $i->NamaU; ?></td>

                    <td>
                         <a href="#" class="btn btn-primary btn-xs" onclick="showdetail('<?php echo $i->ID_STORE; ?>')">Lihat</a>
                        
                        <a href="#" type="submit" method="post" class="btn btn-success btn-xs" id="id" onclick="approve('<?php echo $i->ID_STORE; ?>')">Terima</a>
                        <a href="#" type="submit" method="post" class="btn btn-danger btn-xs" id="id" onclick="reject('<?php echo $i->ID_STORE; ?>')">Tolak</a>
                    </td>
                
                </tr>
                <? $n++; } ?>
            
            </tbody>
          </table>
          
           <script type="text/javascript">
            function showdetail(param){
                document.location='<?php echo base_url(); ?>index.php/Main/vdetail_waitingoutlet/'+param;
            }
            function approve(param){
                document.location='<?php echo base_url('index.php/Main/approve/') ?>'+param;
            }
            function reject(param){
                 document.location='<?php echo base_url('index.php/Main/reject/') ?>'+param;
            }
            
            </script>
          
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

 
 </section>
    <!-- /.content -->
      </div>
  <!-- /.content-wrapper -->