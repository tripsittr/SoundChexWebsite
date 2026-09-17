<?php

namespace Tests\Feature;

use App\Models\WaitlistSignup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ScnetWaitlistTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_valid_email_joins_the_waitlist(): void
    {
        Livewire::test('scnet-waitlist')
            ->set('email', 'Fan@Example.com')
            ->call('join')
            ->assertHasNoErrors()
            ->assertSet('joined', true);

        $this->assertDatabaseHas('waitlist_signups', ['email' => 'fan@example.com']);
    }

    public function test_an_invalid_email_is_rejected(): void
    {
        Livewire::test('scnet-waitlist')
            ->set('email', 'not-an-email')
            ->call('join')
            ->assertHasErrors(['email']);

        $this->assertDatabaseCount('waitlist_signups', 0);
    }

    public function test_joining_twice_does_not_duplicate(): void
    {
        WaitlistSignup::factory()->create(['email' => 'fan@example.com']);

        Livewire::test('scnet-waitlist')
            ->set('email', 'fan@example.com')
            ->call('join')
            ->assertHasNoErrors()
            ->assertSet('joined', true);

        $this->assertDatabaseCount('waitlist_signups', 1);
    }
}
