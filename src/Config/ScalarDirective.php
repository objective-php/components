<?php
    /**
     * This file is part of the Objective PHP project
     *
     * More info about Objective PHP on www.objective-php.org
     *
     * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
     */
    
    namespace ObjectivePHP\Config;
    
    
    abstract class ScalarDirective extends AbstractDirective
    {
        /**
         * Directive configuration identifier (will be used as key in the Config object)
         */
        const DIRECTIVE = 'THIS HAS TO BE SET IN INHERITED CLASSES';

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

            // only set directive if it is not present or if it can be overridden
            if ($config->lacks($identifier) || $this->isOverrideAllowed)
            {
                $config->set($identifier, $this->getValue());
            }

            return $this;
        }


    }
