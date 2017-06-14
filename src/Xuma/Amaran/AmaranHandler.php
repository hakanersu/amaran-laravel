<?php 
namespace Xuma\Amaran;

use Exception;
use Illuminate\Session\Store;

class AmaranHandler
{

    /**
     * Default values of AmaranJS array
     * @var array
     */
    protected $amaran = [
        'theme' => 'default',
        'sticky' => false
    ];

    /**
     * jQuery event creator
     * @var array
     */
    public $click = [];

    /**
     * Content must be filled with AmaranJS theme values.
     * Check documentation for AmaranJS themes.
     * @var array
     */
    public $content = [];

    protected $viewBinder;

    protected $session;

    protected $flash = false;


    /**
     * @param ViewBinder $viewBinder
     * @param Store      $session
     */
    public function __construct(ViewBinder $viewBinder, Store $session)
    {
        $this->viewBinder = $viewBinder;

        $this->session = $session;

        if (file_exists(config_path('amaran.php'))) {
            $this->amaran = array_merge($this->amaran, config('amaran'));
        }
    }

    /**
     * Bind AmaranJS to view.
     */
    public function create()
    {
        $script = "<script>\n\t$(function(){ \n\t\t";

        if ($this->click) {
            $script .= "\t$('".$this->click[0]."').on('".$this->click[1]."',function(){ \n\t\t\t\t $.amaran(". json_encode($this->amaran).") \n\t\t\t}); \n\t\t});\n\t</script>\n";
        } else {
            $script .= "$.amaran(".json_encode($this->amaran)."); \n\t });\n</script>\n";
        }


        if ($this->flash) {
            $this->session->flash('amaranjs.content', $script);
        } else {
            $this->viewBinder->bind($script);
        }
    }

    /**
     * @param string $theme
     * @return $this
     */
    public function theme($theme = 'default')
    {
        $this->amaran['theme'] = $theme;
        return $this;
    }

    /**
     * AmaranJS notification position
     * @param string $position
     * @return $this
     */
    public function position($position = 'bottom right')
    {
        $this->amaran['position'] = $position;
        return $this;
    }

    /**
     * AmaranJS content for notification
     * @param string $content
     * @return $this
     */
    public function content($content)
    {
        $this->amaran['content'] = $content;
        return $this;
    }

    /**
     * AmaranJS appear effect
     * @param string $ineffect
     * @return $this
     */
    public function inEffect($ineffect)
    {
        $this->amaran['inEffect'] = $ineffect;
        return $this;
    }

    /**
     * AmaranJS make notification sticky
     * @return $this
     */
    public function sticky()
    {
        $this->amaran['sticky'] = true;
        return $this;
    }

    /**
     * AmaranJS dissapper effect
     * @param $outEffect
     * @return $this
     */
    public function outEffect($outEffect)
    {
        $this->amaran['outEffect'] = $outEffect;
        return $this;
    }

    public function flash()
    {
        $this->flash = true;
        return $this;
    }

    /**
     * @param bool $element
     * @param string $on
     * @return $this
     * @throws Exception
     */
    public function bind($element = false, $on = 'click')
    {
        if (!$element) {
            throw new Exception("AmaranJS throwed this exception with \"Please set onClick element.( eq ->bind('#example'))\"", 1);
        }

        $this->click = [$element, $on];

        return $this;
    }
}
