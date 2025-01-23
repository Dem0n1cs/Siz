<?php

namespace App\Services;

use PhpOffice\PhpWord\TemplateProcessor as BaseTemplateProcessor;
use PhpOffice\PhpWord\Shared\Text;

class CustomTemplateProcessor extends BaseTemplateProcessor
{
    protected static function ensureUtf8Encoded($subject): ?string
    {
        return ($subject !== null) ? Text::toUTF8($subject) : '';
    }
}
