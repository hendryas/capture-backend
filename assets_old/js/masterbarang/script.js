$("button[name='btnSubmitMasterBarang']").click(function (e) {
	e.preventDefault();
	let input_kategori = $("select[name=input_kategori]").val();
	let nama_barang = $("input[name=input_nama_barang]").val().trim();
	let qty = $("input[name=input_quantity]").val().trim();
	let satuan = $("select[name=input_satuan]").val();
	let pack = $("input[name=input_pack]").val().trim();
	let harga_satu_pack = $("input[name=input_harga_satu_pack]").val().trim();
	let tipe_stok = $("select[name=input_tipe_stok]").val();
	let gambar_barang = $("input[name=input_gambar_barang]");

	let cek_gambar = gambar_barang[0].files[0];

	console.log(input_kategori);
	// console.log(qty);
	// console.log(satuan);
	// console.log(pack);
	// console.log(harga_satu_pack);
	// console.log(tipe_stok);
	// console.log(gambar_barang[0].files[0]);

	let formData = new FormData();
	formData.append("input_kategori", input_kategori);
	formData.append("nama_barang", nama_barang);
	formData.append("qty", qty);
	formData.append("satuan", satuan);
	formData.append("pack", pack);
	formData.append("harga_satu_pack", harga_satu_pack);
	formData.append("tipe_stok", tipe_stok);
	formData.append("gambar_barang", gambar_barang[0].files[0]);

	if (input_kategori == undefined || input_kategori == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom kategori barang tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (nama_barang == undefined || nama_barang == "") {
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
	} else if (pack == undefined || pack == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom pack tidak boleh kosong!",
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
	} else if (tipe_stok == undefined || tipe_stok == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom tipe stok tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (cek_gambar == undefined || cek_gambar == "") {
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
					url: "masterbarang/insert_data_master_barang/masterbarang.php",
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
								// window.location.reload();
								window.location.href = "masterbarang";
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
	// console.log(id_barang);

	// window.location.href =
	// 	"masterbarang/update_master_barang/masterbarang.php?id=" + id_barang;
});

$("button[name='btnSubmitEditMasterBarang']").click(function (e) {
	e.preventDefault();
	let id_barang = $("input[name=edit_id_barang]").val().trim();
	let nama_barang = $("input[name=edit_nama_barang]").val().trim();
	let qty = $("input[name=edit_quantity]").val().trim();
	let satuan = $("select[name=edit_satuan]").val();
	let pack = $("input[name=edit_pack]").val().trim();
	let harga_satu_pack = $("input[name=edit_harga_satu_pack]").val().trim();
	let tipe_stok = $("select[name=edit_tipe_stok]").val();
	let gambar_barang = $("input[name=edit_gambar_barang]");

	console.log(id_barang);
	console.log(nama_barang);
	console.log(gambar_barang);

	let formData = new FormData();
	formData.append("id_barang", id_barang);
	formData.append("nama_barang", nama_barang);
	formData.append("qty", qty);
	formData.append("satuan", satuan);
	formData.append("pack", pack);
	formData.append("harga_satu_pack", harga_satu_pack);
	formData.append("tipe_stok", tipe_stok);
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
	} else if (pack == undefined || pack == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom pack tidak boleh kosong!",
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
	} else if (tipe_stok == undefined || tipe_stok == "") {
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
					url: "masterbarang/update_data_master_barang/masterbarang.php",
					method: "POST",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,
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
				url: "masterbarang/delete_data_master_barang/masterbarang.php",
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
