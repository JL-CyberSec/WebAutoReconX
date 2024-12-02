<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Filament\Infolists\Components\TextEntry;

class TextEntryJson extends TextEntry
{
    protected string $view = 'components.text-entry-json';
}
