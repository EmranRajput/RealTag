<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowPaths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'show:paths';
    
    protected $description = 'Display important paths in Laravel';

    public function handle()
    {
        $basePath = base_path();
        $publicPath = public_path();

        $this->info('Base Path: ' . $basePath);
        $this->info('Public Path: ' . $publicPath);
    }
}
