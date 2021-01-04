@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach($iklan_lowongan_kerja as $v)

        <div class="col-sm-4 card">
            <a href="{{ url('iklan_lowongan_kerja').'/'.$v->id }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $v->judul }}, {{ $v->nama }}</h5>
                    <p class="card-text">{{ $v->deskripsi }}</p>
                    <p class="card-text"><small class="text-muted">{{ $v->created_at }}</small></p>
                </div>
            </a>
        </div>

        @endforeach

    </div>
</div>
@endsection