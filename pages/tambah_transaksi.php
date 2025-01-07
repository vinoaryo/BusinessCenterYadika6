    <?php
    $query = "SELECT 
    products.id,
    products.nama_produk,
    products.kode,
    products.category_id,
    products.stok,
    products.harga,
    categories.nama_kategori
     FROM products 
    JOIN categories ON categories.id=products.category_id
    ";
    $result = $conn->query($query);
    ?>
    <h3 class="my-2">Tambah Data Transaksi</h3>
    <hr>
    <br>
    <div>
        <label for="barcode-input" class="myinput"><b>Scan Barcode:</b></label>
        <input type="text" class="myinput" style="width: 100%;" id="barcode-input" placeholder="Scan barcode di sini..." autofocus>
    </div>
    <br>
    <h3>Daftar Keranjang Belanja :</h3>
    <table class="clean-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody id="cart-body"></tbody>

    </table>
    <br>
    <br>
    <input type="text" class="myinput"
        name="total" id="total" required placeholder="total" readonly>
    <br>
    <br>

    <button type="submit" class="btn-primary">Simpan</button>
    <a href="?page=transaksi" class="btn-danger">Kembali</a>
    <br>
    <form action="action/create_transaksi.php" method="POST">
        <input type="hidden" name="cart_data" id="cart-data">



        <hr>
        <br>
        <input type="date" class="myinput" name="tanggal" value="<?= date('Y-m-d'); ?>" required>
        <table class="clean-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
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
                            <td><?= $p['nama_produk']; ?></td>
                            <td><?= $p['nama_kategori']; ?></td>
                            <td><?= number_format($p['harga']); ?></td>
                            <td><?= number_format($p['stok']); ?></td>
                            <td>
                                <a href="javascript:void(0)" data-id="<?= $p['id'] ?>" data-kode="<?= $p['kode'] ?>" class="btn-primary addcart">Masukkan Keranjang</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>

        </table>
        <hr>
    </form>

    <script>
        $(document).ready(function() {
            // Event ketika barcode di-scan (Enter digunakan sebagai pemisah antara scan)
            $('#barcode-input').on('keypress', function(e) {
                if (e.which === 13) { // Ketika Enter ditekan
                    const barcode = $(this).val().trim();
                    $(this).val(''); // Kosongkan input

                    // Cari tombol dengan data-kode yang sesuai
                    const button = $(`.addcart[data-kode="${barcode}"]`);

                    if (button.length) {
                        const productId = button.data('id');
                        addToCart(productId); // Panggil fungsi tanpa konfirmasi
                    } else {
                        alert('Barang tidak ditemukan!');
                    }
                }
            });


            let cartIndex = 1;

            function addToCart(productId) {
                const row = $(`.addcart[data-id="${productId}"]`).closest('tr');
                const productName = row.find('td:nth-child(2)').text();
                const category = row.find('td:nth-child(3)').text();
                const price = parseFloat(row.find('td:nth-child(4)').text().replace(/,/g, ''));

                // Cek apakah produk sudah ada di keranjang
                if ($(`#cart-body tr[data-id="${productId}"]`).length) {
                    const cartRow = $(`#cart-body tr[data-id="${productId}"]`);
                    const quantityInput = cartRow.find('.quantity');
                    const currentQuantity = parseInt(quantityInput.val(), 10);
                    const newQuantity = currentQuantity + 1;

                    // Update nilai quantity dan trigger perubahan
                    quantityInput.val(newQuantity).trigger('input'); // Simulasikan input agar subtotal dan total diperbarui
                    return; // Berhenti di sini karena sudah menambahkan quantity
                }

                // Tambahkan produk ke keranjang
                $('#cart-body').append(`
                            <tr data-id="${productId}">
                                <td>${cartIndex++}</td>
                                <td>${productName}</td>
                                <td>${category}</td>
                                <td class="price">${price.toLocaleString()}</td>
                                <td><input type="number" class="quantity" value="1" min="1"></td>
                                <td class="subtotal">${price.toLocaleString()}</td>
                                <td><a href="javascript:void(0)" class="btn-danger remove-item">Hapus</a></td>
                            </tr>
                        `);

                updateTotal();
            }
            // Event ketika tombol 'Masukkan Keranjang' diklik
            $('.addcart').click(function(e) {
                e.preventDefault();
                if (confirm('Yakin masukkan ke keranjang ?')) {
                    const productId = $(this).data('id');
                    addToCart(productId);
                }
            });

            // Event ketika tombol 'Hapus' diklik pada keranjang
            $('#cart-body').on('click', '.remove-item', function() {
                $(this).closest('tr').remove();
                updateTotal();
                cartIndex--;
            });

            // Event ketika jumlah barang diubah
            $('#cart-body').on('input', '.quantity', function() {
                const row = $(this).closest('tr');
                const price = parseFloat(row.find('.price').text().replace(/,/g, ''));
                const quantity = parseInt($(this).val());
                const subtotal = price * quantity;

                row.find('.subtotal').text(subtotal.toLocaleString());
                updateTotal();
            });

            // Fungsi untuk memperbarui total keseluruhan dan data keranjang
            function updateTotal() {
                let total = 0;
                let cartData = [];

                $('#cart-body tr').each(function() {
                    const productId = $(this).data('id');
                    const productName = $(this).find('td:nth-child(2)').text();
                    const category = $(this).find('td:nth-child(3)').text();
                    // const price = parseInt($(this).find('.price').text().replace(/,/g, ''));
                    const price = Math.round(parseFloat($(this).find('.price').text().replace(/,/g, '')));
                    const quantity = parseInt($(this).find('.quantity').val());
                    const subtotal = price * quantity;
                    console.log(price)
                    cartData.push({
                        id: productId,
                        name: productName,
                        category: category,
                        price: price,
                        quantity: quantity,
                        subtotal: subtotal
                    });

                    total += subtotal;
                });

                $('#total').val(total.toLocaleString());

                // Update hidden input dengan data keranjang
                $('#cart-data').val(JSON.stringify(cartData));
            }
        });
    </script>