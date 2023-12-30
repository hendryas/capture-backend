$("button[name='btnSubmit']").click(function (e) {
	e.preventDefault();
	let jenis_kategori = $("input[name=jenis_kategori]").val().trim();

	let formData = new FormData();
	formData.append("jenis_kategori", jenis_kategori);

	if (jenis_kategori == undefined || jenis_kategori == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom jenis kategori tidak boleh kosong!",
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
					url: "prmkategori/insert_data/prmkategori.php",
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
	let id_kategori_item = $(this).closest("tr").find("#id_kategori_item").val();
	let nama_kategori = $(this).closest("tr").find("#nama_kategori").val();

	$(".modal-body #id_kategori_item").val(id_kategori_item);
	$(".modal-body #jenis_kategori").val(nama_kategori);
});

$("button[name='btnSubmitEdit']").click(function (e) {
	e.preventDefault();
	let id_kategori = $("input[name=id_kategori]").val().trim();
	let jenis_kategori = $("input[name=edit_jenis_kategori]").val().trim();
	console.log(id_kategori);
	console.log(jenis_kategori);
	// console.log(username);
	// console.log(password);
	// console.log(pilih_status);

	let formData = new FormData();
	formData.append("id_kategori", id_kategori);
	formData.append("jenis_kategori", jenis_kategori);

	if (jenis_kategori == undefined || jenis_kategori == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom jenis kategori tidak boleh kosong!",
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
					url: "prmkategori/update_data/prmkategori.php",
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
	let id_kategori_item = $(this).closest("tr").find("#id_kategori_item").val();
	console.log(id_kategori_item);

	let formData = new FormData();
	formData.append("id_kategori_item", id_kategori_item);

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
				url: "prmkategori/delete_data/prmkategori.php",
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
