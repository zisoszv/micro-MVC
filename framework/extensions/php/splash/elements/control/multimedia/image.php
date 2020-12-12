<?php
    /*
        spl@sh (Class)

        File name: image.php (Version: 4.6)
        Description: This file contains the "IMAGE" class.

        Coded by George Delaportas (G0D)
        Copyright (C) 2013
        Open Software License (OSL 3.0)
    */

    /* ------------------------ BEGIN ------------------------ */

    // Include MULTIMEDIA class
    require_once(UTIL::Absolute_Path('framework/extensions/php/splash/utilities/control/multimedia.php'));

    // Class: [IMAGE]
    class IMAGE extends MULTIMEDIA
    {
        // Attributes
        private $__attr_alt = null;
        private $__attr_width = null;
        private $__attr_height = null;
        private $__attr_usemap = null;
        private $__attr_ismap = false;

        public function Show($attributes, $events = null)
        {
            if (!HELPERS::Valid_Parameters($attributes, $events))
            {
                HELPERS::Error('Image', 2);

                return false;
            }

            if (!HELPERS::Parameters_Contain($attributes, 'src') && !HELPERS::Parameters_Contain($attributes, 'alt'))
            {
                HELPERS::Error('Image', 17);

                return false;
            }

            if (empty($attributes['src']) || empty($attributes['alt']))
            {
                HELPERS::Error('Image', 18);

                return false;
            }

            $html_tag = '<img src="' . $attributes['src'] . '" alt="' . $attributes['alt'] . '" ';
            $this->__attr_src = $attributes['src'];
            $this->__attr_alt = $attributes['alt'];

            foreach ($attributes as $key => $value)
            {
                if (HELPERS::Is_Empty($value))
                {
                    HELPERS::Error('Image', 5);

                    return false;
                }

                if ($key == 'id')
                {
                    $html_tag .= 'id="' . $value . '" ';
                    $this->__attr_id = $value;
                }
                else if ($key == 'class')
                {
                    $html_tag .= 'class="' . $value . '" ';
                    $this->__attr_class = $value;
                }
                else if ($key == 'style')
                {
                    $html_tag .= 'style="' . $value. '" ';
                    $this->__attr_style = $value;
                }
                else if ($key == 'title')
                {
                    $html_tag .= 'title="' . $value . '" ';
                    $this->__attr_title = $value;
                }
                else if ($key == 'lang')
                {
                    $html_tag .= 'lang="' . $value . '" ';
                    $this->__attr_lang = $value;
                }
                else if ($key == 'accesskey')
                {
                    $html_tag .= 'accesskey="' . $value . '" ';
                    $this->__attr_accesskey = $value;
                }
                else if ($key == 'tabindex')
                {
                    $html_tag .= 'tabindex="' . $value . '" ';
                    $this->__attr_tabindex = $value;
                }
                else if (strpos($key, 'data-') === 0)
                {
                    $html_tag .= $key . '="' . $value . '" ';
                    array_push($this->__attr_data, $value);
                }
                else if ($key == 'width' && HELPERS::Is_Positive_Integer($value))
                {
                    $html_tag .= 'width="' . $value . '" ';
                    $this->__attr_width = $value;
                }
                else if ($key == 'height' && HELPERS::Is_Positive_Integer($value))
                {
                    $html_tag .= 'height="' . $value . '" ';
                    $this->__attr_height = $value;
                }
                else if ($key == 'usemap')
                {
                    $html_tag .= 'usemap="' . $value . '" ';
                    $this->__attr_usemap = $value;
                }
                else if ($key == 'ismap' && HELPERS::Is_True($value))
                {
                    $html_tag .= 'ismap ';
                    $this->__attr_ismap = true;
                }
                else
                {
                    if ($key != 'src' && $key != 'alt')
                    {
                        HELPERS::Error('Image', 6);

                        return false;
                    }
                }
            }

            if (!empty($events))
            {
                foreach ($events as $key => $value)
                {
                    if (HELPERS::Is_Empty($value))
                    {
                        HELPERS::Error('Image', 7);

                        return false;
                    }

                    if ($key == 'onserverclick' || $key == 'onajaxserverclick' || $key == 'onclick')
                    {
                        if ($key == 'onserverclick')
                        {
                            if (empty($value[0]))
                                return false;

                            $html_tag .= 'onclick="splash(' . '\'' . $value[0] . '\'' . ', 1, ';

                            if (empty($value[1]))
                                $html_tag .= 'null' . ');" ';
                            else
                               $html_tag .= '\'' . $value[1] . '\'' . ');" ';

                            $this->__event_server_mouse = $value;
                        }
                        else if ($key == 'onajaxserverclick')
                        {
                            if (empty($value[0]))
                                return false;

                            $html_tag .= 'onclick="splash(' . '\'' . $value[0] . '\'' . ', 2, ';

                            if (empty($value[1]))
                                $html_tag .= 'null' . ');" ';
                            else
                               $html_tag .= '\'' . $value[1] . '\'' . ');" ';

                            $this->__event_ajax_server_mouse = $value;
                        }
                        else
                        {
                            $html_tag .= 'onclick="' . $value . '" ';
                            $this->__event_click = $value;
                        }
                    }
                    else if ($key == 'ondblclick')
                    {
                        $html_tag .= 'ondblclick="' . $value . '" ';
                        $this->__event_dblclick = $value;
                    }
                    else if ($key == 'onmousedown')
                    {
                        $html_tag .= 'onmousedown="' . $value . '" ';
                        $this->__event_mousedown = $value;
                    }
                    else if ($key == 'onmousemove')
                    {
                        $html_tag .= 'onmousemove="' . $value . '" ';
                        $this->__event_mousemove = $value;
                    }
                    else if ($key == 'onmouseout')
                    {
                        $html_tag .= 'onmouseout="' . $value . '" ';
                        $this->__event_mouseout = $value;
                    }
                    else if ($key == 'onmouseover')
                    {
                        $html_tag .= 'onmouseover="' . $value . '" ';
                        $this->__event_mouseover = $value;
                    }
                    else if ($key == 'onmouseup')
                    {
                        $html_tag .= 'onmouseup="' . $value . '" ';
                        $this->__event_mouseup = $value;
                    }
                    else if ($key == 'onfocus')
                    {
                        $html_tag .= 'onfocus="' . $value . '" ';
                        $this->__event_focus = $value;
                    }
                    else if ($key == 'onblur')
                    {
                        $html_tag .= 'onblur="' . $value . '" ';
                        $this->__event_blur = $value;
                    }
                    else if ($key == 'onserverkeydown' || $key == 'onajaxserverkeydown' || $key == 'onkeydown')
                    {
                        if ($key == 'onserverkeydown')
                        {
                            if (empty($value[0]))
                                return false;

                            $html_tag .= 'onkeydown="splash(' . '\'' . $value[0] . '\'' . ', 1, ';

                            if (empty($value[1]))
                                $html_tag .= 'null' . ');" ';
                            else
                               $html_tag .= '\'' . $value[1] . '\'' . ');" ';

                            $this->__event_server_key = $value;
                        }
                        else if ($key == 'onajaxserverkeydown')
                        {
                            if (empty($value[0]))
                                return false;

                            $html_tag .= 'onkeydown="splash(' . '\'' . $value[0] . '\'' . ', 2, ';

                            if (empty($value[1]))
                                $html_tag .= 'null' . ');" ';
                            else
                               $html_tag .= '\'' . $value[1] . '\'' . ');" ';

                            $this->__event_ajax_server_key = $value;
                        }
                        else
                        {
                            $html_tag .= 'onkeydown="' . $value . '" ';
                            $this->__event_keydown = $value;
                        }
                    }
                    else if ($key == 'onkeypress')
                    {
                        $html_tag .= 'onkeypress="' . $value . '" ';
                        $this->__event_keypress = $value;
                    }
                    else if ($key == 'onkeyup')
                    {
                        $html_tag .= 'onkeyup="' . $value . '" ';
                        $this->__event_keyup = $value;
                    }
                    else if ($key == 'onabort')
                    {
                        $html_tag .= 'onabort="' . $value . '" ';
                        $this->__event_abort = $value;
                    }
                    else
                    {
                        HELPERS::Error('Image', 8);

                        return false;
                    }
                }
            }

            $html_tag .= '>';

            return $html_tag;
        }

        public function Debug($attributes = null, $events = null)
        {
            if (!empty($attributes))
            {
                if (!HELPERS::Valid_Parameters($attributes, $events))
                {
                    HELPERS::Error('Image', 9);

                    return false;
                }
            }

            $attributes_array = array();
            $events_array = array();
            $final_array = array();

            if (HELPERS::Is_Valid_Array($attributes))
            {
                foreach ($attributes as $key => $value)
                {
                    if ($key == 'id')
                        array_push($attributes_array, $this->__attr_id);
                    else if ($key == 'class')
                        array_push($attributes_array, $this->__attr_class);
                    else if ($key == 'style')
                        array_push($attributes_array, $this->__attr_style);
                    else if ($key == 'title')
                        array_push($attributes_array, $this->__attr_title);
                    else if ($key == 'lang')
                        array_push($attributes_array, $this->__attr_lang);
                    else if ($key == 'accesskey')
                        array_push($attributes_array, $this->__attr_accesskey);
                    else if ($key == 'tabindex')
                        array_push($attributes_array, $this->__attr_tabindex);
                    else if ($key == 'data')
                        array_push($attributes_array, $this->__attr_data);
                    else if ($key == 'src')
                        array_push($attributes_array, $this->__attr_src);
                    else if ($key == 'alt')
                        array_push($attributes_array, $this->__attr_alt);
                    else if ($key == 'width')
                        array_push($attributes_array, $this->__attr_width);
                    else if ($key == 'height')
                        array_push($attributes_array, $this->__attr_height);
                    else if ($key == 'usemap')
                        array_push($attributes_array, $this->__attr_usemap);
                    else if ($key == 'ismap')
                        array_push($attributes_array, $this->__attr_ismap);
                    else
                    {
                        HELPERS::Error('Image', 10);

                        return false;
                    }
                }
            }

            if (HELPERS::Is_Valid_Array($events))
            {
                foreach ($events as $key => $value)
                {
                    if ($key == 'onserverclick')
                        array_push($events_array, $this->__event_server_mouse);
                    else if ($key == 'onajaxserverclick')
                        array_push($events_array, $this->__event_ajax_server_mouse);
                    else if ($key == 'onclick')
                        array_push($events_array, $this->__event_click);
                    else if ($key == 'ondblclick')
                        array_push($events_array, $this->__event_dblclick);
                    else if ($key == 'onmousedown')
                        array_push($events_array, $this->__event_mousedown);
                    else if ($key == 'onmousemove')
                        array_push($events_array, $this->__event_mousemove);
                    else if ($key == 'onmouseout')
                        array_push($events_array, $this->__event_mouseout);
                    else if ($key == 'onmouseover')
                        array_push($events_array, $this->__event_mouseover);
                    else if ($key == 'onmouseup')
                        array_push($events_array, $this->__event_mouseup);
                    else if ($key == 'onfocus')
                        array_push($events_array, $this->__event_focus);
                    else if ($key == 'onblur')
                        array_push($events_array, $this->__event_blur);
                    else if ($key == 'onserverkeydown')
                        array_push($events_array, $this->__event_server_key);
                    else if ($key == 'onajaxserverkeydown')
                        array_push($events_array, $this->__event_ajax_server_key);
                    else if ($key == 'onkeydown')
                        array_push($events_array, $this->__event_keydown);
                    else if ($key == 'onkeypress')
                        array_push($events_array, $this->__event_keypress);
                    else if ($key == 'onkeyup')
                        array_push($events_array, $this->__event_keyup);
                    else if ($key == 'onabort')
                        array_push($events_array, $this->__event_abort);
                    else
                    {
                        HELPERS::Error('Image', 11);

                        return false;
                    }
                }
            }

            $merged_array = array_merge($attributes_array, $events_array);
            $final_array = HELPERS::Filter_Null_Values($merged_array);

            return $final_array;
        }
    }

    /* ------------------------- END ------------------------- */
?>
