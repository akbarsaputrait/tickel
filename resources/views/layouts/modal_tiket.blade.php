<!-- // end .section -->
<!-- MODAL -->
<div class="modal fade" id="showTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 1000px !important;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Daftar ketersedian tiket</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body d-flex justify-content-center">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped table-responsive">
							<thead>
								<th>Rute Awal</th>
								<th>Rute Akhir</th>
								<th>Harga</th>
								<th>Jam Berangkat</th>
								<th>Jam Tiba</th>
								<th>Nama Transportasi</th>
								<th></th>
							</thead>
							<tbody id="dataTiket">
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
