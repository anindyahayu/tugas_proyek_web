<!DOCTYPE html>
<html>
<head>
<title>FORM HTML</title>
<!-- Sertakan Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="container mt-5">
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; 
?>">
<h2>FORMULIR PENDAFTARAN</h2>
<div class="form-group">
<label for="var1">Nama</label>
<input type="text" class="form-control" name="nama"
placeholder="Masukkan nama Anda">
</div>
<div class="form-check">
<input type="checkbox" class="form-check-input"
name="siswa" id="var2">
<label class="form-check-label" for="var2">Apakah 
anda seorang siswa?</label>
</div>
<div class="form-group">
<label for="var3">Berapa Usia anda?</label>
<div class="form-check">
<input type="radio" class="form-check-input"
name="usia" id="r1" value="10 - 15">
<label class="form-check-label" for="r1">10 -
15</label>
</div>
<div class="form-check">
<input type="radio" class="form-check-input"
name="usia" id="r2" value="16 - 20">
<label class="form-check-label" for="r2">16 -
20</label>
</div>
<div class="form-check">
<input type="radio" class="form-check-input"
name="usia" id="r3" value="21 - 25">
<label class="form-check-label" for="r3">21 -
25</label>
</div>
</div>
<div class="form-group">
<label for="var6">Negara Asal</label>
<select class="form-control" name="negara">
<option value="INA" selected>Indonesia</option>
<option value="UK">United Kingdom</option>
<option value="USA">USA</option>
<option value="MAS">Malaysia</option>
</select>
</div>
<div class="form-group">
<label for="var7">Tinggalkan Komentar:</label>
<textarea class="form-control" name="komentar"
rows="6"></textarea>
</div>
<button type="submit" class="btn btn-primary"
name="var4">Send</button>
<button type="reset" class="btn btn-secondary"
name="var5">Clear</button>
</form>
</div>
<?php
// Membuka koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", 
"db_pendaftaran");
// Memeriksa apakah koneksi berhasil
if (!$koneksi) {
die("Koneksi gagal: " . mysqli_connect_error());
}
// Memeriksa apakah formulir telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$nama = $_POST["nama"];
$siswa = isset($_POST["siswa"]) ? 1 : 0;
$usia = $_POST["usia"];
$negara = $_POST["negara"];
$komentar = $_POST["komentar"];
// Menyisipkan data ke dalam tabel pendaftaran
$sql = "INSERT INTO pendaftaran (nama, siswa, usia, negara, 
komentar) VALUES ('$nama', '$siswa', '$usia', '$negara', 
'$komentar')";
if (mysqli_query($koneksi, $sql)) {
echo "Data telah disimpan.";
} else {
echo "Terjadi kesalahan: " . mysqli_error($koneksi);
}
// Menutup koneksi
mysqli_close($koneksi);
}
?>
</body>
</html>