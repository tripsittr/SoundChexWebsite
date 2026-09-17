<x-legal.app-privacy platform="iOS">
    <x-slot:storage>
        <p>On iOS this data lives in the app's sandboxed container — downloads are kept in the app's native storage specifically because it is more durable than browser-style storage, which iOS evicts. Nothing is written outside the sandbox, nothing is synced to iCloud by the app, and no data is shared with other apps.</p>
    </x-slot:storage>
    <x-slot:deletion>
        <p>Delete the app from the Home Screen and iOS removes its entire container — saved server address, session and downloads included. Signing out inside the app ends the session with your server.</p>
    </x-slot:deletion>
    <p class="doc-note"><strong>App Store privacy label, when it ships there: "Data Not Collected."</strong> The app uses no advertising identifier (IDFA), requests no tracking permission because it does none, and asks for no device permissions beyond network access to reach your server.</p>
</x-legal.app-privacy>
