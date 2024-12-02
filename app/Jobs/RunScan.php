<?php

namespace App\Jobs;

use App\Models\Scan;
use App\Models\ScanResult;
use App\Services\OpenAI;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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
        $openAI = new OpenAI;

        $fastapiUri = config('scan.fastapi_uri');
        $endpoints = config('scan.endpoints');

        foreach ($endpoints as $key => $endpoint) {
            $endpoint = str_replace('{timing}', $this->scan->nmap_timing, $endpoint);

            $response = Http::timeout(0)->get("$fastapiUri/$endpoint");
            $data = $response->json();

            $data['type'] = $key;
            $data['scan_id'] = $this->scan->id;
            $data['recommendations'] = $openAI->chat(json_encode($data));

            ScanResult::create($data);
            
            $this->scan->incrementStatus();
        }
    }
}
