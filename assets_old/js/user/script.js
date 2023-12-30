$("button[name='btnSubmit']").click(function (e) {
	e.preventDefault();
	let nama = $("input[name=input_nama]").val().trim();
	let username = $("input[name=input_username]").val().trim();
	let password = $("input[name=input_password]").val().trim();
	let pilih_status = $("select[name=pilih_status]").val().trim();
	let pilih_role = $("select[name=pilih_role]").val();
	console.log(nama);
	console.log(username);
	console.log(password);
	console.log(pilih_status);
	console.log(pilih_role);

	let formData = new FormData();
	formData.append("nama", nama);
	formData.append("username", username);
	formData.append("password", password);
	formData.append("pilih_status", pilih_status);
	formData.append("pilih_role", pilih_role);

	if (nama == undefined || nama == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom nama tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (username == undefined || username == "") {
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
	} else if (pilih_status == undefined || pilih_status == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom Pilih Status tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (pilih_role == undefined || pilih_role == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom Pilih Role tidak boleh kosong!",
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
					url: "user/insert_data/user.php",
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
								window.location.reload();
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

$("button[name='btnSubmitEdit']").click(function (e) {
	e.preventDefault();
	let id_user = $("input[name=edit_id_user]").val().trim();
	let nama = $("input[name=edit_nama]").val().trim();
	let username = $("input[name=edit_username]").val().trim();
	let password = $("input[name=edit_password]").val().trim();
	let pilih_status = $("select[name=edit_pilih_status]").val().trim();
	// console.log(id_user);
	// console.log(nama);
	// console.log(username);
	// console.log(password);
	// console.log(pilih_status);

	let formData = new FormData();
	formData.append("id_user", id_user);
	formData.append("nama", nama);
	formData.append("username", username);
	formData.append("password", password);
	formData.append("pilih_status", pilih_status);

	if (nama == undefined || nama == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom nama tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (username == undefined || username == "") {
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
	} else if (pilih_status == undefined || pilih_status == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom Pilih Status tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else {
		Swal.fire({
			title: "Apakah Anda Yakin?",
			text: "Ingin Mengubah Data!",
			icon: "question",
			showCancelButton: true,
			confirmButtonColor: "#19A87E",
			cancelButtonColor: "#ff3d60",
			confirmButtonText: "Ya, Lanjutkan!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "user/update_data/user.php",
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
								window.location.reload();
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

$(document).on("click", "#btnEdit", function (e) {
	let id_user = $(this).closest("tr").find("#id_user").val();
	let nama = $(this).closest("tr").find("#nama").val();
	let username = $(this).closest("tr").find("#username").val();
	let password = $(this).closest("tr").find("#password").val();
	let is_active = $(this).closest("tr").find("#is_active").val();

	$(".modal-body #edit_id_user").val(id_user);
	$(".modal-body #edit_nama").val(nama);
	$(".modal-body #edit_username").val(username);
	$(".modal-body #edit_password").val(password);
});

$("button[name='btnHapus']").click(function (e) {
	e.preventDefault();
	let id_user = $(this).closest("tr").find("#id_user").val();

	let formData = new FormData();
	formData.append("id_user", id_user);

	Swal.fire({
		title: "Apakah Anda Yakin?",
		text: "Ingin Menghapus Data Ini!",
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#19A87E",
		cancelButtonColor: "#ff3d60",
		confirmButtonText: "Ya, Lanjutkan!",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: "user/delete_data/user.php",
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
							window.location.reload();
						});
					} else {
						Swal.fire("Oops!", obj.message, "error");
					}
				},
			});
		}
	});
});
