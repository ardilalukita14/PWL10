@extends('mahasiswas.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>DAFTAR ARTIKEL TERKINI</h2>
            </div>

            <!-- Form Search -->
            <div class="float-left my-10">
                <form action="{{ route('articles.index') }}" method="GET">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" name="search" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i> Cari</button>
                        </span>
                    </div>
                </form>
            </div>
            <br><br>
            <!-- End Form Search -->
            <div class="float-left my-4" style="margin-left: -280px;">
                <a class="btn btn-success" href="{{ route('cetak_pdf') }}">Cetak PDF</a>
            </div>
            <div class="float-right my-4">
                <a class="btn btn-info" href="{{ route('articles.create') }}">Tambah Data Artikel</a>
            </div>
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
    <table class="table table-bordered">
        <tr>
        <th>Judul</th>
        <th>Konten</th>
        <th>Gambar</th>
        </tr>
        @foreach ($articles as $data)
        <tr>
    
            <td>{{ $data->title }}</td>
            <td>{{ $data->content }}</td>
            <td><img width="150px"
            src="{{asset('storage/'.$data->featured_image)}}"></td>
        </tr>
        @endforeach
    </table>

    <div class="d-flex justify-content-center">
    <div class="pagination">{{ $articles->links() }}</div>
    </div>
    
@endsection
