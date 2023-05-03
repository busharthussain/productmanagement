<?php

namespace bushart\productmanagement\productmanagement\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class RouteCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'productmanagement:route';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a resource route.stub with Cruds implementation';

    protected $type = 'Route';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . 'routes/web.php';
    }




    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {

            return __DIR__ . '/../../resources/stubs/route.stub';

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $stub = $this->files->get(__DIR__ . '/../../resources/stubs/route.stub');

        $this->files->append(base_path('routes/web.php'), $stub);

    }
}
