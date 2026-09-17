<x-legal.app-privacy platform="Android" :available="false">
    <x-slot:storage>
        <p>On Android this data will live in the app's private storage (<code>/data/data</code>, app-scoped), inaccessible to other apps without root. No external-storage scattering, no data shared with other apps, and downloads in app-private storage so Android's cleaners don't silently remove them.</p>
    </x-slot:storage>
    <x-slot:deletion>
        <p>Uninstall the app and Android removes its private storage — saved server address, session and downloads included. "Clear storage" in App info does the same while keeping the app.</p>
    </x-slot:deletion>
    <p class="doc-note"><strong>Play Store data-safety declaration, when it ships there: no data collected, no data shared.</strong> No advertising ID, no analytics SDKs, and no permissions beyond network access to reach your server.</p>
</x-legal.app-privacy>
