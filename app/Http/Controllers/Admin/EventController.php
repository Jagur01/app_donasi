<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
        
        public function index()
        {
            $events = Event::latest()->paginate(5);
            return view('admin.event.index', compact('events'));
        }
    
        public function create()
        {
            return view('admin.event.create');
        }
    
        public function store(Request $request)
        {
            $this->validate($request, [
                'name' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'date' => 'required',
            ]);
    
            $events = Event::create([
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description'),
                'date' => $request->input('date'),
            ]);
    
            if ($events) {
                return redirect()->route('event.index')->with(['success' => 'Data Berhasil']);
            } else {
                return redirect()->route('event.index')->with(['error' => 'Data Gagal']);
            }
        }
    
        public function edit(Event $event)
        {
            return view('admin.event.edit', compact('event'));
        }
    
        public function update(Request $request, Event $event)
        {
            $this->validate($request, [
                'name' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'date' => 'required',
            ]);
    
            $event = Event::find($event->id)->update([
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id'),
                'description' => $request->input('description'),
                'date' => $request->input('date'),
            ]);
    
            if ($event) {
                return redirect()->route('event.index')->with(['success' => 'Data Berhasil']);
            } else {
                return redirect()->route('event.index')->with(['error' => 'Data Gagal']);
            }
        }

        public function destroy(Event $event)
        {
            $event = Event::find($event->id);
            $event->delete();
    
            if ($event) {
                return redirect()->route('event.index')->with(['success' => 'Data Berhasil']);
            } else {
                return redirect()->route('event.index')->with(['error' => 'Data Gagal']);
            }
        }
}
