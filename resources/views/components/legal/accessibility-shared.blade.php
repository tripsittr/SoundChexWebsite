{{--
    The parts of the accessibility statement that are true everywhere (S-444).

    Kept in one place so six pages cannot drift into disagreeing about the
    same software. Anything platform-specific — what each app supports, and
    what it does not — lives on the page itself.
--}}

<h2>How to tell us something is wrong</h2>
<p>
    If something here is inaccurate, or you hit a barrier this page does not
    mention, please
    <a href="https://github.com/tripsittr/SoundChex/issues">open an issue</a>
    or email <a href="mailto:hello@soundchex.app">hello@soundchex.app</a>.
    A report that a feature listed as supported does not actually work for you
    is the most useful thing you can send us, and we would rather hear it than
    have the page keep saying otherwise.
</p>

<h2>Audio descriptions</h2>
<p>
    <strong>Not supported, on any platform.</strong> Audio descriptions are a
    separate narration track describing what happens on screen. SoundChex does
    not detect one, does not offer one, and cannot play one — not even when
    the file you own already contains it.
</p>
<p>
    This is not an oversight we are about to fix in a client. The server would
    have to recognise a described audio track, the API would have to advertise
    it, and every player would have to let you select it. It is
    <a href="{{ route('roadmap') }}">on the roadmap</a> and it is not built.
</p>

<h2>What "supported" means on this page</h2>
<p>
    It means the feature is implemented and we have checked the code that
    implements it. Where we have also driven the software with the assistive
    technology in question, the page says so explicitly.
</p>
<p>
    Those are different levels of confidence and we do not blur them. An
    accessibility claim is a promise to someone who depends on it, and a false
    one is worse than an absent one — it wastes the time of the person least
    able to spare it.
</p>

<h2>Your own media</h2>
<p>
    SoundChex plays files you already own, from a server you run. We do not
    supply the content, so we cannot promise anything about it. Whether a film
    in your library carries subtitles, or a book is a readable text rather than
    page images, depends on the file. What this page describes is the software
    around it.
</p>
