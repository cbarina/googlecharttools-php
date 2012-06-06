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
 * The ChartArea defines the size and position of the displayed chart area.
 *
 *
 * @package view
 * @subpackage options
 */
class ChartArea extends OptionStorage {

    /**
     * Creates a new ChartArea option-set
     *
     * @param string $left
     *              The chart's distance from it's left border
     * @param type $top
     * @param type $width
     * @param type $height
     */
    public function __construct($left = null, $top = null, $width = null, $height = null) {
        $this->setOption("left", $left);
        $this->setOption("top", $top);
        $this->setOption("width", $width);
        $this->setOption("height", $height);
    }

    public function setPosition($left = null, $top = null) {
        $this->setOption("left", $left);
        $this->setOption("top", $top);
    }

    public function setSize($width = null, $height = null) {
        $this->setOption("width", $width);
        $this->setOption("height", $height);
    }


    public function getJsonOptions() {
        return "backgroundColor: " . $this->encodeOptions();
    }

}

?>