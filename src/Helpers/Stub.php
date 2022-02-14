<?php

namespace Regnerisch\LaravelBeyond\Helpers;

use Regnerisch\LaravelBeyond\Actions\MoveAndRefactorFileAction;
use Regnerisch\LaravelBeyond\Actions\MoveFileAction;
use Regnerisch\LaravelBeyond\Actions\RefactorFileAction;

class Stub
{
    public static function makeFromTemplate(string $template, string $path, array $variables = []): void
    {
        $action = new MoveAndRefactorFileAction(
            new MoveFileAction(),
            new RefactorFileAction()
        );

        $action->execute(
            __DIR__ . "/../../stubs/{$template}",
            $path,
            $variables
        );
    }
}
