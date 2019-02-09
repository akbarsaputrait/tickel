@extends('errors.layout')

@section('bgcolor', 'warning')
@section('code', '403')
@section('title', 'Terlarang')

@section('message', __($exception->getMessage() ?: 'Maaf, Anda dilarang mengakses halaman ini.'))
