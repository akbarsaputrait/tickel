$(function() {
	$('b[role="presentation"]').hide();
	$('.select2-selection__arrow').append('<i class="fa fa-angle-down"></i>');
		$(document).on('click', '#cariTiket', function(event) {
			event.preventDefault();

			var rute_awal = $("select[name='rute_awal']").val();
			var rute_akhir = $("select[name='rute_akhir']").val();

			if(rute_awal === "" || rute_akhir === ""){
				Swal({
					title: 'Gagal!',
					text: 'Anda harus memilih kota asal dan tujuan terlebih dahulu.',
					type: "error",
					buttonsStyling: false,
					showCancelButton: false,
					showConfirmButton: false,
					timer: 2000
				});
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
															'<td>' + v.jumlah_kursi + '</td>' +
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
			e.preventDefault();
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
					$('input[name="harga"]').val(data.harga).attr("readonly", true);
					$('input[name="tujuan"]').val(data.tujuan);
					$('#id_rute').val(idrute);
					$('input[name="tanggal_berangkat"]').focus();
					$("#cariTiket").hide();
					$("#pesanTiketButton").removeClass('d-none');
					$("#clearButton").removeClass('d-none');
					$("#clearButton").addClass('mt-4');
				}
			})
		});

		$(document).on('change', 'select[name="rute_akhir"]', function() {
			var val = $(this).val();
			$('input[name="tujuan"]').val(val);
		});

		$(document).on('change', 'select[name="rute_awal"]', function() {
			var val = $(this).val();
			$('input[name="tempat_pemesanan"]').val(val);
		});

		$(document).on('click', '#clearButton', function() {
			$('select[name="kelas"]').attr('disabled', true).val('');
			$('select[name="transportasi"]').attr('disabled', true).val('');
			$('input[name="jam_berangkat"]').attr('disabled', true).val('');
			$('input[name="harga"]').attr('disabled', true).val('');
			$('input[name="tempat_pemesanan"]').attr('disabled', true).val('');
			$('select[name="rute_awal"]').val('');
			$('select[name="rute_akhir"]').val('');
			$('input[name="tujuan"]').val('');
			$('input[name="id_rutes"]').val('');
			$('input[name="tempat_pemesanan"]').val('');
			$('input[name="tanggal_berangkat"]').val('');
			$("#cariTiket").show();
			$("#pesanTiketButton").addClass('d-none');
			$("#clearButton").addClass('d-none');
		});

		$(document).on('click', '#cancelOrder', function() {
      var link = $(this).data('link');
			Swal({
				type: 'warning',
				title: 'Anda yakin?',
				text: 'Pesanan anda dibatalkan dan tidak akan kami proses.',
				showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya!',
				cancelButtonText: 'Tidak'
			}).then((result) => {
				if(result.value) {
					window.open(link, '_self');
				}else {
					swal.close();
				}
			});
		});
});
