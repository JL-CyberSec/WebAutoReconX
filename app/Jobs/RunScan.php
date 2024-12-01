<?php

namespace App\Jobs;

use App\Models\Scan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RunScan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Scan $scan
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fastapiUri = config('scan.fastapi_uri');
        $endpoints = config('scan.endpoints');

        foreach ($endpoints as $endpoint) {
            $endpoint = str_replace('{timing}', $this->scan->nmap_timing, $endpoint);

            $response = Http::get("$fastapiUri/$endpoint");
            $data = $response->json();
            
            $this->scan->incrementStatus();
        }
    }
}
