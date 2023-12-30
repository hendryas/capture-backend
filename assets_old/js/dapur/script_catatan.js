// $(document).on("click", "#btnCatatanDapur", function (e) {
// 	e.preventDefault();
// 	let id_dapur = $(this).closest("tr").find("#id_dapur").val();
// 	console.log(id_dapur);

// 	$.ajax({
// 		url: "<?php echo site_url('dapur/getCatatan')?>",
// 		method: "POST",
// 		data: { id_dapur },
// 		dataType: "JSON",
// 		cache: false,
// 		success: function (response) {
// 			$("#modalCatatan").modal({
// 				show: true,
// 				keyboard: false,
// 			});
// 			$("#modalCatatan").html(response);
// 		},
// 	});
// });

$(document).on("click", "#btnCatatan", function (e) {
	let id_dapur = $(this).closest("tr").find("#id_dapur").val();
	let catatan_tambah_stok = $(this)
		.closest("tr")
		.find("#catatan_tambah_stok")
		.val();
	let catatan_sisa_stok = $(this)
		.closest("tr")
		.find("#catatan_sisa_stok")
		.val();

	// console.log(id_dapur);
	// console.log(catatan_tambah_stok);
	// console.log(catatan_sisa_stok);

	$(".modal-body #id_dapur").val(id_dapur);
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
