$("button[name='btnSaveStock']").click(function (e) {
	let id_rumah = $(this).closest("tr").find("#id_rumah").val();
	let id_dapur = $(this).closest("tr").find("#id_dapur").val();
	let stok_awal_qty = $(this).closest("tr").find("#stok_awal_qty").val();
	let stok_awal_pack = $(this).closest("tr").find("#stok_awal_pack").val();
	let stok_awal_harga = $(this).closest("tr").find("#stok_awal_harga").val();
	let tanggal_input_stok = $(this)
		.closest("tr")
		.find("#tanggal_input_stok")
		.val();
	let input_stok = $(this).closest("tr").find("#input_stok").val();
	let tambah_qty = $(this).closest("tr").find("#tambah_qty").val();

	console.log(id_rumah);
	console.log(id_dapur);
	console.log(stok_awal_qty);
	console.log(stok_awal_pack);
	console.log(stok_awal_harga);
	console.log(tanggal_input_stok);
	console.log(input_stok);
	console.log(tambah_qty);
	// console.log("hei");

	let formData = new FormData();
	formData.append("id_rumah", id_rumah);
	formData.append("id_dapur", id_dapur);
	formData.append("stok_awal_qty", stok_awal_qty);
	formData.append("stok_awal_pack", stok_awal_pack);
	formData.append("stok_awal_harga", stok_awal_harga);
	formData.append("tanggal_input_stok", tanggal_input_stok);
	formData.append("input_stok", input_stok);
	formData.append("tambah_qty", tambah_qty);

	if (input_stok == undefined || input_stok == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom input stok tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else {
		Swal.fire({
			title: "Apakah Anda Yakin?",
			text: "Ingin Menambahkan Stok!",
			icon: "question",
			showCancelButton: true,
			confirmButtonColor: "#19A87E",
			cancelButtonColor: "#ff3d60",
			confirmButtonText: "Ya, Lanjutkan!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "dapur/insert_data_stok_dapur/dapur.php",
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
								$(this)
									.closest("tr")
									.find("#stok_akhir")
									.html(
										obj.stokakhir +
											"<input name='tambah_qty' id='tambah_qty' type='hidden' value='" +
											obj.stokakhir +
											"'>"
									);
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

$("button[name='btnSaveSisaPack']").click(function (e) {
	let id_rumah = $(this).closest("tr").find("#id_rumah").val();
	let id_dapur = $(this).closest("tr").find("#id_dapur").val();
	let stok_awal_qty = $(this).closest("tr").find("#stok_awal_qty").val();
	let stok_awal_pack = $(this).closest("tr").find("#stok_awal_pack").val();
	let stok_awal_harga = $(this).closest("tr").find("#stok_awal_harga").val();
	let tanggal_input_stok = $(this)
		.closest("tr")
		.find("#tanggal_input_stok")
		.val();
	let input_sisa_pack = $(this).closest("tr").find("#input_sisa_pack").val();
	let input_sisa_ecer = $(this).closest("tr").find("#input_sisa_ecer").val();
	let tambah_qty = $(this).closest("tr").find("#tambah_qty").val();

	console.log(id_rumah);
	console.log(id_dapur);
	console.log(stok_awal_qty);
	console.log(stok_awal_pack);
	console.log(stok_awal_harga);
	console.log(tanggal_input_stok);
	console.log(input_sisa_pack);
	console.log(input_sisa_ecer);
	console.log(tambah_qty);

	let formData = new FormData();
	formData.append("id_rumah", id_rumah);
	formData.append("id_dapur", id_dapur);
	formData.append("stok_awal_qty", stok_awal_qty);
	formData.append("stok_awal_pack", stok_awal_pack);
	formData.append("stok_awal_harga", stok_awal_harga);
	formData.append("tanggal_input_stok", tanggal_input_stok);
	formData.append("input_sisa_pack", input_sisa_pack);
	formData.append("input_sisa_ecer", input_sisa_ecer);
	formData.append("tambah_qty", tambah_qty);

	if (input_sisa_ecer == undefined || input_sisa_ecer == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom input sisa ecer tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else {
		Swal.fire({
			title: "Apakah Anda Yakin?",
			text: "Ingin Menambahkan Sisa Stok!",
			icon: "question",
			showCancelButton: true,
			confirmButtonColor: "#19A87E",
			cancelButtonColor: "#ff3d60",
			confirmButtonText: "Ya, Lanjutkan!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "dapur/insert_data_sisa_stok_dapur/dapur.php",
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
								$(this)
									.closest("tr")
									.find("#stok_akhir")
									.html(
										obj.stokakhir +
											"<input name='tambah_qty' id='tambah_qty' type='hidden' value='" +
											obj.stokakhir +
											"'>"
									);
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

$("button[name='btnTambahStokDapurLangsung']").click(function (e) {
	let id_rumah = $(this).closest("tr").find("#id_rumah").val();
	let id_dapur = $(this).closest("tr").find("#id_dapur").val();
	let stok_awal_qty = $(this).closest("tr").find("#stok_awal_qty").val();
	let stok_awal_pack = $(this).closest("tr").find("#stok_awal_pack").val();
	let stok_awal_harga = $(this).closest("tr").find("#stok_awal_harga").val();
	let tanggal_input_stok = $(this)
		.closest("tr")
		.find("#tanggal_input_stok")
		.val();
	let input_stok_qty_dapur = $(this)
		.closest("tr")
		.find("#input_stok_qty_dapur")
		.val();
	let tambah_qty = $(this).closest("tr").find("#tambah_qty").val();

	console.log(id_rumah);
	console.log(id_dapur);
	console.log(stok_awal_qty);
	console.log(stok_awal_pack);
	console.log(stok_awal_harga);
	console.log(tanggal_input_stok);
	console.log(input_stok_qty_dapur);
	console.log(tambah_qty);

	let formData = new FormData();
	formData.append("id_rumah", id_rumah);
	formData.append("id_dapur", id_dapur);
	formData.append("stok_awal_qty", stok_awal_qty);
	formData.append("stok_awal_pack", stok_awal_pack);
	formData.append("stok_awal_harga", stok_awal_harga);
	formData.append("tanggal_input_stok", tanggal_input_stok);
	formData.append("input_stok_qty_dapur", input_stok_qty_dapur);
	formData.append("tambah_qty", tambah_qty);

	if (input_stok_qty_dapur == undefined || input_stok_qty_dapur == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom input stok dapur langsung tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else {
		Swal.fire({
			title: "Apakah Anda Yakin?",
			text: "Ingin Menambahkan Stok Dapur Langsung!",
			icon: "question",
			showCancelButton: true,
			confirmButtonColor: "#19A87E",
			cancelButtonColor: "#ff3d60",
			confirmButtonText: "Ya, Lanjutkan!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "dapur/insert_data_stok_dapur_langsung/dapur.php",
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
								$(this)
									.closest("tr")
									.find("#stok_akhir")
									.html(
										obj.stokakhir +
											"<input name='tambah_qty' id='tambah_qty' type='hidden' value='" +
											obj.stokakhir +
											"'>"
									);
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

$("button[name='btnSaveCatatanTambah']").click(function (e) {
	let id_rumah = $(this).closest("tr").find("#id_rumah").val();
	let id_dapur = $(this).closest("tr").find("#id_dapur").val();
	let catatan = $(this).closest("tr").find("#catatan").val();
	console.log(id_rumah);
	console.log(id_dapur);
	console.log(catatan);
	let formData = new FormData();
	formData.append("id_rumah", id_rumah);
	formData.append("id_dapur", id_dapur);
	formData.append("catatan", catatan);

	if (catatan == undefined || catatan == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom input catatan tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else {
		Swal.fire({
			title: "Apakah Anda Yakin?",
			text: "Ingin Menambahkan Catatan!",
			icon: "question",
			showCancelButton: true,
			confirmButtonColor: "#19A87E",
			cancelButtonColor: "#ff3d60",
			confirmButtonText: "Ya, Lanjutkan!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "dapur/insert_catatan_tambah_stok_dapur/dapur.php",
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

$("button[name='btnSaveCatatanSisa']").click(function (e) {
	let id_rumah = $(this).closest("tr").find("#id_rumah").val();
	let id_dapur = $(this).closest("tr").find("#id_dapur").val();
	let catatan = $(this).closest("tr").find("#catatan").val();
	console.log(id_rumah);
	console.log(id_dapur);
	console.log(catatan);
	let formData = new FormData();
	formData.append("id_rumah", id_rumah);
	formData.append("id_dapur", id_dapur);
	formData.append("catatan", catatan);

	if (catatan == undefined || catatan == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom input catatan tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else {
		Swal.fire({
			title: "Apakah Anda Yakin?",
			text: "Ingin Menambahkan Catatan!",
			icon: "question",
			showCancelButton: true,
			confirmButtonColor: "#19A87E",
			cancelButtonColor: "#ff3d60",
			confirmButtonText: "Ya, Lanjutkan!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "dapur/insert_catatan_sisa_stok_dapur/dapur.php",
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
