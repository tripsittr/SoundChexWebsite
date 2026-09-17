<?php

namespace Tests\Feature;

use Tests\TestCase;

class DocsPagesTest extends TestCase
{
    /**
     * Every page the docs sidebar links to. A slug listed here without a view
     * fails; a new page should be added here and to the sidebar together.
     *
     * @var list<string>
     */
    private const PAGES = [
        'introduction',
        'quick-start',
        'requirements',
        'server-macos',
        'server-windows',
        'server-linux',
        'libraries',
        'metadata',
        'workers',
        'remote-access',
        'moving-a-server',
        'app-macos',
        'app-windows',
        'app-linux',
        'app-ios',
        'app-ipados',
        'app-android',
        'profiles',
        'search',
        'offline',
        'customization',
        'troubleshooting',
    ];

    public function test_every_docs_page_renders_with_sidebar(): void
    {
        foreach (self::PAGES as $slug) {
            $this->get(route('docs.show', $slug))
                ->assertOk()
                ->assertSee('Documentation home');
        }
    }

    public function test_sidebar_links_every_page(): void
    {
        $response = $this->get(route('docs.show', 'introduction'))->assertOk();

        foreach (self::PAGES as $slug) {
            $response->assertSee(route('docs.show', $slug));
        }
    }

    public function test_unknown_docs_page_is_404(): void
    {
        $this->get('/docs/no-such-page')->assertNotFound();
        $this->get('/docs/../../etc/passwd')->assertNotFound();
    }
}
