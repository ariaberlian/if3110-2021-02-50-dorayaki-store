<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat <?php if ($data['is_admin'] == 1) echo "Pengubahan Stok";
                    else echo "Pembelian"; ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>css/riwayat.css">
    <link rel="shortcut icon" type="image/jpg" href="<?= BASEURL; ?>img/favicon.png" />

</head>

<body>
    <button class="back_button" onclick="window.history.back()">
        <h3>Go Back</h3>
    </button>
    <div class="center">
        <h1>Riwayat <?php if ($data['is_admin'] == 1) echo "Perubahan Stok";
                    else echo "Pembelian"; ?></h1>
        <?php
        if (isset($data['histori']) && $data['is_admin'] == 1) { // Admin ingin melihat riwayat perubahan yang dilakukan olehnya
            echo "
        <div class='dropdown' id='dropdown' onclick='toggleDropdown()'>&#11206; Lihat Perubahan per Variant &#11206;";

            foreach ($data['nama_var'] as $varname) {
                echo "
        <a href='" . BASEURL . "riwayat/" . urlencode($varname['nama_var']) . "' class='dropdown-content'>" . $varname['nama_var'] . "</a>
        ";
            }

            echo " 
        </div>
        <a href='" . BASEURL . "riwayat' class='saya'>Lihat Perubahan Oleh Saya</a>
        <table>
            <tr>
                <th>No</th>
                <th>Nama Varian</th>
                <th>Jumlah Perubahan</th>
                <th>Waktu Perubahan</th>
            </tr>";

            $i = 0;
            foreach ($data['histori'] as $histori) {
                $i++;
                echo "
                <tr>
                    <td>" . $i . "</td>
                    <td><a href='" . BASEURL . "detail/" . urlencode($histori['nama_var']) . "'>" . $histori['nama_var'] . "</a></td>
                    <td>" . $histori['perubahan'] . "</td>
                    <td>" . $histori['tanggal_perubahan'] . "</td>
                </tr>
                ";
            }

            echo "
        </table>";
        } else if (isset($data['histori']) && $data['is_admin'] == 0) { // User ingin melihat riwayat pembelian yang dilakukan olehnya
            echo "
        <table>
            <tr>
                <th>No</th>
                <th>Nama Variant</th>
                <th>Jumlah Pembelian</th>
                <th>Total Harga</th>
                <th>Waktu Pembelian</th>
            </tr>";

            $i = 0;
            foreach ($data['histori'] as $histori) {
                $i++;
                echo "
                <tr>
                    <td>" . $i . "</td>
                    <td> <a href='" . BASEURL . "detail/" . urlencode($histori['nama_var']) . "'>" . $histori['nama_var'] . "</a></td>
                    <td>" . $histori['pembelian'] . "</td>
                    <td>" . $histori['total_harga'] . "</td>
                    <td>" . $histori['tanggal_perubahan'] . "</td>
                </tr>
                ";
            }

            echo "
        </table>
        ";
        } else { // Admin ingin melihat per detail variant
            echo "
        <div class='dropdown' id='dropdown' onclick='toggleDropdown()'>&#11206; Lihat Perubahan per Variant &#11206;";

            foreach ($data['nama_var'] as $varname)
                echo "
        <a href='" . BASEURL . "riwayat/" . urlencode($varname['nama_var']) . "' class='dropdown-content'>" . $varname['nama_var'] . "</a>
        ";

            echo " 
        </div>
        <a class = 'saya' href='" . BASEURL . "riwayat'>Lihat Perubahan Oleh Saya</a>";
            echo "
        <table>
            <tr>
                <th>No</th>
                <th>Nama Pengubah</th>
                <th>Jumlah Perubahan</th>
                <th>Waktu Perubahan</th>
            </tr>";

            $i = 0;
            foreach ($data['variant_history'] as $variant_history) {
                $i++;
                echo "
                <tr>
                    <td>" . $i . "</td>
                    <td>" . $variant_history['username'] . "</td>
                    <td>" . $variant_history['perubahan'] . "</td>
                    <td>" . $variant_history['tanggal_perubahan'] . "</td>
                </tr>
                ";
            }

            echo "
        </table>
        ";
        }
        ?>
    </div>
    <script>
        function toggleDropdown() {
            // document.getElementById("dropdown").innerHTML = "⯅ Lihat Perubahan per Variant ⯅";
            let content = document.getElementsByClassName("dropdown-content");
            for (let i = 0; i < content.length; i++) {
                content[i].classList.toggle("show");
            }

        }

        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown')) {
                // document.getElementById("dropdown").innerHTML = "&#11206; Lihat Perubahan per Variant &#11206;";
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }

        }
    </script>
</body>

</html>