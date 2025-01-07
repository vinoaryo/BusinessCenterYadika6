  <?php
    // Query cek username
    $query = "SELECT * FROM categories";
    $result = $conn->query($query);

    ?>
  <h3 class="my-2">Tambah Data Barang</h3>

  <form action="action/create_barang.php" method="POST">

      <input type="text" class="myinput"
          name="nama_product" required placeholder="nama barang">
      <br>
      <br>
      <input type="text" class="myinput"
          name="kode" required placeholder="kode barang">
      <br>
      <br>
      <select name="category_id" id="category_id" class="myinput" required>
          <option value="">Pilih Kategori</option>
          <?php

            if ($result->num_rows > 0) {
                $no = 1;
                while ($c = $result->fetch_assoc()) {
            ?>
                  <option value="<?= $c['id']; ?>"><?= $c['nama_kategori']; ?></option>
          <?php
                }
            }
            ?>

      </select>
      <br>
      <br>
      <input type="number" class="myinput"
          name="stok" required placeholder="stok">
      <br>
      <br>
      <input type="number" class="myinput"
          name="harga" required placeholder="harga">
      <br>
      <br>

      <button type="submit" class="btn-primary">Simpan</button>
      <a href="?page=barang" class="btn-danger">Kembali</a>
      <br>
  </form>