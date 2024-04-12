@extends('layout.insidelayout')
  
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    webpage
                    <ul>
                        <li><a href='/mmobil'>manajemen mobil</a></li>
                        <li><a href='/pmobil'>pinjam mobil</a></li>
                        <li><a href='/bmobil'>pengembalian mobil</a></li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection