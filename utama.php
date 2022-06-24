<form action="" method="post">
    <table border="1" width="100%">
        <tr>
            <td><a href="?beranda">Beranda</a> </td>
            <td><a href="?menu"> Menu</a></td>
            <td><a href="?pemasok"> Pemasok </a></td>
            <td><a href="?pagawai">Pegawaai</a> </td>

        </tr>
        <tr>
            <td colspan="5" height="500px">
                <?php 
                    if(isset($_GET['menu'])){
                        include "menu.php";
                    }elseif(isset($_GET['pemasok'])){
                        include "pemasok.php";

                    }elseif(isset($_GET['pagawai'])){
                        include "pagawai.php";
                    }else{
                        echo "<script>document.location.href='utama.php';</script>";
                    }
                ?>
            </td>
        </tr>
    </table>
</form>