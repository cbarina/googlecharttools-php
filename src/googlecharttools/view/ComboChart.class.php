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
 * Creates a combo chart.
 *
 * <b>Data format:</b><br />
 * The combo chart requires a {@link DataTable} with at least two columns.
 * The first column is used for the X-axis labels and values. Each column that
 * follows will be seen as Y-values for one bar.
 *
 * See {@link https://google-developers.appspot.com/chart/interactive/docs/gallery/combochart}
 * for examples and detailed background information on the required data format.
 *
 * @package view
 */

class ComboChart extends CartesianChart {

    const SERIES_AREA = "area";
    const SERIES_BARS = "bars";
    const SERIES_LINE = "line";

    /**
     * Sets the default series' type.
     *
     * @param string $type
     *              The series marker's type. Must be on of the <i>SERIES_...</i>
     *              constants. If set to null, the default type will be used.
     * @throws \InvalidArgumentException
     *              Thrown, if the given type is invalid. That is, if a value
     *              other than one of the constants is used.
     */
    public function setSeriesType($type) {
        if ($type != self::SERIES_AREA && $type != self::SERIES_BARS &&
                $type != self::SERIES_LINE && $type != null) {
            throw new \InvalidArgumentException("Parameter \"type\" is invalid");
        }
        $this->setOptions("seriesType", $type);
    }

}

?>
