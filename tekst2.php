<?php
/**
 * Created by PhpStorm.
 * User: siim-kaarel.kabel
 * Date: 7.03.2016
 * Time: 12:24
 */
class tekst
{
    var $str = '';
    function __construct($s = '')
    {
        $this->setTekst($s);
    }
    function setTekst($s)
    {
        $this->str = $s;
    }
    function show()
    {
        echo $this->str;
    }
}
class ctekst extends tekst
{
    var $color = false;

    function setColor($c)
    {
        $this->color = $c;
    }
    function show()
    {
        if($this->color === false)
        {
            parent::show();
        }
        else
        {
            echo '<font color="'.$this->color.'">'.$this->str.'</font><br />';
        }
    }
}
//testimine
$tekst1 = new tekst();
    echo '<pre>';
        print_r($tekst1);
    echo '</pre>';
$tekst1->setTekst('tere maailm!');
    echo '<pre>';
        print_r($tekst1);
    echo '</pre>';
$tekst1->show();
    echo '<br />';
$tekst2 = new tekst('tere jalle');
$tekst3 = new ctekst('asd tekst');
$tekst3->
    echo '<pre>';
        print_r($tekst2);
    echo '</pre>';
$tekst2->show();
