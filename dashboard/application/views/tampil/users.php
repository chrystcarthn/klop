 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
       
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Outlet</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('index.php/Main') ?>"><i class="fa fa-circle-o"></i>Terverifikasi</a></li>
            <li><a href="<?php echo base_url('index.php/Main/waiting') ?>"><i class="fa fa-circle-o"></i>Menunggu Verifikasi</a></li>
            <li><a href="<?php echo base_url('index.php/Main/rejected') ?>"><i class="fa fa-circle-o"></i>Ditolak</a></li>
          </ul>
        </li>
        <li  class="active">
          <a href="<?php echo base_url('index.php/Main/users') ?>">
            <i class="fa fa-users"></i> <span>Pengguna</span>
          </a>
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
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bar-chart-o"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
          </ul>
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
          Pengguna Terdaftar
        </b>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Utama</a></li>
        <li><a href="#" class="active">Pengguna</a></li>
      
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


<!-- Main content -->

  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
       
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
           <!--<table id="example1" class="table table-bordered table-striped">-->
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
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  </section>
  </div>
  <!-- /.content-wrapper -->
 