<style>
	#head td {
		color: #333;
		font-weight: bold;
	}

	table {
		margin-bottom: 50px;
	}
</style>

<h5>Kode Pesanan:</h5>
<h1 style="tetext-align: center;">#{{ $pemesanan->kode_pemesanan }}</h1>

<p style="font-weight: bold;">Informasi Penumpang</p>
<table border="1">
  <tr style="padding: 10px;" id="head">
    <td>Nama</td>
    <td>Email</td>
    <td>Jenis Kelamin</td>
    <td>Nomor Telepon</td>
  </tr>

  <tr>
    <td>{{ $penumpang->nama_penumpang }}</td>
    <td>{{ $penumpang->email }}</td>
    <td>{{ $penumpang->jenis_kelamin }}</td>
    <td>{{ $penumpang->telefone }}</td>
  </tr>
</table>

<p style="font-weight: bold;">Informasi Pesanan</p>
<table border="1">
  <tr style="padding: 10px;" id="head">
    <td>Tanggal Pemesanan</td>
    <td>Tanggal Berangkat</td>
    <td>Total Bayar</td>
  </tr>

  <tr>
    <td>{{ date('d F Y', strtotime($pemesanan->tanggal_pemesanan)) }}</td>
    <td>{{ date('d F Y', strtotime($pemesanan->tanggal_berangkat)) }}</td>
    <td>{{ $pemesanan->total_bayar }}</td>
  </tr>
</table>

<p style="font-weight: bold;">Informasi Rute</p>
<table border="1">
  <tr style="padding: 10px;" id="head">
    <td>Rute Awal</td>
    <td>Rute Akhir</td>
    <td>Nama Transportasi</td>
		<td>Kelas</td>
  </tr>

  <tr>
    <td>{{ $rute->rute_awal }}</td>
    <td>{{ $rute->rute_akhir }}</td>
    <td>{{ $rute->transportasi->nama_transportasi }}</td>
		<td>{{ $rute->type->nama_type }}</td>
  </tr>
</table>
