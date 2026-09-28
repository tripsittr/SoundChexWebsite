# An accessibility statement for every platform

W-44 / S-444.

## Written last, on purpose

The tracker item said to write these **from what shipped, not from what was
planned**, and that is why they come after the work rather than before it.
Every claim on these six pages was checked against the code that implements
it, and where a feature has also been used on a device, the page says so in
those words.

## Six pages

`/legal/{macos,windows,linux,ios,ipados,android}-accessibility`, linked from
the legal hub and the sidebar, going feature by feature through the nine
things Apple lets an app declare.

## What they say that a marketing page would not

- **iOS**: VoiceOver is "supported — not yet tested with the screen curtain".
  That distinction is the whole point. The labels are written and reviewed;
  nobody has played a song, seeked and downloaded without looking at the
  screen. Larger Text and Reduced Motion say "tested on device", because they
  were.
- **macOS, Windows, Linux**: Reduced Motion is **partial**, and the page says
  partial rather than rounding up. Two elements honour the setting; the rest
  of the transitions do not check it yet.
- **macOS, Windows, Linux**: the interface is **dark only**, with no light
  theme and no following the system. Stated as a real gap, with an invitation
  to say if it matters.
- **Android**: there is no app. The page exists so the absence is stated
  rather than inferred from a missing link, and points at the browser
  interface instead — while being clear we have not tested that with TalkBack
  either.
- **Everywhere**: audio descriptions are not supported, will not be fixed in a
  client, and are not declared.

## The guardrail

Three tests. Every platform has a statement and it is linked from the hub;
none of them carries the "draft pending legal review" stamp (they are factual
reports, not contracts — the layout now takes a `:legal="false"` flag); and
**no page claims audio descriptions**. I checked that last one fails by
falsifying the claim and watching it catch, rather than trusting a green tick.
