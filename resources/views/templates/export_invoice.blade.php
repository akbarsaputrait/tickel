<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Invoice | Tickel</title>
  <link rel="stylesheet" href="style.css" media="all" />
  <style media="screen">
    @font-face {
      font-family: Junge;
      src: url(Junge-Regular.ttf);
    }

    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }

    a {
      color: #001028;
      text-decoration: none;
    }

    body {
      font-family: Junge;
      position: relative;
      width: 27cm;
      height: 29.7cm;
      margin: 0 auto;
      color: #001028;
      background: #FFFFFF;
      font-size: 14px;
    }

    .arrow {
      margin-bottom: 4px;
    }

    .arrow.back {
      text-align: right;
    }

    .inner-arrow {
      /* padding-right: 10px; */
      height: 30px;
      display: inline-block;
      background-color: rgb(233, 125, 49);
      text-align: center;
      line-height: 30px;
      vertical-align: middle;
    }

    .arrow.back .inner-arrow {
      background-color: rgb(233, 217, 49);
      padding-right: 0;
      /* padding-left: 10px; */
    }

    .arrow:before,
    .arrow:after {
      content: '';
      display: inline-block;
      width: 0;
      height: 0;
      border: 15px solid transparent;
      vertical-align: middle;
    }

    .arrow:before {
      border-top-color: rgb(233, 125, 49);
      border-bottom-color: rgb(233, 125, 49);
      border-right-color: rgb(233, 125, 49);
    }

    .arrow.back:before {
      border-top-color: transparent;
      border-bottom-color: transparent;
      border-right-color: rgb(233, 217, 49);
      border-left-color: transparent;
    }

    .arrow:after {
      border-left-color: rgb(233, 125, 49);
    }

    .arrow.back:after {
      border-left-color: rgb(233, 217, 49);
      border-top-color: rgb(233, 217, 49);
      border-bottom-color: rgb(233, 217, 49);
      border-right-color: transparent;
    }

    .arrow span {
      display: inline-block;
      width: 80px;
      margin-right: 20px;
      text-align: right;
    }

    .arrow.back span {
      margin-right: 0;
      margin-left: 20px;
      text-align: left;
    }

    h1 {
      color: #5D6975;
      font-family: Junge;
      font-size: 2.4em;
      line-height: 1.4em;
      font-weight: normal;
      text-align: center;
      border-top: 1px solid #5D6975;
      border-bottom: 1px solid #5D6975;
      margin: 0 0 2em 0;
    }

    h1 small {
      font-size: 0.45em;
      line-height: 1.5em;
      float: left;
    }

    h1 small:last-child {
      float: right;
    }

    #project {
      float: left;
    }

    #company {
      float: right;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 30px;
    }

    table th,
    table td {
      text-align: center;
    }

    table th {
      padding: 5px 20px;
      color: #5D6975;
      border-bottom: 1px solid #C1CED9;
      white-space: nowrap;
      font-weight: normal;
    }

    table .service,
    table .desc {
      text-align: left;
    }

    table td {
      padding: 20px;
      text-align: right;
    }

    table td.service,
    table td.desc {
      vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
      font-size: 1.2em;
    }

    table td.sub {
      border-top: 1px solid #C1CED9;
    }

    table td.grand {
      border-top: 1px solid #5D6975;
    }

    table tr:nth-child(2n-1) td {
      background: #EEEEEE;
    }

    table tr:last-child td {
      background: #DDDDDD;
    }

    #details {
      margin-bottom: 30px;
    }

    footer {
      color: #5D6975;
      width: 100%;
      height: 30px;
      position: absolute;
      bottom: 0;
      border-top: 1px solid #C1CED9;
      padding: 8px 0;
      text-align: center;
    }
  </style>
</head>

<body>
  <main>
    <h1 class="clearfix"><small><span>Dibuat pada</span><br />{{ date('d F Y', strtotime($pemesanan->created_at)) }}</small> {{ $pemesanan->kode_pemesanan }} <small><span></span><br /> </small></h1>
    <table>
      <thead>
        <tr>
          <th class="service">TIKET</th>
          <th class="desc">KETERANGAN</th>
          <th>HARGA</th>
          <th>JUMLAH</th>
          <th>TOTAL</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="service">{{ $rute->transportasi->nama_transportasi }}</td>
          <td class="desc">
            {{ $rute->rute_awal }} - {{ $rute->rute_akhir }}
            <br>{{ $rute->type->nama_type }}
          </td>
          <td class="unit">Rp. {{ $rute->harga }}</td>
          <td class="qty">{{ count($pemesanan) }}</td>
          <td class="total">{{ $rute->harga * count($pemesanan) }}</td>
        </tr>
        <tr>
          <td colspan="4" class="grand total">TOTAL HARGA</td>
          <td class="grand total">{{ $pemesanan->total_bayar }}</td>
        </tr>
      </tbody>
    </table>
    <br>
    <br>
    <br>

    NOMOR REKENING YANG TERSEDIA

    <br>
    <br>
    @foreach($rekening as $item)
    <div style="color: black; font-size: 15px;">
      <span style="margin-right: 5px;">{{ $item->nama_bank }}</span>
      {{ $item->no_rekening }} - {{ $item->atas_nama }}
    </div>
    @endforeach
    <br>
    <br>
    <br>

    </div>
    <div id="notices">
      <div>KETERANGAN:</div>
      <div class="notice">
        Segera unggah bukti pembayaran untuk melanjutkan transaksi. Terima kasih
      </div>
    </div>
  </main>
</body>

</html>
