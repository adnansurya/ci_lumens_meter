<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>




<script>
    let startPage = true;
    let sliderCurrentValue = 0;
    const slider = document.getElementById('mySlider');


    $.ajax({

        url: '<?= base_url('assets/data_transfer.php'); ?>', // File PHP untuk menghapus data

        type: 'GET',

        success: function(response) {

            console.log(response);

            var objSlider = JSON.parse(response);

            sliderCurrentValue = objSlider.dimmer_percent;

            slider.value = sliderCurrentValue;

            document.getElementById('sliderValue').textContent = objSlider.dimmer_percent + '%';

            startPage = false;

        }

    });


    slider.addEventListener('change', function() {

        const sliderValue = slider.value;

        document.getElementById('sliderValue').textContent = sliderValue + '%';

        console.log('Mouse released at value:', sliderValue);


        sendSliderValue(sliderValue); // Send the value to the server



    });



    function sendSliderValue(value) {

        var url = "<?= base_url('assets/history.php'); ?>";

        const xhr = new XMLHttpRequest();

        xhr.open("POST", url, true);

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");



        xhr.onreadystatechange = function() {

            if (xhr.readyState === 4 && xhr.status === 200) {

                console.log("Response dari server: " + xhr.responseText);

            } else if (xhr.readyState === 4) {

                console.error("Gagal mengirim data. Status: " + xhr.status);

            }

        };

        xhr.send("slider_value=" + value);

    }
</script>



<script>
    function loadXMLDoc() {

        var url = "<?= base_url('assets/data_transfer.php'); ?>";

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {

            if (this.readyState == 4 && this.status == 200) {

                var obj = JSON.parse(this.responseText);

                document.getElementById("light_level").innerText = obj.light_level + ' Lumen';

                document.getElementById("power").innerText = obj.power + ' Watt';

                let dbDimmerValue = obj.dimmer_percent;

                if (dbDimmerValue != sliderCurrentValue) {

                    slider.value = dbDimmerValue;

                    document.getElementById('sliderValue').textContent = dbDimmerValue + '%';

                }




            }

        };

        xhttp.open("GET", url, true);

        xhttp.send();



    }



    setInterval(function() {

        loadXMLDoc();

    }, 1000);



    window.onload = loadXMLDoc;
</script>



<script>
    // Hapus data pada Tabel 1

    $('#hapusTabel1').click(function() {

        if (confirm('Apakah Anda yakin ingin menghapus semua data di Tabel Data?')) {

            $.ajax({

                url: '<?= base_url('assets/hapus_data.php'); ?>', // File PHP untuk menghapus data

                type: 'POST',

                data: {
                    tabel: 'all'
                }, // Mengirimkan nama tabel yang akan dihapus (Tabel 1)

                success: function(response) {

                    if (response == 'success') {

                        location.reload();

                        alert('Semua data pada Tabel berhasil dihapus.');

                    } else {

                        alert('Gagal menghapus data pada Tabel 1.');

                    }

                }

            });

        }

    });



    // Hapus data pada Tabel 2

    $('#hapusTabel2').click(function() {

        if (confirm('Apakah Anda yakin ingin menghapus semua data di Tabel Persentase Kecerahan?')) {

            $.ajax({

                url: '<?= base_url('assets/hapus_data.php'); ?>', // File PHP untuk menghapus data

                type: 'POST',

                data: {
                    tabel: 'dataHistory'
                }, // Mengirimkan nama tabel yang akan dihapus (Tabel 2)

                success: function(response) {

                    if (response == 'success') {

                        location.reload();

                        alert('Semua data pada Tabel 2 berhasil dihapus.');

                    } else {

                        alert('Gagal menghapus data pada Tabel 2.');

                    }

                }

            });

        }

    });
</script>

</body>

</html>