<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\UpdateUserProfileInformation;

class UserController extends Controller
{
    public function user(Request $request)
    {
    	return $request->user();
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UpdateUserProfileInformation $updater)
    {
        return response()->json($updater->update($request->user(), $request->all()), 200);
    }

    public function showPost($id)
    {
        return response()->json(\App\Models\Post::findOrFail($id), 200);
    }
}
