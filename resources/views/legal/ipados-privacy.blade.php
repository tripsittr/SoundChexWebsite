<x-legal.app-privacy platform="iPadOS" :available="false">
    <x-slot:storage>
        <p>As on iOS, data lives in the app's sandboxed container, with downloads in native storage for durability. Nothing outside the sandbox, no iCloud sync by the app, no sharing with other apps. Until the dedicated iPad app ships, the <a href="{{ route('legal.show', 'ios-privacy') }}">iOS privacy document</a> governs the iOS build running on iPad — its commitments are identical.</p>
    </x-slot:storage>
    <x-slot:deletion>
        <p>Delete the app from the Home Screen and iPadOS removes its entire container — saved server address, session and downloads included.</p>
    </x-slot:deletion>
    <p class="doc-note"><strong>App Store privacy label, when it ships there: "Data Not Collected."</strong> No advertising identifier, no tracking permission (nothing to ask for), no device permissions beyond network access.</p>
</x-legal.app-privacy>
