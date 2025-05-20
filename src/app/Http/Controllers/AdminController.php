<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    //
    public function admin(Request $request)
    {
        $contacts = Contact::with('category')
        ->when($request->keyword, function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
                  ->orWhere(DB::raw("CONCAT(last_name, first_name)"), 'like', '%' . $request->keyword . '%')
                  ->orWhere('email', 'like', '%' . $request->keyword . '%');
            });
        })
        ->when($request->gender, function ($query) use ($request) {
            $query->where('gender', $request->gender);
        })
        ->when($request->category_id, function ($query) use ($request) {
            $query->where('category_id', $request->category_id);
        })
        ->when($request->created_at, function ($query) use ($request) {
            $query->whereDate('created_at', $request->created_at);
        })
        ->paginate(7);
        $categories = Category::all();
        return view('admin', compact('contacts', 'categories'));
    }
}
