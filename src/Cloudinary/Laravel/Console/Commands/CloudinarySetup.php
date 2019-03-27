<?php

namespace JoeTannenbaum\Cloudinary\Laravel\Console\Commands;

use Illuminate\Console\Command;

class CloudinarySetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cloudinary:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Cloudinary';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!env('CLOUDINARY_URL')) {
            $url = $this->ask('What is your Cloudinary URL?');
            dd($url);
        }
    }
}
