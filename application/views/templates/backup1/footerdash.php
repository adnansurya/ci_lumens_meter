<script>
    const slider = document.getElementById('mySlider');
    const output = document.getElementById('sliderValue');

    if (typeof(Storage) !== "undefined") {
        const savedValue = localStorage.getItem('sliderValue');
        if (savedValue !== null) {
            slider.value = savedValue;
            output.textContent = savedValue + '%'; 
            console.log('Saved value from localStorage: ' + savedValue); 
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
</body>
</html>