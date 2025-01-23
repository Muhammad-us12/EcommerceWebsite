<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();

        return view('adminPanel.slider.index', compact('sliders'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'title1' => 'required',
            'title2' => 'required',
            'shortParagraph' => 'required',
            'image' => ['required', 'mimes:jpeg,jpg,png,gif,webp', 'max:110244'],
        ]);

        $slider = new Slider;
        $slider->title1 = $request->title1;
        $slider->title2 = $request->title2;
        $slider->shortParagraph = $request->shortParagraph;

        $slider->addMediaFromRequest('image')->toMediaCollection('images');

        $slider->save();

        return redirect()->back()->with(['success' => 'Slider added successfully']);
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title1' => 'required',
            'title2' => 'required',
            'shortParagraph' => 'required',
            'image' => ['required', 'mimes:jpeg,jpg,png,gif,webp', 'max:10244'],
        ]);

        $slider->title1 = $request->title1;
        $slider->title2 = $request->title2;
        $slider->shortParagraph = $request->shortParagraph;

        if ($request->hasFile('image')) {
            // If the slider already has an image, you may want to clear it
            $slider->clearMediaCollection('images');
            // Add the new image to the media collection
            $slider->addMediaFromRequest('image')->toMediaCollection('images');
        }
        $slider->save();

        return redirect()->back()->with('success', 'Slider updated successfully.');
    }

    public function delete(Slider $slider)
    {
        $slider->delete();

        return redirect()->back()->with(['success' => 'Slider deleted successfully']);

    }

    public function edit(Slider $slider)
    {
        return view('adminPanel.slider.edit', compact('slider'));

    }
}
