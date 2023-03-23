<?php


namespace apps\queue\classier\service;

use apps\queue\classier\model\HandlerModel;
use apps\queue\classier\process\UnifiedDispatchProcess;
use Exception;
use rapidPHP\modules\console\classier\Output;
use ReflectionException;
use Swoole\Process;
use function rapidPHP\B;
use function rapidPHP\Cal;

if (!defined('SIGHUP')) define('SIGHUP', 1);

if (!defined('SIGTERM')) define('SIGTERM', 15);

class UnifiedDispatchService
{
    /**
     * pid file
     */
    const PID_FILE = PATH_APP . '.pid';

    /**
     * @var UnifiedDispatchProcess
     */
    protected $dispatchProcess;

    /**
     * @var Output
     */
    protected $output;

    /**
     * 处理信号
     * @var string[][]
     */
    protected $handlerSig = [
        'self::onHandlerSignal',
        SIGHUP => 'self::onSIGHUP',
        SIGTERM => 'self::onSIGTERM',
    ];

    /**
     * @var HandlerModel[]
     */
    protected $handlers;

    /**
     * UnifiedDispatchService constructor.
     * @param Output $output
     * @param HandlerModel[] $handlers
     */
    public function __construct(Output $output, array $handlers = [])
    {
        $this->output = $output;

        $this->handlers = $handlers;
    }

    /**
     * 获取主进程pid
     * @return false|string
     */
    private function getPId()
    {
        return file_get_contents(self::PID_FILE);
    }

    /**
     * 设置当前主进程pid
     * @param $pid
     */
    private function setPId($pid)
    {
        file_put_contents(self::PID_FILE, $pid);
    }

    /**
     * 创建进程
     * @throws ReflectionException
     * @throws Exception
     */
    private function create()
    {
        $this->dispatchProcess = new UnifiedDispatchProcess(1, $this->output, $this->handlers);

        $this->setPId($this->dispatchProcess->pid);

        $date = Cal()->getDate();

        $this->output->psuccess("{$date} {$this->dispatchProcess->pid} 启动主进程成功");
    }

    /**
     * 获取处理信号回调函数
     * @param $signal
     * @return string|string[]
     */
    private function getHandlerSignal($signal)
    {
        if (isset($this->handlerSig[$signal])) return $this->handlerSig[$signal];

        return $this->handlerSig[0] ?? null;
    }

    /**
     * 启动
     * @param callable $call
     * @throws ReflectionException
     */
    public function start(callable $call)
    {
        $this->create();

        call_user_func($call);

        while ($ret = Process::wait(true)) {
            $pid = B()->getData($ret, 'pid');

            $signal = B()->getData($ret, 'signal');

            $handler = $this->getHandlerSignal($signal);

            if (is_callable($handler)) call_user_func($handler, $pid, $signal);
        }
    }

    /**
     * 获取全部进程pid
     * @return array
     */
    public function getAllPIDs(): array
    {
        return $this->dispatchProcess->getWorkerPIDs(true);
    }

    /**
     * kill
     * @param null $pid
     * @param int $sig
     */
    public function kill($pid = null, int $sig = SIGTERM)
    {
        $pid = $pid ?: $this->getPId();

        if ($pid) Process::kill($pid, $sig);
    }

    /**
     * 其他信号
     * @param $pid
     * @param $signal
     */
    private function onHandlerSignal($pid, $signal)
    {
        $date = Cal()->getDate();

        $this->output->write("{$date} 收到信号 {$pid} $signal ");
    }

    /**
     * 退出信号
     * @param $pid
     * @throws Exception
     */
    private function onSIGTERM($pid)
    {
        $date = Cal()->getDate();

        if ($pid == $this->dispatchProcess->pid) {
            $this->output->perror("{$date} 主进程已经退出，即将退出全部子进程");

            $PIDs = $this->dispatchProcess->getWorkerPIDs();

            foreach ($PIDs as $type) $this->dispatchProcess->pkill($type);

            $this->output->perror("{$date} 进程已经全部退出");
        } else {
            $PIDs = $this->dispatchProcess->getWorkerPIDs();

            if (!isset($PIDs[$pid])) return;

            $this->output->perror("{$date} {$pid} {$PIDs[$pid]} 进程退出");
        }
    }

    /**
     * 重启信号
     * @param $pid
     * @throws ReflectionException
     */
    private function onSIGHUP($pid)
    {
        $date = Cal()->getDate();

        $PIDs = $this->dispatchProcess->getWorkerPIDs();

        if ($pid == $this->dispatchProcess->pid) {
            $this->output->perror("{$date} 重启主进程，即将退出全部子进程");

            foreach ($PIDs as $pid => $type) Process::kill($pid);

            $this->output->psuccess("{$date} 子进程已经全部退出，等待启动主进程");

            $this->create();
        } else {
            $this->output->perror("{$date} 重启子进程");

            try {
                $this->dispatchProcess->restart($PIDs[$pid]);
            } catch (Exception $e) {
                $this->output->perror("{$date} 重启子进程出现意外:{$e->getMessage()}");
            }

            $this->output->perror("{$date} 子进程重启完毕");
        }
    }

}
