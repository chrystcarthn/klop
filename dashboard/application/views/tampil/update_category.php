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
        Pengelolaan Kategori
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
              <h3 class="box-title">Ubah Kategori</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form method="post" role="form" action="<?php echo base_url('index.php/Main/update_category') ?>">
              <div class="box-body">
                <div class="form-group">
                <?php foreach ($dataupdate->result() as $key) { ?>
                  <label for="text">Nama Kategori</label>
                     <input type="hidden" class="form-control" id="id" name="id" placeholder="Id" value="<?php echo $key->ID_CATEGORY_DB; ?>">
                    <input type="text" required class="form-control" id="namecategory" name="namecategory" placeholder="Ketik nama kategori..." value="<?php echo $key->NAME_CATEGORY; ?>">
                    
                  
                </div>
               <div class="form-group">
                  <label>Publikasi sekarang</label>
                  <select class="form-control" id="published" name="published" value="<?php echo $key->PUBLISHED; ?>">
                     <option <?php if($key->PUBLISHED == "true") {echo 'selected="selected"'; } ?> >Ya</option>
                     <option <?php if($key->PUBLISHED == "false") {echo 'selected="selected"'; } ?> >Tidak</option>
                  </select>
                </div>
                
                 <?php } ?>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <a href="#" class="btn btn-default btn-m" onclick="viewcategory()">Batal</a>
                <button type="submit" class="btn btn-success pull-right" >Simpan</button>
              </div>
            </form>
          </div>
        
        <script type="text/javascript">
         
            function viewcategory(){
                document.location='<?php echo base_url(); ?>index.php/Main/category/';
            }
            </script>
        </div>
    </div>
    <!-- /.col -->
    
 </section>
    <!-- /.content -->
      </div>
  <!-- /.content-wrapper -->