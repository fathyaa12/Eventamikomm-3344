<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;

class EventController extends Controller
{
    public function show(Event $event)
{
    $event->load(['user', 'reviews.user', 'category']);
    $categories = Category::all();
    return view('event-detail', compact('event', 'categories'));
}
}
