$(document).ready(function() {
var TIMEOUT = 2000;

	$(document).on('click', '#deleteButton', function() {
			var id 	 = $(this).data('id'),
					menu = $(this).data('menu');

			Swal({
				title: "Anda yakin untuk menghapusnya?",
				text: "Data akan hilang jika anda menghapusnya.",
				type: "warning",
				showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya!',
				cancelButtonText: 'Tidak'
			}).then((result) => {
				if(result.value) {

					$.ajax({
						type: 'GET',
						url: '/admin/'+menu+"/delete/"+id,
						success: function(data) {
							if(data.success) {
								Swal({
									title: 'Berhasil!',
									text: 'Data berhasil dihapus.',
									type: "success",
									timer: TIMEOUT,
									showConfirmButton: false
								});
								location.reload();
							}
						}
					})
				}else {
					swal.close();
				}
			});
	});
});
