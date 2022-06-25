@extends('layoutUtama.layoutEdit')
@section('title', 'Gejala Edit Save')
@section('contents')
<form action="{{route('save-edit-gejala',$gejala->id)}}" method="POST" >
        @csrf
        <div class="col-lg-12 col-xlg-9 col-md-7 mt-3">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal form-material mx-2">
                        <div class="form-group">
                            <label class="col-md-12 mb-0 mb-2" for="nama">Nama Gejala</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control ps-0 form-control-line @error ('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $gejala->nama_gejala }}" autofocus>
                            </div>
                            <div class="text-danger">
                                @error('id_penyakit')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="col-md-12 container">
                            <button type="submit" class="btn btn-success mt-3 ">Simpan</button>
                            <a type="button" class="btn btn-info mt-3 " href="{{route('data-penyakit')}}">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection