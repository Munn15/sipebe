<?php  
session_start();

require 'naive_bayes.php';
require 'koneksi.php';
$hasil = '';
$name = '';
$address = '';
$email = '';

if (isset($_POST['submit'])) {
	$data = [
		"jml_beli" => $_POST['jml_beli'],
		"waktu" => $_POST['waktu'],
		"lokasi" => $_POST['lokasi'],
		"jp" => $_POST['jp'],
	];
	$hasil = posteriorProbability($data);

	// Mendapatkan ID pengguna dari sesi
	$id = $_SESSION['id'];
	
	// Query untuk mendapatkan data diri pengguna
	$query = "SELECT name, address, email FROM user_form WHERE id = '$id'";

	// Eksekusi query
	$result = $koneksi->query($query);

	// Memeriksa apakah query berhasil dieksekusi
	if ($result->num_rows > 0) {
	    // Mendapatkan data diri pengguna
	    $user_data = $result->fetch_assoc();
	    $name = $user_data["name"];
	    $address = $user_data["address"];
	    $email = $user_data["email"];
	}

	// Menutup koneksi
	$koneksi->close();
	
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Naive Bayes</title>

	<meta content="" name="description">
  	<meta content="" name="keywords">

  	<!-- Google Fonts -->
  	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  	<!-- Vendor CSS Files -->
  	<link href="assets/vendor/aos/aos.css" rel="stylesheet">
  	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  	<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  	<link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  	<link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  	<link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  	<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  	<!-- Template Main CSS File -->
  	<link href="assets/css/style.css" rel="stylesheet">

</head>
<body>
	<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="input.php">SIPEBE</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
        	<li><a class="nav-link scrollto active" href="index.php">Logout</a></li>
          	
        		<i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <main id="main">
  	<footer id="footer">
  		<div class="container">
  		<div class="row justify-content-between">
  		
    		<!-- ======= Contact Section ======= -->
    		<section id="contact" class="contact">
    			<div class="container" data-aos="fade-up">

    			<div class="row justify-content-center">
            		<div class="col-xl-12 col-lg-0 col-md-9">
                		<div class="card o-hidden border-0 shadow-lg my-5">
                    		<div class="card-body p-0">

        		<div class="section-title footer-top" >
          			<h2>INPUT DATA UJI</h2>
        		</div>
        		<div class="row">
        			<div class="col-lg-5 d-flex align-items-stretch"> 
          		</div>

          		<div class=" mt-5 mt-lg-0 d-flex align-items-stretch">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-6">
							<form method="POST" action="">
								<label>Jumlah Pembelian:</label>
								<select name="jml_beli" class="form-control">
								<option value="">- Pilih Jumlah Pembelian -</option>
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
        						</select><br>
        						<label>Interval Waktu:</label>
        						<select name="waktu" class="form-control">
								<option value="">- Pilih Interval Waktu -</option>
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
					        	</select><br>
					        	<label>Lokasi:</label>
					        	<select name="lokasi" class="form-control">
								<option value="">- Pilih Lokasi -</option>
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
				        		</select><br>
        						<label>Jenis Pembelian:</label>
        						<select name="jp" class="form-control">
								<option value="">- Pilih Jenis Pembelian -</option>
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
						        </select><br>
						        <!-- tombol submit -->
						        <button type="submit" name="submit" value="submit" class="btn btn-primary" onclick="resetForm()">SUBMIT</button>
				    		</form><br>
				    	</div>
				    </div>
					</div>
				</div>
				</div>
			</div>
			</div>

			<div class="footer-top text-center">
				<h3>KETERANGAN:</h3>

				<div class="row justify-content-center">
					<div class="col-lg-7">
                  		<table border="2" class="table table-hover">
                  		<thead class="bg-secondary text-white">
                      	<tr>
							<th>No</th>
							<th>Kriteria</th>
							<th>Sub-Kriteria</th>
							<th>Keterangan</th>
                      	</tr>
                    	</thead>

                    	<tbody>
                    	<tr>
                    		<td>1</td>
                    		<td>Jumlah Pembelian</td>
                    		<td>Sangat Banyak</td>
                    		<td>> 100 pcs</td>
                      	</tr>
                    	<tr>
                    		<td></td>
                    		<td></td>
                    		<td>Banyak</td>
                    		<td>50 - 100 pcs</td>
                      	</tr>
                    	<tr>
                    		<td></td>
                    		<td></td>
                    		<td>Sedikit</td>
                    		<td>20 - 49 pcs</td>
                      	</tr>
                    	<tr>
                    		<td></td>
                    		<td></td>
                    		<td>Sangat Sedikit</td>
                    		<td>< 20 pcs</td>
                      	</tr>
                    	<tr>
                    		<td>2</td>
                    		<td>Jarak</td>
                    		<td>Dekat</td>
                    		<td>< 10 km</td>
                      	</tr>
                    	<tr>
                    		<td></td>
                    		<td></td>
                    		<td>Sedang</td>
                    		<td>10 - 20 km</td>
                      	</tr>
                    	<tr>
                    		<td></td>
                    		<td></td>
                    		<td>Jauh</td>
                    		<td>> 20 km</td>
                      	</tr>
                    	<tr>
                    		<td>3</td>
                    		<td>Interval Waktu</td>
                    		<td>Mingguan</td>
                    		<td></td>
                      	</tr>
                    	<tr>
                    		<td></td>
                    		<td></td>
                    		<td>Tidak Pasti</td>
                    		<td></td>
                      	</tr>
                    	<tr>
                    		<td>4</td>
                    		<td>Jenis Pembelian</td>
                    		<td>Toko</td>
                    		<td></td>
                      	</tr>
                    	<tr>
                    		<td></td>
                    		<td></td>
                    		<td>Pribadi</td>
                    		<td></td>
                      	</tr>
                    	
                    	</tbody>
                  		</table>
					</div>
					</div>

				<h3>HASIL :</h3>

				<div class="row justify-content-center">
					<div class="col-lg-7">
                  		<table border="2" class="table table-hover">
                  		<thead class="bg-secondary text-white">
                      	<tr>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Email</th>
							<th>Hasil</th>
                      	</tr>
                    	</thead>

                    	<tbody>
                    	<tr>
                    		<td><?= $name; ?></td>
                    		<td><?= $address; ?></td>
                    		<td><?= $email; ?></td>
                    		<td><?= $hasil; ?></td>
                      	</tr>
                    	</tbody>
                  		</table>
					</div>
					</div>
			</div>

			</div>
			</div>
			</div>
			</section>

			<div class="container footer-bottom clearfix">
		      <div class="copyright">
		        &copy; Copyright <strong><span>SIPEBE</span></strong>. All Rights Reserved
		      </div>
		      <div class="credits">
		        <!-- All the links in the footer should remain intact. -->
		        <!-- You can delete the links only if you purchased the pro version. -->
		        <!-- Licensing information: https://bootstrapmade.com/license/ -->
		        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
		        Designed by <a href="">SIPEBE</a>
		      </div>
		    </div>
  		</div>
  		</div>
  		</div>
  	</footer><!-- End Footer -->

  	<div id="preloader"></div>
  	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  	<!-- Vendor JS Files -->
  	<script src="assets/vendor/aos/aos.js"></script>
  	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  	<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  	<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  	<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  	<script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  	<script src="assets/vendor/php-email-form/validate.js"></script>

  	<!-- Template Main JS File -->
  	<script src="assets/js/main.js"></script>

</body>
</html>