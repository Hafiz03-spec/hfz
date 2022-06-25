@extends('layoutUtama.dashboard')
@section('title','gejalas')
@section('content')
<div class="col-md-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Gejala</strong>
        </div>
        <div class="panel-body">
            <form method="POST" action="{{ route('diagnosas') }}">
                {{ csrf_field() }}
                <input type="hidden" name="pasien_id" value="{{ $pasien_id }}">
                <div class="form-group">
                    <label>Gejala-gejala yang nampak pada tanaman padi anda :</label>
                    <div class="col-md-12">
                        @foreach ($gejalas as $gejala)
                            <div>
								<label>{{ $gejala->nama_gejala }}</label>
								<select class="status form-control" id="gejala[]" style="width:550px;" name="gejala[]">
									<option value="100" selected="true">-selected-</option>
									<option value="1" value={{ $gejala->id }}>ya</option>
									<option value="0.5" value={{ $gejala->id }}>mungkin</option>
									<option value="0" value={{ $gejala->id }}>tidak</option>
								</select>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right">Cek Hasil Diagnonsa <i class="fa fa-fw fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
{{-- <script type="text/javascript">
	$('#gejala[]').on('change', function() {
			 
			   
			   var state_id = $('#gejala').val();
			  
				   $.post('{{route('fetch_data')}}',{_token:'{{ csrf_token() }}', state_id:state_id}, function(data){
					   
					if(stae_id != null){
						
					}
					//    $('#buku_id').html(null);
					//    $('#buku_id').append($('<option value="">Select Buku</option>', {
					//    }));
					//    for (var i = 0; i < data.length; i++) {
					// 	   $('#buku_id').append($('<option>', {
					// 		   value: data[i].id,
					// 		   text: data[i].judul
					// 	   }));
					   }
			   });
		   
		 });
</script> --}}