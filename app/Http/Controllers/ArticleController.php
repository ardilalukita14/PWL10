<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Article;
use Illuminate\Http\Request;
use Session;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){ // Jika ingin melakukan pencarian nama
            $articles = Article::where('title', 'like', "%".$request->search."%")->paginate(3);
           } else { // Jika tidak melakukan pencarian nama
            //fungsi eloquent menampilkan data menggunakan pagination
            $articles = Article::orderBy('id', 'desc')->paginate(5); // Pagination menampilkan 5 data
        }
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $article = new Article;
        $article->title = request('title');
        $article->content= request('content');
        $article->featured_image = request()->file('image')->store('images', 'public');
        $article->save();
        if ($article) {
            Session::flash('success','Sukses Tambah Data'); 
            return redirect()->route('articles.index');
        } else {
            Session::flash('success','Failed Tambah Data');
            return redirect()->route('articles.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);

        return view('articles.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // syntax untuk menemukan artikel berdasarkan id
        $article = Article::find($id);

        // setelah artikel ditemukan, maka akan dilakukan request sesuai masing-masing variabel
        $article->title = $request->title;
        $article->content = $request->content;

        // jika file gambar pada artikel tersebut telah tersedia, maka file yang lama akan dihapus
        if ($article->featured_image && file_exists(storage_path('app/public/' .$article->featured_image))) {
            \Storage::delete(['public/' . $article->featured_image]);
        }
        // namun, jika file gambar masih belum ada, maka file baru yang diupload akan disimpan
        $image_name = $request->file('image')->store('images', 'public');
        $article->featured_image = $image_name;

        // sytax untuk menyimpan perubahan setelah melakukan edit
        $article->save();
        return 'Artikel berhasil diubah';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        Article::find($id)->delete();
        return redirect()->route('articles.index')
            -> with('success', 'Artikel Berhasil Dihapus');
    }

    public function cetak_pdf() {
        $articles = Article::all();
        $pdf = PDF::loadview('articles.articles_pdf', ['articles'=>$articles]);
         return $pdf->stream();
    }
}
