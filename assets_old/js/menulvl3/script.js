$("button[name='btnSubmit']").click(function (e) {
	e.preventDefault();
	let url = $("input[name=input_url]").val().trim();
	let title = $("input[name=input_title]").val().trim();
	let icon = $("input[name=input_icon]").val().trim();
	let pilih_menu_level_2 = $("select[name=pilih_menu_level_2]").val().trim();
	let pilih_status = $("select[name=pilih_status]").val().trim();
	// console.log(url);
	// console.log(title);
	// console.log(icon);
	// console.log(pilih_menu_level_2);
	// console.log(pilih_status);

	let formData = new FormData();
	formData.append("url", url);
	formData.append("title", title);
	formData.append("icon", icon);
	formData.append("pilih_menu_level_2", pilih_menu_level_2);
	formData.append("pilih_status", pilih_status);

	if (url == undefined || url == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom url tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (title == undefined || title == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom title tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (icon == undefined || icon == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom icon tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (pilih_menu_level_2 == undefined || pilih_menu_level_2 == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom Pilih Menu tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (pilih_status == undefined || pilih_status == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom Pilih Status tidak boleh kosong!",
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
					url: "menulevel3/insert_data/menulevel3.php",
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

$("button[name='btnSubmitEdit']").click(function (e) {
	e.preventDefault();
	let id_menu_lvl3 = $("input[name=edit_id_menu_lvl3]").val().trim();
	let url = $("input[name=edit_url]").val().trim();
	let title = $("input[name=edit_title]").val().trim();
	let icon = $("input[name=edit_icon]").val().trim();
	let pilih_menu_level_2 = $("select[name=edit_pilih_menu_level_2]")
		.val()
		.trim();
	let pilih_status = $("select[name=edit_pilih_status]").val().trim();
	// console.log(id_menu_lvl3);
	// console.log(url);
	// console.log(title);
	// console.log(icon);
	// console.log(pilih_menu_level_2);
	// console.log(pilih_status);

	let formData = new FormData();
	formData.append("id_menu_lvl3", id_menu_lvl3);
	formData.append("url", url);
	formData.append("title", title);
	formData.append("icon", icon);
	formData.append("pilih_menu_level_2", pilih_menu_level_2);
	formData.append("pilih_status", pilih_status);

	if (url == undefined || url == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom url tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (title == undefined || title == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom title tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (icon == undefined || icon == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom icon tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (pilih_menu_level_2 == undefined || pilih_menu_level_2 == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom Pilih Menu tidak boleh kosong!",
			icon: "question",
			confirmButtonColor: "#5664d2",
		});
	} else if (pilih_status == undefined || pilih_status == "") {
		Swal.fire({
			title: "Inputan Kosong!",
			text: "Kolom Pilih Status tidak boleh kosong!",
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
					url: "menulevel3/update_data/menulevel3.php",
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
	let id_menu_lvl3 = $(this).closest("tr").find("#id_menu_lvl3").val();
	let id_menu_lvl2 = $(this).closest("tr").find("#id_menu_lvl2").val();
	let url = $(this).closest("tr").find("#url").val();
	let title = $(this).closest("tr").find("#title").val();
	let icon = $(this).closest("tr").find("#icon").val();
	let is_active = $(this).closest("tr").find("#is_active").val();

	// console.log(id_menu_lvl3);
	// console.log(id_menu_lvl2);
	// console.log(url);
	// console.log(title);
	// console.log(icon);
	// console.log(is_active);
	// console.log(status_sub);

	$(".modal-body #edit_id_menu_lvl3").val(id_menu_lvl3);
	$(".modal-body #edit_url").val(url);
	$(".modal-body #edit_title").val(title);
	$(".modal-body #edit_icon").val(icon);
});

$("button[name='btnHapus']").click(function (e) {
	e.preventDefault();
	let id_menu_lvl3 = $(this).closest("tr").find("#id_menu_lvl3").val();

	let formData = new FormData();
	formData.append("id_menu_lvl3", id_menu_lvl3);

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
				url: "menulevel3/delete_data/menulevel3.php",
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
