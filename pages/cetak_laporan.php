<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/cetak.css">
</head>
<?php
extract($_GET);
include "../koneksi.php";
// Query
$query = "SELECT 
    transactions.*,users.username
    FROM
    transactions
    LEFT JOIN users ON users.id=transactions.user_id
    WHERE tanggal BETWEEN '$date1' AND '$date2'
    ";
$result = $conn->query($query);

?>

<body>
    <page size='A4-landscape'>
        <table class='table table-bordered table-hover'>
            <thead>
                <tr>
                    <th colspan='5'>
                        <div class='d-flex'>
                            <div>
                                <h2>Laporan TRANSAKSI Periode <?= date('d F Y', strtotime($date1)); ?> s/d <?= date('d F Y', strtotime($date2)); ?></h2>
                                <div class='small fw-normal'>Tanggal Cetak Laporan : <?= date('Y-m-d'); ?></div>
                            </div>
                            <div class='small flex-grow-1 fw-normal'>
                                <div class='d-flex flex-column align-items-end'>

                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class='small'>
                <tr>
                    <th style='width: 15px;'>No.</th>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th>Total</th>
                </tr>
                <?php
                $totalx = 0;
                if ($result->num_rows > 0) {
                    $no = 1;

                    while ($p = $result->fetch_assoc()) {
                ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p['id']; ?></td>
                            <td><?= $p['tanggal']; ?></td>
                            <td><?= $p['username']; ?></td>
                            <td><?= number_format($p['total']); ?></td>

                        </tr>
                <?php
                        $totalx += $p['total'];
                    }
                }
                ?>
                <tr>
                    <td colspan='4'><b>TOTAL</b></td>
                    <td class='text-end'><b>Rp. <?= number_format($totalx); ?></b></td>

                </tr>
            </tbody>
        </table>
    </page>
</body>

</html>