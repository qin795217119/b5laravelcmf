<?php
// +----------------------------------------------------------------------
// | B5LaravelCMF
// +----------------------------------------------------------------------
// | Author: 李恒 <357145480@qq.com>
// +----------------------------------------------------------------------
// | 测试邮箱发送队列
// +----------------------------------------------------------------------
namespace App\Jobs;

use App\Helpers\Util\MailApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //自定义属性
    public $id;
    public $email;
    public $name;
    public $type;
    /**
     * Create a new job instance.
     * @param array $data
     * @return void
     */
    public function __construct(array $data)
    {
        //初始化时可以传入一些数据并处理
        $this->id=$data['id']??0;
        $this->email=$data['email']??'';
        $this->name=$data['name']??'';
        $this->type=$data['type']??'';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //添加到队列的方法   $this->dispatch(new TestJob($data));

        //自己的代码逻辑

        (new MailApi())->sendEmail($this->type,['id'=>$this->id,'name'=>$this->name,'email'=>$this->email]);
    }
}
