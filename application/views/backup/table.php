<div id='content'>
    <div class='container'>
        <h1>Tabel Data</h1>
        <table class="table table-dark table-stripped">
            <thead>
                <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Lux Lx</th>
                    <th scope="col">Watt</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Koneksi database
                $host = "localhost";
                $username = "cond7572_root";
                $password = "UDTyT)],K*Cg";
                $database = "cond7572_login";
                
                $conn = mysqli_connect($host, $username, $password, $database);
                
                if (!$conn) {
                    die("Koneksi Tidak Berhasil" . mysqli_connect_error());
                }
                
                // Pagination 
                $limit = 15; // data per halaman
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $offset = ($page - 1) * $limit;

                // Query records
                $total_records_query = "SELECT COUNT(*) FROM data";
                $total_records_result = mysqli_query($conn, $total_records_query);
                $total_records_row = mysqli_fetch_array($total_records_result);
                $total_records = $total_records_row[0];
                $total_pages = ceil($total_records / $limit);

                // Query pagination
                $query = "SELECT * FROM data ORDER BY id DESC LIMIT $offset, $limit";
                $read = mysqli_query($conn, $query);

                // Cek apakah ada data
                if ($total_records > 0) {
                    while ($row = mysqli_fetch_array($read)) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $row['id']; ?></th>
                            <td><?php echo $row['tanggal']; ?></td>
                            <td><?php echo $row['waktu']; ?></td>
                            <td><?php echo $row['pressure_102']; ?></td>
                            <td><?php echo $row['pressure_103']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data tersedia.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <?php if ($total_records > $limit): //pagination hanya jika jumlah data lebih dari limit ?>
            <!-- script pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">

                    <!-- Tombol Previous -->
                    <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                    </li>
                    <?php endif; ?>

                    <!-- Tombol halaman pertama -->
                    <?php if ($page > 3): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=1">1</a>
                    </li>
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                    <?php endif; ?>

                    <!-- Menampilkan maksimal 5 nomor halaman -->
                    <?php
                    for ($i = max(1, $page - 2); $i <= min($total_pages, $page + 2); $i++) {
                        echo '<li class="page-item ';
                        if ($i == $page) echo 'active';
                        echo '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
                    }
                    ?>

                    <!-- Tombol halaman terakhir -->
                    <?php if ($page < $total_pages - 2): ?>
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a>
                    </li>
                    <?php endif; ?>

                    <!-- Tombol Next -->
                    <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                    </li>
                    <?php endif; ?>

                </ul>
            </nav>
        <?php endif; // Akhir dari pengecekan untuk pagination ?>

    </div>
</div>
