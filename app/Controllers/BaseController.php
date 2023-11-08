<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */   
    protected $BaseModel;
    protected $UserModel;
    protected $CategoryModel;
    protected $helpers = [];
    public $data = array();
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;


    public function __construct(){
       
		$this->BaseModel = new \App\Models\BaseModel();
		$this->UserModel = new \App\Models\UserModel();
		$this->CategoryModel = new \App\Models\CategoryModel();
        $this->session = \Config\Services::session();

        $this->request = \Config\Services::request();

        helper(['request']);
        $response = service('response');
        $request = service('request');


        // helper('url');
        helper('form');
        $this->uri=service('uri');
        $s3 = service('s3');
        // // Get the current URL
        // $this->uri= base_url(uri_string());
        // $this->segment1 = $this->request->getSegment(3);
        // $uri = service('uri');
        // $this->currentURL = $uri->currentURL();

		// $this->LoginHistoryModel = new \App\Models\LoginHistoryModel();

		// // $this->TwilioService = new \App\Libraries\TwilioService();
        // $this->request = \Config\Services::request();

		// helper(['api']);
		// helper(['date']);

        // $response = service('response');
        // $request = service('request');
     


        // // $headers = $request->getHeader('Authkey');
        // $response->setHeader('Authkey','jobseeker');
        // $router = service('router');
	
	}









    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }



    public function UUID4()
    {
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
        // Set version to 0100
        $data[6] = chr(ord($data[6])&0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8])&0x3f | 0x80);
        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
    public function get_rand_number($length = 6)
    {
        return substr(str_shuffle("0123456789"), 0, $length);
    }

    public function checkSession($type = '')
    {
        $sessData = '';
        if ($type == 'A') {
            $sessData = $this->session->get(APP_NAME . '_session_admin_uuid');
        } else if ($type == 'AN') {
            $sessData = $this->session->get(APP_NAME . '_session_admin_name');
        } else if ($type == 'AE') {
            $sessData = $this->session->get(APP_NAME . '_session_admin_email');
        } else if ($type == 'AM') {
            $sessData = $this->session->get(APP_NAME . '_session_admin_mode');
        } else if ($type == 'AI') {
            $sessData = $this->session->get(APP_NAME . '_session_admin_image');
        }
        if ($sessData == null) {
            $sessData = '';
        }
        return $sessData;
    }



    public function setFlashMessage($type = '', $msg = '')
    {
        $msg = base64_encode($msg);
        ($type == 'success') ? $msgVal = 'success' : $msgVal = 'error';
        $this->session->setFlashdata('sFlashType', $msgVal);
        $this->session->setFlashdata('sFlashMSG', $msg);
    }

    public function forceRedirect($url = '')
    {
        header('Location: /' . $url);
        exit();
    }
    public function timeZoneConvert($fromTime, $fromTimezone, $toTimezone = '', $format = 'Y-m-d H:i:s')
    {
        if ($toTimezone == '') {
            $toTimezone = date_default_timezone_get();
        }

        // create timeZone object , with fromtimeZone
        $from = new \DateTimeZone($fromTimezone);
        // create timeZone object , with totimeZone
        $to = new \DateTimeZone($toTimezone);
        // read give time into ,fromtimeZone
        $orgTime = new \DateTime($fromTime, $from);
        // fromte input date to ISO 8601 date (added in PHP 5). the create new date time object
        $toTime = new \DateTime($orgTime->format("c"));

        // set target time zone to $toTme ojbect.
        $toTime->setTimezone($to);
        // return reuslt.
        return $toTime->format($format);
    }


    public function cleanString($orig_text)
    {
        $text = $orig_text;
        // Single letters
        $text = preg_replace("/[∂άαáàâãªä]/u", "a", $text);
        $text = preg_replace("/[∆лДΛдАÁÀÂÃÄ]/u", "A", $text);
        $text = preg_replace("/[ЂЪЬБъь]/u", "b", $text);
        $text = preg_replace("/[βвВ]/u", "B", $text);
        $text = preg_replace("/[çς©с]/u", "c", $text);
        $text = preg_replace("/[ÇС]/u", "C", $text);
        $text = preg_replace("/[δ]/u", "d", $text);
        $text = preg_replace("/[éèêëέëèεе℮ёєэЭ]/u", "e", $text);
        $text = preg_replace("/[ÉÈÊË€ξЄ€Е∑]/u", "E", $text);
        $text = preg_replace("/[₣]/u", "F", $text);
        $text = preg_replace("/[НнЊњ]/u", "H", $text);
        $text = preg_replace("/[ђћЋ]/u", "h", $text);
        $text = preg_replace("/[ÍÌÎÏ]/u", "I", $text);
        $text = preg_replace("/[íìîïιίϊі]/u", "i", $text);
        $text = preg_replace("/[Јј]/u", "j", $text);
        $text = preg_replace("/[ΚЌК]/u", 'K', $text);
        $text = preg_replace("/[ќк]/u", 'k', $text);
        $text = preg_replace("/[ℓ∟]/u", 'l', $text);
        $text = preg_replace("/[Мм]/u", "M", $text);
        $text = preg_replace("/[ñηήηπⁿ]/u", "n", $text);
        $text = preg_replace("/[Ñ∏пПИЙийΝЛ]/u", "N", $text);
        $text = preg_replace("/[óòôõºöοФσόо]/u", "o", $text);
        $text = preg_replace("/[ÓÒÔÕÖθΩθОΩ]/u", "O", $text);
        $text = preg_replace("/[ρφрРф]/u", "p", $text);
        $text = preg_replace("/[®яЯ]/u", "R", $text);
        $text = preg_replace("/[ГЃгѓ]/u", "r", $text);
        $text = preg_replace("/[Ѕ]/u", "S", $text);
        $text = preg_replace("/[ѕ]/u", "s", $text);
        $text = preg_replace("/[Тт]/u", "T", $text);
        $text = preg_replace("/[τ†‡]/u", "t", $text);
        $text = preg_replace("/[úùûüџμΰµυϋύ]/u", "u", $text);
        $text = preg_replace("/[√]/u", "v", $text);
        $text = preg_replace("/[ÚÙÛÜЏЦц]/u", "U", $text);
        $text = preg_replace("/[Ψψωώẅẃẁщш]/u", "w", $text);
        $text = preg_replace("/[ẀẄẂШЩ]/u", "W", $text);
        $text = preg_replace("/[ΧχЖХж]/u", "x", $text);
        $text = preg_replace("/[ỲΫ¥]/u", "Y", $text);
        $text = preg_replace("/[ỳγўЎУуч]/u", "y", $text);
        $text = preg_replace("/[ζ]/u", "Z", $text);

        // Punctuation
        $text = preg_replace("/[‚‚]/u", ",", $text);
        $text = preg_replace("/[`‛′’‘]/u", "'", $text);
        $text = preg_replace("/[″“”«»„]/u", '"', $text);
        $text = preg_replace("/[—–―−–‾⌐─↔→←]/u", '-', $text);
        $text = preg_replace("/[  ]/u", ' ', $text);

        $text = str_replace("…", "...", $text);
        $text = str_replace("≠", "!=", $text);
        $text = str_replace("≤", "<=", $text);
        $text = str_replace("≥", ">=", $text);
        $text = preg_replace("/[‗≈≡]/u", "=", $text);

        // Exciting combinations
        $text = str_replace("ыЫ", "bl", $text);
        $text = str_replace("℅", "c/o", $text);
        $text = str_replace("₧", "Pts", $text);
        $text = str_replace("™", "tm", $text);
        $text = str_replace("№", "No", $text);
        $text = str_replace("Ч", "4", $text);
        $text = str_replace("‰", "%", $text);
        $text = preg_replace("/[∙•]/u", "*", $text);
        $text = str_replace("‹", "<", $text);
        $text = str_replace("›", ">", $text);
        $text = str_replace("‼", "!!", $text);
        $text = str_replace("⁄", "/", $text);
        $text = str_replace("∕", "/", $text);
        $text = str_replace("⅞", "7/8", $text);
        $text = str_replace("⅝", "5/8", $text);
        $text = str_replace("⅜", "3/8", $text);
        $text = str_replace("⅛", "1/8", $text);
        $text = preg_replace("/[‰]/u", "%", $text);
        $text = preg_replace("/[Љљ]/u", "Ab", $text);
        $text = preg_replace("/[Юю]/u", "IO", $text);
        $text = preg_replace("/[ﬁﬂ]/u", "fi", $text);
        $text = preg_replace("/[зЗ]/u", "3", $text);
        $text = str_replace("£", "(pounds)", $text);
        $text = str_replace("₤", "(lira)", $text);
        $text = preg_replace("/[‰]/u", "%", $text);
        $text = preg_replace("/[↨↕↓↑│]/u", "|", $text);
        $text = preg_replace("/[∞∩∫⌂⌠⌡]/u", "", $text);

        //2) Translation CP1252.
        $trans = get_html_translation_table(HTML_ENTITIES);
        $trans['f'] = '&fnof;'; // Latin Small Letter F With Hook
        $trans['-'] = array(
            '&hellip;', // Horizontal Ellipsis
            '&tilde;', // Small Tilde
            '&ndash;', // Dash
        );
        $trans["+"] = '&dagger;'; // Dagger
        $trans['#'] = '&Dagger;'; // Double Dagger
        $trans['M'] = '&permil;'; // Per Mille Sign
        $trans['S'] = '&Scaron;'; // Latin Capital Letter S With Caron
        $trans['OE'] = '&OElig;'; // Latin Capital Ligature OE
        $trans["'"] = array(
            '&lsquo;', // Left Single Quotation Mark
            '&rsquo;', // Right Single Quotation Mark
            '&rsaquo;', // Single Right-Pointing Angle Quotation Mark
            '&sbquo;', // Single Low-9 Quotation Mark
            '&circ;', // Modifier Letter Circumflex Accent
            '&lsaquo;', // Single Left-Pointing Angle Quotation Mark
        );

        $trans['"'] = array(
            '&ldquo;', // Left Double Quotation Mark
            '&rdquo;', // Right Double Quotation Mark
            '&bdquo;', // Double Low-9 Quotation Mark
        );

        $trans['*'] = '&bull;'; // Bullet
        $trans['n'] = '&ndash;'; // En Dash
        $trans['m'] = '&mdash;'; // Em Dash
        $trans['tm'] = '&trade;'; // Trade Mark Sign
        $trans['s'] = '&scaron;'; // Latin Small Letter S With Caron
        $trans['oe'] = '&oelig;'; // Latin Small Ligature OE
        $trans['Y'] = '&Yuml;'; // Latin Capital Letter Y With Diaeresis
        $trans['euro'] = '&euro;'; // euro currency symbol
        ksort($trans);

        foreach ($trans as $k => $v) {
            $text = str_replace($v, $k, $text);
        }

        // 3) remove <p>, <br/> ...
        $text = strip_tags($text);

        // 4) &amp; => & &quot; => '
        $text = html_entity_decode($text);

        // transliterate
        // if (function_exists('iconv')) {
        // $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // }
        // remove non ascii characters
        #$text =  preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $text);

        return $text;
    }



}
