<?php

namespace bushart\productmanagement\productmanagement\Commands;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ControllerCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'productmanagement:controller {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a controller';

    protected $type = 'Controller';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Controllers';
    }

    protected function buildClass($name)
    {
        $controllerNamespace = '';

        $replace["use {$controllerNamespace}\Controller;\n"] = '';
        $replace = array_merge($replace, [
            'DummyViewPath' => '',
            'DummyServiceVar' => '',
            'DummySingularServiceVar' => '',
            'DummyContract' => '',
            'DummyModel' => '',
        ]);

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }


    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $string = str_replace($this->getNamespace($this->getNameInput()) . '\\', '', $this->getNameInput());
        $name = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));

        return __DIR__ . '/../../resources/stubs/controllers'.'/'.$name.'.stub';

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->comment('Building new based resource controller');

        $name = $this->qualifyClass($this->getNameInput());
        $path = $this->getPath($name);
        if ($this->alreadyExists($this->getNameInput())) {
            $this->error($this->type . ' already exists!');

            return false;
        }

        // Next, we will generate the path to the location where this class' file should get
        // written. Then, we will build the class and make the proper replacements on the
        // stub files so that it gets the correctly formatted namespace and class name.
        $this->makeDirectory($path);
        $this->files->put($path, $this->buildClass($name));

    }
}
