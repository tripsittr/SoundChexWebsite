<?php

use App\Models\WaitlistSignup;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Validate('required|email:rfc|max:254')]
    public string $email = '';

    public bool $joined = false;

    public function join(): void
    {
        $this->validate();

        WaitlistSignup::firstOrCreate(['email' => strtolower(trim($this->email))]);

        $this->joined = true;
        $this->email = '';
    }
};
?>

<div>
    @if ($joined)
        <p class="rounded-lg border border-base-600 bg-base-700 px-4 py-3 text-sm text-ink-100">
            You're on the list. We'll email you when SCNet opens — nothing else, ever.
        </p>
    @else
        <form wire:submit="join" class="flex flex-col gap-3 sm:flex-row">
            <label for="scnet-email" class="sr-only">Email address</label>
            <input
                id="scnet-email"
                type="email"
                wire:model="email"
                required
                placeholder="you@example.com"
                class="w-full rounded-lg border border-base-500 bg-base-800 px-4 py-2.5 text-sm text-ink-100 placeholder:text-ink-500 focus:border-accent focus:outline-none"
            />
            <button
                type="submit"
                class="shrink-0 rounded-lg bg-accent px-5 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-accent-hot disabled:opacity-60"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>Join the waitlist</span>
                <span wire:loading>Joining…</span>
            </button>
        </form>
        @error('email')
            <p class="mt-2 text-sm text-accent-hot">{{ $message }}</p>
        @enderror
    @endif
</div>
