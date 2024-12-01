<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<div class='wrapper'>

<nav id="sidebar">

            <div class="sidebar-header">

              <img src="<?= base_url('Logo/Logo.png');?>" alt="" width="150" height="63">

            </div>





        <ul class="list-unstyled components">

            <li>

                <a href="<?= base_url('admin'); ?>"> <img src="<?= base_url('Logo/monitor.png'); ?>" alt="img" style="max-width: 20px; max-height: 20px"></img> Monitor</a>

            </li>

            <li>

                <a href="<?= base_url('admin/grapik1'); ?>"><img src="<?= base_url('Logo/graph.png'); ?>" alt="img" style="max-width: 20px; max-height: 20px"> Grafik Cahaya</a>

            </li>

            <li>

                <a href="<?= base_url('admin/grapik2'); ?>"><img src="<?= base_url('Logo/graph.png'); ?>" alt="img" style="max-width: 20px; max-height: 20px"> Grafik Daya</a>

            </li>

            <li>

                <a href="<?= base_url('admin/persentase'); ?>"><img src="<?= base_url('Logo/graph.png'); ?>" alt="img" style="max-width: 20px; max-height: 20px"> Grafik Dimmer</a>

            </li>

            <li>

                <a href="<?= base_url('admin/tabel'); ?>"><img src="<?= base_url('Logo/table.png'); ?>" alt="img" style="max-width: 20px; max-height: 20px"> Tabel History</a>

            </li>

            <li>

                <a href="<?= base_url('auth/logout'); ?>"><img src="<?= base_url('Logo/logouticon.png'); ?>" alt="img" style="max-width: 20px; max-height: 20px"> Log Out</a>

            </li>

        </ul>

        

</nav>



<button id="toggle-button">Menu Dashboard</button>





<script>

    document.addEventListener('DOMContentLoaded', function() {

        const sidebar = document.getElementById('sidebar');

        const toggleButton = document.getElementById('toggle-button');



        toggleButton.addEventListener('click', function() {

            sidebar.classList.toggle('active');

        });

    });

</script>



