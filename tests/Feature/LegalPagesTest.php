<?php

// SPDX-License-Identifier: AGPL-3.0-or-later
// Copyright (C) 2026 SoundChex

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

    /** @var list<string> */
    private const ACCESSIBILITY = [
        'macos-accessibility',
        'windows-accessibility',
        'linux-accessibility',
        'ios-accessibility',
        'ipados-accessibility',
        'android-accessibility',
    ];

    public function test_every_platform_has_an_accessibility_statement(): void
    {
        $hub = $this->get(route('legal'))->assertOk();

        foreach (self::ACCESSIBILITY as $slug) {
            $hub->assertSee(route('legal.show', $slug));

            $this->get(route('legal.show', $slug))
                ->assertOk()
                ->assertSee('Tripsittr LLC');
        }
    }

    /**
     * An accessibility statement is a factual report on the software, not a
     * contract, so it must not carry the "draft pending legal review" stamp
     * the policies do — that would misdescribe what it is (S-444).
     */
    public function test_accessibility_statements_are_not_marked_as_draft_policies(): void
    {
        foreach (self::ACCESSIBILITY as $slug) {
            $this->get(route('legal.show', $slug))
                ->assertOk()
                ->assertDontSee('Draft pending legal review')
                ->assertSee('Last checked');
        }
    }

    /**
     * The one claim that must never drift.
     *
     * Audio descriptions are unsupported on every platform: the server cannot
     * expose a described audio track and no client can select one. Declaring
     * support for an accommodation that does not exist wastes the time of the
     * person least able to spare it, so every page has to say so plainly
     * until it is built (S-443).
     */
    public function test_no_page_claims_audio_descriptions(): void
    {
        foreach (self::ACCESSIBILITY as $slug) {
            $this->get(route('legal.show', $slug))
                ->assertOk()
                ->assertSee('Not supported', escape: false);
        }
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
