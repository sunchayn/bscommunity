<?php

class HTML {

    /**
     * @param $input
     * @return mixed|tidy
     */
    public static function clean($input)
    {
        //-- using php Tidy library --//
        if (extension_loaded('Tidy'))
        {
            //Specify configuration
            $config = array(
                'indent'         => true,
                'output-xhtml'   => true,
                'show-body-only' => true,
            );
            // Tidy
            $tidy = new tidy;
            $tidy->parseString($input, $config, 'utf8');
            $tidy->cleanRepair();
            //for further expand
            $input = $tidy;
        }else{
            $input = self::closeTags($input);
        }
        //-- end - using php Tidy library --//
        #remove js and css codes
        $input = renderOutput(htmlspecialchars_decode($input));
        return $input;
    }

    public static function closeTags($html)
    {
            preg_match_all('/<(?!meta|img|br|hr|input\b)\b([A-z]+)(?: .*)?(?<![/|/ ])>/iu', $html, $result);
            $openedtags = $result[1];
            preg_match_all('/</([A-z]+)>/iu', $html, $result);
            $closedtags = $result[1];
            $len_opened = count($openedtags);
            if (count($closedtags) == $len_opened)
                return $html;
            $openedtags = array_reverse($openedtags);
            for ($i=0; $i < $len_opened; $i++)
            {
                if (!in_array($openedtags[$i], $closedtags))
                    $html .= '</'.$openedtags[$i].'>';
                else
                    unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
            return $html;
    }
}