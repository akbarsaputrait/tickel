<div class="row">
	<div class="col-md-12">
		<table class="table table-stripped">
			<thead class="thead-dark">
				<th>Kode Pemesanan</th>
				<th>Status</th>
				<th>Total Harga</th>
				<th>Rute Awal</th>
				<th>Rute Akhir</th>
				<th>Tanggal Pemesanan</th>
			</thead>
			<tbody>
				@foreach($pemesanan as $item)
				<tr>
					<td>
						<a href="{{ route('pembayaran.show', ['id_pemesanan' => $item->kode_pemesanan]) }}" class="btn btn-primary btn-sm">#{{ $item->kode_pemesanan }}</a>
						<br> <span class="text-small text-muted" style="font-size: 70%;">{{ $item->created_at->diffForHumans() }}</span>
					</td>
					<td>
						<span class="badge badge-warning">{{ ucfirst($item->status) }}</span>
					</td>
					<td>
						Rp. {{ $item->total_bayar }}
					</td>
					<td>{{ $item->rute->rute_awal }}</td>
					<td>{{ $item->rute->rute_akhir }}</td>
					<td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
