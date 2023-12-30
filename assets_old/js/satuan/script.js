$("button[name='btnTambahSatuan']").click(function (e) {
	e.preventDefault();
	let nama_satuan = $("input[name=input_nama_satuan]").val().trim();
	let satuan = $("input[name=satuan]").val().trim();

	console.log(nama_satuan);
	console.log(satuan);

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
					url: "satuan/insert_data_satuan/satuan.php",
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
