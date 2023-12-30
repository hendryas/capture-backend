$("button[name='btnSubmitFoto']").click(function (e) {
	console.log("hei btn foto");
});

$("button[name='btnUbahStatus']").click(function (e) {
	console.log("hei btn Ubah Status");
});

$("button[name='btnUbahDataProfile']").click(function (e) {
	e.preventDefault();
	let edit_nama = $("input[name=edit_nama]").val().trim();
	let edit_nik = $("input[name=edit_nik]").val().trim();
	let edit_jenis_kelamin = $("input[name=edit_jenis_kelamin]").val().trim();
	let edit_alamat = $("input[name=edit_alamat]").val().trim();
	let edit_ktp_rt = $("input[name=edit_ktp_rt]").val().trim();
	let edit_ktp_rw = $("input[name=edit_ktp_rw]").val().trim();
	let edit_ktp_kelurahan = $("input[name=edit_ktp_kelurahan]").val().trim();
	let edit_ktp_kecamatan = $("input[name=edit_ktp_kecamatan]").val().trim();
	let edit_ktp_kabkota = $("input[name=edit_ktp_kabkota]").val().trim();
	let edit_ktp_provinsi = $("input[name=edit_ktp_provinsi]").val().trim();
	let edit_ktp_pos = $("input[name=edit_ktp_pos]").val().trim();
	let edit_tgllahir = $("input[name=edit_tgllahir]").val().trim();
	let edit_agama = $("input[name=edit_agama]").val().trim();
	let edit_no_phone = $("input[name=edit_no_phone]").val().trim();
	let edit_username = $("input[name=edit_username]").val().trim();
	let password = $("input[name=password]").val().trim();

	let formData = new FormData();
	formData.append("edit_nama", edit_nama);
	formData.append("edit_nik", edit_nik);
	formData.append("edit_jenis_kelamin", edit_jenis_kelamin);
	formData.append("edit_alamat", edit_alamat);
	formData.append("edit_ktp_rt", edit_ktp_rt);
	formData.append("edit_ktp_rw", edit_ktp_rw);
	formData.append("edit_ktp_kelurahan", edit_ktp_kelurahan);
	formData.append("edit_ktp_kecamatan", edit_ktp_kecamatan);
	formData.append("edit_ktp_kabkota", edit_ktp_kabkota);
	formData.append("edit_ktp_provinsi", edit_ktp_provinsi);
	formData.append("edit_ktp_pos", edit_ktp_pos);
	formData.append("edit_tgllahir", edit_tgllahir);
	formData.append("edit_agama", edit_agama);
	formData.append("edit_no_phone", edit_no_phone);
	formData.append("edit_username", edit_username);
	formData.append("password", password);

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
				url: "user/update_data_user_profile/user.php",
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

	// if (edit_nama == undefined || edit_nama == "") {
	// 	Swal.fire({
	// 		title: "Inputan Kosong!",
	// 		text: "Kolom nama tidak boleh kosong!",
	// 		icon: "question",
	// 		confirmButtonColor: "#5664d2",
	// 	});
	// } else if (edit_nik == undefined || edit_nik == "") {
	// 	Swal.fire({
	// 		title: "Inputan Kosong!",
	// 		text: "Kolom nik tidak boleh kosong!",
	// 		icon: "question",
	// 		confirmButtonColor: "#5664d2",
	// 	});
	// } else if (edit_jenis_kelamin == undefined || edit_jenis_kelamin == "") {
	// 	Swal.fire({
	// 		title: "Inputan Kosong!",
	// 		text: "Kolom jenis kelamin tidak boleh kosong!",
	// 		icon: "question",
	// 		confirmButtonColor: "#5664d2",
	// 	});
	// } else if (edit_alamat == undefined || edit_alamat == "") {
	// 	Swal.fire({
	// 		title: "Inputan Kosong!",
	// 		text: "Kolom alamat tidak boleh kosong!",
	// 		icon: "question",
	// 		confirmButtonColor: "#5664d2",
	// 	});
	// } else {

	// }
});
