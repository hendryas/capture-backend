$(document).on("click", "#btnCatatan", function (e) {
	let id_bar = $(this).closest("tr").find("#id_bar").val();
	let catatan_tambah_stok = $(this)
		.closest("tr")
		.find("#catatan_tambah_stok")
		.val();
	let catatan_sisa_stok = $(this)
		.closest("tr")
		.find("#catatan_sisa_stok")
		.val();

	// console.log(id_bar);
	// console.log(catatan_tambah_stok);
	// console.log(catatan_sisa_stok);

	$(".modal-body #id_bar").val(id_bar);
	if (catatan_tambah_stok == null || catatan_tambah_stok == "") {
		let catatan_tambah_stok = "Tidak Ada Catatan";
		$(".modal-body #catatan_tambah_stok").html(catatan_tambah_stok);
	} else {
		$(".modal-body #catatan_tambah_stok").html(catatan_tambah_stok);
	}

	if (catatan_sisa_stok == null || catatan_sisa_stok == "") {
		let catatan_sisa_stok = "Tidak Ada Catatan";
		$(".modal-body #catatan_sisa_stok").html(catatan_sisa_stok);
	} else {
		$(".modal-body #catatan_sisa_stok").html(catatan_sisa_stok);
	}
});
