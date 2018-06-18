 <div class="box-body">
    <table id="example1" class="table table-bordered table-hover">
    <!--<table id="example1" class="table table-bordered table-striped">-->
    <thead>
    <tr>
      <th>No.</th>
      <th>Nama Outlet</th>
      <th>Alamat</th>
      <th>Telp.</th>
      <th>Didaftarkan</th>
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
            <td><?php  
            
                if($i->CONFIRMED == "0000-00-00 00:00:00"){
                    echo "-";
                } else {
                    $origin = $i->CONFIRMED;
                    $newDate = date("d/m/Y H:m:s", strtotime($origin));
                    echo $newDate; 
                    
                }
                
            ?></td>
            <td><?php echo $i->CONFIRMED_BY; ?></td>
            <td><?php
                 if($i->STATUS_STORE == "verified"){
                    echo "Terverifikasi";
                } else if($i->STATUS_STORE == "unverified"){
                    echo "Menunggu verifikasi";
                }else echo "Ditolak"; 
            ?></td>
        
    </tr>
        <? $n++; } ?>
    
    </tbody>
    </table>
    
    </div>
    <!-- /.box-body -->