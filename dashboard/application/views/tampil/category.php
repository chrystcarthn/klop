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
      
        <li class="active">
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
        Pengelolaan Kategori
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
         
          <a href="#" class="btn btn-success btn-m" onclick="addcategory()">+ Tambah kategori baru</a>
          
           
        
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
              <th>Nama Kategori</th>
               <th>Dipublikasi</th>
              <th>Dibuat</th>
              <th>Dibuat oleh</th>
              <th>Diubah</th>
              <th>Diubah oleh</th>
               <th>Aksi</th>
              
              
            
            </tr>
            </thead>
            <tbody>
            
             <?php 
                $n=1;
                    foreach ($kategori->result() as $i){
                   ?>     
                    
                 <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $i->NAME_CATEGORY; ?></td>
                     <td>
                        <?php if($i->PUBLISHED == "true"){
                            echo "Ya";
                          } 
                           else echo "Tidak";
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
                    <td><?php echo $i->CREATED_BY; ?></td>
                
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
                        <?php if($i->UPDATED_BY == "0"){
                            echo "-";
                          } 
                           else echo $i->UPDATED_BY;
                          ?>
                        
                    </td>
                    <td>
                        <a href="#" class="btn btn-primary btn-xs" onclick="updatecategory('<?php echo $i->ID_CATEGORY_DB; ?>')">Ubah</a>
                       
                    </td>
                    
                   
                
                </tr>
                <? $n++; } ?>
            
            </tbody>
          </table>
          
          <script type="text/javascript">
            
            function updatecategory(param){
                document.location='<?php echo base_url(); ?>index.php/Main/update_cat/'+param;
            }
            function addcategory(){
                document.location='<?php echo base_url(); ?>index.php/Main/add_new_cat/';
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