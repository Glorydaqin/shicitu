<?php

namespace App\Console\Commands;

use App\Model\Dynasty;
use App\Model\Poetry;
use App\Model\Type;
use App\Module\AuthorModule;
use Illuminate\Console\Command;

class SyncDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '数据同步到数据库';
    protected $path = '';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->path = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'Data'.DIRECTORY_SEPARATOR;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dump("sync Author");
        $this->syncAuthor();
        //同步唐诗宋词
        dump("sync Json");
        $this->syncJson();

    }

    private function syncAuthor(){
        $path = $this->path."json";
        $list = [
            ['dynasty'=>Dynasty::$typeSong,'file'=>$path.DIRECTORY_SEPARATOR.'authors.song.json'],
            ['dynasty'=>Dynasty::$typeTang,'file'=>$path.DIRECTORY_SEPARATOR.'authors.tang.json'],
        ];
        foreach ($list as $item){
            $list = json_decode(file_get_contents($item['file']),true);
            foreach ($list as $data){
                AuthorModule::insertAuthor($data['name'],$data['desc'],$item['dynasty']);
            }
        }
    }

    private function syncJson(){
        //取路径下的
        $path = $this->path."json";
        $files = $this->getPathJsonFile($path);
        foreach ($files as $file){
            //匹配
            preg_match("/poet\.([taso]{2}ng)\.\d+\.json/",$file,$matchType);

            if(isset($matchType[1])){
                if($matchType[1] == 'song'){
                    $type = Type::$typeSong;
                }elseif($matchType[1] == 'tang'){
                    $type = Type::$typeTang;
                }else{
                    continue;
                }
                $data = json_decode(file_get_contents($file),true);
                foreach ($data as $datum){
                    $insertData = [
                        'title'=>$datum['title'],
                        'author'=>$datum['author'],
                        'paragraphs'=>json_encode($datum['paragraphs']),
                        'strains'=>json_encode($datum['strains']),
                        'type' =>$type,
                        'hash'=>hash('md5',$datum['title'].json_encode($datum['paragraphs']))
                    ];
                    $exist = Poetry::where("hash",$insertData['hash'])->exists();
                    if(!$exist){
                        Poetry::insert($insertData);
                    }
                }
            }
        }
    }

    /**
     * 获取路径下的json文件
     * @param $path
     * @return array
     */
    private function getPathJsonFile($path){
        $file = scandir($path);
        $files = [];
        foreach ($file as $item){
            if($item=='.' || $item=='..')
                continue;
            if(substr($item,-5,5) != '.json')
                continue;
            $files[] = $path.DIRECTORY_SEPARATOR.$item;
        }
        return $files;
    }

}
