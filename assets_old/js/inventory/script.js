// Start Master Barang

$("button[name='btnSubmitMasterBarang']").click(function (e) {
	e.preventDefault();
	let nama_barang = $("input[name=input_nama_barang]").val().trim();
	let qty = $("input[name=input_quantity]").val().trim();
	let satuan = $("input[name=input_satuan]").val().trim();
	let harga_satu_pack = $("input[name=input_harga_satu_pack]").val().trim();
	let gambar_barang = $("input[name=input_gambar_barang]");

	let formData = new FormData();
	formData.append("nama_barang", nama_barang);
	formData.append("qty", qty);
	formData.append("satuan", satuan);
	formData.append("harga_satu_pack", harga_satu_pack);
	formData.append("gambar_barang", gambar_barang[0].files[0]);

	if (nama_barang == undefined || nama_barang == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom nama barang tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (qty == undefined || qty == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom quantity tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (satuan == undefined || satuan == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom satuan tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (harga_satu_pack == undefined || harga_satu_pack == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom harga satu pack tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (gambar_barang == undefined || gambar_barang == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom gambar barang tidak boleh kosong!",
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
					url: "inventory/insert_data_master_barang/inventory.php",
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

$("button[name='btnSubmitEditMasterBarang']").click(function (e) {
	e.preventDefault();
	let id_barang = $("input[name=edit_id_barang]").val().trim();
	let nama_barang = $("input[name=edit_nama_barang]").val().trim();
	let qty = $("input[name=edit_quantity]").val().trim();
	let satuan = $("input[name=edit_satuan]").val().trim();
	let harga_satu_pack = $("input[name=edit_harga_satu_pack]").val().trim();
	let gambar_barang = $("input[name=edit_gambar_barang]");
	console.log(gambar_barang[0].files[0]);

	let formData = new FormData();
	formData.append("id_barang", id_barang);
	formData.append("nama_barang", nama_barang);
	formData.append("qty", qty);
	formData.append("satuan", satuan);
	formData.append("harga_satu_pack", harga_satu_pack);
	formData.append("gambar_barang", gambar_barang[0].files[0]);

	if (nama_barang == undefined || nama_barang == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom nama barang tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (qty == undefined || qty == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom quantity tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (satuan == undefined || satuan == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom satuan tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (harga_satu_pack == undefined || harga_satu_pack == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom harga satu pack tidak boleh kosong!",
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
					url: "inventory/update_data_master_barang/inventory.php",
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

$(document).on("click", "#btnEditMasterBarang", function (e) {
	let id_barang = $(this).closest("tr").find("#id_barang").val();
	let nama_barang = $(this).closest("tr").find("#nama_barang").val();
	let qty = $(this).closest("tr").find("#qty").val();
	let satuan = $(this).closest("tr").find("#satuan").val();
	let harga_satu_pack = $(this).closest("tr").find("#harga_satu_pack").val();
	let gambar_barang = $(this).closest("tr").find("#gambar_barang").val();

	console.log(id_barang);
	console.log(nama_barang);
	console.log(qty);
	console.log(satuan);
	// console.log(icon);
	// console.log(is_active);
	// console.log(status_sub);

	$(".modal-body #edit_id_barang").val(id_barang);
	$(".modal-body #edit_nama_barang").val(nama_barang);
	$(".modal-body #edit_quantity").val(qty);
	$(".modal-body #edit_satuan").val(satuan);
	$(".modal-body #edit_harga_satu_pack").val(harga_satu_pack);
	$(".modal-body #preview_gambar_barang").attr("src", gambar_barang);
});

$("button[name='btnHapusMasterBarang']").click(function (e) {
	e.preventDefault();
	let id_barang = $(this).closest("tr").find("#id_barang").val();

	let formData = new FormData();
	formData.append("id_barang", id_barang);

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
				url: "inventory/delete_data_master_barang/inventory.php",
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

// Start Dapur (Gudang/Rumah)
$("button[name='btnSubmitDapurRumah']").click(function (e) {
	e.preventDefault();
	let nama_barang = $("select[name=input_nama_barang]").val().trim();
	let tanggal = $("input[name=input_tanggal]").val().trim();
	let quantity = $("input[name=input_quantity_dapur_rumah]").val().trim();
	let pack = $("input[name=input_pack_dapur_rumah]").val().trim();
	let harga = $("input[name=input_harga_dapur_rumah]").val().trim();

	// console.log(nama_barang);
	// console.log(tanggal);
	// console.log(quantity);
	// console.log(pack);
	// console.log(harga);

	let formData = new FormData();
	formData.append("nama_barang", nama_barang);
	formData.append("tanggal", tanggal);
	formData.append("quantity", quantity);
	formData.append("pack", pack);
	formData.append("harga", harga);

	if (nama_barang == undefined || nama_barang == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom nama barang tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (tanggal == undefined || tanggal == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom tanggal tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (quantity == undefined || quantity == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom quantity tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (pack == undefined || pack == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom pack tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (harga == undefined || harga == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom harga tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else {
		Swal.fire({
			title: "Apakah Anda Yakin?",
			text: "Ingin Menambahkan Data!",
			icon: "question",
			showCancelButton: true,
			confirmButtonColor: "#19A87E",
			cancelButtonColor: "#ff3d60",
			confirmButtonText: "Ya, Lanjutkan!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "inventory/insert_data_dapur_rumah/inventory.php",
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

// Start Bar (Gudang/Rumah)

// Start Master Dapur

// Start Master Bar

// Start Tambah Satuan
$("button[name='btnSubmitSatuan']").click(function (e) {
	e.preventDefault();
	let nama_satuan = $("input[name=input_nama_satuan]").val().trim();
	let satuan = $("input[name=satuan]").val().trim();

	let formData = new FormData();
	formData.append("nama_satuan", nama_satuan);
	formData.append("satuan", satuan);

	if (nama_satuan == undefined || nama_satuan == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom nama satuan tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (satuan == undefined || satuan == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom satuan tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else {
		Swal.fire({
			title: "Apakah Anda Yakin?",
			text: "Ingin Menambahkan Data!",
			icon: "question",
			showCancelButton: true,
			confirmButtonColor: "#19A87E",
			cancelButtonColor: "#ff3d60",
			confirmButtonText: "Ya, Lanjutkan!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "inventory/insert_data_satuan/inventory.php",
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
