<?php
namespace App\Http\Components\View;


use Illuminate\Contracts\Support\Htmlable;

class IframeComponent implements Htmlable
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
                    $extend['title']=$extend['title']??$title;
                    $extend['id']=$extend['id']??'';
                    $extend['class']=$extend['class']??'';
                    return view('widget.iframe.' . trim($type),$extend);
                }
            }
        }
        return '';
    }
}
