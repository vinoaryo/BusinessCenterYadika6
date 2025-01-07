<?php
include "../koneksi.php";
extract($_GET);
$query = "SELECT * FROM transactions JOIN users on users.id=transactions.user_id WHERE transactions.id='$id'";
$trx = $conn->query($query)->fetch_assoc();

$querydetail = "SELECT * FROM transaction_details WHERE transaction_details.transaction_id='$id'";
$trxdetail = $conn->query($querydetail);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Transaksi</title>
    <style>
        @page {
            margin: 0;
        }

        * {
            font-size: 11px;
            font-family: monospace;
        }

        td,
        th,
        tr,
        table {
            border-collapse: collapse;
        }

        td.description,
        th.description {
            width: 40%;
            max-width: 40%;
        }

        td.quantity,
        th.quantity {
            width: 20%;
            max-width: 20%;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 40%;
            max-width: 40%;
            word-break: break-all;
        }

        .garisatas {
            border-top: 1px solid black;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 58mm;
            max-width: 58mm;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        .logos {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
            margin-bottom: -15px;
        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <p class="centered">
            Nama Toko
            <br>
            alamat toko
        </p>
        <p class="centered textnota">
            Tanggal : <?= $trx['tanggal']; ?>
            <br>
            <b><span style="font-size: 16px;">No #<?= $trx['id']; ?></span></b>
        </p>
        <table style="width: 58mm;">
            <thead>
                <tr>
                    <th class="description" style="text-align: left;">Item</th>
                    <th class="quantity" style="text-align: center;">Qty</th>
                    <th class="price" style="text-align: right;">Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalx = 0;
                while ($t = $trxdetail->fetch_assoc()) {
                ?>
                    <tr class="garisatas">
                        <td class="description"><?= $t['product_name'] ?></td>
                        <td class="quantity" style="text-align: center;"><?= $t['jumlah'] ?></td>
                        <td class="price" style="text-align: right;">Rp. <?= number_format($t['subtotal']) ?></td>

                    </tr>
                <?php
                    $totalx += $t['subtotal'];
                }
                ?>



                <tr class="garisatas">
                    <td class="description"><b>TOTAL</b></td>
                    <td class="quantity"></td>
                    <td class="price" style="text-align: right;"><b>Rp. <?= number_format($totalx) ?></b></td>
                </tr>



            </tbody>
        </table>
        ====================================
        <div class="centered"><?= $trx['created_at']; ?> - <?= $trx['username']; ?></div>
        <p class="centered">Terimakasih telah berbelanja di toko kami.
        </p>
        <br>
        ------------------------------------

        <button id="btnPrint" class="hidden-print">Print</button>
        <script>
            const $btnPrint = document.querySelector("#btnPrint");
            $btnPrint.addEventListener("click", () => {
                window.print();
            });
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById("btnPrint").click();
            });
        </script>
</body>

</html>