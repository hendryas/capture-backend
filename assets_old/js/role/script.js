$("button[name='btnSubmit']").click(function (e) {
	e.preventDefault();
	let role = $("input[name=input_role]").val().trim();

	let formData = new FormData();
	formData.append("role", role);

	if (role == undefined || role == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom role tidak boleh kosong!",
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
					url: "role/insert_data/role.php",
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
	let id_role = $("input[name=edit_id_role]").val().trim();
	let role = $("input[name=edit_role]").val().trim();
	// console.log(id_user);
	// console.log(nama);
	// console.log(username);
	// console.log(password);
	// console.log(pilih_status);

	let formData = new FormData();
	formData.append("id_role", id_role);
	formData.append("role", role);

	if (role == undefined || role == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom role tidak boleh kosong!",
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
					url: "role/update_data/role.php",
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
	let id_role = $(this).closest("tr").find("#id_role").val();
	let role = $(this).closest("tr").find("#nama_role").val();

	$(".modal-body #edit_id_role").val(id_role);
	$(".modal-body #edit_role").val(role);
});

$("button[name='btnHapus']").click(function (e) {
	e.preventDefault();
	let id_role = $(this).closest("tr").find("#id_role").val();

	let formData = new FormData();
	formData.append("id_role", id_role);

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
				url: "role/delete_data/role.php",
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
