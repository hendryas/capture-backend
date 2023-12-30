$("button[name='btnSubmit']").click(function (e) {
	e.preventDefault();
	let tipe_stok = $("input[name=tipe_stok]").val().trim();

	let formData = new FormData();
	formData.append("tipe_stok", tipe_stok);

	if (tipe_stok == undefined || tipe_stok == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom tipe stok tidak boleh kosong!",
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
					url: "prmstok/insert_data/prmstok.php",
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
	let id_tipe_stok = $(this).closest("tr").find("#id_tipe_stok").val();
	let nama_tipe = $(this).closest("tr").find("#nama_tipe").val();

	$(".modal-body #edit_id_tipe_stok").val(id_tipe_stok);
	$(".modal-body #edit_nama_tipe").val(nama_tipe);
});

$("button[name='btnSubmitEdit']").click(function (e) {
	e.preventDefault();
	let id_tipe_stok = $("input[name=edit_id_tipe_stok]").val().trim();
	let nama_tipe = $("input[name=edit_nama_tipe]").val().trim();

	console.log(id_tipe_stok);
	console.log(nama_tipe);

	let formData = new FormData();
	formData.append("id_tipe_stok", id_tipe_stok);
	formData.append("nama_tipe", nama_tipe);

	if (nama_tipe == undefined || nama_tipe == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom tipe stok tidak boleh kosong!",
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
					url: "prmstok/update_data/prmstok.php",
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

$("button[name='btnHapus']").click(function (e) {
	e.preventDefault();
	let id_tipe_stok = $(this).closest("tr").find("#id_tipe_stok").val();

	let formData = new FormData();
	formData.append("id_tipe_stok", id_tipe_stok);

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
				url: "prmstok/delete_data/prmstok.php",
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
