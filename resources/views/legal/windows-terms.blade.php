<x-legal.app-terms platform="Windows" :available="false">
    <h2>5. Windows specifics</h2>
    <ul>
        <li>These terms are published ahead of the Windows app's release so they are on record from day one; they take practical effect when the installer ships on the <a href="{{ route('download') }}">download page</a>.</li>
        <li>Early builds may not carry a code-signing certificate; running them past SmartScreen (<a href="{{ route('docs.show', 'exe-setup') }}">documented here</a>) is your informed choice, and the source is public so it can be informed.</li>
        <li>The app uses the system WebView2 runtime; that component is Microsoft's, updated and governed by Microsoft.</li>
    </ul>
</x-legal.app-terms>
