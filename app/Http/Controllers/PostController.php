<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;

//menghapus gambar dari server
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //

    public function index(){
        //get data posts dari database melalui model Post
        //latest= mengurutkan dari yang paling baru
        //paginate membatasi data yang ditampilkan perhalaman sebanyak 5 
        $posts = Post::latest()->paginate(5);

        //return view ke resources/views/post
        //mengirimkan data posts ke dalam view dengan method bawaan PHP yaitu compact
        $kategori_level = Kategori::all();
        return view('posts.index', compact('posts','kategori_level'));
    }

    public function create(){
        //return ke create.blade.php yg ada di resources/views/posts
        $kategori_level = Kategori::all();
        return view('posts.create', compact('kategori_level'));
        
    }

    public function store(Request $request){
        //validasi form
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gi,svg|max:2048',
            'title' => 'required|min:5',
            'id_kategori' => 'required',
            'content' => 'required|min:10'
        ]);

        //upload image
        $image = $request->file('image');
        //upload gambar ke folder storage/app/public/posts
        //random nama gambar dengan method hasName()
        $image->storeAs('public/posts', $image->hashName());

        //create post
        Post::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'id_kategori' => $request->id_kategori,
            'content' => $request->content
        ]);

        ///redirect ke index
        return redirect()->route('posts.index')->with(['success' => 'data berhasil disimpan!']);
    }

    public function edit(Post $post) {
        $kategori_level = Kategori::all();
        return view('posts.edit',compact('post','kategori_level'));
    }

    public function update(Request $request, Post $post) {
      ///validasi isi form
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,jpg,gif,png,svg|max:2048',
            'title' => 'required|min:5',
            'id_kategori' => 'required',
            'content' => 'required|min:10'
        ]);
        
        //cek image udh diupload atau blm
        if($request->hasFile('image')){

            //upload new image
            $image=$request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            //delete old image
            Storage::delete('public/posts/'.$post->image);

            //update post with new image
            $post->update([
                'image' =>$image->hashName(),
                'title' =>$request->title,
                'id_kategori' =>$request->id_kategori,
                'content' => $request->content
            ]);
        } else {
            //upload post without image
            $post->update([
                'title' => $request->title,
                'id_kategori' => $request->id_kategori,
                'content' => $request->content
            ]);
        }

        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diupdate']);
    }

    public function destroy(Post $post){
        //hapus gambar
        Storage::delete('public/posts'.$post->image);

        //hapus postannya dari db
        $post->delete();

        //redirect ke index
        return redirect()->route('posts.index')->with(['Data Berhasil Dihapus!']);
    }
}
