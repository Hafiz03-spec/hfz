@extends('layoutUtama.dashboard')
@section('title','Diagnosa')
@section('contents')  
<div class="justify-content-center">
<div class="card " style="width: 75rem;">
    <div class="card-header bg-dark" style="color: aliceblue" >
        <div class="text-center">
            Hasil Diagnosa
        </div>
    </div>
    <div class="card-header bg-dark" style="color: aliceblue" >
        <div class="text-center">
            Anda Terdiagnosa {{ count($data_sementara) }} Penyakit
        </div>
    </div>
    <ul class="list-group list-group-flush">
    @foreach($data_sementara as $data)
      <li class="list-group-item">Nama Pasien : {{ $data->name }}</li>
      <li class="list-group-item">Tanggal Cek : {{ $data->created_at }} </li>
      <li class="list-group-item">Terkena Penyakit : {{ $data->nama_penyakit }} </li>
      <li class="list-group-item">Persentase Terkena : {{ $data->persen }} %</li>
      <li class="list-group-item"> </li>
    @endforeach
    <a type="button" class="btn btn-dark mt-3" href="{{route('data-penyakit')}}">Kembali</a>
    </ul>
  </div>
</div>
  @endsection