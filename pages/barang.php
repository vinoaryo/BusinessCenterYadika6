 <?php
    // Query
    $query = "SELECT 
    products.id,
    products.kode,
    products.nama_produk,
    products.category_id,
    products.stok,
    products.harga,
    categories.nama_kategori
     FROM products 
    JOIN categories ON categories.id=products.category_id
    ";
    $result = $conn->query($query);

    ?>
 <h3>Data Barang</h3>
 <span>
     <a href="?page=tambah_barang" class="btn btn-primary my-2 float-right">Tambah</a>
     <div class="clearfix"></div>
 </span>
 <table class="clean-table">
     <thead>
         <tr>
             <th>No</th>
             <th>Kode Produk</th>
             <th>Nama Produk</th>
             <th>Kategori</th>
             <th>Harga</th>
             <th>Stok</th>
             <th>Opsi</th>
         </tr>
     </thead>
     <tbody>
         <?php

            if ($result->num_rows > 0) {
                $no = 1;
                while ($p = $result->fetch_assoc()) {
            ?>
                 <tr>
                     <td><?= $no++; ?></td>
                     <td><?= $p['kode']; ?></td>
                     <td><?= $p['nama_produk']; ?></td>
                     <td><?= $p['nama_kategori']; ?></td>
                     <td><?= number_format($p['harga']); ?></td>
                     <td><?= number_format($p['stok']); ?></td>
                     <td>
                         <a href="?page=edit_barang&id=<?= $p['id']; ?>" class="btn-success">Edit</a>
                         <a onclick="return confirm('Yakin hapus data ini?')" href="action/delete_barang.php?id=<?= $p['id']; ?>" class="btn-danger">Hapus</a>
                     </td>
                 </tr>
         <?php
                }
            }
            ?>
     </tbody>
 </table>