<!DOCTYPE html>
<html>
    <head>
        <title>Data Fasilitas</title>
    </head>
    <script src="<?php echo base_url(); ?>assets/jquery-2.2.3.min.js"></script>
    <body>
        <a href="<?php echo site_url('OutletDashboard/index') ?>">Kembali</a>
        <!--<a href="<?php echo site_url('OutletDashboard/manage_category') ?>">Pengelolaan Kategori</a>-->
        
         <form method="post" action="<?php echo site_url('OutletDashboard/add_facility') ?>">
            <table>
                <tr>
                    <td>Nama Fasilitas</td>
                    <td><input type="text" name="namedata"></td>
                    <td><button type="submit">Tambah</button></td>
                </tr>
                
            </table>
        </form>
        
        
        <form method="post" id="updatefac">
            <table>
                <tr>
                    <td>Ubah nama fasilitas</td>
                </tr>
                <tr>
                    <td><input type="text" name="idFac" id="idFac"></td>
                    <td><input type="text" name="nmFac" id="nmFac"></td>
                     
                     <td><button type="submit">Simpan</button></td>
                </tr>
            </table>
        </form>
        <br>

            <script type="text/javascript">
                function update_facility(data1, data2){
                    $("#idFac").val(data1);
                    $("#nmFac").val(data2);
                    $("#updatefac").attr("action","<?php echo site_url('OutletDashboard/update_facility') ?>");
                }
                
                function delete_facility(param){
                    var proc = window.confirm("Yakin ingin menghapus fasilitas ini?");
                    if(proc){
                        document.location='<?php echo base_url(); ?>index.php/OutletDashboard/delete_facility/'+param;
                    }
                }
            </script>
            
            <table border="1">
                <tr>
                    <td>No</td>
                    <td>Nama Fasilitas</td>
                    <td>Dibuat</td>
                    <td>Opsi</td>
                </tr

                <?php 
                $n=1;
                    foreach ($fasilitas->result() as $i){
                        
                    
                ?>
                
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $i->NAME_FACILITY; ?></td>
                    <td><?php echo $i->CREATED; ?></td>
                   <td><a href="#" onclick="update_facility('<?php echo $i->ID_FACILITY_DB; ?>','<?php echo $i->NAME_FACILITY; ?>')">Ubah</a>
                        <a href="#" onclick="delete_facility('<?php echo $i->ID_FACILITY_DB; ?>')">Hapus</a>
                    </td>
                </tr>
                <? $n++; } ?>
            </table>
            
       
    </body>
</html>