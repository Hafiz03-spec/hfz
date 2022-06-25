@extends('layoutUtama.layoutEdit')
@section('title', 'Penyakit Edit Save')
@section('contents')
    <form action="{{route('save-edit-penyakit',$penyakit->id)}}" method="POST" >
        @csrf
        <div class="col-lg-12 col-xlg-9 col-md-7 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 col-xlg-9 col-md-7 mt-3">
                        <form class="form-horizontal form-material mx-2">
                            <div class="form-group">
                                <label class="col-md-12 mb-0 mb-2" for="nama">Nama Penyakit</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control ps-0 form-control-line @error ('nama') is-invalid @enderror" id="nama" name="nama" value="{{ $penyakit->nama_penyakit }}" autofocus>
                                </div>
                                <div class="text-danger">
                                    @error('id_penyakit')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0 mb-2" for="penyebab">Nama Penyebab</label>
                                <div class="col-md-12">
                                    <input type="text" class="form-control ps-0 form-control-line @error ('penyebab') is-invalid @enderror" id="penyebab" name="penyebab" value="{{ $penyakit->penyebab }}">
                                </div>
                                <div class="text-danger">
                                    @error('penyebab')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0 mb-2" for="obat_id">Nama Obat</label>
                                <div class="col-md-12">
                                    <select class="form-control" id="obat_id" style="width:820px;" name="obat_id">
                                        @foreach($obat as $obats)
                                            <option value="{{ $obats->id }}" readonly>{{ $obats->nama_obat}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 container">
                                    <button type="submit" class="btn btn-success mt-3">Simpan</button>
                                    <a type="button" class="btn btn-info mt-3" href="{{route('data-penyakit')}}">Kembali</a>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection