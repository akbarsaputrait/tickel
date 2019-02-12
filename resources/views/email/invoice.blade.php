<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Invoice | Tickel</title>

  <style>
    .invoice-box {
      max-width: 800px;
      margin: auto;
      padding: 30px;
      border: 1px solid #eee;
      box-shadow: 0 0 10px rgba(0, 0, 0, .15);
      font-size: 16px;
      line-height: 24px;
      font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
      color: #555;
    }

    .invoice-box table {
      width: 100%;
      line-height: inherit;
      text-align: left;
    }

    .invoice-box table td {
      padding: 5px;
      vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
      text-align: right;
    }

    .invoice-box table tr.top table td {
      padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
      font-size: 45px;
      line-height: 45px;
      color: #333;
    }

    .invoice-box table tr.information table td {
      padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
      background: #eee;
      border-bottom: 1px solid #ddd;
      font-weight: bold;
    }

    .invoice-box table tr.details td {
      padding-bottom: 20px;
    }

    .invoice-box table tr.item td {
      border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
      border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
      border-top: 2px solid #eee;
      font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
      .invoice-box table tr.top table td {
        width: 100%;
        display: block;
        text-align: center;
      }
      .invoice-box table tr.information table td {
        width: 100%;
        display: block;
        text-align: center;
      }
    }
    /** RTL **/

    .rtl {
      direction: rtl;
      font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
      text-align: right;
    }

    .rtl table tr td:nth-child(2) {
      text-align: left;
    }
  </style>
</head>

<body>
  <div class="invoice-box">
    <table cellpadding="0" cellspacing="0">
      <tr class="top">
        <td colspan="2">
          <table>
            <tr>
              <td class="title">
                <img src="http://localhost:8000/home/images/logo.png" style="width:100%; max-width:300px;">
              </td>

              <td>
                Kode Pesanan #: {{ $pemesanan->kode_pemesanan }}
                <br> Dibuat pada: {{ date('d F Y', strtotime($pemesanan->created_at)) }}
                <!-- <br> Due: February 1, 2015 -->
              </td>
            </tr>
          </table>
        </td>
      </tr>

      <tr class="heading">
        <td>
          Pesanan
        </td>

        <td>
          Harga
        </td>
      </tr>
      <tr class="item">
        <td>
					{{ $rute->rute_awal }} - {{ $rute->rute_akhir }}
          <br>{{ $rute->transportasi->nama_transportasi }} | {{ $rute->type->nama_type }}
					<br>Jam Berangkat : {{ date('H:i A', strtotime($rute->jam_berangkat)) }}
					<br>Jam Tiba : {{ date('H:i A', strtotime($rute->jam_tiba)) }}
        </td>

        <td>
          Rp. {{ $rute->harga }}
        </td>
      </tr>

      <tr class="total">
        <td></td>

        <td>
          Total: Rp. {{ $pemesanan->total_bayar }}
        </td>
      </tr>

			<tr class="heading">
        <td>
					Atas Nama
        </td>
				<td>
					Nama Bank
				</td>
        <td>
          Nomor Rekening
        </td>
      </tr>
			@foreach($rekening as $item)
      <tr class="item">
        <td>
					{{ $item->atas_nama }}
        </td>
				<td>
					{{ $item->nama_bank }}
				</td>
        <td>
					{{ $item->no_rekening }}
        </td>
      </tr>
			@endforeach
    </table>

		<tr class="heading">
			<td>
				Kirim bukti pembayaran <a href="{{ route('pembayaran.show', ['id_pemesanan' => $pemesanan->kode_pemesanan]) }}" target="_blank">disini</a>
			</td>
		</tr>
  </div>
</body>

</html>
