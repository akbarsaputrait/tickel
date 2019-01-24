$(function() {
	$(document).on('click', '#cariTiket', function(event) {
		event.preventDefault;

		var rute_awal = $("select[name='rute_awal']").val();
		var rute_akhir = $("select[name='rute_akhir']").val();

		if(rute_awal === "" || rute_akhir === ""){
			alert('Anda harus memilih kota asal dan tujuan terlebih dahulu');
		} else {
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: 'api/cariTransportasi',
				data: {
					rute_awal: rute_awal,
					rute_akhir: rute_akhir
				},
				beforeSend: function() {
					swal.showLoading();
				},
				success: function(data) {
					swal.close();
					var data = data.transportasi;
					console.log(data);
					if(data.length > 0) {
						var table = $("#dataTiket");
						$.each(data, function(k,v){
							var tableData =
													'<tr>' +
														'<td>' + v.rute_awal + '</td>' +
														'<td>' + v.rute_akhir + '</td>' +
														'<td>Rp. ' + v.harga + '</td>' +
														'<td>' + v.jam_berangkat + '</td>' +
														'<td>' + v.jam_tiba + '</td>' +
														'<td>' + v.type_transportasi + ' - ' + v.nama_transportasi + ' <span class="badge badge-primary">'+ v.nama_type +'</span>' + '</td>' +
														'<td>'+
															'<button class="btn btn-primary-custom" id="idRute" data-idrute="'+ v.id_rute +'">Pilih</button>'+
														'</td>' +
													'</tr>';
							table.append(tableData);
						});
						$('#showTicket').modal('show');
						$(document).on('hide.bs.modal', '#showTicket', function() {
							table.empty();
						});
						// $.each(data, function(k, v){
						// 	Swal({
						// 		title: 'Berhasil!',
						// 		text: 'Tiket dengan rute awal '+ v.rute_awal +' dan rute akhir '+ v.rute_akhir +' berhasil ditemukan',
						// 		type: "success",
						// 		confirmButtonClass: 'btn btn-primary-custom mr-3',
						// 		cancelButtonClass: 'btn btn-danger-custom',
						// 		buttonsStyling: false,
						// 		showCancelButton: true,
						// 		confirmButtonText: 'Lanjut pemesanan',
						// 		cancelButtonText: 'Batalkan',
						// 	}).then((result) => {
						// 		if(result.value) {
						// 			swal.close();
						// 			$("#cariTiket").attr('value', 'Pesan tiket');
						// 			$("#cariTiket").attr('class', 'btn btn-primary-custom');
						// 			$("#cariTiket").attr('type', 'submit');
						// 			$("#pesanTiket").attr('action', '#');
						//
						// 			$("select[name='transportasi']").val(v.type_transportasi);
						// 		}else {
						// 			$("select[name='rute_awal']").val('');
						// 			$("select[name='rute_akhir']").val('');
						// 			swal.close();
						// 		}
						// 	});
						// });
					} else {
						Swal({
							title: 'Gagal!',
							text: 'Tiket dengan rute awal '+ rute_awal +' dan rute akhir '+ rute_akhir +' tidak ditemukan',
							type: "error",
							cancelButtonClass: 'btn btn-danger-custom ',
							buttonsStyling: false,
							showCancelButton: true,
							showConfirmButton: false,
							cancelButtonText: 'Lanjut pemesanan',
						});
					}
				}
			});
		}
	});

	$(document).on('click', '#idRute', function(e) {
		e.preventDefault;
		var idrute = $(this).data('idrute');

		$.ajax({
			url: 'api/cariTransportasiBy/' + idrute,
			beforeSend: function() {
				swal.showLoading();
			},
			success: function(data) {
				swal.close();
				$('#showTicket').modal('hide');
				var data = data.rute[0];
				$("select").removeAttr('disabled');
				$("input").removeAttr('disabled');
				$('select[name="rute_awal"]').val(data.rute_awal);
				$('select[name="rute_akhir"]').val(data.rute_akhir);
				$('select[name="transportasi"]').val(data.nama_transportasi);
				$('select[name="kelas"]').val(data.nama_type);
				$('input[name="jam_berangkat"]').val(data.jam_berangkat);

				$("#cariTiket").attr('value', 'Pesan tiket');
				$("#cariTiket").attr('class', 'btn btn-primary-custom mt-4');
				$("#cariTiket").attr('type', 'submit');
				$("#pesanTiket").attr('action', '#');
				$("#clearButton").removeClass('d-none');
				$("#clearButton").addClass('mt-4');
			}
		})
	});

	$(document).on('click', '#clearButton', function() {
		$('select[name="kelas"]').attr('disabled', true);
		$('select[name="transportasi"]').attr('disabled', true);
		$('input[name="jumlah_kursi"]').attr('disabled', true);
		$('input[name="tanggal_berangkat"]').attr('disabled', true);
		$('input[name="jam_berangkat"]').attr('disabled', true);
		$('select[name="rute_awal"]').val('');
		$('select[name="rute_akhir"]').val('');
		$('select[name="transportasi"]').val('');
		$('select[name="kelas"]').val('');
		$('input[name="jam_berangkat"]').val('');

		$("#cariTiket").attr('value', 'Cari Tiket');
		$("#cariTiket").attr('class', 'btn btn-primary custom mt-4');
		$("#cariTiket").attr('type', 'button');
		$("#pesanTiket").attr('action', '#');
		$("#clearButton").addClass('d-none');
	});
});
