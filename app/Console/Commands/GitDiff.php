<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GitDiff extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'git:diff {repo_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /**
         * コマンドの引数を取得
         */
        $dir = $this->argument("repo_name");

        $this->changeCurrentDir($dir);
//        /**
//         * 自身のルートディレクトリを取得
//         */
//        $current = base_path();
//        /**
//         * コマンド実行ディレクトリへ移動
//         */
//        chdir ($current.'/../'.$dir.'/Employee_Management');
////        chdir ($current.'/../'.$dir);
        /**
         * gitリポジトリか判定
         * 違うならば終了
         */
        if (!file_exists('.git')) {
            return $this->error('Its git repository not found !');
        };
        $diff = $this->getGitDiff();
//        /**
//         * 自身と最新のコミットまでの差分を取得
//         */
//        $cmd = 'git diff --stat --name-only HEAD';
//        $gitcmd = sprintf($cmd);
//        ob_start();
//        passthru($gitcmd, $ret);
//        $diff =  ob_get_clean();
        var_dump($diff);
        exit;
        /**
         * 自身が更新が存在するかを判定
         * 最新の状態であれば終了
         */
        if (empty($diff)) {
            return $this->line('It is already up to date !');
        }
        /**
         * 初めのディレクトリへ移動
         * 戻らなくてよい？
         */
//        chdir ($current);
        /**
         * 差分を配列に変換
         */
        $diff = explode("\n", $diff); // とりあえず行に分割
        $diff = array_map('trim', $diff); // 各行にtrim()をかける
        $diff = array_filter($diff, 'strlen');

        var_dump($diff);
    }

    private function changeCurrentDir($dir)
    {
        /**
         * 自身のルートディレクトリを取得
         */
        $current = base_path();
        /**
         * コマンド実行ディレクトリへ移動
         */
        return chdir ($current.'/../'.$dir.'/Employee_Management');
    }

    private function getGitDiff()
    {
        echo 'git diff processing';
        /**
         * 自身と最新のコミットまでの差分を取得
         */
        $cmd = 'git diff --stat --name-only HEAD';
        $gitcmd = sprintf($cmd);
        ob_start();
        passthru($gitcmd, $ret);
        $diff =  ob_get_clean();
        return $diff;
    }

    public function exec($cmd_name, $cmd)
    {
        $progressBar = $this->output->createProgressBar();
        $progressBar->setFormatDefinition('custom', $cmd_name . ' -- (%status%)');
        $progressBar->setFormat('custom');
        $progressBar->setMessage('processing...', 'status');


        $diff = $cmd;

        $progressBar->setMessage('[ OK ]', 'status');
        $progressBar->finish();

        return $diff;
    }
}
