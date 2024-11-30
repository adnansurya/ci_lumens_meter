<?php
$conn = mysqli_connect('localhost','root','','arduino');
$data_tds = mysqli_query($conn, "SELECT NilaiTDS FROM log order by id desc");
$data_pH = mysqli_query($conn, "SELECT NilaipH FROM log order by id desc");
$waktu= mysqli_query($conn, "SELECT waktu FROM log order by id desc"); 
 ?>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("Pie");
var myPieChart = new Chart(ctx, {
type: 'doughnut',
data: {
labels: [<?php while($p = mysqli_fetch_array($data_tds)) echo '"' . $p['NilaiTDS'] . '",'?>],
datasets: [{
data: [<?php while($p = mysqli_fetch_array($data_pH)) echo '"' . $p['NilaipH'] . '",'?>],
backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
hoverBorderColor: "rgba(234, 236, 244, 1)",
}],
},
options: {
maintainAspectRatio: false,
tooltips: {
backgroundColor: "rgb(255,255,255)",
bodyFontColor: "#858796",
borderColor: '#dddfeb',
borderWidth: 1,
xPadding: 15,
yPadding: 15,
displayColors: false,
caretPadding: 10,
},
legend: {
display: false
},
cutoutPercentage: 80,
},
});