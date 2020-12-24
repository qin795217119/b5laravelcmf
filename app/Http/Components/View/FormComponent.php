<?php
namespace App\Http\Components\View;


use Illuminate\Contracts\Support\Htmlable;

class FormComponent implements Htmlable
{
    private $params;

    public function init($params)
    {
        $this->params = $params;
        return $this->toHtml();
    }

    public function toHtml()
    {
        if(is_array($this->params) && $this->params){
            $name = $this->params['name'];
            if($name){
                if(strpos($name,'|')!==false){
                    list($type,$title)=explode('|',trim($name),2);
                }else{
                    $type=$name;
                    $title='';
                }
                if($type){
                    $extend = $this->params['extend'] ?? [];
                    if(!isset($extend['title'])){
                        $extend['title']=$title;
                    }
                    if(!isset($extend['op'])){
                        $extend['op']='';
                    }
                    return view('widget.form.' . trim($type),$extend);
                }
            }
        }
        return '';
    }
}
