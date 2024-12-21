<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Kasir iPhone</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Memberikan jarak yang sama antar card */
        .card {
            margin-bottom: 20px; /* Atur jarak antar card */
        }
    </style>
</head>
<body>
        <!-- Grafik Penjualan Bulanan -->
        <div class="card mb-4">
            <div class="card-header">Grafik Penjualan Bulanan</div>
            <div class="card-body">
                <canvas id="monthlySalesChart" height="100"></canvas>
            </div>
        </div>

        <!-- Grafik Penjualan Mingguan -->
        <div class="card mb-4">
            <div class="card-header">Grafik Penjualan Mingguan</div>
            <div class="card-body">
                <canvas id="weeklySalesChart" height="100"></canvas>
            </div>
        </div>

        <!-- Daftar Produk Stok Rendah -->
        <div class="card mb-4">
            <div class="card-header">Iphone Dengan Stok Rendah</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Koneksi ke database
                        $conn = new mysqli('localhost', 'root', '', 'kasirdb');

                        // Cek koneksi
                        if ($conn->connect_error) {
                            die("Koneksi gagal: " . $conn->connect_error);
                        }

                        // Query untuk mengambil data produk dengan stok rendah
                        $sql = "SELECT kode_barang, nama, harga, jumlah FROM barang WHERE jumlah < 5";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['kode_barang']}</td>
                                    <td>{$row['nama']}</td>
                                    <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                                    <td>{$row['jumlah']}</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>Tidak ada data</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    <script>
        // Grafik Penjualan Mingguan
        const weeklyCtx = document.getElementById('weeklySalesChart').getContext('2d');
        const weeklySalesChart = new Chart(weeklyCtx, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Penjualan (Rp)',
                    data: [10000000, 12000000, 15000000, 20000000, 25000000, 30000000, 50000000],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });

        // Grafik Penjualan Bulanan
        const monthlyCtx = document.getElementById('monthlySalesChart').getContext('2d');
        const monthlySalesChart = new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Penjualan Bulanan (Rp)',
                    data: [50000000, 60000000, 75000000, 80000000, 90000000, 85000000, 95000000, 100000000, 110000000, 120000000, 130000000, 140000000],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    </script>
</body>
</html>
