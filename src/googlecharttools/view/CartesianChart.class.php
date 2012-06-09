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

use googlecharttools\view\options\Animation;

/**
 * A CartesianChart is used as base for all charts that are based on a coordinate system.
 *
 * All charts that extends the CartesianChart do have x- and y-axis, for which
 * this class provides the specific options.
 *
 * @package view
 */
abstract class CartesianChart extends Chart {
    /**
     * The axis title will be drawn inside the chart area.
     */

    const AXIS_TITLE_IN = "in";

    /**
     * The axis title will be drawn outsite the chart area.
     */
    const AXIS_TITLE_OUT = "out";

    /**
     * The axis title won't be displayed.
     */
    const AXIS_TITLE_NONE = "none";

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
     * Sets the animation that will be used when the data is drawn or redrawn.
     *
     * @param Animation $animation
     *              The animation. If set to null, no animation will be used.
     */
    public function setAnimation(Animation $animation) {
        $this->setOption("animation", $animation);
    }

    /**
     * Sets the position where the axis title will be displayed.
     *
     * @param string $position
     *              The title's position. Must be one of the <i>AXIS_TITLE_...</i>
     *              constants or null. If set to null, the title will be
     *              drawn outsite the chart area.
     * @throws \InvalidArgumentException
     *              Thrown, if the given position is invalid. That is, if a value
     *              other than one of the constants is used.
     */
    public function setAxisTitlesPosition($position) {
        if ($position != self::AXIS_TITLE_IN && $position != self::AXIS_TITLE_NONE &&
                $position != self::AXIS_TITLE_OUT && $position != null) {
            throw new \InvalidArgumentException("Parameter \"position\" is invalid");
        }
        $this->setOption("axisTitlesPosition", $position);
    }

    /**
     * Sets if the chart will react on user actions and throws events.
     *
     * @param boolean $interactivity
     *              If set to true, the chart will react on user actions and
     *              throw events. If set to null, the chart will behave is set
     *              to true.
     */
    public function setEnableInteractivity($interactivity) {
        $this->setOptionBoolean("enableInteractivity", $interactivity);
    }

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
     * Sets the appearance of the horizontal axis.
     *
     * @param Axis $axis
     *              The axis definition.
     */
    public function setHAxis(Axis $axis) {
        $this->setOption("hAxis", $axis);
    }

    // TODO: Implement remaining options.

    /**
     * Sets the appearance of the vertical axis.
     *
     * @param Axis $axis
     *              The axis definition.
     */
    public function setVAxis(Axis $axis) {
        $this->setOption("vAxis", $axis);
    }

}

?>
