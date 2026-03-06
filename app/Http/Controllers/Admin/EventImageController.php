<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventImage;
use Illuminate\Support\Facades\Storage;

class EventImageController extends Controller
{
    public function destroy($id)
    {
        $img = EventImage::findOrFail($id);
        if ($img->path && Storage::disk('public')->exists($img->path)) {
            Storage::disk('public')->delete($img->path);
        }
        $img->delete();
        return back()->with('success', 'Gallery image deleted successfully.');
    }
}
