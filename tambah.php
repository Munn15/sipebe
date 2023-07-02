<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data</title>

  	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";
    
    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
	
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $kode=input($_POST["kode_pelanggan"]);
        $jml_beli=input($_POST["jml_beli"]);
        $waktu=input($_POST["waktu"]);
        $lokasi=input($_POST["lokasi"]);
        $jp=input($_POST["jp"]);
        $target=input($_POST["target"]);

        //Query input menginput data kedalam tabel data_training
        $sql="insert into data_training (kode_pelanggan, jml_beli, waktu, lokasi, jp, target) values
		('$kode', '$jml_beli', '$waktu', '$lokasi', '$jp', '$target')";

        //Mengeksekusi/menjalankan query diatas
        $hsl=mysqli_query($koneksi, $sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hsl) {
            header("Location:inputAdmin.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>Tambah Data</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Kode Pelanggan:</label>
            <input type="text" name="kode_pelanggan" class="form-control" placeholder="Masukan Kode" required />
        </div>
        <br>

        <div class="form-group">
            <label>Jumlah Pembelian:</label>
            <select name="jml_beli" class="form-control">
				<option value="">- Pilih Salah Satu -</option>
					<?php
					// Koneksi ke database
					require 'koneksi.php';

					// Mendapatkan data untuk dropdown dari database
					$sql = "SELECT DISTINCT jml_beli FROM data_training";
					$result = $koneksi->query($sql);

					// Membuat opsi dropdown
					if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						echo "<option value='" . $row['jml_beli'] . "'>" . $row['jml_beli'] . "</option>";
						    }
						        }

					// Menutup koneksi ke database
					$koneksi->close();
					?>
			</select>
        </div><br>        

        <div class="form-group">
            <label>Interval Waktu:</label>
            <select name="waktu" class="form-control">
				<option value="">- Pilih Salah Satu -</option>
					<?php
					// Koneksi ke database
					require 'koneksi.php';

					// Mendapatkan data untuk dropdown dari database
					$sql = "SELECT DISTINCT waktu FROM data_training";
					$result = $koneksi->query($sql);

					// Membuat opsi dropdown
					if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						echo "<option value='" . $row['waktu'] . "'>" . $row['waktu'] . "</option>";
						    }
						        }

					// Menutup koneksi ke database
					$koneksi->close();
					?>
			</select>
        </div><br>        

        <div class="form-group">
            <label>Lokasi:</label>
            <select name="lokasi" class="form-control">
				<option value="">- Pilih Salah Satu -</option>
					<?php
					// Koneksi ke database
					require 'koneksi.php';

					// Mendapatkan data untuk dropdown dari database
					$sql = "SELECT DISTINCT lokasi FROM data_training";
					$result = $koneksi->query($sql);

					// Membuat opsi dropdown
					if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						echo "<option value='" . $row['lokasi'] . "'>" . $row['lokasi'] . "</option>";
						    }
						        }

					// Menutup koneksi ke database
					$koneksi->close();
					?>
			</select>
        </div><br>        

        <div class="form-group">
            <label>Jumlah Pembelian:</label>
            <select name="jp" class="form-control">
				<option value="">- Pilih Salah Satu -</option>
					<?php
					// Koneksi ke database
					require 'koneksi.php';

					// Mendapatkan data untuk dropdown dari database
					$sql = "SELECT DISTINCT jp FROM data_training";
					$result = $koneksi->query($sql);

					// Membuat opsi dropdown
					if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						echo "<option value='" . $row['jp'] . "'>" . $row['jp'] . "</option>";
						    }
						        }

					// Menutup koneksi ke database
					$koneksi->close();
					?>
			</select>
        </div><br>        

        <div class="form-group">
            <label>Target:</label>
            <select name="target" class="form-control">
				<option value="">- Pilih Salah Satu -</option>
					<?php
					// Koneksi ke database
					require 'koneksi.php';

					// Mendapatkan data untuk dropdown dari database
					$sql = "SELECT DISTINCT target FROM data_training";
					$result = $koneksi->query($sql);

					// Membuat opsi dropdown
					if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						echo "<option value='" . $row['target'] . "'>" . $row['target'] . "</option>";
						    }
						        }

					// Menutup koneksi ke database
					$koneksi->close();
					?>
			</select>
        </div><br>        

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>