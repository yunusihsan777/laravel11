@extends('layouts.app')

@section('title', 'Evaluasi AKIP')

@section('content')
<div class="content" id="content">
    <div class="container-fluid">
        <div class="card border-light shadow-sm">
            <div class="card border-light shadow-sm" style="background-color: #e6bf3e;">
                <center>
                    <h2><b>Evaluasi AKIP</b></h2>
                </center>
            </div>
            <div class="card-body">
                @include('kelola.components.evaluasi_lke', ['sections' => $sections, 'tahun' => $tahun])
            </div>
        </div>
    </div>
</div>
@endsection
