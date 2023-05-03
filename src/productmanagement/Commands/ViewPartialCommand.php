<?php

namespace bushart\productmanagement\productmanagement\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ViewPartialCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'productmanagement:views-partial {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates productmanagement views';

    protected $type = 'Views';
    private $current_stub;

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return [
            '_navbar.blade.php' => __DIR__ . '/../../resources/stubs/views/partials/navbar.stub',
            '_sidebar.blade.php' => __DIR__ . '/../../resources/stubs/views/partials/sidebar.stub',
            'index.blade.php' => __DIR__ . '/../../resources/stubs/views/layout/index.stub',
        ];
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        return resource_path('views/admin/layout/partials');
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPathView($name)
    {
        return resource_path('views/admin/layout');
    }


    /**
     * Build the class with the given name.
     *
     * Remove the base controller import if we are already in base namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $controllerNamespace = '';
        $replace = [
            'DummyServiceVar' => '',
            'DummyViewPath' => '',
            'DummyHeading' => '',
            'DummySingularServiceVar' => ''
        ];
        return str_replace(
            array_keys($replace),
            array_values($replace),
            $this->generateClass($name)
        );
    }

    protected function generateClass($name)
    {
        $stub = $this->files->get($this->current_stub);
        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return $this->files->exists($this->getPath($this->getNameInput()));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment('Building new views.');

        $path = $this->getPath(strtolower('layout/partials'));
        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type . ' already exist!');
            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        foreach ($this->getStub() as $name => $stub) {
            $viewName = explode('.',$name);
            if (!empty($viewName) && $viewName[0] == 'index'){
                $path = $this->getPathView(strtolower('layout'));
            }
            $this->current_stub = $stub;
            $this->makeDirectory($path . '/' . $name);
            $this->files->put($path . '/' . $name, $this->buildClass($this->getNameInput()));
        }

    }
}
