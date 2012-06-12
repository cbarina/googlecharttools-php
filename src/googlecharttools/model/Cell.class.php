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
 * @package model
 */

namespace googlecharttools\model;

use googlecharttools\model\Column;

/**
 * A Cell stores the data of one cell of the {@link DataTable}.
 *
 * Various cells are grouped together in a {@link Row}.
 *
 * Please visit Google's API documentation on
 * {@link https://google-developers.appspot.com/chart/interactive/docs/reference#cell_object}
 * for detailed background information.
 *
 * @package model
 */
class Cell {

    /** @var mixed */
    private $value;

    /** @var string */
    private $formatted;

    /** @var string */
    private $properties;

    /**
     * Creates a new cell.
     *
     * @param mixed $value
     *              The cells value, that will be used to render the chart.
     *              If $formatted is not set, this will be displayed, too.
     *              This parameter's data type depends on the {@link Column} this
     *              cell belongs to:
     *              <ul>
     *                  <li>{@link Column::TYPE_BOOLEAN}: Boolean</li>
     *                  <li>{@link Column::TYPE_NUMBER}: Integer</li>
     *                  <li>{@link Column::TYPE_STRING}: string or number</li>
     *                  <li>{@link Column::TYPE_DATE} and {@link Column::TYPE_DATETIME}:
     *                      A PHP timestamp (will be converted into a JavaScript
     *                      date-object automatically)</li>
     *                  <li>{@link Column::TYPE_TIMEOFDAY}: Array with three or
     *                      four elements (in this sequence): Hour, minute, second
     *                      [, millisecond]</li>
     *               </ul>
     * @param string $formatted
     *              If specified, this value will be displayed instead of $value.
     *              Should match with the value specified in the $value parameter.
     * @param string $properties
     *              Any additional properties that might be used by some chart types.
     */
    public function __construct($value, $formatted = null, $properties = null) {
        $this->value = $value;
        $this->formatted = $formatted;
        $this->properties = $properties;
    }

    /**
     * Gets the cell's value
     *
     * @return mixed
     *              The cells value. The actual type depends on the {@link Column}
     *              this cell depends to.
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Gets the cell's formatted value
     *
     * @return string
     *              The formatted value or null, if no formatted value has been set
     */
    public function getFormatted() {
        return $this->formatted;
    }

    /**
     * Gets the cell's properties
     * @return string
     *              Any additional properties that have been addded to the cell
     */
    public function getProperties() {
        return $this->properties;
    }

    /**
     * Sets the cell's value
     *
     * @param mixed $value
     *              The cells value, that will be used to render the chart.
     *              If $formatted is not set, this will be displayed, too.
     *              The parameter's data type depends on the {@link Column} this
     *              cell belongs to:
     *              <ul>
     *                  <li>{@link Column::TYPE_BOOLEAN}: Boolean</li>
     *                  <li>{@link Column::TYPE_NUMBER}: Integer</li>
     *                  <li>{@link Column::TYPE_STRING}: string or number</li>
     *                  <li>{@link Column::TYPE_DATE} and {@link Column::TYPE_DATETIME}:
     *                      A PHP timestamp (will be converted into a JavaScript
     *                      date-object automatically)</li>
     *                  <li>{@link Column::TYPE_TIMEOFDAY}: Array with three or
     *                      four elements (in this squence): Hour, minute, seconds
     *                      [, milliseconds]</li>
     *               </ul>
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * Sets the cell's formatted value.
     * If not set, the cell's value will be displayed
     *
     * @param string $formatted
     *              If specified, this value will be displayed instead of the cells value.
     *              Should match with the value specified.
     */
    public function setFormatted($formatted) {
        $this->formatted = $formatted;
    }

    /**
     * Sets the cell's properties.
     *
     * @param type $properties
     *              Any additional properties that will be used by some chart types.
     */
    public function setProperties($properties) {
        $this->properties = $properties;
    }

    /**
     * Converts this object into a JSON representation.
     *
     * This representation follows the JavaScript literal format specified
     * on {@link https://google-developers.appspot.com/chart/interactive/docs/reference#dataparam}
     * as element of an entry of the "row" JavaScript array.
     *
     * @param string $type
     *              The cells type that has been set in the corresponding
     *              {@link Column} (used to convert the
     *              cell's value into a proper output format)
     * @return string
     *              The JSON representation of this Cell
     */
    public function toJsonString($type) {
        $string = "{\"v\": ";

        // Convert value to correct output according to the column's type
        switch ($type) {
            case Column::TYPE_BOOLEAN:
                $string .= $this->value ? "true" : "false";
                break;
            case Column::TYPE_NUMBER:
                $string .= $this->value;
                break;
            case Column::TYPE_STRING:
                $string .= "\"" . $this->value . "\"";
                break;
            case Column::TYPE_DATE:
            case Column::TYPE_DATETIME:
                $string .= "new Date(" . $this->value * 1000 . ")";
                break;
            case TYPE_TIMEOFDAY:
                $string .= "[";
                implode(", ", $this->value);
                $string .= "]";
                break;
        }


        if ($this->formatted != null) {
            $string .= ", \"f\": \"" . $this->formatted . "\"";
        }

        if ($this->properties != null) {
            $string .= ", \"p\": \"" . $this->properties . "\"";
        }


        $string .= "}";
        return $string;
    }

}

?>
