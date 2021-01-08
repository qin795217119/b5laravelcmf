<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
namespace App\Http\Components\View;

use Illuminate\Contracts\Support\Htmlable;

/**
 * 自定义后台快速生成html
 * Class IframeComponent
 * @package App\Http\Components\View
 */
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
                    $extend['name']=$extend['name']??'';
                    return view('widget.iframe.' . trim($type),['widget_data'=>$extend]);
                }
            }
        }
        return '';
    }
}
