<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use PDF;
use Illuminate\Notifications\Messages\MailMessage;
use Snowfire\Beautymail\Beautymail;
use App\Mail\TicketMail;
use App\Pemesanan;
use App\Penumpang;
use App\Rute;
use App\BuktiPembayaran;
use App\Petugas;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['pemesanan'] = Pemesanan::all();
      return view('layouts.admin.order.index')->with($data);
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
        return view('layouts.admin.order.show')->with($data);
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
             'rute' => Rute::with(['transportasi', 'type', 'typeTrans'])->where('id_rute', '=', $pesanan->id_rute)->first(),
             'pemesanan' => $pesanan,
             'keterangan' => $request->keterangan
           ], function($message)
           {
               $message
           			->from(auth()->guard('admin')->user()->email)
           			->to('akbarsaputra-548bce@inbox.mailtrap.io')
           			->subject('Informasi Pesanan | Tickel');
           });

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
       Pemesanan::destroy($id);
       return response()->json(['success' => true]);
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
       // $pdf->save(public_path('export/pdf/').$data['pemesanan']->kode_pemesanan.'-'. time() .'.pdf');

       // Finally, you can download the file using download function
       return $pdf->download($data['pemesanan']->kode_pemesanan.'-'. date('Y-m-d') .'.pdf');
     }
}
