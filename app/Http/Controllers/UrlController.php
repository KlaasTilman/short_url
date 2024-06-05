<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

/**
 * UrlController
 */
class UrlController extends Controller
{
    /**
     * Returns a view for the urls.
     */
    public function index()
    {
        return view('urls.index', [
            'urls' => Url::with('user')->latest()->get(),
        ]);
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

        // Short url generation with a random string.
        $data['short_url'] = Str::random(5);

        // Link this user to the url.
        $data['user_id'] = Auth::user()->id;

        Url::create($data);

        return redirect(route('urls.index'));
    }

    /**
     * Show the form for editing a url.
     */
    public function edit(Url $url)
    {
        // Simply return the form for editing
        return view('urls.edit', [
            'url' => $url,
        ]);
    }

    /**
     * Update a url.
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

        return redirect(route('urls.index'));
    }

    /**
     * Removal of a url.
     */
    public function destroy(Url $url)
    {
        $url->delete();
        // Redirect to index page
        return redirect(route('urls.index'));
    }

    // Function used to redirect a short url to the og url.
    public function shortUrlRedirecter($short_url)
    {
        $url_object = Url::where('short_url', $short_url)->first();

        return redirect($url_object->og_url);
    }
}
