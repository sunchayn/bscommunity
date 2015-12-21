<?php
/**
 * bloodstone community V1.0.0
 * @link https://www.facebook.com/Mazn.touati
 * @author Mazen Touati
 * @version 1.0.0
 */

class HTML {

    /** clean the editor Output to be a valid HTML !
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
        #get rid of bad words
        $input = Filters::sexualContentFilter($input);
        #clear blackListed website from the content if filter is enabled
        $input = Filters::externalFilter($input);
        return $input;
    }

    /** fix no closed tags
     * @param $html
     * @return string
     */
    public static function closeTags($html)
    {
            preg_match_all('/<(?!meta|img|br|hr|input\b)\b([A-z]+)(?: .*)?(?<![/|/ ])>/u', $html, $result);
            $openedTags = $result[1];
            preg_match_all('/</([A-z]+)>/u', $html, $result);
            $closedTags = $result[1];
            $len_opened = count($openedTags);
            if (count($closedTags) == $len_opened)
                return $html;
            $openedTags = array_reverse($openedTags);
            for ($i=0; $i < $len_opened; $i++)
            {
                if (!in_array($openedTags[$i], $closedTags))
                    $html .= '</'.$openedTags[$i].'>';
                else
                    unset($closedTags[array_search($openedTags[$i], $closedTags)]);
            }
            return $html;
    }
}