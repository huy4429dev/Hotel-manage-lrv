<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        // return json_decode(json_encode($posts),true);
        return view('admin.post.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('admin.post.create');
    }

    public function store(Request $request)
    {

        $request->validate(
            [
                'tieu_de'  => 'required',
                'hinh_anh' => 'required',
                'mo_ta'    => 'required|max:255',
                'noi_dung' => 'required',
            ],
            [
                'tieu_de.required'  => 'Vui lòng nhập tiêu đề',
                'hinh_anh.required' => 'Vui lòng chọn ảnh đại diện',
                'mo_ta.required'    => 'Vui lòng nhập mô tả',
                'mo_ta.max'    => 'Vui lòng nhập mô tả qúa dài',
                'noi_dung.required' => 'Vui lòng nội dung',
            ]
        );


        if ($request->hasFile('hinh_anh')) {
            $originName = $request->file('hinh_anh')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('hinh_anh')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('hinh_anh')->move(public_path('images'), $fileName);

            $hinh_anh = 'images/' . $fileName;
        } else {
            $hinh_anh = '';
        }

        Post::create([

            'tieu_de'  => $request->tieu_de,
            'hinh_anh' => $hinh_anh,
            'mo_ta'    => $request->mo_ta,
            'noi_dung' => $request->noi_dung,
            'luot_xem' => 0,
            'user_id'  => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Thêm bài viết thành công !');
    }

    public function edit($id)
    {
        return view('admin.post.edit', ['post' => Post::find($id)]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if ($post != null) {
        }
        $request->validate(
            [
                'tieu_de'  => 'required',
                'mo_ta'    => 'required|max:255',
                'noi_dung' => 'required',
            ],
            [
                'tieu_de.required'  => 'Vui lòng nhập tiêu đề',
                'mo_ta.required'    => 'Vui lòng nhập mô tả',
                'mo_ta.max'         => 'Mô tả quá dài',
                'noi_dung.required' => 'Vui lòng nội dung',
            ]
        );

        $post = Post::find($id);

        if ($post != null) {

            if ($request->hasFile('hinh_anh')) {
                $originName = $request->file('hinh_anh')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('hinh_anh')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;
                $request->file('hinh_anh')->move(public_path('images'), $fileName);

                $hinh_anh = 'images/' . $fileName;
            } else {
                $hinh_anh = $post->hinh_anh;
            }



            $post->tieu_de  = $request->tieu_de;
            $post->hinh_anh = $hinh_anh;
            $post->mo_ta    = $request->mo_ta;
            $post->noi_dung = $request->noi_dung;
            $post->user_id  = Auth::user()->id;

            $post->save();

            return redirect()->back()->with('success', 'Cập nhật bài viết thành công. ');
        }

        return redirect()->back()->with('success', 'Không tồn tại bài viết');
    }



    public function delete ($id)
    {
        $post = Post::find($id);

        if ($post != null) {
            $post->delete();
            return redirect()->back()->with('success', 'Xóa bài viết thành công');
        }

        return redirect()->back()->with('error', 'Bài viết không tồn tại');
    }
}
