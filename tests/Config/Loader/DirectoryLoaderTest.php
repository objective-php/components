<?php

    namespace Test\ObjectivePHP\Config\Loader;


    use ObjectivePHP\Config\Exception;
    use ObjectivePHP\Config\Loader\DirectoryLoader;
    use ObjectivePHP\Config\SingleValueDirectiveGroup;
    use ObjectivePHP\Config\SingleValueDirective;
    use ObjectivePHP\Config\StackedValuesDirective;
    use ObjectivePHP\PHPUnit\TestCase;

    class DirectoryLoaderTest extends TestCase
    {


        public function testLoadingConfigFromNonExistingLocationFailsWithAnException()
        {
            $this->expectsException(function() use(&$location)
            {
                $loader = new DirectoryLoader();
                $loader->load($location = uniqid(uniqid()));
            }, Exception::class, $location, Exception::INVALID_LOCATION);
        }

        public function testConfigTreeLoading()
        {
            $configLoader = new DirectoryLoader();

            $config = $configLoader->load(__DIR__ . '/config');
            $this->assertEquals($this->getExpectedConfig(), $config->toArray());

        }

        protected function getExpectedConfig()
        {

            return [
                'multiple.version' => '1.0',
                'multiple.env'     => 'dev',
                'stack' => ['packageX', 'packageY'],
                'test' => 'value'
            ];

        }

    }

    class TestSingleValueDirective extends SingleValueDirective
    {
        const DIRECTIVE = 'test';
    }

    class TestStackedValuesDirective extends StackedValuesDirective
    {
        const DIRECTIVE = 'stack';
    }

    class TestSingleValueDirectiveGroup extends SingleValueDirectiveGroup
    {
        const PREFIX = 'multiple';
    }
