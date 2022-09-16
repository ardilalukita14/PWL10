@extends('mahasiswas.layout')
 
@section('content')
 
<div class="container mt-5">

    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 80rem;">
            <div class="card-header">
                Tambah Data Artikel
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('articles.store') }}" id="myForm" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="form-group" style="width: 1000px; margin-left: 30px;">
                    <label for="title">Title: </label>
                    <input type="text" class="form-control" required="required" name="title"></br>
                
                    <label for="content">Content: </label>
                    <textarea type="text" class="form-control" required="required" name="content"></textarea></br>
                
                    <label for="image">Feature Image: </label>
                    <input type="file" class="form-control" required="required" name="image"></br>
                    <button type="submit" name="submit" class="btn btn-primary float-center">Simpan</button>
                    </div>
                    </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection