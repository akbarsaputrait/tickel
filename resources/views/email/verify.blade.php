@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => 'Verifikasi Akun!',
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

        <p>Hallo, {{ $nama_penumpang }} (@ {{ $username }})!</p>
        <br>
        <p>Silahkan klik tombol dibawah untuk memverifikasi akun anda.</p>

    @include('beautymail::templates.sunny.contentEnd')

    @include('beautymail::templates.sunny.button', [
        	'title' => 'Verifikasi Akun',
        	'link' => "http://localhost:8000/penumpang/verify/". $token
    ])

@stop
