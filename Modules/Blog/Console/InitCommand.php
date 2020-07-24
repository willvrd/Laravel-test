<?php

namespace Modules\Blog\Console;

use Illuminate\Console\Command;
use Modules\User\Traits\Permissions;

class InitCommand extends Command
{

    use Permissions;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'blog:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create permissions.';

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

        try{

            $this->line('');
            $this->info('WELCOME TO BLOG MODULE:');

            $this->createPermissionsFromModule("blog.permissions");

            $this->info("THAT'S ALL MY FRIEND ;)");


        }catch(\Exception $e){
            $this->line('');
            $this->error(":O ERROR:");
            $this->line($e);
            $this->error("NO MORE");
        }


    }


}
