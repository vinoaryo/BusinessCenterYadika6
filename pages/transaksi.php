 <?php
    // Query
    $query = "SELECT 
    transactions.*,users.username
    FROM
    transactions
    LEFT JOIN users ON users.id=transactions.user_id
    ";
    $result = $conn->query($query);

    ?>
 <h3>Data Transaksi</h3>
 <span>
     <a href="?page=tambah_transaksi" class="btn btn-primary my-2 float-right">Tambah</a>
     <div class="clearfix"></div>
 </span>
 <table class="clean-table">
     <thead>
         <tr>
             <th>No</th>
             <th>ID</th>
             <th>Tanggal</th>
             <th>Total</th>
             <th>Kasir</th>
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
                     <td><?= $p['id']; ?></td>
                     <td><?= $p['tanggal']; ?></td>
                     <td><?= number_format($p['total']); ?></td>
                     <td><?= $p['username']; ?></td>
                     <td>
                         <a onclick="return confirm('Yakin hapus data ini?')" href="action/delete_transaksi.php?id=<?= $p['id']; ?>" class="btn-danger">Hapus</a>
                         <a href="pages/struk.php?id=<?= $p['id']; ?>" target="_blank" class="btn-success">Cetak Struk</a>
                     </td>
                 </tr>
         <?php
                }
            }
            ?>
     </tbody>
 </table>