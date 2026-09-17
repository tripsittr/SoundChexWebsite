<x-legal.app-privacy platform="Linux" :available="false">
    <x-slot:storage>
        <p>On Linux this data will live in your home directory under the XDG paths (<code>~/.config</code> and <code>~/.local/share</code>), owned by your user like any per-user app data. Nothing is written outside them.</p>
    </x-slot:storage>
    <x-slot:deletion>
        <p>Remove the package with your package manager (or delete the AppImage), then remove the app's directories under <code>~/.config</code> and <code>~/.local/share</code> if you want the saved server address and downloads gone too.</p>
    </x-slot:deletion>
</x-legal.app-privacy>
