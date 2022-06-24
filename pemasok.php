<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
      <form action="" method="post">
          <?php 
          include "koneksi.php";
          if(isset($_POST['simpan'])){
              mysqli_query($con,"insert into tb_pemasok values('','$_POST[nama_pemasok]','$_POST[cp]','$_POST[alamat]')");
              echo "<script>alert('Tersimpan')</script>";
              echo "<script>document.location.href='pemasok.php';</script>";
          }
          if(isset($_GET['hapus'])){
            mysqli_query($con,"delete from tb_pemasok where kd_pemasok='$_GET[id]'");
            echo "<script>alert('Data terhapus');</script>";
            echo "<script>document.location.href='pemasok.php';</script>";
        }
        
          ?>
      <div class="container-fluid mt-3">
    <h1>Data Pemasok</h1>
        <div class="d-grid gap-2 col-3 mb-3">
            <button class="btn btn-primary" type="button">Tambah Data</button>
        </div>
        <table>
            <tr>
                <td>Nama Pemasok</td>
                <td>:</td>
                <td><input type="text" name="nama_pemasok" value="<?php echo @$edit['nama_pemasok']?>"></td>
            </tr>
            <tr>
                <td>Contact Person</td>
                <td>:</td>
                <td><input type="text" name="cp" value="<?php echo @$edit['kontak_person']?>"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><textarea name="alamat" id="" cols="30" rows="5"></textarea> value="<?php echo @$edit['alamat']?>"</td>
            </tr>
            <tr>
                <td>
                <?php if(isset($_GET['edit'])){ ?>
                    <button type="submit" name="update" value="update" class="btn btn-outline-dark">Update</button>
                    <?php } else{?>
                <button type="submit" name="simpan" value="simpan" class="btn btn-outline-dark">Simpan</button>
                        <?php } ?>
                </td>
            </tr>
           
        </table>
        <div class="row justify-content-end">
           <div class="col-4">
        <div class="input-group">
            
        <input type="text" class="form-control" name="tcari" placeholder="Search"  aria-describedby="button-addon2">
        <button class="col-3 btn btn-primary" name="cari" type="submit" id="button-addon2">Cari</button>
        </div>    
        </div>   
      
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Kode Pemasok</th>
                <th scope="col">Nama Pemasok</th>
                <th scope="col">Contact Person</th>
                <th scope="col">Alamat</th>
                <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                include "koneksi.php";
                
                if(isset($_POST['cari'])){
                    $sql = mysqli_query($con,"select * from tb_pemasok where nama_pemasok like '%$_POST[tcari]%'");
                }else{
                $sql = mysqli_query($con,"select * from tb_pemasok");
                }
                while($data=mysqli_fetch_array($sql)){

                
                ?>
                <tr>
                <td><?php echo $data['kd_pemasok']?></td>
                <td><?php echo $data['nama_pemasok']?></td>
                <td><?php echo $data['kontak_person']?></td>
                <td><?php echo $data['alamat']?></td>
                <td>
                    <a href="?hapus&id=<?php echo $data['kd_pemasok']?>" class="btn btn-danger">Hapus</a>
                    <a href="?edit&id=<?php echo $data['kd_pemasok']?>" class="btn btn-info">Edit</a>
                </td>
                </tr>
                <?php } ?>
               
            </tbody>
        </table>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    </form>
    
  </body>
</html>