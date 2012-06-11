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
 */

namespace googlecharttools\view;

/**
 * Creates a column chart.
 *
 * <b>Data format:</b><br />
 * The column chart requires a {@link DataTable} with at least two columns.
 * The first column is used for the x-axis labels and values. Each column that
 * follows will be seen as y-values for one column.
 *
 * See {@link https://google-developers.appspot.com/chart/interactive/docs/gallery/columnchart}
 * for examples and detailed background information on the required data format.
 *
 * @package view
 */
class ColumnChart extends CartesianChart {

    /**
     * Focus is given to a single data point (On cell in the {@link DataTable}).
     */
    const FOCUS_DATUM = "datum";

    /**
     * Focus is given to all data point that belong to the same x-value
     * (On row in the {@link DataTable}).
     */
    const FOCUS_CATEGORY = "category";

    /**
     * Sets which elements will recevie the focus on mouse hover and on mouse click.
     *
     * @param string $target
     *              The element that will receive the focus. Must be on of the
     *              <i>FOCUS_...</i> constants or null. If set null, the
     *              focus will be on one single data point.
     * @throws \InvalidArgumentException
     *              Thrown, if the given focus is invalid. That is, if a value
     *              other than one of the constants is used.
     */
    public function setFocusTarget($target) {
        if ($target != self::FOCUS_CATEGORY && $target != self::FOCUS_DATUM &&
                $target != null) {
            throw new \InvalidArgumentException("Parameter \"target\" is invalid");
        }
        $this->setOption("focusTarget", $target);
    }

    /**
     * Sets if the elements should be stacked.
     *
     * @param boolean $stacked
     *              If set to true, elements of the same type are stacked.
     *              If set to false or null, the elements are not stacked.
     */
    public function setIsStacked($stacked) {
        $this->setOptionBoolean("isStacked", $stacked);
    }

}

?>
