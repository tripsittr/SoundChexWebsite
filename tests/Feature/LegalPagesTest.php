<?php

namespace Tests\Feature;

use Tests\TestCase;

class LegalPagesTest extends TestCase
{
    /** @var list<string> */
    private const PAGES = [
        'website-terms',
        'website-privacy',
        'cookies',
        'server-terms',
        'server-privacy',
        'macos-terms',
        'macos-privacy',
        'windows-terms',
        'windows-privacy',
        'linux-terms',
        'linux-privacy',
        'ios-terms',
        'ios-privacy',
        'ipados-terms',
        'ipados-privacy',
        'android-terms',
        'android-privacy',
    ];

    public function test_legal_hub_lists_every_document(): void
    {
        $response = $this->get(route('legal'))->assertOk();

        foreach (self::PAGES as $slug) {
            $response->assertSee(route('legal.show', $slug));
        }
    }

    public function test_every_legal_page_renders_with_operator_and_draft_notice(): void
    {
        foreach (self::PAGES as $slug) {
            $this->get(route('legal.show', $slug))
                ->assertOk()
                ->assertSee('Tripsittr LLC')
                ->assertSee('Draft pending legal review');
        }
    }

    public function test_every_privacy_page_commits_to_zero_collection(): void
    {
        foreach (['server-privacy', 'macos-privacy', 'windows-privacy', 'linux-privacy', 'ios-privacy', 'ipados-privacy', 'android-privacy'] as $slug) {
            $this->get(route('legal.show', $slug))
                ->assertOk()
                ->assertSee('none', escape: false);
        }

        $this->get(route('legal.show', 'website-privacy'))
            ->assertSee('zero trackers and zero analytics');
    }

    public function test_old_policy_urls_redirect(): void
    {
        $this->get('/privacy')->assertRedirect('/legal/website-privacy');
        $this->get('/terms')->assertRedirect('/legal/website-terms');
    }

    public function test_unknown_legal_page_is_404(): void
    {
        $this->get('/legal/no-such-document')->assertNotFound();
    }
}
