@extends('layoutUtama.dashboard')
@section('title','gejala Penyakit')
@if(auth()->user()->level == 'admin')
    @section('buttons') 
    <div class="text-end upgrade-bt mr-5 mb-3 mt-3">
        <a href="{{ route('add-gejala') }}"
            class="btn btn-success d-none d-md-inline-block text-white">
            Tambah Gejala
        </a>
    </div>
    @endsection
@endif
    @section('contents') 
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama Gejala</th>
                    @if(auth()->user()->level == 'admin')
                        <th scope="col">Status</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($gejala as $gejalas)
                    <tr>
                        <th scope="row">{{ $loop->index+1+($gejala->currentPage()-1)*5}} </th>     <!--  looping dari metdhod index pada controller -->
                        <td>{{ $gejalas->nama_gejala }} </td>
                        @if(auth()->user()->level == 'admin')
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                @csrf
                                <a type="button" class="btn btn-info" href="{{route('edit-gejala', $gejalas->id)}}">Edit</a>
                            </div>
                            <form action="{{route('delete-gejala',$gejalas->id)}}" method='post' class='d-inline'onsubmit="return confirm('Apakah kamu yakin ingin menghapus agenda ini ?')">
                                @csrf
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                        @endif
                    </tr> 
                @endforeach
                </tbody>
            </table>
        <div class='mt-4 text-center'>
            showing
            {{ $gejala->firstItem() }}
            to
            {{ $gejala->lastItem() }}
            of
            {{ $gejala->total()   }}
        </div>
        <div>
            {{ $gejala->links() }}
        </div>
    </div>
@endsection