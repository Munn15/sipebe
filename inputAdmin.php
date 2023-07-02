<?php  
require 'naive_bayes.php';
$hasil = '';
$c = array("jml_beli", "waktu", "lokasi", "jp");

$dataTraining = "SELECT * FROM data_training";
$result = mysqli_query($koneksi, $dataTraining);

$priorProbability = priorProbability();
$jumlahDataKelas = jumlahDataKelas();

if (isset($_POST['submit'])) {
	$data = [
		"jml_beli" => $_POST['jml_beli'],
		"waktu" => $_POST['waktu'],
		"lokasi" => $_POST['lokasi'],
		"jp" => $_POST['jp'],
	];
	$hasil = posteriorProbability($data);

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

      <h1 class="logo me-auto"><a href="inputAdmin.php">SIPEBE</a></h1>
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
  		<div class="row justify-content-center">
  		<div class="col-lg-6"> 
  			<!-- ======= Header ======= -->
    		<!-- <div class="footer-top"> -->
      			<div class="container">
        			<div class="row">
        			</div>
      			</div>
   			</div>

    		<!-- ======= Contact Section ======= -->
    		<section id="contact" class="contact">
    			<div class="container" data-aos="fade-up">

    			<div class="row justify-content-center">
            <div class="col-xl-12 col-lg-0 col-md-9">
              <div class="card o-hidden border-10 shadow-lg my-5">
                <div class="card-body p-0">
                	<div class="section-title footer-top" >
			          		<h2>DATA TRAINING </h2>
			        		</div>
			        		<div class="row">
			        			<div class="col-lg-5 d-flex align-items-stretch">
			        			</div>
			          	</div>

							<div class="row justify-content-center">
								<div class="col-lg-11">
								
			          	<table class="table table-light text-center" border="2">
			          		<thead class="bg-secondary text-white">
                      <tr>
                          <th>Kode Pelanggan</th>
                          <th>Jumlah Beli</th>
                          <th>Interal Waktu</th>
                          <th>Lokasi</th>
                          <th>Jenis Kelamin</th>
                        	<th>Target</th>
                        	<th>Aksi</th>
                      </tr>  
			          		</thead>

			          		<tbody>
			          			<?php while ($dataTraining = mysqli_fetch_assoc($result)) { ?>
			          				<tr>
					                <td><?php echo $dataTraining['kode_pelanggan']; ?></td>
					                <td><?php echo $dataTraining['jml_beli']; ?></td>
					                <td><?php echo $dataTraining['waktu']; ?></td>
					                <td><?php echo $dataTraining['lokasi']; ?></td>
					                <td><?php echo $dataTraining['jp']; ?></td>
					                <td><?php echo $dataTraining['target']; ?></td>
					                <td>
					                	<center>
								        	<a href="edit.php" class="btn btn-sm btn-primary">Edit</a>
								        	<a href="delete.php?kode_pelanggan=<?php echo $dataTraining['kode_pelanggan']; ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger">Delete</a>
								    	</center>
					                </td>
					            	</tr>	
        							<?php } ?>
        						</tbody>
			          	</table>
						  <a href="tambah.php" class="btn btn-primary" role="button">Tambah Data</a>
						<br>
						
			          </div>
			        </div>

                </div>
              </div>
            </div>
          </div>                  

    <div class="row justify-content-between">
		<div class="col-xl-7 col-lg-0 col-md-9">
			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">

			    <div class="section-title footer-top" >
          			<h2>PROBABILITAS </h2>
        		</div>
        		<div class="row">
        			<div class="col-lg-5 d-flex align-items-stretch">
        			</div>
          		</div>
          		<div class="row justify-content-center">
					<div class="col-lg-11">
          				<h4>PROBABILITAS TARGET</h4>
                  		<table border="2" class="table table-hover">
                  		<thead class="bg-secondary text-white">
                  		<tr>
                  			<th scope="col" rowspan="2" class="align-middle text-center">TARGET</th>
                        	<th scope="col" colspan="2" class="text-center">Jumlah</th>
                        	<th scope="col" colspan="2" class="text-center">Probabilitas</th>
						</tr>
						<tr>
							<th>Berpotensi</th>
							<th>Tidak Berpotensi</th>
							<th>Berpotensi</th>
							<th>Tidak Berpotensi</th>
                      	</tr>
                    	</thead>

                    	<tbody>
                    	<tr>
                    		<td>Probabilitas Target</td> 
                    		<td><?php echo $jumlahDataKelas['Berpotensi'];  ?></td>
							<td><?php echo $jumlahDataKelas['Tidak Berpotensi'];  ?></td>
							<td><?php echo $priorProbability['Berpotensi'];  ?></td>
							<td><?php echo $priorProbability['Tidak Berpotensi'];  ?></td>
                      	</tr>
                    	</tbody>
                  	</table>

					<?php foreach ($c as $c) { ?>
                        <br>
                        <h4>PROBABILITAS <?= strtoupper($c) ?></h4>
                        <table border="2" class="table table-hover">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th scope="col" rowspan="2" class="align-middle text-center"><?= strtoupper($c) ?></th>
                                    <th scope="col" colspan="2" class="text-center">Jumlah</th>
                                    <th scope="col" colspan="2" class="text-center">Probabilitas</th>
                                </tr>
                                <tr>
                                    <th>Berpotensi</th>
                                    <th>Tidak Berpotensi</th>
                                    <th>Berpotensi</th>
                                    <th>Tidak Berpotensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ya = 0;
                                $tidak = 0;
                                foreach (c($c) as $nilai) { ?> 
                                
								<tr>
                                    <td><?= $nilai[$c] ?></td>
                                    <td><?= hitung($c, $nilai[$c], 'Berpotensi') ?></td> 
									<td><?= hitung($c, $nilai[$c], 'Tidak Berpotensi') ?></td> 
									<td><?= hitung($c, $nilai[$c], 'Berpotensi') / target('Berpotensi') ?></td>
                					<td><?= hitung($c, $nilai[$c], 'Tidak Berpotensi') / target('Tidak Berpotensi') ?></td>
                                                
								</tr>
                                
								<?php
                                $ya = $ya + (hitung($c, $nilai[$c], 'Berpotensi') / target('Berpotensi')); 
                                $tidak = $tidak + (hitung($c, $nilai[$c], 'Tidak Berpotensi') / target('Tidak Berpotensi'));   
                                } ?>
                                
								<tr>     
									<td>Jumlah</td>                   
									<td><?= target('Berpotensi') ?></td>                
									<td><?= target('Tidak Berpotensi') ?></td>
									<td><?= $ya ?></td>
									<td><?= $tidak ?></td>
								</tr>
                            </tbody>
                        </table>
                        <?php } ?>
                  
              		</div>
            	</div>

			    </div>
				</div>
			</div> 
			<div class="col-xl-5 col-lg-0 col-md-9">
			  <div class="card o-hidden border-0 shadow-lg my-5">
			    <div class="card-body p-0">


			    	<div class="section-title footer-top" >
          			<h2>INPUT DATA UJI</h2>
        		</div>
        		<div class="row">
        			<div class="col-lg-5 d-flex align-items-stretch">
        			</div>
          	</div>


          		<div class=" mt-5 mt-lg-0 d-flex align-items-stretch">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-10">
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

			<div class="footer-top text-center">
				<div class="section-title footer-top" >
          			<h2>HASIL :</h2>
        		</div>
				<h3><?= $hasil; ?></h3>
			</div>

			<div class="card o-hidden border-0 shadow-lg my-5">
			<div class="card-body p-0">
				<div class="section-title footer-top" >
          			<h2>Daftar Pengguna :</h2>
        		</div>
				<div class="row justify-content-center">
				<div class="col-lg-11">
            		<table border="2" class="table table-hover">
                	<thead class="bg-secondary text-white">
						<tr>
							<th>ID</th>
							<th>Nama</th>
							<th>Email</th>
							<th>Password</th>
							<th>Tipe User</th>
							<th>Alamat</th>
						</tr>
					</thead>

					<tbody>
					<?php
					require 'koneksi.php';
				
					// Query untuk mengambil data pengguna
					$query = "SELECT * FROM user_form";
					$result = mysqli_query($koneksi, $query);
				
					// Loop melalui hasil query dan tampilkan data pengguna
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" . $row['id'] . "</td>";
						echo "<td>" . $row['name'] . "</td>";
						echo "<td>" . $row['email'] . "</td>";
						echo "<td>" . $row['password'] . "</td>";
						echo "<td>" . $row['user_type'] . "</td>";
						echo "<td>" . $row['address'] . "</td>";
						echo "</tr>";
					}
					
					// Tutup koneksi ke database
					mysqli_close($koneksi);
					?>
                    
                	</tbody>
            		</table>
        		</div>
    			</div>
			</div>

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