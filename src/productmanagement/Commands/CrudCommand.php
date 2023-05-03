<?php

namespace bushart\productmanagement\productmanagement\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Facades\Artisan;

class CrudCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'productmanagement:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Point Of Sale system';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Point Of Sale system';


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return;
    }



    /**
     * Execute the console command.
     *
     * @return bool|null
     */
    public function handle()
    {
        $this->handleCommands();
        $this->info($this->type . ' created successfully.');
        $this->info('Do not forget to register any bindings.');
    }

    protected function handleCommands()
    {


        //Generate controllers and models
        $controllerNames = ['ProductType','ProductCategory','ProductSubCategory','ProductListing','Brand','Material','Color','Style','ProductAttachment','Dashboard'];
        foreach ($controllerNames as $name){
            $controllerName = $name . 'Controller';
            //create controller
            if ($name != 'ProductAttachment' && $name != 'Dashboard'){
                $this->call('productmanagement:controller', ['name' => $controllerName]);
            }

            //create model
            if ($name != 'Dashboard') {
                $this->call('productmanagement:model', ['name' => $name]);
            }

            //create model
            if ($name != 'Dashboard' && $name != 'ProductAttachment') {
                $request = $name.'Request';
                $this->call('productmanagement:request', ['name' => $request]);
            }


            //Generate Views
            if ($name != 'ProductAttachment') {
                $this->call('productmanagement:views', ['name' => $name]);
            }
        }

        //Generate Routes
        $this->call('productmanagement:route');

        Artisan::call('vendor:publish', [
            '--tag' => 'migrations',
        ]);

        Artisan::call('vendor:publish', [
            '--tag' => 'public',
        ]);

        //Generate layout
        $this->call('productmanagement:views-partial',['name' => 'test']);

    }
}
