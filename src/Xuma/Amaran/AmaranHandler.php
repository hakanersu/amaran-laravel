<?php namespace Xuma\Amaran;
use Exception;

class AmaranHandler{

    /**
     * Default values of amaran array
     * @var array
     */
    protected $amaran=['theme'=>'default','sticky'=>false];

    /**
     *
     * @var array
     */
    public $click=[];

    /**
     * @var bool
     */
    public $content=false;

    /**
     * @return $this
     */
    public function create()
    {
        return $this;
    }

    /**
     * @param string $theme
     * @return $this
     */
    public function theme($theme='default')
    {
        $this->amaran['theme']=$theme;
        return $this;
    }

    /**
     * AmaranJS notification position
     * @param string $position
     * @return $this
     */
    public function position($position='bottom right')
    {
        $this->amaran['position']=$position;
        return $this;
    }

    /**
     *  AmaranJS content for notification
     * @param string $content
     * @return $this
     */
    public function content($content)
    {
        $this->amaran['content']=$content;
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
     * @param $outEffect
     * @return $this
     */
    public function outEffect($outEffect)
    {
        $this->amaran['outEffect'] = $outEffect;
        return $this;
    }

    /**
     * @param bool $element
     * @param string $on
     * @return $this
     * @throws Exception
     */
    public function bind($element=false,$on='click')
    {
        if(!$element) throw new Exception("AmaranJS throwed this exception with \"Please set onClick element.( eq ->bind('#example'))\"", 1);

        $this->click = [$element,$on];
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $script = "<script> \n\t\t$(function(){ \n\t\t";
        if($this->click)
        {
            return $script."\t$('".$this->click[0]."').on('".$this->click[1]."',function(){ \n\t\t\t\t $.amaran(". json_encode($this->amaran).") \n\t\t\t}); \n\t\t});\n\t</script>\n";
        }
        return $script."$.amaran(".json_encode($this->amaran)."); \n\t });\n</script>\n";
    }
}