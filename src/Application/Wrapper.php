<?php

namespace Application;

class Wrapper
{
    protected $app = null;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function wrap(string $contents, array $args = []): string
    {
        $filename = $this->app->get('storage_dir') . '/layout.phtml';
        $context = $this->makeContext([
            'content' => $contents,
        ] + $args);
        $renderer = function (string $filename): string {
            ob_start();

            require $filename;

            return ob_get_clean();
        };

        return $renderer->call($context, $filename);
    }

    protected function makeContext(array $args = []): object
    {
        return new class($args) {
            public function __construct(array $args)
            {
                foreach ($args as $key => $value) {
                    $this->$key = $value;
                }
            }
        };
    }
}
