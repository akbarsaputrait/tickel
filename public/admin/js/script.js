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
						url: '/admin/admin/'+menu+"/hapus/"+id,
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

	$(document).on('keyup', '#hargaRute', function(e) {
		$(this).val(formatRupiah($(this).val()));
	});

	$("#hargaRute").val(formatRupiah($("#hargaRute").val()));

	function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
});
