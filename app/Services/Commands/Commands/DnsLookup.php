<?php

namespace App\Services\Commands\Commands;

use App\Services\Commands\Command;
use App\Services\DnsRecordsRetriever;
use Symfony\Component\HttpFoundation\Response;

class DnsLookup implements Command
{
    public function canPerform(string $command): bool
    {
        return true;
    }

    public function perform(string $command): Response
    {
        $dnsRecordsRetriever = new DnsRecordsRetriever();

        $dnsRecords = $dnsRecordsRetriever->retrieveDnsRecords($command);

        if ($dnsRecords === '') {
            $domain = $dnsRecordsRetriever->getSanitizedDomain($command);

            $errorText = __('errors.noDnsRecordsFound', compact('domain'));

            return response([
                'message'   => $errorText,
                'type'      => 'danger',
            ]);
        }

        return response([
            'message'   => htmlentities($dnsRecords),
            'type'      => 'default',
        ]);
    }
}