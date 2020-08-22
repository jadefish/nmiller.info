# nmiller.info

It's my personal website.

## Requirements

* ruby 2.7.1
* pandoc 2
* Golang 1.15

## Details

`builder` reads [GitHub Flavored Markdown](https://github.github.com/gfm/#what-is-github-flavored-markdown)
files from the provided `--docs_dir` and uses [pandoc](https://pandoc.org/) to
convert them to HTML.

These converted markdown files are interpolated with the provided ERB template
`--wrapper` to produce full-fledged views.

Finally, `server` serves up these generated views. TODO TODO TODO
