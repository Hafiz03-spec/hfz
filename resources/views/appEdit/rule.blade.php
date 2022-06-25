@extends('layoutUtama.layoutEdit')
@section('title', 'Rule Edit')
@section('contents')
    <form action="{{route('save-edit-rule', $rule->id )}}" method="POST" >
        @csrf
        <div class="col-lg-12 col-xlg-9 col-md-7 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 col-xlg-9 col-md-7 mt-3">
                        <form class="form-horizontal form-material mx-2">
                            <div class="form-group">
                                <label class="col-md-12 mb-0 mb-2" for="penyakit_id">Nama Penyakit</label>
                                <div class="col-md-12">
                                    <select class="form-control" id="id_penyakit" style="width:820px;" name="id_penyakit">
                                        @foreach($penyakit as $penyakits)
                                            <option value="{{ $penyakits->id }}" readonly>{{ $penyakits->nama_penyakit}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-danger">
                                    @error('penyakit_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0 mb-2" for="id_gejala">Nama Gejala</label>
                                <div class="col-md-12">
                                    <select class="form-control" id="id_gejala" style="width:820px;" name="id_gejala">
                                        @foreach($gejala as $gejalas)
                                            <option value="{{ $gejalas->id }}" readonly>{{ $gejalas->nama_gejala}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="text-danger">
                                    @error('gejala_id')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 mb-0 mb-2" for="nilai_cf">Nilai CF</label>
                                <div class="col-md-12">
                                    <input type="decimal" class="form-control ps-0 form-control-line @error ('nilai_cf') is-invalid @enderror" id="nilai_cf" name="nilai_cf" value="{{ $rule->cf }}">
                                </div>
                                <div class="text-danger">
                                    @error('nilai_cf')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 container">
                                <button type="submit" class="btn btn-success mt-3">Simpan</button>
                                <a type="button" class="btn btn-info mt-3" href="{{route('data-rule')}}">Kembali</a>
                            </div>
                            </div>
                        </form>
                            
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
