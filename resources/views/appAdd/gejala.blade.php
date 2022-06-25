@extends('layoutUtama.dashboard')

@section('title', 'Gejala Add')

@section('contents')
<form action="{{route('save-gejala')}}" method="POST" >
        @csrf
        <div class="col-lg-12 col-xlg-9 col-md-7 mt-3">
            <form class="form-horizontal form-material mx-2">
                <div class="form-group">
                    <label class="col-md-12 mb-0 mb-2" for="nama">Nama Gejala</label>
                    <div class="col-md-12">
                        <input type="text" placeholder=""
                            class="form-control ps-0 form-control-line @error ('nama') is-invalid @enderror" id="nama" name="nama" autofocus>
                    </div>
                    <div class="text-danger">
                        @error('nama')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3 mb-2">Simpan</button>
                <a type="button" class="btn btn-info mt-3 mb-2" href="{{route('data-gejala')}}">Kembali</a>
                </div>
            </form>  
        </div>
    </form>
</div>
@endsection