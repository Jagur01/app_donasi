<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryEvent;

class CategoryEventController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('role:1');
    }

    public function index()
    {
        $categoryEvents = CategoryEvent::latest()->when(request()->q, function($categoryEvents) {
            $categoryEvents = $categoryEvents->where('name', 'like', '%'. request()->q . '%');
        })->paginate(5);
        return view('admin.categoryEvent.index', compact('categoryEvents'));
    }

    public function create()
    {
        return view('admin.categoryEvent.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $categories = CategoryEvent::create([
            'name' => $request->input('name'),
        ]);

        if ($categories) {
            return redirect()->route('categoryEvent.index')->with(['success' => 'Data Berhasil']);
        } else {
            return redirect()->route('categoryEvent.index')->with(['error' => 'Data Gagal']);
        }
    }

    public function edit(CategoryEvent $categoryEvent)
    {
        return view('admin.categoryEvent.edit', compact('categoryEvent'));
    }

    public function update(Request $request, CategoryEvent $categoryEvent)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = CategoryEvent::findOrfail($categoryEvent->id);
        $category->update([
            'name' => $request->name,
        ]);

        if ($category) {
            return redirect()->route('categoryEvent.index')->with(['success' => 'Data Berhasil']);
        } else {
            return redirect()->route('categoryEvent.index')->with(['error' => 'Data Gagal']);
        }
    }

    public function destroy($id)
    {
        $category = CategoryEvent::findOrFail($id);
        $category->delete();

        if ($category) {
            return redirect()->route('categoryEvent.index')->with(['success' => 'Data Berhasil']);
        } else {
            return redirect()->route('categoryEvent.index')->with(['error' => 'Data Gagal']);
        }
    }
}
