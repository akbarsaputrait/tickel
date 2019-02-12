<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Illuminate\Notifications\Messages\MailMessage;
use PDF;
use Snowfire\Beautymail\Beautymail;
use App\Mail\TicketMail;
use App\Pemesanan;
use App\Penumpang;
use App\Rute;
use App\Petugas;
use App\BuktiPembayaran;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['pemesanan'] = Pemesanan::with(['petugas', 'admin'])->orderBy('id_pemesanan', 'DESC')->get();
      return view('layouts.petugas.order.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $data['pemesanan'] = Pemesanan::with(['petugas', 'admin'])->where('kode_pemesanan', '=', $id)->first();
      $data['pembayaran'] = BuktiPembayaran::where('id_pemesanan', '=', $data['pemesanan']->id_pemesanan)->first();
      $data['penumpang'] = Penumpang::find($data['pemesanan']->id_pelanggan)->first();
      $data['rute'] = Rute::with(['transportasi', 'type'])->where('id_rute', '=', $data['pemesanan']->id_rute)->first();
      $data['petugas'] = Petugas::find($data['pemesanan']->id_petugas);
      // dd($data);
        return view('layouts.petugas.order.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'status' => 'required'
      ], [
        'status.required' => 'Status harus diisi'
      ]);

      $pesanan = Pemesanan::with(['pelanggan'])->where('kode_pemesanan', '=', $id)->where('status', '!=', 'cancel')->first();
      $pesanan->status = $request->status;
      $pesanan->id_petugas = auth()->guard('petugas')->user()->id_petugas;
      $pesanan->keterangan = $request->keterangan;
      $pesanan->save();

        // SEND EMAIL TO USER
        $to = "akbarsaputra-548bce@inbox.mailtrap.io";
        $beautymail = app()->make(Beautymail::class);
          $beautymail->send('email.ticket', [
            // DATA
            'rute' => Rute::with(['transportasi', 'type'])->where('id_rute', '=', $pesanan->id_rute)->first(),
            'pemesanan' => $pesanan,
            'keterangan' => $request->keterangan,
            'bukti' => BuktiPembayaran::where('id_pemesanan', '=', $pesanan->id_pemesanan)->first()
          ], function($message)
          {
              $message
          			->from(auth()->guard('petugas')->user()->email)
          			->to('akbarsaputra-548bce@inbox.mailtrap.io')
          			->subject('Informasi Pesanan | Tickel');
          });

          $bukti = BuktiPembayaran::where('id_pemesanan', '=', $pesanan->id_pemesanan)->first();
          $bukti->id_petugas = auth()->guard('petugas')->user()->id_petugas;
          $bukti->save();

        session()->flash('status','success');
        session()->flash('message', 'Pesanan berhasil diperbarui dan email berhasil dikirim!');
        return redirect()->route('petugas.order.show', ['order' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function export($kode) {
      $data['pemesanan'] = Pemesanan::where('kode_pemesanan', '=', $kode)->first();
      $data['pembayaran'] = BuktiPembayaran::where('id_pemesanan', '=', $data['pemesanan']->id_pemesanan)->first();
      $data['penumpang'] = Penumpang::find($data['pemesanan']->id_pelanggan)->first();
      $data['rute'] = Rute::with(['transportasi', 'type'])->where('id_rute', '=', $data['pemesanan']->id_rute)->first();
      $data['petugas'] = Petugas::find($data['pemesanan']->id_petugas);
      // $data['bukti'] = BuktiPembayaran::where('id_pemesanan', '=', $data['pemesanan']->id_pemesanan)->first();


      // Send data to the view using loadView function of PDF facade
      $pdf = PDF::loadView('templates.export_pdf_pesanan', $data);

      // If you want to store the generated pdf to the server then you can use the store function
      $pdf->save(public_path('export/pdf/').$data['pemesanan']->kode_pemesanan.'-'. time() .'.pdf');

      // Finally, you can download the file using download function
      return $pdf->download($data['pemesanan']->kode_pemesanan.'-'. date('Y-m-d') .'.pdf');
    }

}
