$("button[name='btnSubmitTambahRumah']").click(function (e) {
	e.preventDefault();
	let nama_barang = $("select[name=input_nama_barang]").val().trim();
	let tanggal = $("input[name=input_tanggal]").val().trim();
	let quantity = $("input[name=input_quantity]").val().trim();
	let pack = $("input[name=input_pack]").val().trim();
	let harga = $("input[name=input_harga]").val().trim();

	console.log(nama_barang);
	console.log(tanggal);
	console.log(quantity);
	console.log(pack);
	console.log(harga);

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
					url: "rumah/insert_data_rumah/rumah.php",
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
								window.location.href = "rumah";
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

$("button[name='btnSaveStock']").click(function (e) {
	let id_barang = $(this).closest("tr").find("#id_barang").val();
	let id_rumah = $(this).closest("tr").find("#id_rumah").val();
	let stok_awal_qty = $(this).closest("tr").find("#stok_awal_qty").val();
	let stok_awal_pack = $(this).closest("tr").find("#stok_awal_pack").val();
	let stok_awal_harga = $(this).closest("tr").find("#stok_awal_harga").val();
	let tanggal_input_stok = $(this)
		.closest("tr")
		.find("#tanggal_input_stok")
		.val();
	let tambah_qty = $(this).closest("tr").find("#tambah_qty").val();
	let input_stok = $(this).closest("tr").find("#input_stok").val();

	console.log(tambah_qty);
	// console.log(id_rumah);
	// console.log(id_barang);
	// console.log(stok_awal_qty);
	// console.log(stok_awal_harga);
	// console.log(tanggal_input_stok);
	// console.log(stok_awal_pack);
	// console.log(input_stok);

	let formData = new FormData();
	formData.append("id_barang", id_barang);
	formData.append("id_rumah", id_rumah);
	formData.append("stok_awal_qty", stok_awal_qty);
	formData.append("stok_awal_pack", stok_awal_pack);
	formData.append("stok_awal_harga", stok_awal_harga);
	formData.append("tanggal_input_stok", tanggal_input_stok);
	formData.append("tambah_qty", tambah_qty);
	formData.append("input_stok", input_stok);

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
					url: "rumah/insert_data_stok_rumah/rumah.php",
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
