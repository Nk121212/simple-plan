<!DOCTYPE html>
<html>
<head>
	<title>Email</title>
</head>
<body>

	<h2>Selamat datang di Simple Plan, <?=$post_data['first_name']?></h2>
	<h3>Great Solution From Simple Idea</h3>
	<p>Anda telah melakukan registrasi</p>
	<p>Silakan masukan kode OTP dibawah untuk konfirmasi akun</p>
	<p><?=$post_data['kode_otp']?></p>

</body>
</html>