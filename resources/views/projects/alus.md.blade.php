@extends('layouts.app')
@section('title', 'Project: alus')

@section('content')

# Project: alus

## Overview
**alus** is a web application framework written in
[Lua](https://www.lua.org/). In Estonian, _alus_ means "basis", "base",
or "foundation".

I have not spent much time working on alus, so it is very feature incomplete.

## Structure
The planned structure for alus is as follows.

* Request/responses alá
  [symfony/http-foundation](https://github.com/symfony/http-foundation)
* I/O via
  [luarocks/luasocket](https://luarocks.org/modules/luarocks/luasocket) and
  [keplerproject/luafilesystem](https://github.com/keplerproject/luafilesystem)
* SQLite support via
  [dougcurrie/lsqlite3](https://luarocks.org/modules/dougcurrie/lsqlite3)
* Environment support via
  [moteus/environ](https://github.com/moteus/lua-environ)
* PCRE2 support via [Lrexlib](https://rrthomas.github.io/lrexlib/)
* Templating/views: custom
* Routing: custom
* Sessions: custom

## Rationale

I greatly enjoy Lua. It's a simple language that's quick to learn,
comfortable to use, and is extraordinarily fast when compiled via
[LuaJIT](http://luajit.org/).

alus is the result of my love for web development, small, fast languages, and
the innate desire to reinvent the wheel just for fun.

## Links
[alus on Github](https://github.com/jadefish/alus)
@endsection
