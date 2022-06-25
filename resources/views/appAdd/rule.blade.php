@extends('layoutUtama.dashboard')
@section('title', 'Rule Add')
@section('contents')
    <form action="{{route('save-rule')}}" style="width:500px" method="POST" >
        @csrf
            <div class="form-group mt-2">
                <label class="col-md-12 mb-0 mb-2" for="penyakit_id">Nama Penyakit</label>
                <div class="col-md-12">
                    <select class="form-control" id="penyakit_id" style="width:1180px" name="penyakit_id">
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
                <label class="col-md-12 mb-0 mb-2" for="gejala_id">Nama Gejala</label>
                <div class="col-md-12">
                    <select class="form-control" id="gejala_id" style="width:1180px" name="gejala_id">
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
                <label class="col-md-12 mb-0 mb-2"  for="nilai_cf">Nilai CF</label>
                <div class="col-md-12">
                    <input type="decimal" style="width:1180px;" class="form-control ps-0 form-control-line @error ('nilai_cf') is-invalid @enderror" id="nilai_cf" name="nilai_cf">
                </div>
                <div class="text-danger">
                    @error('nilai_cf')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-3">Simpan</button>
            <a type="button" class="btn btn-info mt-3" href="{{route('data-rule')}}">Kembali</a>
            </div>
    </form>
</div>
@endsection
