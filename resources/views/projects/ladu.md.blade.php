@extends('layouts.app')
@section('title', 'Project: ladu')

@section('content')

# Project: ladu

## Overview
**ladu** is a key-value store written in C11. It utilizes
[libuv](https://libuv.org) for its event loop and asynchronous networking and
I/O. In Estonian, _ladu_ means "storage", "store", or "warehouse".

I have not spent much time working on ladu, so it currently is just a
Makefile and libuv TCP echo server example.

## Links
[ladu on Github](https://github.com/jadefish/ladu)
@endsection
