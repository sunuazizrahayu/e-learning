<div class="login-box">
	<div class="login-logo">
		<img src="<?= base_url('assets/img/profile/') . $sekolah->logo ?>" alt="Logo" width="100px" height="100px">
	</div>
	<h3 class="text-center"><?= $sekolah->nama ?></h3>
	<p class="text-center"><?= $sekolah->alamat ?></p>
	<p class="text-center"> No Telepon : <?= $sekolah->nohp ?></p>
	<div class="login-box-body">
		<p class="login-box-msg">Silahkan Login</p>
		<form id="login" method="POST">
			<div class="form-group has-feedback user">
				<input type="text" class="form-control" name="user" id="user" placeholder="Masukkan Username">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback pass">
				<input type="password" class="form-control" name="pass" id="pass" placeholder="Masukkan Password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-primary btn-block btn-flat login">Login</button>
			</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.login').click(function() {
			user = $('#user').val();
			pass = $('#pass').val();
			if (user == '') {
				if (!$('.user').hasClass('has-error')) {
					$('.user').addClass('has-error');
				}
				toastr["error"]('Kolom Username tidak boleh kosong');
			} else {
				$('.user').removeClass('has-error');
			}
			if (pass == '') {
				if (!$('.pass').hasClass('has-error')) {
					$('.pass').addClass('has-error');
				}
				toastr["error"]('Kolom Password tidak boleh kosong');
			} else {
				$('.pass').removeClass('has-error');
			}
			if (user != '' && pass != '') {
				$.ajax({
					url: '<?= site_url('auth/login') ?>',
					type: 'POST',
					data: $('#login').serialize(),
					dataType: 'json',
					success: function(result) {
						if (result.status == false) {
							toastr["error"](result.pesan);
						} else if (result.status == true) {
							window.location.href = result.link;
						}
					}
				})
			}
		})
	});
</script>