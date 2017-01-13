<?
/**
 * @fileoverview This PHP-Class should only read a iCal-File (*.ics), parse it
 * and give an array with its content.
 *
 * @author: samim almamun
 * @version: 1.0
 * @example
 *     $this->load->library('ical');
 *     $this->ical->read($content );
       $result = $this->ical->get_event_array();
 */

//error_reporting(E_ALL);
//$this = & get_instance();

class ical {
    
    public   $todo_count = 0;

    
    public  $event_count = 0;

    
    public  $cal;

    
    private  $last_keyword;
    
    public function read($file_content) {
       
       if(!is_array($file_content) || count($file_content)<1){
        return false;
       }
       
       $lines = $file_content;
        if (stristr($lines[0],'BEGIN:VCALENDAR') === false){
            return false;
        } else {
            foreach ($lines as $line) {
                $line = trim($line);
                $add = $this->split_key_value($line);
                if($add === false){
                    $this->add_to_array($type, false, $line);
                    continue;
                }

                list($keyword, $value) = $add;

                switch ($line) {
                    case "BEGIN:VTODO":
                        $this->todo_count++;
                        $type = "VTODO";
                        break;
                    case "BEGIN:VEVENT":
                        #echo "vevent gematcht";
                        $this->event_count++;
                        $type = "VEVENT";
                        break;

                    //all other special strings
                    case "BEGIN:VCALENDAR":
                    case "BEGIN:DAYLIGHT":

                  
                    case "BEGIN:VTIMEZONE":
                    case "BEGIN:STANDARD":
                        $type = $value;
                        break;
                    case "END:VTODO": // end special text - goto VCALENDAR key
                    case "END:VEVENT":
                    case "END:VCALENDAR":
                    case "END:DAYLIGHT":
                    case "END:VTIMEZONE":
                    case "END:STANDARD":
                        $type = "VCALENDAR";
                        break;
                    default:
                        $this->add_to_array($type, $keyword, $value);
                        break;
                }
            }
           return  $this->cal;
        }
    }

    /**
     * Add to $this->ical array one value and key.
     *
     * @param {string} $type This could be VTODO, VEVENT, VCALENDAR, ...
     * @param {string} $keyword
     * @param {string} $value
     */
    function add_to_array($type, $keyword, $value) {
        if ($keyword == false) {
            $keyword = $this->last_keyword;
            switch ($type) {
              case 'VEVENT':
                  $value = $this->cal[$type][$this->event_count - 1][$keyword].$value;
                  break;
              case 'VTODO' :
                  $value = $this->cal[$type][$this->todo_count - 1][$keyword].$value;
                  break;
            }
        }
       
        if (stristr($keyword,"DTSTART") or stristr($keyword,"DTEND")) {
            $keyword = explode(";", $keyword);
            $keyword =  $keyword[0];
            $value   = $this->ical_date_to_db_date($value);
        }

        switch ($type) {
            case "VTODO":
                $this->cal[$type][$this->todo_count - 1][$keyword] = $value;
                #$this->cal[$type][$this->todo_count]['Unix'] = $unixtime;
                break;
            case "VEVENT":
                $this->cal[$type][$this->event_count - 1][$keyword] = $value;
                break;
            default:
                $this->cal[$type][$keyword] = $value;
                break;
        }
        $this->last_keyword = $keyword;
    }

    /**
     * @param {string} $text which is like "VCALENDAR:Begin" or "LOCATION:"
     * @return {Array} array("VCALENDAR", "Begin")
     */
    function split_key_value($text) {
        preg_match("/([^:]+)[:]([\w\W]*)/", $text, $matches);
        if(count($matches) == 0){return false;}
        $matches = array_splice($matches, 1, 2);
        return $matches;
    }

    /**
     * Return Unix timestamp from ical date time format
     *
     * @param {string} $ical_date A Date in the format YYYYMMDD[T]HHMMSS[Z] or
     *                            YYYYMMDD[T]HHMMSS
     * @return {int}
     */
    function ical_date_to_unix_timestamp($ical_date) {
        $ical_date = str_replace('T', '', $ical_date);
        $ical_date = str_replace('Z', '', $ical_date);

        $pattern = '/([0-9]{4})';   # 1: YYYY
        $pattern.= '([0-9]{2})';    # 2: MM
        $pattern.= '([0-9]{2})';    # 3: DD
        $pattern.= '([0-9]{0,2})';  # 4: HH
        $pattern.= '([0-9]{0,2})';  # 5: MM
        $pattern.= '([0-9]{0,2})/'; # 6: SS
        preg_match($pattern, $ical_date, $date);

        // Unix timestamp can't represent dates before 1970
        if ($date[1] <= 1970) {
            return false;
        }
        $timestamp = mktime(
                        (int)$date[4],
                        (int)$date[5],
                        (int)$date[6],
                        (int)$date[2],
                        (int)$date[3],
                        (int)$date[1]
                      );
        return  $timestamp;
    }
    
    /******* ical date format to db format date YYYYMMDD to YYYY-MM-DD ***/
    public function ical_date_to_db_date($ical_date){
        $ical_date = str_replace('T', '', $ical_date);
        $ical_date = str_replace('Z', '', $ical_date);

        $pattern = '/([0-9]{4})';   # 1: YYYY
        $pattern.= '([0-9]{2})';    # 2: MM
        $pattern.= '([0-9]{2})';    # 3: DD
        $pattern.= '([0-9]{0,2})';  # 4: HH
        $pattern.= '([0-9]{0,2})';  # 5: MM
        $pattern.= '([0-9]{0,2})/'; # 6: SS
        preg_match($pattern, $ical_date, $date);

        // Unix timestamp can't represent dates before 1970
        if ($date[1] <= 1970) {
            return false;
        }
        $timestamp = mktime(
                        (int)$date[4],
                        (int)$date[5],
                        (int)$date[6],
                        (int)$date[2],
                        (int)$date[3],
                        (int)$date[1]
                      );
        return date( 'Y-m-d',$timestamp );
    }
    /**
     * Returns an array of arrays with all events. Every event is an associative
     * array and each property is an element it.
     * @return {array}
     */
    function get_event_array() {
        
        $array = $this->cal;
        unset($this->cal);
        if(!isset($array['VEVENT'])){ $array['VEVENT'] = '';    }
        return $array['VEVENT'];
    }
}
?>