<div id='content'>
    <div class='container'>
        <h1>Tabel Data</h1>
        <table class="table table-dark table-stripped">
            <thead>
                <tr>
                    <th scope="col">
                        <center>Nomor</center>
                    </th>
                    <th scope="col">
                        <center>Tanggal</center>
                    </th>
                    <th scope="col">
                        <center>Waktu</center>
                    </th>
                    <th scope="col">
                        <center>Lumen</center>
                    </th>
                    <th scope="col">
                        <center>Watt</center>
                    </th>
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
                // Pagination untuk tabel pertama
                $limit1 = 10; // data per halaman untuk tabel pertama
                if (isset($_GET['page1'])) {
                    $page1 = $_GET['page1'];
                } else {
                    $page1 = 1;
                }
                $offset1 = ($page1 - 1) * $limit1;

                // Query untuk tabel pertama
                $total_records_query1 = "SELECT COUNT(*) FROM data";
                $total_records_result1 = mysqli_query($conn, $total_records_query1);
                $total_records_row1 = mysqli_fetch_array($total_records_result1);
                $total_records1 = $total_records_row1[0];
                $total_pages1 = ceil($total_records1 / $limit1);

                // Query pagination untuk tabel pertama
                $query1 = "SELECT * FROM data ORDER BY id DESC LIMIT $offset1, $limit1";
                $read1 = mysqli_query($conn, $query1);

                // Cek apakah ada data
                if ($total_records1 > 0) {
                    while ($row = mysqli_fetch_array($read1)) {
                ?>
                        <tr>
                            <th scope="row">
                                <center><?php echo $row['id']; ?></center>
                            </th>
                            <td>
                                <center><?php echo $row['tanggal']; ?></center>
                            </td>
                            <td>
                                <center><?php echo $row['waktu']; ?></center>
                            </td>
                            <td>
                                <center><?php echo $row['pressure_102']; ?></center>
                            </td>
                            <td>
                                <center><?php echo $row['pressure_103']; ?></center>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data tersedia.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <?php if ($total_records1 > $limit1): //pagination hanya jika jumlah data lebih dari limit 
        ?>
            <!-- script pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php if ($page1 > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page1=<?php echo $page1 - 1; ?>">Previous</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($page1 > 3): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page1=1">1</a>
                        </li>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    <?php endif; ?>
                    <?php
                    for ($i = max(1, $page1 - 2); $i <= min($total_pages1, $page1 + 2); $i++) {
                        echo '<li class="page-item ';
                        if ($i == $page1) echo 'active';
                        echo '"><a class="page-link" href="?page1=' . $i . '">' . $i . '</a></li>';
                    }
                    ?>
                    <?php if ($page1 < $total_pages1 - 2): ?>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                        <li class="page-item">
                            <a class="page-link" href="?page1=<?php echo $total_pages1; ?>"><?php echo $total_pages1; ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($page1 < $total_pages1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page1=<?php echo $page1 + 1; ?>">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; // Akhir dari pengecekan untuk pagination 
        ?>


        <h1>Tabel Persentase Kecerahan</h1>
        <table class="table table-dark table-stripped">
            <thead>
                <tr>
                    <th scope="col">
                        <center>Nomor</center>
                    </th>
                    <th scope="col">
                        <center>Waktu</center>
                    </th>
                    <th scope="col">
                        <center>Persentase</center>
                    </th>
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
                $limit2 = 10; // data per halaman untuk tabel kedua
                if (isset($_GET['page2'])) {
                    $page2 = $_GET['page2'];
                } else {
                    $page2 = 1;
                }
                $offset2 = ($page2 - 1) * $limit2;

                // Query untuk tabel kedua
                $total_records_query2 = "SELECT COUNT(*) FROM dataHistory";
                $total_records_result2 = mysqli_query($conn, $total_records_query2);
                $total_records_row2 = mysqli_fetch_array($total_records_result2);
                $total_records2 = $total_records_row2[0];
                $total_pages2 = ceil($total_records2 / $limit2);

                // Query pagination untuk tabel kedua
                $query2 = "SELECT * FROM dataHistory ORDER BY id DESC LIMIT $offset2, $limit2";
                $read2 = mysqli_query($conn, $query2);

                // Cek apakah ada data
                if ($total_records2 > 0) {
                    while ($row = mysqli_fetch_array($read2)) {
                ?>
                        <tr>
                            <th scope="row">
                                <center><?= $row['id'] ?></center>
                            </th>
                            <td>
                                <center><?php echo $row['waktu']; ?></center>
                            </td>
                            <td>
                                <center><?php echo $row['slider_value']; ?>%</center>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data tersedia.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <?php if ($total_records2 > $limit2): //pagination hanya jika jumlah data lebih dari limit 
        ?>
            <!-- script pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php if ($page2 > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page2=<?php echo $page2 - 1; ?>">Previous</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($page2 > 3): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page2=1">1</a>
                        </li>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    <?php endif; ?>
                    <?php
                    for ($i = max(1, $page2 - 2); $i <= min($total_pages2, $page2 + 2); $i++) {
                        echo '<li class="page-item ';
                        if ($i == $page2) echo 'active';
                        echo '"><a class="page-link" href="?page2=' . $i . '">' . $i . '</a></li>';
                    }
                    ?>
                    <?php if ($page2 < $total_pages2 - 2): ?>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                        <li class="page-item">
                            <a class="page-link" href="?page2=<?php echo $total_pages2; ?>"><?php echo $total_pages2; ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ($page2 < $total_pages2): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page2=<?php echo $page2 + 1; ?>">Next</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; // Akhir dari pengecekan untuk pagination 
        ?>

    </div>
</div>