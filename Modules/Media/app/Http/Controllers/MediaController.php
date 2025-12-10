<?php

namespace Modules\Media\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class MediaController extends Controller
{
    public function index()
    {
        // return $this->mediaRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            // jpg mp4 gif png
            'file_path' => 'required|mimes:webp,png,jpeg,jpg,mp4,gif,png'
        ]);

        // Create ImageManager instance
        $manager = new ImageManager(new Driver());

        if ($this->file_path) {
            // $name = "product-" . time() . "." . $this->thumbnail_image->getClientOriginalExtension();
            $name = time() . ".webp";

            $image = $manager->read($this->file_path->getRealPath()); // ✅ একই manager ব্যবহার
            $image->encodeByExtension('webp', 85);
            
            // $path = $this->thumbnail_image->storeAs('products', $name, 'public');
            $path = 'media/' . $name;
            Storage::disk('public')->put($path, (string) $image->encode());
            $validated['thumbnail_image'] = $path;

            if ($this->productId && $this->thumbnail_path && Storage::disk('public')->exists($this->thumbnail_path)) {
                Storage::disk('public')->delete($this->thumbnail_path);
            }
        } else {
            $validated['thumbnail_image'] = $this->thumbnail_path ?? null;
        }
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('media::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('media::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
