<?php

namespace App\Http\Controllers\Api;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

/**
 * API UrlController for CRUD operations
 */
class UrlController extends Controller
{
    /**
     * Returns all urls.
     */
    public function index()
    {
        return response()->json(['urls' => Url::with('user')->latest()->get()], 200);
    }

    /**
     * Store a new url.
     */
    public function store(Request $request)
    {
        // First we need to validate the request
        $request->validate([
            'name' => 'required|string|max:200',
            'og_url' => 'required|string|max:200',
        ]);

        $data = $request->all();
        $data['name'] = $request->name;
        $data['og_url'] = $request->og_url;
        $data['short_url'] = Str::random(5);
        $data['user_id'] = Auth::user()->id;

        $url = Url::create($data);

        return response()->json(['message' => 'URL created successfully', 'url' => json_encode($url)], 201);
    }

    /**
     * Update the specified url.
     */
    public function update(Request $request, Url $url)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'og_url' => 'required|string|max:200',
        ]);

        $data = $request->all();

        // Regenerate the url
        $data['short_url'] = Str::random(5);

        // Update the information in the database
        $url->update($data);

        return response()->json(['message' => 'URL updated successfully'], 201);
    }

    /**
     * Remove the specified url.
     */
    public function destroy(Url $url)
    {
        $url->delete();
        return response()->json(['message' => 'URL deleted successfully'], 201);
    }
}
