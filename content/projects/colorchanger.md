---
title: "Project: ColorChanger"
---
# Project: ColorChanger

## Overview
**ColorChanger** is a small utility for Windows which rotates through a user-
defined list of opaque colors, applying each to the system's window
colorization.

ColorChanger runs unobtrusively in the system tray, displaying the current
window color as its icon. It will rotate through window colors (if desired)
without any input or interruption. It is written in C# and utilizes a lot
of WinAPI calls.

![Picture of ColorChanger](/images/projects/ColorChanger.png "ColorChanger")

## Rationale
Windows offers similar built-in functionality, but uses the current desktop
wallpaper image instead of a user-selected color. Often, the color extracted
from the desktop wallpaper is quite inaccurate. Additionally, I wanted the
built-in color-changing functionality while maintaining a single desktop
background.

Naturally, since pre-Vista Windows does not feature Aero, ColorChanger is
compatible with Windows Vista or later.

## Links
[ColorChanger on Github](https://github.com/jadefish/colorchanger)
