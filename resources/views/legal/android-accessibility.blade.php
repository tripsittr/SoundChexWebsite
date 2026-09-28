<x-layouts.legal title="Accessibility — Android" :legal="false" updated="September 28, 2026">
    <h1>Accessibility on Android</h1>

    <p class="doc-lead">
        There is no Android app yet, so there is nothing here to report on.
        This page exists so that the absence is stated rather than left to be
        inferred from a missing link.
    </p>

    <h2>What exists today</h2>
    <p>
        The Android app is <a href="{{ route('roadmap') }}">on the
        roadmap</a> and has not been built. No code, no beta, no test build.
        There are Android terms and a privacy policy on this site because the
        documents are written ahead of the software, not because an app is
        quietly available somewhere.
    </p>

    <h2>What you can use now</h2>
    <p>
        SoundChex's interface is a website, served by your own server. On an
        Android phone you can open it in Chrome or Firefox and use it with
        TalkBack, exactly as you would any other site — this is the same
        interface the desktop apps display, so the
        <a href="{{ route('legal.show', 'linux-accessibility') }}">notes we
        have written about it</a> apply.
    </p>
    <p>
        We have not tested it with TalkBack. The interface uses real HTML
        controls with labels, headings in order and keyboard support, which is
        what a screen reader needs, but "should work" and "does work" are
        different claims and only one of them is ours to make.
    </p>

    <h2>When the app is built</h2>
    <p>
        This page will be replaced with the same feature-by-feature account the
        other platforms have, written from what actually shipped. If
        accessibility on Android matters to you, saying so now is more useful
        than saying so afterwards — it is easier to build in than to retrofit,
        as the rest of this project has demonstrated.
    </p>

    <x-legal.accessibility-shared />
</x-layouts.legal>
