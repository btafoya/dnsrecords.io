<?php

namespace App\Services\Commands\Commands;

use App\Services\Commands\Command;
use Symfony\Component\HttpFoundation\Response;

class Manual implements Command
{
    public function canPerform(string $command): bool
    {
        return $command === 'help';
    }

    public function perform(string $command): Response
    {
        $manualText = collect([
            'Enter a domain name to retrieve all DNS records.',
            "Enter 'ip' to check your own address.",
            "Enter 'clear' to wipe the screen.",
            "Enter 'doom' to play Doom.",
            "Drag this bookmarklet to your toolbar to <a class=\"bookmarklet\" href=\"javascript:location.href='https://dig.tafoyaventures.com/'+location.hostname;\">lookup DNS records</a> for sites you're visiting."
        ])->implode('<br>');

        flash()->message($manualText, 'info');

        return redirect('/');
    }
}
