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
        <li class="active">
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
        Pengelolaan Admin
        </b>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">


<!-- Main content -->

  <div class="row">
    <div class="col-xs-12">
       
      <div class="box box-primary">
        <div class="box-header">
            
          <!--<h3 class="box-title"><b>Tambah fasilitas baru</b></h3>-->
         
          <a href="#" class="btn btn-success btn-m" onclick="addadmin()">+ Tambah admin baru</a>
          
           
        
        <script type="text/javascript">
            function myFunction() {
                var x = document.getElementById("myDIV");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
           <!--<table id="example1" class="table table-bordered table-striped">-->
            <thead>
            <tr>
              <th>No.</th>
              <th>Nama Admin</th>
              <th>Status</th>
              <th>Didaftarkan</th>
              <th>Didaftarkan oleh</th>
              <th>Diubah</th>
			  <th>Diubah oleh</th>
              <th>Aksi</th>
              
              
            
            </tr>
            </thead>
            <tbody>
            
             <?php 
                $n=1;
                    foreach ($admin->result() as $i){
                   ?>     
                    
                 <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $i->FULL_NAME; ?></td>
                     <td>
                        <?php if($i->STATUS == "active"){
                            echo "Aktif";
                          } 
                           else echo "Nonaktif";
                          ?>
                        
                    </td>
                    <td><?php 
                        if($i->CREATED == "0000-00-00 00:00:00"){
                            echo "-";
                        } else{
                            $origin = $i->CREATED;
                            $newDate = date("d/m/Y H:m:s", strtotime($origin));
                            echo $newDate; 
                        }
                    
                    ?></td>
                    <td><?php echo $i->NamaAC; ?></td>
                
                    <td>
                        <?php if($i->UPDATED == "0000-00-00 00:00:00"){
                            echo "-";
                        } else{
                            $origin = $i->UPDATED;
                            $newDate = date("d/m/Y H:m:s", strtotime($origin));
                            echo $newDate; 
                        }
                          ?>
                        
                    </td>
                    <td>
					<?php if($i->NamaAU == "" || $i->NamaAU == null){
						echo "-"; 
					}
					else echo $i->NamaAU;
						?>
					
					</td>
                    
					 <td>
                        <a href="#" type="submit" method="post" class="btn btn-success btn-xs" id="id" onclick="active('<?php echo $i->ID_USER; ?>')">Aktifkan</a>
                        <a href="#" type="submit" method="post" class="btn btn-danger btn-xs" id="id" onclick="nonactive('<?php echo $i->ID_USER; ?>')">Deaktif</a>
                    </td>
                    
                   
                
                </tr>
                <? $n++; } ?>
            
            </tbody>
          </table>
          
          <script type="text/javascript">
           function addadmin(){
                document.location='<?php echo base_url(); ?>index.php/Main/add_new_adm/';
            }
            function active(param){
                document.location='<?php echo base_url('index.php/Main/activeAdm/') ?>'+param;
            }
            function nonactive(param){
                 document.location='<?php echo base_url('index.php/Main/nonactiveAdm/') ?>'+param;
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