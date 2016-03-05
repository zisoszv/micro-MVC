<?php

    /*

        localhost Ltd - spl@sh

        Version: 4.0

        File name: action.php
        Description: This file contains the ACTION abstract class.

        Coded by George Delaportas (G0D)

        localhost Ltd
        Copyright © 2013

    */



    /* ------------------------ BEGIN ------------------------ */

    // Include CONTROL class
    require_once(ALPHA_CMS::Absolute_Path('framework/extensions/php/splash/classes/control.php'));

    // Utility: [ACTION]
    abstract class ACTION extends CONTROL
    {

        // Events
        protected $__event_focus = null;
        protected $__event_blur = null;

    }

    /* ------------------------- END ------------------------- */

?>
