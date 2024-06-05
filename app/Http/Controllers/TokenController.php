<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

/**
 * Controller for token logic.
 */
class TokenController extends Controller
{
    /**
     * Returns a view for the token.
     */
    public function index()
    {
        return view('token.index', [
            'token' => '',
        ]);
    }

    /**
     * Store a new token.
     */
    public function store(Request $request)
    {
        // First we need to validate the request
        $request->validate([
            'name' => 'required|string|max:200',
        ]);

        $token = $request->user()->createToken($request->name);

        // Return the view after token generation.
        return view('token.index', [
            'token' => $token->plainTextToken,
        ]);
    }
}
