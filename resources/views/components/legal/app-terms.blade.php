@props(['platform', 'available' => true])
<x-layouts.legal :title="'SoundChex for '.$platform.' Terms'">
    <h1>SoundChex for {{ $platform }} — Terms</h1>
    @unless ($available)
        <p><span class="inline-block rounded-full border border-base-500 bg-base-700 px-3 py-1 text-xs font-semibold text-ink-300">App not yet released — terms published ahead</span></p>
    @endunless
    <p class="doc-lead">These terms cover the SoundChex app for {{ $platform }} — the client you browse, play and read with. The server it connects to has <a href="{{ route('legal.show', 'server-terms') }}">its own terms</a>.</p>

    <h2>1. The license is the MIT License</h2>
    <p>The app is open-source software released by Tripsittr LLC under the MIT License; the license text in the <a href="https://github.com/tripsittr/SoundChex">repository</a> is the complete and only license. It is provided "as is", without warranty of any kind.</p>

    <h2>2. The app is a window onto your server</h2>
    <ul>
        <li>The app connects only to the server address you enter — a machine you (or your household) run. Tripsittr LLC operates no service the app depends on.</li>
        <li>The interface is served by your server, so its behaviour and content are your server's version of SoundChex. The binary itself carries only the connect screen and the offline shell.</li>
        <li>Accounts, permissions and content restrictions (including kids mode) are enforced by your server, under its operator's control.</li>
    </ul>

    <h2>3. Your media, your responsibility</h2>
    <p>The app plays media from a library its operator assembled. It does not acquire media and these terms are not a license to infringe copyright.</p>

    <h2>4. Downloads live on this device</h2>
    <p>Media you download for offline use is stored on the device for your use within your household's library. Deleting the app deletes its downloads; the library itself lives on the server and loses nothing.</p>

    {{ $slot }}

    <h2>No warranty; limitation of liability</h2>
    <p>As the MIT License states: no warranty, express or implied. To the maximum extent permitted by law, Tripsittr LLC and contributors are not liable for damages arising from the app or its use.</p>

    <h2>SCNet</h2>
    <p>If and when this app gains the option to connect through SCNet (the SoundChex Network), that connection will be governed by SCNet's own subscriber terms, published before the service opens — nothing in these terms signs you up for anything.</p>
</x-layouts.legal>
