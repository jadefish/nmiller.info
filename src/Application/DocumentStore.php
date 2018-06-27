<?php

namespace Application;

use League\CommonMark\CommonMarkConverter;
use Application\Exceptions\FileNotFoundException;

class DocumentStore
{
    protected $app = null;
    protected $markdown = null;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->markdown = new CommonMarkConverter([
            'html_input' => 'allow'
        ]);
    }

    protected function parse(string $path)
    {
        $dir = $this->app->get('storage_dir');
        $filename = "{$dir}/documents/{$path}.md";
        $contents = file_get_contents($filename);

        return $this->markdown->convertToHtml($contents);
    }

    protected function store(string $key, string $contents): ?string
    {
        $dir = $this->app->get('storage_dir');
        $filename = "{$dir}/cache/{$key}";
        $count = file_put_contents($filename, $contents);

        return $count ? $filename : null;
    }

    protected function makeKey(string $filename): string
    {
        return sha1_file($filename);
    }

    public function get(string $path): string
    {
        $dir = $this->app->get('storage_dir');
        $filename = "{$dir}/documents/{$path}.md";

        if (!(is_file($filename) && is_readable($filename))) {
            throw new FileNotFoundException($filename);
        }

        $key = $this->makeKey($filename);
        $cache = realpath("{$dir}/cache/{$key}");

        if ($cache) {
            return file_get_contents($cache);
        }

        $contents = $this->parse($path);
        $cache = $this->store($key, $contents);

        return $contents;
    }
}
