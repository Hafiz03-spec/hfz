@extends('layoutUtama.dashboard')
@section('title','Diagnosa Penyakit')
@section('contents')
    <div class="card-body">
        <div class="panel-body">
            <form method="POST" action="{{ route('diagnosa') }}">
                {{ csrf_field() }}
                <input type="hidden" name="pasien_id" value="{{ auth()->user()->id }}">
                <div class="container form-group">
                    <table class="table user-table no-wrap">
                        <thead class="thead-dark">
                            <tr>
                                <th class="border-top-0">No</th>
                                <th class="border-top-0">Gejala</th>
                                <th class="border-top-0">Nilai CF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=0
                            @endphp
                        <tr>
                            @foreach ($gejalas as $gejala)
                            @php
                                $i++
                            @endphp
                            {{-- <th scope="row">{{ $loop->index+1+($gejalas->currentPage()-1)*5}} </th>     <!--  looping dari metdhod index pada controller --> --}}
                            <td>{{ $i }}</td>
                            <td>{{ $gejala->nama_gejala }}</td>
                            <td>
                                <div class="col-8 " style="padding-right: 2cm">
                                        <select class="status form-control" id="gejala[]" name="gejala[]">
                                            <option value="100" selected="true">-selected-</option>
                                            <option value="1" value={{ $gejala->id }}>Iya</option>
                                            <option value="0.5" value={{ $gejala->id }}>Mungkin Iya</option>
                                            <option value="0.3" value={{ $gejala->id }}>Tidak Tahu</option>
                                            <option value="0.1" value={{ $gejala->id }}>Mungkin Tidak</option>
                                            <option value="0" value={{ $gejala->id }}>Tidak</option>
                                        </select>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right">Cek Hasil Diagnonsa <i class="fa fa-fw fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- <form method="POST" action="{{ route('diagnosa') }}">
    {{ csrf_field() }}
    <input type="hidden" name="pasien_id" value="{{ $pasien_id }}">
    <div class="form-group">
        <div class="col-md-12">
            @foreach ($gejalas as $gejala)
                <div class="checkbox">
                    <label><input class="check" type="checkbox" name="gejala[]" value="{{ $gejala->id }}">{{ $gejala->nama_gejala }}</label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary pull-right">Cek Hasil Diagnonsa <i class="fa fa-fw fa-search"></i></button>
    </div>
</form> --}}
