---
title: "Project: BundleReader"
---
# Project: BundleReader

## Overview
**BundleReader** is an inspector tool for Windows which parses and reads
metadata for
[macOS .app bundles](https://en.wikipedia.org/wiki/Bundle_(macOS)#macOS_application_bundles).

BundleReader uses a few external tools and utilities:

* [lipo](https://ss64.com/osx/lipo.html) is used for reading architecture
  info from app bundles' binary files.
* [nconvert](https://www.xnview.com/en/nconvert) is used to convert Apple's
  icon image format
  ([.icns](https://en.wikipedia.org/wiki/Apple_Icon_Image_format)) to PNG.
* [PlistCS](https://github.com/animetrics/PlistCS) is used for reading
  property lists.

Unfortunately, due to data loss, BundleReader cannot be compiled in its
current state: the project containing its GUI framework has been lost.

## Rationale
I wrote BundleReader to assist my content editing duties at
[MacUpdate](https://www.macupdate.com). Before my shift began, I would have
to switch gears from Windows to macOS (desktop to laptop), which became
tiresome after a year or so.

BundleReader allowed me to continue working in a Windows-based environment
without having to mentally context switch and constantly adjust to the
idiosyncrasies between macOS and Windows.

## Links
[BundleReader on Github](https://github.com/jadefish/bundlereader)
