@extends('errors.layout')

@section('bgcolor', 'dark')
@section('code', '503')
@section('title', 'Layanan tidak tersedia')

@section('message', __($exception->getMessage() ?: 'Maaf, kami sedang melakukan beberapa pemeliharaan. Silakan periksa kembali nanti.'))
