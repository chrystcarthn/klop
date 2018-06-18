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
 