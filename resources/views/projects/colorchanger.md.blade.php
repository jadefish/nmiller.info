@extends('layouts.app')
@section('title', 'Project: ColorChanger')

@section('content')

# Project: ColorChanger

<ul class="list-horizontal">
    <li><a href="https://github.com/jadefish/colorchanger">ColorChanger on GitHub</a></li>
</ul>

## Overview
**ColorChanger** is a small utility for Windows which rotates through a user-
defined list of opaque colors, applying each to the system's window
colorization.

ColorChanges runs unobtrusively in the system tray, displaying the current
window color as its icon. It will rotate through window colors (if desired)
without any input or interruption. It is written in C# and utilizes a lot
of WinAPI calls.

![Picture of ColorChanger](/images/projects/colorchanger.png "ColorChanger")

## Rationale
Windows offers similar built-in functionality, but uses the current desktop
wallpaper image instead of a user-selected color. Often, the color extracted
from the desktop wallpaper is quite inaccurate. Additionally, I wanted the
built-in color-changing functionality while maintaining a single desktop
background.

Naturally, since pre-Vista Windows does not feature Aero, ColorChanger is
compatible with Windows Vista or later.
@endsection
