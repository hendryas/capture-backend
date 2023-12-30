$(".logout").click(function (e) {
	e.preventDefault();
	Swal.fire({
		title: "Apakah Anda Yakin Ingin Keluar?",
		icon: "question",
		showCancelButton: true,
		confirmButtonColor: "#19A87E",
		cancelButtonColor: "#ff3d60",
		confirmButtonText: "Ya, Lanjutkan!",
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				url: "http://localhost/inaakustock/user/logout/user.php",
				cache: false,
				contentType: false,
				processData: false,
				success: (response) => {
					let obj = JSON.parse(response);
					if (obj.status == "OK") {
						Swal.fire("Sukses!", obj.message, "success").then(() => {
							// window.location.href = "login";
							window.location.replace("http://localhost/inaakustock/login");
						});
					} else {
						Swal.fire("Oops!", obj.message, "error");
					}
				},
			});
		}
	});
});
