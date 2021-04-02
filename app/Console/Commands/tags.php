<?php

namespace App\Console\Commands;

use App\Models\Tag;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class tags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Tags To DataBase';

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
     * @return int
     */
    public function handle()
    {   
        $tag= new Tag;
        $tag->label='Gas Bill';
        $tag->slug= Str::slug($tag->label);
        $tag->save();

        $tag= new Tag;
        $tag->label='Electricity Bill';
        $tag->slug= Str::slug($tag->label);
        $tag->save();

        $tag= new Tag;
        $tag->label='Utility Bill';
        $tag->slug= Str::slug($tag->label);
        $tag->save();

        $tag= new Tag;
        $tag->label='Water Bill';
        $tag->slug= Str::slug($tag->label);
        $tag->save();
    }
}
