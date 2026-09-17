<x-legal.app-terms platform="Linux" :available="false">
    <h2>5. Linux specifics</h2>
    <ul>
        <li>These terms are published ahead of the Linux app's release; they take practical effect when packages (<code>.deb</code>, <code>.rpm</code>, <code>.AppImage</code>) ship on the <a href="{{ route('download') }}">download page</a>.</li>
        <li>Packages are unsigned until a signing key is published alongside them; building from <a href="{{ route('docs.show', 'github-setup') }}">source</a> is always available and always equivalent.</li>
        <li>The app renders through your distribution's WebKitGTK; that library is governed and updated by your distribution.</li>
    </ul>
</x-legal.app-terms>
