 <?php
    extract($_GET);
    $query = "SELECT * FROM categories WHERE id='$id'";
    $edit = $conn->query($query)->fetch_assoc();
    ?>
 <h3 class="my-2">Edit Data Kategori</h3>

 <form action="action/update_kategori.php" method="POST">
     <input type="hidden" name="id" value="<?= $id; ?>">
     <input type="text" class="myinput"
         name="nama_kategori" required value="<?= $edit['nama_kategori']; ?>">
     <br>
     <br>

     <button type="submit" class="btn-primary">Simpan</button>
     <a href="?page=kategori" class="btn-danger">Kembali</a>
     <br>
 </form>