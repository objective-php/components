<?php
    /**
     * This file is part of the Objective PHP project
     *
     * More info about Objective PHP on www.objective-php.org
     *
     * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
     */
    
    namespace ObjectivePHP\Config;
    
    
    abstract class StackDirective extends AbstractDirective
    {
        const DIRECTIVE = 'THIS HAS TO BE SET IN INHERITED CLASSES';

        /**
         * @var bool
         */
        protected $isOverrideAllowed = false;

        /**
         * ScalarDirective constructor.
         *
         * @param $value
         */
        public function __construct($value)
        {
            $this->value = $value;
        }

        /**
         * @param ConfigInterface $config
         *
         * @return DirectiveInterface
         * @throws Exception
         */
        public function mergeInto(ConfigInterface $config) : DirectiveInterface
        {
            $identifier = static::DIRECTIVE;

            $currentValue = $this->isOverrideAllowed ? [] : $config->get($identifier, []);

            $currentValue[] = $this->value;

            $config->set($identifier, $currentValue);

            return $this;
        }


    }
