<?php

namespace Tests\Feature;

use Tests\TestCase;

class SitePagesTest extends TestCase
{
    public function test_home_page_renders(): void
    {
        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Your media. Your machine.')
            ->assertSee('SCNet')
            ->assertSee('SoundChex Network')
            ->assertSeeLivewire('scnet-waitlist');
    }

    public function test_docs_index_renders_all_categories(): void
    {
        $this->get(route('docs'))
            ->assertOk()
            ->assertSeeInOrder(['Getting started', 'Server', 'Your library', 'Apps — every device', 'Away from home', 'People & help']);
    }

    public function test_download_page_renders_both_apps(): void
    {
        $this->get(route('download'))
            ->assertOk()
            ->assertSeeInOrder(['SoundChex', 'SoundChex Server'])
            ->assertSee('github.com/tripsittr/SoundChex/releases');
    }

    public function test_policy_pages_redirect_into_legal_hub(): void
    {
        $this->get(route('privacy'))->assertRedirect('/legal/website-privacy');
        $this->get(route('terms'))->assertRedirect('/legal/website-terms');
    }
}
