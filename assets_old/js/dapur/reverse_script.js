$("button[name='btnAktifReverseTambahStokDapur']").click(function (e) {
	let id_tambah = $(this).closest("tr").find("#id_tambah").val();
	let id_prm_aktivitas = $(this).closest("tr").find("#id_prm_aktivitas").val();
	let tanggal_input = $(this).closest("tr").find("#tanggal_input").val();

	console.log(id_tambah);
	console.log(id_prm_aktivitas);
	console.log(tanggal_input);

	let formData = new FormData();
	formData.append("id_tambah", id_tambah);
	formData.append("id_prm_aktivitas", id_prm_aktivitas);
	formData.append("tanggal_input", tanggal_input);

	Swal.fire({
		title: "Apakah Anda Yakin?",
		text: "Ingin Mereverse Stok Ini!",
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#19A87E",
		cancelButtonColor: "#ff3d60",
		confirmButtonText: "Ya, Lanjutkan!",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: "reverse/reverse_data_tambah_stok_dapur/reverse.php",
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

$("button[name='btnAktifReverseSisaStok']").click(function (e) {
	let id_sisa = $(this).closest("tr").find("#id_sisa").val();
	let id_dapur = $(this).closest("tr").find("#id_dapur").val();
	let qty = $(this).closest("tr").find("#qty").val();
	let biaya = $(this).closest("tr").find("#biaya").val();
	let tanggal_input = $(this).closest("tr").find("#tanggal_input").val();

	console.log(id_sisa);
	console.log(id_dapur);
	console.log(qty);
	console.log(biaya);
	console.log(tanggal_input);

	let formData = new FormData();
	formData.append("id_sisa", id_sisa);
	formData.append("id_dapur", id_dapur);
	formData.append("qty", qty);
	formData.append("biaya", biaya);
	formData.append("tanggal_input", tanggal_input);

	Swal.fire({
		title: "Apakah Anda Yakin?",
		text: "Ingin Mereverse Stok Ini!",
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#19A87E",
		cancelButtonColor: "#ff3d60",
		confirmButtonText: "Ya, Lanjutkan!",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: "reverse/reverse_data_sisa_stok_dapur/reverse.php",
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
