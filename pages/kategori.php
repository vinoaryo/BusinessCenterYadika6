 <?php
    // Query cek username
    $query = "SELECT * FROM categories";
    $result = $conn->query($query);

    ?>
 <h3>Data Kategori</h3>
 <span>
     <a href="?page=tambah_kategori" class="btn btn-primary my-2 float-right">Tambah</a>
     <div class="clearfix"></div>
 </span>
 <table class="clean-table">
     <thead>
         <tr>
             <th>No</th>
             <th>Nama Kategori</th>
             <th>Opsi</th>
         </tr>
     </thead>
     <tbody>
         <?php

            if ($result->num_rows > 0) {
                $no = 1;
                while ($c = $result->fetch_assoc()) {
            ?>
                 <tr>
                     <td><?= $no++; ?></td>
                     <td><?= $c['nama_kategori']; ?></td>
                     <td>
                         <a href="?page=edit_kategori&id=<?= $c['id']; ?>" class="btn-success">Edit</a>
                         <a onclick="return confirm('Yakin hapus data ini?')" href="action/delete_kategori.php?id=<?= $c['id']; ?>" class="btn-danger">Hapus</a>
                     </td>
                 </tr>
         <?php
                }
            }
            ?>
     </tbody>
 </table>