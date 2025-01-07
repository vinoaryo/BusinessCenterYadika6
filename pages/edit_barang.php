 <?php
    extract($_GET);
    $query = "SELECT * FROM products WHERE id='$id'";
    $edit = $conn->query($query)->fetch_assoc();
    ?>
 <?php
    // Query cek username
    $query = "SELECT * FROM categories";
    $result = $conn->query($query);

    ?>
 <h3 class="my-2">Edit Data Barang</h3>

 <form action="action/update_barang.php" method="POST">
     <input type="hidden" name="id" value="<?= $id; ?>">
     <input type="text" class="myinput"
         name="nama_product" required placeholder="nama barang" value="<?= $edit['nama_produk']; ?>">
     <br>
     <br>
     <input type="text" class="myinput"
         name="kode" required placeholder="kode barang" value="<?= $edit['kode']; ?>">
     <br>
     <br>
     <select name="category_id" id="category_id" class="myinput" required>
         <option value="">Pilih Kategori</option>
         <?php

            if ($result->num_rows > 0) {
                $no = 1;
                while ($c = $result->fetch_assoc()) {
            ?>
                 <option value="<?= $c['id']; ?>"
                     <?= ($edit['category_id'] == $c['id'] ? 'selected' : ''); ?>><?= $c['nama_kategori']; ?></option>
         <?php
                }
            }
            ?>

     </select>
     <br>
     <br>
     <input type="number" class="myinput"
         name="stok" required placeholder="stok" value="<?= $edit['stok']; ?>">
     <br>
     <br>
     <input type="number" class="myinput"
         name="harga" required placeholder="harga" value="<?= $edit['harga']; ?>">
     <br>
     <br>

     <button type="submit" class="btn-primary">Simpan</button>
     <a href="?page=barang" class="btn-danger">Kembali</a>
     <br>
 </form>