<script>
    var url = "<?= base_url('assets/data_graph2.php'); ?>"; // PHP mengisi URL
    function loadXMLDoc() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("divChart").innerHTML = '<canvas id="cnvChart"></canvas>';
                let obj = JSON.parse(xhttp.response);
                let chart_settings = {
                    type: 'line',
                    data: {
                        labels: obj.waktu.split(','),
                        datasets: [{
                            label: "Persentase Cahaya",
                            hoverBackgroundColor: 'rgba(0, 0, 0, 0.1)',
                            hoverBorderWidth: 3,
                            fill: false,
                            borderColor: '#2d3237',
                            data: obj.pressure_102.split(',')
                        }]
                    },
                    options: {
                        legend: {
                            display: true
                        },
                        scales: {
                            y: {
                                min: 0, // Batas minimum pada sumbu Y
                                max: 100, // Batas maksimum pada sumbu Y
                                title: {
                                    display: true,
                                    text: '(%)' // Menambahkan persen di judul sumbu Y
                                },
                                ticks: {
                                    stepSize: 10, // Menampilkan skala 10, 20, 30, dst.
                                    beginAtZero: true, // Memastikan angka 0 muncul
                                    callback: function(value) {
                                        return value + '%'; // Menambahkan tanda persen
                                    }
                                }
                            }
                        },
                        animation: {
                            duration: 0
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let value = context.raw; // Ambil nilai asli
                                        return context.dataset.label + ': ' + value + '%'; // Menambahkan persen di label tooltip
                                    }
                                }
                            }
                        }
                    }
                };
                let chart = new Chart(document.getElementById('cnvChart'), chart_settings);
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();
    }

    setInterval(function() {
        loadXMLDoc();
        // 1sec
    }, 1000);

    window.onload = loadXMLDoc;
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>