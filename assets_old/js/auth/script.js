$("button[name='btnRegister']").click(function (e) {
	e.preventDefault();
	let username = $("input[name=input_username]").val().trim();
	let password = $("input[name=input_password]").val().trim();

	let formData = new FormData();
	formData.append("username", username);
	formData.append("password", password);

	if (username == undefined || username == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom username tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (password == undefined || password == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom password tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else {
		Swal.fire({
			title: "Apakah Anda Yakin?",
			text: "Ingin Menyimpan Data!",
			icon: "question",
			showCancelButton: true,
			confirmButtonColor: "#19A87E",
			cancelButtonColor: "#ff3d60",
			confirmButtonText: "Ya, Lanjutkan!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "register/insert_data_register/register.php",
					method: "POST",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: () => {
						$.LoadingOverlay("show");
					},
					complete: () => {
						$.LoadingOverlay("hide");
					},
					success: (response) => {
						let obj = JSON.parse(response);
						if (obj.status == "OK") {
							Swal.fire("Sukses!", obj.message, "success").then(() => {
								window.location.href = "login";
							});
						} else {
							Swal.fire("Oops!", obj.message, "error");
						}
					},
				});
			}
		});
	}
});

$("button[name='btnLogin']").click(function (e) {
	e.preventDefault();
	let username = $("input[name=input_username]").val().trim();
	let password = $("input[name=input_password]").val().trim();
	console.log(username);

	let formData = new FormData();
	formData.append("username", username);
	formData.append("password", password);

	if (username == undefined || username == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom username tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (password == undefined || password == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom password tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else {
		Swal.fire({
			title: "Apakah Anda Yakin?",
			text: "Ingin Menyimpan Data!",
			icon: "question",
			showCancelButton: true,
			confirmButtonColor: "#19A87E",
			cancelButtonColor: "#ff3d60",
			confirmButtonText: "Ya, Lanjutkan!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "login/login_akun/login.php",
					method: "POST",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
					beforeSend: () => {
						$.LoadingOverlay("show");
					},
					complete: () => {
						$.LoadingOverlay("hide");
					},
					success: (response) => {
						let obj = JSON.parse(response);
						if (obj.status == "OK") {
							window.location.href = obj.link;
						} else if (obj.status == "ERROR NOT FOUND") {
							window.location.href = "errors/error404";
						} else {
							Swal.fire("Oops!", obj.message, "error");
						}
					},
				});
			}
		});
	}
});
