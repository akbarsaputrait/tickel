@extends('beautymail::templates.ark')

@section('content')

@include('beautymail::templates.ark.heading', [
		'heading' => 'Informasi Pesaanan Anda',
		'level' => 'h1'
	])

	@include('beautymail::templates.ark.contentStart', ['color' => "#333"])

	<h4 class="secondary"><strong>Halo, {{ $pemesanan->pelanggan->nama_penumpang }}</strong></h4>
	<p>Kode Pemesanan : </p>
	<h1 class="secondary">#{{ $pemesanan->kode_pemesanan }}</h1>
	<br><br>
	<p>Kode Kursi : </p>
	<h1 class="secondary">#{{ $pemesanan->kode_kursi }}</h1>
	@switch($pemesanan->status)
			@case("done")
					<h3 class="secondary" style="color: green;">{{ ucfirst($pemesanan->status) }}</h3>
				@break

			@case("proccess")
					<h3 class="secondary" style="color: blue;">{{ ucfirst($pemesanan->status) }}</h3>
				@break

			@case("pending")
					<h3 class="secondary" style="color: yellow;">{{ ucfirst($pemesanan->status) }}</h3>
			@break

			@case("cancel")
				<h3 class="secondary" style="color: red;">{{ ucfirst($pemesanan->status) }}</h3>
			@break

			@default
				<h3 class="secondary" style="color: darkblue;">{{ ucfirst($pemesanan->status) }}</h3>
		@endswitch
	@include('beautymail::templates.ark.contentEnd')

	@include('beautymail::templates.ark.contentStart')

        <h4 class="secondary"><strong>Informasi Rute :</strong></h4>
        <table border="1">
        	<thead>
        		<th>Rute Awal</th>
						<th>Rute Akhir</th>
						<th>Total Biaya</th>
						<th>Jam Berangkat</th>
						<th>Transportasi</th>
        	</thead>
					<tbody>
						<tr>
							<td>{{ $rute->rute_awal }}</td>
							<td>{{ $rute->rute_akhir }}</td>
							<td>Rp. {{ $pemesanan->total_bayar }}</td>
							<td>{{ $rute->jam_berangkat }}</td>
							<td>{{ $rute->transportasi->nama_transportasi }} - {{ $rute->type->nama_type }}</td>
						</tr>
					</tbody>
        </table>
				<br>
				<br>

				<h4 class="secondary"><strong>Bukti pembayaran :</strong></h4>
				<br>
				<a href="{{ asset('uploads/images/bukti-pembayaran/'.$bukti->file) }}" target="_blank" style="text-align:center;">
					<img src="{{ asset('uploads/images/bukti-pembayaran/'.$bukti->file) }}" width="150" alt="">
				</a>

  @include('beautymail::templates.ark.contentEnd')

	@include('beautymail::templates.ark.contentStart')

        <h4 class="secondary"><strong>Keterangan :</strong></h4>
        <p>{{ (is_null($keterangan)) ? '-' : $keterangan }}</p>

  @include('beautymail::templates.ark.contentEnd')

@stop
