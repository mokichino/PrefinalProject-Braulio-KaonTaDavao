<?php

namespace Tests\Feature;

use App\Models\Eatery;
use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_closed_eatery_rejects_review_submission(): void
    {
        $eatery = Eatery::where('is_open', false)->firstOrFail();
        $user = User::firstOrFail();

        $response = $this->post(route('eateries.reviews.store', $eatery), [
            'user_id' => $user->id,
            'rating' => 5,
            'body' => 'This is a valid review body.',
        ]);

        $response->assertForbidden();
    }
}
