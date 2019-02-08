<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Illuminate\Notifications\Messages\MailMessage;
use PDF;
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
      $data['pemesanan'] = Pemesanan::with('petugas')->orderBy('id_pemesanan', 'DESC')->limit(10)->get();
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
      $data['pemesanan'] = Pemesanan::where('kode_pemesanan', '=', $id)->first();
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
        $pesanan = Pemesanan::where('kode_pemesanan', '=', $id)->where('status', '=', 'cancel')->first();
        $pesanan->status = $request->status;
        $pesanan->id_petugas = auth()->guard('petugas')->user()->id_petugas;
        $pesanan->save();

        // SEND EMAIL TO USER
        $to = "akbarsaputra-548bce@inbox.mailtrap.io";
        Mail::to($to)->send(new TicketMail(
          auth()->guard('petugas')->user()->email, // EMAIL PETUGAS
          "Tiket telah kami konfirmasi. Terima kasih telah menggunakan jasa kami :)", // CONTENT EMAIL
          'success', // STATUS VERIFIKASI
          $to, // TO USER
          'https://web.snmptn.ac.id'
        ));

        session()->flash('status','success');
        session()->flash('message', 'Pesanan berhasil diperbarui dan email berhasil dikirim!');
        return redirect()->route('petugas.order.index');
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

      // Send data to the view using loadView function of PDF facade
      $pdf = PDF::loadView('templates.export_pdf_pesanan', $data);

      // If you want to store the generated pdf to the server then you can use the store function
      $pdf->save(public_path('export/pdf/').$data['pemesanan']->kode_pemesanan.'-'. time() .'.pdf');

      // Finally, you can download the file using download function
      return $pdf->download($data['pemesanan']->kode_pemesanan.'-'. date('Y-m-d') .'.pdf');
    }
}
