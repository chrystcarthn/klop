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
        <li class="active">
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
        Pengelolaan Fasilitas
        </b>
      </h1>
     
    </section>

    <!-- Main content -->
    <section class="content">


<!-- Main content -->

  <div class="row">
    <div class="col-xs-12">



        <div class="box box-success" style="width: 550px;">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Fasilitas Baru</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            

            
             <form method="post" role="form" action="<?php echo base_url('index.php/Main/add_facility') ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="text">Nama Fasilitas </label>
                  <input type="text" required class="form-control" id="namefacility" name="namefacility" placeholder="Ketik nama fasilitas...">
                </div>
               <div class="form-group">
                  <label>Publikasi sekarang</label>
                  <select class="form-control" id="published" name="published">
                    <option>Ya</option>
                    <option>Tidak</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <a href="#" class="btn btn-default btn-m" onclick="viewfacility()">Batal</a>
                <button type="submit" class="btn btn-success pull-right" >Tambah</button>
              </div>
            </form>
          </div>
        
        <script type="text/javascript">
         
            function viewfacility(){
                document.location='<?php echo base_url(); ?>index.php/Main/facility/';
            }
            </script>
          
        </div>
      
    </div>
    <!-- /.col -->

 </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 