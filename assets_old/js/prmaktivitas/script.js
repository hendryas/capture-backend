$("button[name='btnSubmit']").click(function (e) {
	e.preventDefault();
	let jenis_aktivitas = $("input[name=jenis_aktivitas]").val().trim();
	console.log(jenis_aktivitas);

	let formData = new FormData();
	formData.append("jenis_aktivitas", jenis_aktivitas);

	if (jenis_aktivitas == undefined || jenis_aktivitas == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom jenis aktivitas tidak boleh kosong!",
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
					url: "prmaktivitas/insert_data/prmaktivitas.php",
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
	let id_prm_aktivitas = $(this).closest("tr").find("#id_prm_aktivitas").val();
	let nama_aktivitas = $(this).closest("tr").find("#nama_aktivitas").val();

	console.log(id_prm_aktivitas);
	console.log(nama_aktivitas);

	$(".modal-body #edit_id_prm_aktivitas").val(id_prm_aktivitas);
	$(".modal-body #edit_nama_aktivitas").val(nama_aktivitas);
});

$("button[name='btnSubmitEdit']").click(function (e) {
	e.preventDefault();
	let id_prm_aktivitas = $("input[name=edit_id_prm_aktivitas]").val().trim();
	let nama_aktivitas = $("input[name=edit_nama_aktivitas]").val().trim();

	console.log(id_prm_aktivitas);
	console.log(nama_aktivitas);

	let formData = new FormData();
	formData.append("id_prm_aktivitas", id_prm_aktivitas);
	formData.append("nama_aktivitas", nama_aktivitas);

	if (nama_aktivitas == undefined || nama_aktivitas == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom nama aktivitas tidak boleh kosong!",
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
					url: "prmaktivitas/update_data/prmaktivitas.php",
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
	let id_prm_aktivitas = $(this).closest("tr").find("#id_prm_aktivitas").val();

	let formData = new FormData();
	formData.append("id_prm_aktivitas", id_prm_aktivitas);

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
				url: "prmaktivitas/delete_data/prmaktivitas.php",
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
