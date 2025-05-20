<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

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

    public function confirm(Request $request)
    {
        // バリデーション（必要であれば追加）
        $data = $request->all();

        return view('confirm', compact('data'));
    }

    public function submit(Request $request)
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

        // 実際の保存処理など
        // Contact::create($request->all());
    /*$validated = $request->validate([
        'last_name' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'gender' => 'required|in:1,2,3',
        'email' => 'required|email',
        'first_tel' => 'nullable|string|max:5',
        'second_tel' => 'nullable|string|max:5',
        'third_tel' => 'nullable|string|max:5',
        'address' => 'required|string|max:255',
        'building' => 'nullable|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'detail' => 'required|string',
    ]);*/

        // 4. 保存
        Contact::create($data);

        return view('thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
