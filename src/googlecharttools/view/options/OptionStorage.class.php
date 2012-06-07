<?php

/*
 * Copyright 2012 Patrick Strobel.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * @author Patrick Strobel
 * @license http://www.apache.org/licenses/LICENSE-2.0  Apache License, Version 2.0
 * @link http://code.google.com/p/googlecharttools-php
 * @version $Id$
 * @package view
 * @subpackage options
 */

namespace googlecharttools\view\options;

/**
 * Abstract base class for all charts and option-sets that store information.
 *
 * @package view
 * @subpackage options
 */
abstract class OptionStorage {

    /** @var mixed[] */
    private $options = array();

    /**
     * Gets an option's value
     *
     * @param string $name
     *                  The name of the option to get the value for
     * @return mixed
     *                  The option's value. Might be null, if option is not set
     */
    public function getOption($name) {
        if (key_exists($name, $this->options)) {
            return $this->options[$name];
        } else {
            return null;
        }
    }

    /**
     * Sets an option to a given value.
     *
     * This allows to set additional options that are currently not supported by the set-methods.
     * Howevever, you should always use on of the other set-methods if possible.
     *
     * Through this method, additional option-code can be added to the generated
     * JavaScript-code. This is usefull, when options should be set that are
     * currently not directly supported by this API (through set...() methods).
     *
     * @param string $name
     *                  The option's name
     * @param string $value
     *                  The option's value. If set to null, the option
     *                  will be removed
     */
    public function setOption($name, $value) {
        if ($value !== null) {
            $this->options[$name] = $value;
        } else {
            unset($this->options[$name]);
        }
    }

    /**
     * Sets an option to a given value.
     *
     * This has the same semantic as {@link setOption()}.
     * However, only boolean values are accepted.
     *
     * @param string $name
     *                  The option's name
     * @param boolean $value
     *                  The option's value. If set to null, the option
     *                  will be removed
     */
    public function setOptionBoolean($name, $value) {
        if (is_bool($value) || $value == null) {
            $this->setOption($name, $value);
        }
    }

    /**
     * Sets an option to a given value.
     *
     * This has the same semantic as {@link setOption()}.
     * However, only numeric values are accepted.
     *
     * @param string $name
     *                  The option's name
     * @param number $value
     *                  The option's value. If set to null, the option
     *                  will be removed
     */
    public function setOptionNumeric($name, $value) {
        if (is_numeric($value) || $value == null) {
            $this->setOption($name, $value);
        }
    }

    /**
     * Sets an option to a given value.
     *
     * This has the same semantic as {@link setOption()}.
     * However, only array values are accepted.
     *
     * @param string $name
     *                  The option's name
     * @param string[] $value
     *                  The option's value. If set to null, the option
     *                  will be removed
     */
    public function setOptionArray($name, $value) {
        if (is_array($value) || $value == null) {
            $this->setOption($name, $value);
        }
    }

    /**
     * Encodes the set options into a JSON-object
     *
     * @return string
     *                  Encoded options
     */
    protected function encodeOptions() {
        $encoded = "{";

        $first = true;
        foreach ($this->options as $name => $value) {
            if (!$first) {
                $encoded .= ", ";
            } else {
                $first = false;
            }

            if ($value instanceof OptionStorage) {
                $encoded .= $name . ": " . $value->encodeOptions();
            } else if (is_array($value)) {
                $encoded .= $name . ": " . json_encode($value);
            } else if (is_bool ($value)) {
                $encoded .= $name . ": " . ($value ? "true" : "false");
            } else {
                $encoded .= $name . ": \"" . $value . "\"";
            }
        }
        $encoded .= "}";
        return $encoded;
    }

}

?>
