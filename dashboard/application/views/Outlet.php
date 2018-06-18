<!DOCTYPE html>
<html>
    <head>
        <title>Data Outlet</title>
    </head>

    <body>
        <a href="<?php echo site_url('OutletDashboard/manage_category') ?>">Pengelolaan Kategori</a>
        <a href="<?php echo site_url('OutletDashboard/manage_facility') ?>">Pengelolaan Fasilitas</a>
    
         <form>
             
             <script type="text/javascript">
              
                function verifikasi(param, param2){
                    var proc = window.confirm("Konfirmasi verifikasi outlet?");
                    if(proc){
                        document.location='<?php echo base_url(); ?>index.php/OutletDashboard/verifikasi/'+param;
                    }
                }
            </script>
             
            <table border="1">
                <tr>
                    <td>No</td>
                    <td>Nama Outlet</td>
                    <td>Alamat</td>
                    <td>No. Telepon</td>
                    <td>Didaftarkan</td>
                    <td>Dihapus Oleh Pemilik</td>
                    <td>Dihapus</td>
                    <td>Status</td>
                     <td>Opsi</td>
                </tr

                <?php 
                $n=1;
                    foreach ($outlet->result() as $i){
                        
                    
                ?>
                
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $i->NAME_STORE; ?></td>
                    <td><?php echo $i->ADDRESS_STORE; ?></td>
                    <td><?php echo $i->PHONE_STORE; ?></td>
                    <td><?php echo $i->CREATED; ?></td>
                    <td><?php 
                        
                        if($i->ISDELETED == 0){
                            echo "Ya";
                        } else echo "Tidak";
                        
                    ?></td>
                    <td><?php  
                    
                        if($i->DELETED == "0000-00-00 00:00:00"){
                            echo "-";
                        } else echo $i->DELETED; 
                        
                    ?></td>
                    <td><?php
                         if($i->STATUS_STORE == "verified"){
                            echo "Terverifikasi";
                        } else if($i->STATUS_STORE == "unverified"){
                            echo "Menunggu verifikasi";
                        }else echo "Ditolak"; 
                    ?></td>
                    <td>
                        <a href="#" onclick="verifikasi('<?php echo $i->ID_STORE; ?>','<?php echo "verified" ?>')">Verifikasi</a>
                        <a href="#">Tolak</a>
                    </td>
                </tr>
                <? $n++; } ?>
            </table>
        </form>
        
        
    </body>
</html>