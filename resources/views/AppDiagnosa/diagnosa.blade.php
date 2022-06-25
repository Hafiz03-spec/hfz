@extends('layoutUtama.dashboard')
@section('title','gejala Penyakit')
@section('contents')  
@section('buttons') 
<div class="text-end upgrade-bt mr-5 mt-2 mb-3">
    <a href="{{ route('diagnosa2') }}"
        class="btn btn-success d-none d-md-inline-block text-white">
        Cek Penyakit
    </a>
</div>
@endsection
    <table class="table mt-3">
        <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Pasien</th>
            <th scope="col">Nama Penyakit</th>
            <th scope="col">Tanggal Diagnosa</th>
            <th scope="col">Persentase Terkena</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $gejalas)
            <tr>
                <th scope="row">{{ $loop->index+1+($data->currentPage()-1)*5}} </th>     <!--  looping dari metdhod index pada controller -->
                <td>{{ $gejalas->name }} </td>
                <td>{{ $gejalas->nama_penyakit }} </td>
                <td>{{ $gejalas->tanggal }} </td>
                <td>{{ $gejalas->persentase_Terkena }} % </td>
                <td>
                    @if(strtotime($gejalas->tanggal) > strtotime($time))
                        <button class="btn btn-primary">New</button>
                    @else
                        <button class="btn btn-danger">New</button>
                    @endif
                </td>
                <td>
                    <form action="{{route('delete-diagnosa',$gejalas->id)}}" method='post' class='d-inline'onsubmit="return confirm('Apakah kamu yakin ingin menghapus agenda ini ?')">
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr> 
        @endforeach
        </tbody>
    </table>
        <div class='mt-4 text-center'>
            showing
            {{ $data->firstItem() }}
            to
            {{ $data->lastItem() }}
            of
            {{ $data->total()   }}
        </div>
        <div>
            {{ $data->links() }}
        </div>
    </div>
@endsection