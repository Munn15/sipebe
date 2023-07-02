<?php  
require 'koneksi.php';

//hitung jumlah total data training 
function totalDataTraining() {
	global $koneksi;
	return (int) mysqli_fetch_row(mysqli_query($koneksi, "SELECT COUNT(*) FROM data_training")) [0];
}

//hitung jumlah data kelas target = Berpotensi dan kelas target = Tidak Berpotensi 
function jumlahDataKelas() {
	global $koneksi;
	$query = "SELECT COUNT(*) FROM data_training WHERE target =";

	$jumlahData['Berpotensi'] = (int) mysqli_fetch_row(mysqli_query($koneksi, $query . "'Berpotensi'")) [0];
	$jumlahData['Tidak Berpotensi'] = (int) mysqli_fetch_row(mysqli_query($koneksi, $query . "'Tidak Berpotensi'")) [0];
	return $jumlahData;
}

//hitung nilai prior probability 
function priorProbability(){
	//probability = jumlah data kelas (Berpotensi/ Tidak Berpotensi) / total data training 
	//=> probability Berpotensi 
	$kelas['Berpotensi'] = jumlahDataKelas()['Berpotensi'] / totalDataTraining();
	//=> probability Tidak Berpotensi
	$kelas['Tidak Berpotensi'] = jumlahDataKelas()['Tidak Berpotensi'] / totalDataTraining();
	return $kelas;
}

function conditionalProbability($nama_kolom, $nilai) {
    global $koneksi;

    // Query untuk menghitung jumlah data dengan nilai kolom yang sama pada setiap kelas
    $query = "SELECT COUNT($nama_kolom) FROM data_training WHERE $nama_kolom = '$nilai' AND target = ";
	
    // Menghitung conditional probability untuk setiap kelas
    $conditionalProbability['Berpotensi'] = (int) mysqli_fetch_row(mysqli_query($koneksi, $query . "'Berpotensi'"))[0] / jumlahDataKelas()['Berpotensi'];
    $conditionalProbability['Tidak Berpotensi'] = (int) mysqli_fetch_row(mysqli_query($koneksi, $query . "'Tidak Berpotensi'"))[0] / jumlahDataKelas()['Tidak Berpotensi'];

    return $conditionalProbability;
	
}

//hitung posterior probability
function posteriorProbability($data) {
	//hitung setiap atribut
	$atribut['jml_beli'] = conditionalProbability('jml_beli', $data['jml_beli']);
	$atribut['waktu'] = conditionalProbability('waktu', $data['waktu']);
	$atribut['lokasi'] = conditionalProbability('lokasi', $data['lokasi']);
	$atribut['jp'] = conditionalProbability('jp', $data['jp']);

	$probabilitas['Berpotensi'] = $atribut['jml_beli']['Berpotensi'] * $atribut['waktu']['Berpotensi'] * $atribut['lokasi']['Berpotensi'] * $atribut['jp']['Berpotensi'] * priorProbability()['Berpotensi'];
	$probabilitas['Tidak Berpotensi'] = $atribut['jml_beli']['Tidak Berpotensi'] * $atribut['waktu']['Tidak Berpotensi'] * $atribut['lokasi']['Tidak Berpotensi'] * $atribut['jp']['Tidak Berpotensi'] * priorProbability()['Tidak Berpotensi'];

	//penentuan terget 
	if ($probabilitas['Berpotensi'] > $probabilitas['Tidak Berpotensi']) {
		return 'Berpotensi';
	} else if ($probabilitas['Berpotensi'] < $probabilitas['Tidak Berpotensi']) {
		return 'Tidak Berpotensi';
	}
}

// hitung probabilitas setiap kriteria
function c($c)
{
	global $koneksi;
	$query = "SELECT DISTINCT $c FROM data_training";
	$result = mysqli_query($koneksi, $query); 
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function hitung($c, $nilai, $target) 
{
	global $koneksi;
	$query = "SELECT COUNT($c) FROM data_training WHERE $c = '$nilai' AND target = '$target'";
	$res = mysqli_query($koneksi, $query);
	$result = mysqli_fetch_row($res);
	return $result[0];
}

function target($target)
{
	global $koneksi;
	$query = "SELECT COUNT(target) FROM data_training WHERE target = '$target'";
	$res = mysqli_query($koneksi, $query);
	$result = mysqli_fetch_row($res);
	return $result[0];
}

// end

?>