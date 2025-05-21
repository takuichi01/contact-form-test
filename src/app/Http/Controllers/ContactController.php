<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    //
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->isMethod('post')) {
            // POSTのとき（例：confirm画面から「修正する」ボタンで戻ってきた）
            // old() によってフォームを復元する
            return view('index', [
                'data' => $request->all(),
                'categories' => $categories,
            ]);
        }
    
        // GETのとき
        return view('index', ['categories' => $categories]);
    }

    public function confirm(ContactRequest $request)
    {
        // バリデーション（必要であれば追加）
        $data = $request->all();

        return view('confirm', compact('data'));
    }

    public function submit(ContactRequest $request)
    {
        $categoryContent = $request->input('category');
        $categoryID = Category::where('content', $categoryContent)->first();

        $data = $request->except('category');
        $data['category_id'] = $categoryID->id;

        $data['tel'] = implode('-', [
            $request->input('first_tel'),
            $request->input('second_tel'),
            $request->input('third_tel'),
        ]);

        Contact::create($data);

        return view('thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
