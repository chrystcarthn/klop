<!DOCTYPE html>
<html>
    <head>
        <title>Data Kategori</title>
    </head>
    <script src="<?php echo base_url(); ?>assets/jquery-2.2.3.min.js"></script>
    <body>
        <a href="<?php echo site_url('OutletDashboard/index') ?>">Kembali</a>
        <!--<a href="<?php echo site_url('OutletDashboard/manage_facility') ?>">Pengelolaan Fasilitas</a-->
        
        <form method="post" action="<?php echo site_url('OutletDashboard/add_category') ?>">
            <table>
                <tr>
                    <td>Nama Kategori</td>
                    <td><input type="text" name="namedata"></td>
                    <td><button type="submit">Tambah</button></td>
                </tr>
                
            </table>
        </form>
        
         <form method="post" id="updatecat">
            <table>
                <tr>
                    <td>Ubah nama kategori</td>
                </tr>
                <tr>
                    <td><input type="text" name="idCat" id="idCat"></td>
                    <td><input type="text" name="nmCat" id="nmCat"></td>
                     
                     <td><button type="submit">Simpan</button></td>
                </tr>
            </table>
        </form>
        <br>

            <script type="text/javascript">
                function update_category(data1, data2){
                    $("#idCat").val(data1);
                    $("#nmCat").val(data2);
                    $("#updatecat").attr("action","<?php echo site_url('OutletDashboard/update_category') ?>");
                }
                
                function delete_category(param){
                    var proc = window.confirm("Yakin ingin menghapus kategori ini?");
                    if(proc){
                        document.location='<?php echo base_url(); ?>index.php/OutletDashboard/delete_category/'+param;
                    }
                }
            </script>
            
            <table border="1">
                <tr>
                    <td>No</td>
                    <td>Nama Kategori</td>
                    <td>Dibuat</td>
                    <td>Opsi</td>
                </tr

                <?php 
                $n=1;
                    foreach ($kategori->result() as $i){
                        
                    
                ?>
                
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $i->NAME_CATEGORY; ?></td>
                    <td><?php echo $i->CREATED; ?></td>
                     <td><a href="#" onclick="update_category('<?php echo $i->ID_CATEGORY_DB; ?>','<?php echo $i->NAME_CATEGORY; ?>')">Ubah</a>
                        <a href="#" onclick="delete_category('<?php echo $i->ID_CATEGORY_DB; ?>')">Hapus</a>
                    </td>
                </tr>
                <? $n++; } ?>
            </table>
    </body>
</html>