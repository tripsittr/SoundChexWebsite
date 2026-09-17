<x-legal.app-privacy platform="Windows" :available="false">
    <x-slot:storage>
        <p>On Windows this data will live under your user profile (<code>%APPDATA%</code> and <code>%LOCALAPPDATA%</code>), protected by your Windows account like any per-user app data. Nothing is written outside it, and nothing goes to the registry beyond standard install entries.</p>
    </x-slot:storage>
    <x-slot:deletion>
        <p>Uninstall from Windows Settings → Apps, then remove the app's folder under <code>%APPDATA%</code>/<code>%LOCALAPPDATA%</code> if you want the saved server address and downloads gone too.</p>
    </x-slot:deletion>
    <p class="doc-note">The Windows WebView2 runtime is a Microsoft component with Microsoft's own privacy characteristics; the app doesn't add to them, and everything it renders comes from your server.</p>
</x-legal.app-privacy>
