<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>




<script>

    const slider = document.getElementById('mySlider');

    const output = document.getElementById('sliderValue');



    if (typeof(Storage) !== "undefined") {

        const savedValue = localStorage.getItem('sliderValue');

        if (savedValue !== null) {

            slider.value = savedValue;

            output.textContent = savedValue + '%'; 

            console.log('Saved value from localStorage: ' + savedValue); 
            // alert('Saved value from localStorage: ' + savedValue); 

        }

    } else {

        console.error("localStorage is not supported on this browser.");

    }



     slider.addEventListener('input', function() {

            const sliderValue = slider.value;

            output.textContent = sliderValue + '%';

            localStorage.setItem('sliderValue', sliderValue);

            sendSliderValue(sliderValue); // Send the value to the server

            console.log('Slider value: ' + sliderValue); 

        });

        

    // Update the current slider value and save it to localStorage

    // slider.oninput = function() {

    //     const sliderValue = this.value;

    //     output.textContent = sliderValue + '%';

    //     localStorage.setItem('sliderValue', sliderValue);

    //     sendSliderValue(sliderValue); // Send the value to the server

    //     }



    function sendSliderValue(value) {

        var url = "<?= base_url('assets/history.php'); ?>"; 

        const xhr = new XMLHttpRequest();

        xhr.open("POST", url, true);

        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");



        xhr.onreadystatechange = function () {

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

      xhttp.onreadystatechange = function () {

          if (this.readyState == 4 && this.status == 200) {

              var obj = JSON.parse(this.responseText);

              document.getElementById("pressure_102").innerText = obj.pressure_102 + ' Lumen';  

              document.getElementById("pressure_103").innerText = obj.pressure_103 + ' Watt';  

          }

      };

      xhttp.open("GET", url, true);

      xhttp.send();

  }



  setInterval(function () {

      loadXMLDoc();

  }, 1000);



  window.onload = loadXMLDoc;  

</script>



<script>

    // Hapus data pada Tabel 1

    $('#hapusTabel1').click(function() {

        if (confirm('Apakah Anda yakin ingin menghapus semua data di Tabel Data?')) {

            $.ajax({

                url: '<?= base_url('assets/hapus_data.php');?>',  // File PHP untuk menghapus data

                type: 'POST',

                data: { tabel: 'all' }, // Mengirimkan nama tabel yang akan dihapus (Tabel 1)

                success: function(response) {

                    if (response == 'success') {

                        location.reload();

                        alert('Semua data pada Tabel 1 berhasil dihapus.');

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

                url: '<?= base_url('assets/hapus_data.php');?>',  // File PHP untuk menghapus data

                type: 'POST',

                data: { tabel: 'dataHistory' }, // Mengirimkan nama tabel yang akan dihapus (Tabel 2)

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