@extends('layoutUtama.dashboard')
@section('title','Data Penyakit')

@if(auth()->user()->level == 'admin')
    @section('buttons') 
    <div class="text-end upgrade-bt mr-5 mt-2 mb-3">
        <a href="{{ route('add-rule') }}"
            class="btn btn-success d-none d-md-inline-block text-white">
            Tambah Aturan 
        </a>
    </div>
    @endsection
@endif

@section('contents')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="/css/script.css">    

<h1 class="card-title " ></h1>
    <div class="table-responsive">
        <table class="table user-table no-wrap">
            <thead class="thead-dark">
                <tr>
                    <th class="border-top-0">Kode</th>
                    <th class="border-top-0">Nama Penyakit</th>
                    <th class="border-top-0">Gejala</th>
                    <th class="border-top-0">Nilai CF</th>
                    @if(auth()->user()->level == 'admin')
                        <th class="border-top-0">Status</th>
                    @endif
                </tr>
            </thead>
            <tbody>
             @foreach ($rule as $rules)
            <tr>
                <th scope="row">{{ $loop->index+1+($rule->currentPage()-1)*5}} </th>     <!--  looping dari metdhod index pada controller -->
                <td>{{ $rules->nama_penyakit }} </td>
                <td>{{ $rules->nama_gejala }} </td>
                <td>{{ $rules->cf }} </td>
                @if(auth()->user()->level == 'admin')
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        @csrf
                        <a type="button" class="btn btn-info" href="{{route('edit-rule', $rules->id)}}">Edit</a>
                    </div>
                    <form action="{{route('delete-rule',$rules->id)}}" method='post' class='d-inline'onsubmit="return confirm('Apakah kamu yakin ingin menghapus agenda ini ?')">
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                    </td>
                @endif
            @endforeach
             
            </tbody>
        </table>
        <div class='mt-4 text-center'>
            showing
            {{ $rule->firstItem() }}
            to
            {{ $rule->lastItem() }}
            of
            {{ $rule->total()   }}
        </div>
        <div>
            {{ $rule->links() }}
        </div>
    </div>
@endsection