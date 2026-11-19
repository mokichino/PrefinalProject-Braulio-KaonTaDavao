<?php

namespace App\Http\Controllers;

use App\Models\User;

class ReviewerController extends Controller
{
    public function show(User $user)
    {
        return view('reviewers.show', ['user' => $user->load(['reviews' => fn ($query) => $query->with('eatery')->latest()])]);
    }
}
