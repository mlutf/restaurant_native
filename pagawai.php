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
              mysqli_query($con,"insert into tb_pagawai values('','$_POST[nama_pegawai]','$_POST[jk]','$_POST[alamat]', '$_POST[nohp]','$_POST[jabatan]')");
              echo "<script>alert('Tersimpan')</script>";
              echo "<script>document.location.href='?pagawai';</script>";
          }
          if(isset($_GET['hapus'])){
            mysqli_query($con,"delete from tb_pagawai where kd_pegawai='$_GET[id]'");
            echo "<script>alert('Data terhapus');</script>";
            echo "<script>document.location.href='?pagawai';</script>";
        }
        if(isset($_GET['edit'])){
            $ed=mysqli_query($con,"select * from tb_pagawai where kd_pegawai='$_GET[id]'");
            $edit=mysqli_fetch_array($ed);
        }
        if(isset($_POST['update'])){
            mysqli_query($con, "update tb_pagawai set nama_pegawai='$_POST[nama_pegawai]', jenis_kelamin='$_POST[jk]', alamat='$_POST[alamat]', no_hp='$_POST[nohp]', jabatan='$_POST[jabatan]' where kd_pegawai=$_GET[id]");
            echo "<script>alert('Data terubah');</script>";
            echo "<script>document.location.href='?pagawai';</script>";
        }
        if(isset($_POST['cari'])){
            $sql = mysqli_query($con,"select * from tb_pagawai where nama_pegawai like '%$_POST[tcari]%'");
        }else{
          ?>
  <div class="container-fluid">
    <h1>Data Pegawai</h1>

        <div class="d-grid gap-2 col-3 mb-3 mt-3">
            <button class="btn btn-primary" type="button">Tambah Data</button>
        </div>
        <table>
            <tr>
                <td>Nama Pegawai</td>
                <td>:</td>
                <td><input type="text" name="nama_pegawai" value="<?php echo @$edit['nama_pegawai']?>"></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><select  name="jk" id="">
            <?php
            $jk=array("Laki-laki","Perempuan");
            foreach($jk as $jk){
                ?>
                <option value="<?php echo @$edit['jenis_kelamin']?>"<?php if(@$edit['jenis_kelamin']==@$jk) echo "selected='selected'"?>><?php echo @$jk ?></option>
            
            <?php } ?>
            </select></td>
            </tr>
            <tr>
                <td>alamat</td>
                <td>:</td>
                <td><textarea name="alamat" cols="30" rows="5"><?php echo @$edit['alamat']?></textarea></td>
            </tr>
            <tr>
                <td>NO HP</td>
                <td>:</td>
                <td><input type="number" name="nohp" id="" value="<?php echo @$edit['no_hp']?>"></td>
                
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td><select  name="jabatan" id="">
            <?php
            $jabatan=array("Manager","Admin", "Kasir", "Koki", "waitres", "Security");
            foreach($jabatan as $jabatan){
                ?>
                <option value="<?php echo @$edit['jabatan']?>"<?php if(@$edit['jabatan']==@$jabatan) echo "selected='selected'"?>><?php echo @$jabatan ?></option>
                <!-- <option value="<?php echo $jabatan ?>"><?php echo $jabatan ?></option> -->
            
            <?php } ?>
            </select></td>
            </tr>
            <tr>
                <td>
                <?php if(isset($_GET['edit'])){ ?>
                    <button type="submit" name="update" value="update" class="btn btn-outline-dark">Update</button>
                    <?php } else{?>
                <button type="submit" name="simpan" value="simpan" class="btn btn-outline-dark">Simpan</button>
                        <?php } ?>
                    <!-- <input type="submit" name="simpan" value="simpan"> -->
                </td>
            </tr>
           
        </table>
        <div>
       <div class="row justify-content-end">
           <div class="col-4">
        <div class="input-group">
            
        <input type="text" class="form-control" name="tcari" placeholder="Search"  aria-describedby="button-addon2">
        <button class="col-3 btn btn-primary" name="cari" type="submit" id="button-addon2">Cari</button>
        </div>    
        </div>    
        </div>
        <!-- <input class="form-control me-2" name="tcari" type="search" placeholder="Search" aria-label="Search">
        <button type="submit" name="cari" class="btn btn-primary">Cari</button> -->
        </div>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Alamat</th>
                <th scope="col">No Hp</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php
                
               
                $sql = mysqli_query($con,"select * from tb_pagawai");
                }
                while($data=mysqli_fetch_array($sql)){

                
                ?>
                <tr>
                <td><?php echo $data['kd_pegawai']?></td>
                <td><?php echo $data['nama_pegawai']?></td>
                <td><?php echo $data['jenis_kelamin']?></td>
                <td><?php echo $data['alamat']?></td>
                <td><?php echo $data['no_hp']?></td>
                <td><?php echo $data['jabatan']?></td>
                <td>
                    <a href="?pagawai&hapus&id=<?php echo $data['kd_pegawai']?>" class="btn btn-danger">Hapus</a>
                    <a href="?pagawai&edit&id=<?php echo $data['kd_pegawai']?>" class="btn btn-info">Edit</a>
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