$("button[name='btnSubmit']").click(function (e) {
	e.preventDefault();
	let lokasi_stok = $("input[name=lokasi_stok]").val().trim();
	console.log(lokasi_stok);

	let formData = new FormData();
	formData.append("lokasi_stok", lokasi_stok);

	if (lokasi_stok == undefined || lokasi_stok == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom lokasi stok tidak boleh kosong!",
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
					url: "lokasistok/insert_data/lokasistok.php",
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
	let id_prm_lokasi = $(this).closest("tr").find("#id_prm_lokasi").val();
	let nama_lokasi = $(this).closest("tr").find("#nama_lokasi").val();

	console.log(id_prm_lokasi);
	console.log(nama_lokasi);

	$(".modal-body #edit_id_prm_lokasi").val(id_prm_lokasi);
	$(".modal-body #edit_nama_lokasi").val(nama_lokasi);
});

$("button[name='btnSubmitEdit']").click(function (e) {
	e.preventDefault();
	let id_prm_lokasi = $("input[name=edit_id_prm_lokasi]").val().trim();
	let nama_lokasi = $("input[name=edit_nama_lokasi]").val().trim();

	console.log(id_prm_lokasi);
	console.log(nama_lokasi);

	let formData = new FormData();
	formData.append("id_prm_lokasi", id_prm_lokasi);
	formData.append("nama_lokasi", nama_lokasi);

	if (nama_lokasi == undefined || nama_lokasi == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom nama lokasi tidak boleh kosong!",
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
					url: "lokasistok/update_data/lokasistok.php",
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
	let id_prm_lokasi = $(this).closest("tr").find("#id_prm_lokasi").val();

	let formData = new FormData();
	formData.append("id_prm_lokasi", id_prm_lokasi);

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
				url: "lokasistok/delete_data/lokasistok.php",
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
