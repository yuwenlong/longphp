<?php
namespace class;

class ProgressBar
{
    /**
     * @var int 进度条显示长度
     */
    public $length = 100;
    /**
     * @var string 进度条开始字符
     */
    public $startChar = '[';
    /**
     * @var string 进度条结束字符
     */
    public $endChar = ']';
    /**
     * @var string 进度条空字符
     */
    public $emptyChar = ' ';
    /**
     * @var string 进度条进度字符
     */
    public $progressChar = '#';
    /**
     * @var int 进度条最大进度
     */
    public $maxStep;
    /**
     * @var string 进度条标题
     */
    public $message = '';

    /**
     * ProgressBar constructor.
     * @param integer $maxStep 最大进度
     * @param string $message 进度条标题
     */
    public function __construct($maxStep, $message = '正在处理')
    {
        $this->maxStep = $maxStep;
        $this->message = $message;
    }

    public function show($step)
    {
        if ($step > $this->maxStep) return;
        echo "\r";
        echo $this->message . " $step/$this->maxStep ";
        echo $this->startChar;
        $progressNum = (int)($step / $this->maxStep * $this->length);
        for ($i = 0; $i < $progressNum; $i++)
            echo $this->progressChar;

        for ($i = 0; $i < $this->length - $progressNum; $i++)
            echo $this->emptyChar;

        echo $this->endChar;

        echo (int)($step * 100 / $this->maxStep), "%";

        if ($step >= $this->maxStep) {
            echo PHP_EOL;
        }
    }
}