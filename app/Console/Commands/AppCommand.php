<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deploy {act}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'application deploy build|upgrade|reset';

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
        $act = $this->argument('act');
        switch ($act) {
            case 'build':
                $this->build();
                break;
            case 'upgrade':
                $this->upgrade();
                break;
            case 'reset':
                $this->reset();
                break;
            default:
                break;
        }
    }

    /**
     * 安装
     */
    protected function build()
    {
        // 创建配置文件
        $this->execShellPrint('cp .env.example .env');
        // 生成加密密钥
        $this->execShellPrint('php artisan key:generate');
        // 生成passport 加密的keys
        $this->execShellPrint('php artisan passport:keys');
        // 迁移数据库
        $this->execShellPrint('php artisan migrate --force');
        // 这一步没有执行的话，填充数据有可能会报 xxxTablesSeeder 不存在
        $this->execShellPrint('php composer.phar dump-autoload --optimize');
        // 填充数据： admin账号,行业,省份信息
        $this->execShellPrint('php artisan db:seed --force');
        // 配置缓存
        $this->execShellPrint('php artisan config:cache');
        // 路由缓存
        $this->execShellPrint('php artisan route:cache');
    }

    /**
     * 升级执行步骤
     */
    protected function upgrade()
    {
        // 升级数据库
        $this->execShellPrint('php artisan migrate');
        // 配置缓存，生成之前会清理之前的，下同
        $this->execShellPrint('php artisan config:cache');
        // 路由缓存
        $this->execShellPrint('php artisan route:cache');
    }

    protected function reset()
    {
        // 创建配置文件
        $this->execShellPrint('cp .env.example .env');
        // 生成加密密钥
        $this->execShellPrint('php artisan key:generate');
        // 生成passport 加密的keys
        $this->execShellPrint('php artisan passport:keys');
        // 迁移数据库
        $this->execShellPrint('php artisan migrate --force');
        // 这一步没有执行的话，填充数据有可能会报 xxxTablesSeeder 不存在
        $this->execShellPrint('php composer.phar dump-autoload --optimize');
        // 填充数据： admin账号,行业,省份信息
        $this->execShellPrint('php artisan db:seed --force');
        // 配置缓存
        $this->execShellPrint('php artisan config:cache');
        // 路由缓存
        $this->execShellPrint('php artisan route:cache');
    }

    /**
     * 输出命令，打印执行结果
     *
     * @param $command
     */
    protected function execShellPrint($command)
    {
        $this->info('Command: ' . $command);
        $this->info(shell_exec($command));
    }
}
