<?php
/**
 * Created by PhpStorm.
 * User: Charles.Tide <charlestide@vip.163.com>
 * Date: 2017/9/18
 * Time: 下午5:14
 */

namespace Charlestide\Paladin\Util;

use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use Illuminate\Database\Eloquent\Model;

trait StyledOutput {

    /**
     * The default verbosity of output commands.
     *
     * @var int
     */
    protected $_verbosity = OutputInterface::VERBOSITY_NORMAL;
    
    /**
     * The mapping between human readable verbosity levels and Symfony's OutputInterface.
     *
     * @var array
     */
    protected $_verbosityMap = [
        'v' => OutputInterface::VERBOSITY_VERBOSE,
        'vv' => OutputInterface::VERBOSITY_VERY_VERBOSE,
        'vvv' => OutputInterface::VERBOSITY_DEBUG,
        'quiet' => OutputInterface::VERBOSITY_QUIET,
        'normal' => OutputInterface::VERBOSITY_NORMAL,
    ];
    
    /**
    * @var OutputInterface
     */
    protected $output;
    
    /**
    * @var String
    */
    protected $outputContent;
    
    /**
    * @param $message
    * @param $style
    * @param bool $newLine
    * @param null $verbosity
     */
    public function put($message, $style = null, $newLine = true, $verbosity = null) {
        $styled = $style ? "<$style>$message</$style>" : $message;

        $this->getOutput()->write($styled, $newLine, $this->parseVerbosity($verbosity));
    }
    
    /**
     * Get the verbosity level in terms of Symfony's OutputInterface level.
     *
     * @param  string|int  $level
     * @return int
     */
    protected function parseVerbosity($level = null)
    {
        if (isset($this->_verbosityMap[$level])) {
            $level = $this->_verbosityMap[$level];
        } elseif (! is_int($level)) {
            $level = $this->_verbosity;
        }

        return $level;
    }
    
    /**
     * Get the output implementation.
     *
     * @return BufferedOutput
     */
    public function getOutput() {
        if (!($this->output instanceof OutputInterface)) {
            $this->output = new BufferedOutput();
        }
        return $this->output;
    }
    
    /**
     * Write a string as information output.
     *
     * @param  string  $string
     * @param  bool $newLine
     * @param  null|int|string  $verbosity
     * @return void
     */
    public function info($string, $newLine = true,$verbosity = null)
    {
        $this->put($string,'info', $newLine, $verbosity);
    }
    
    /**
     * Write a string as comment output.
     *
     * @param  string  $string
     * @param  bool $newLine
     * @param  null|int|string  $verbosity
     * @return void
     */
    public function comment($string, $newLine = true, $verbosity = null)
    {
        $this->put($string,'comment', $newLine, $verbosity);
    }
    
    /**
     * Write a string as question output.
     *
     * @param  string  $string
     * @param  bool $newLine
     * @param  null|int|string  $verbosity
     * @return void
     */
    public function question($string, $newLine = true, $verbosity = null)
    {
        $this->put($string, 'question', $newLine, $verbosity);
    }
    
    /**
     * Write a string as error output.
     *
     * @param  string  $string
     * @param  bool $newLine
     * @param  null|int|string  $verbosity
     * @return void
     */
    public function error($string, $newLine = true, $verbosity = null)
    {
        $this->put($string, 'error', $newLine, $verbosity);
    }
    
    /**
     * Write a string in an alert box.
     *
     * @param  string  $string
     * @param  bool $newLine
     * @return void
     */
    public function alert($string, $newLine = true)
    {
        $this->comment(str_repeat('*', strlen($string) + 12));
        $this->comment('*     '.$string.'     *');
        $this->comment(str_repeat('*', strlen($string) + 12));

        if ($newLine) {
            $this->getOutput()->writeln('');
        }
    }
    
    /**
     * Write a string as warning output.
     *
     * @param  string  $string
     * @param  bool $newLine
     * @param  null|int|string  $verbosity
     * @return void
     */
    public function warn($string, $newLine = true, $verbosity = null)
    {
        if (! $this->getOutput()->getFormatter()->hasStyle('warning')) {
            $style = new OutputFormatterStyle('yellow');

            $this->getOutput()->getFormatter()->setStyle('warning', $style);
        }

        $this->put($string, 'warning', $newLine, $verbosity);
    }
    
    /**
     * Write a string as standard output.
     *
     * @param  string  $string
     * @param  null|int|string  $verbosity
     * @return void
     */
    public function line($string, $style = null,  $verbosity = null)
    {
        $this->getOutput()->writeln($string, $this->parseVerbosity($verbosity));
    }
    
    /**
    * write a key-value string
    *
    * @param $title
    * @param $value
    * @param bool $newLine
     */
    public function field($title,$value, $newLine = true) {
        $message = "<fg=default;bg=default>$title ：</>";
        $message .= "<fg=default;bg=blue> $value </>";
        $this->getOutput()->write($message,$newLine);
    }
    
    /**
    * 使用vsprintf 输出
    *
    * @param $message
    * @param null $args
    * @param bool $newLine
    * @param string $color
     */
    public function printf($message,$args = null,$newLine = true,$color = 'blue') {
        if ($args) {
            if (!is_array($args)) {
                $args = [$args];
            }
            foreach($args as $k => $arg) {
                $args[$k] = "<fg=default;bg=$color> $arg </>";
            }
            
            $message = vsprintf($message,$args);
        } else {
            $message = "<fg=default;bg=$color> $message </>";;
        }
        $this->getOutput()->write($message,$newLine);
    }
    
    /**
    * 输出一组key-value数组
    *
    * @param $title
    * @param array $fields
    * @param array $headers
     */
    protected function fields($title,array $fields, array $headers = ['字段','值']) {
        $this->info($title);
        $data = [];
        foreach($fields as $field => $value) {
            $data[] = [
                'field' =>  $field,
                'value' =>  $value
            ];
        }
        $this->table($headers,$data);
    }
    
    public function table(array $headers, $rows, $style = 'default')
    {
        $table = new Table($this->getOutput());

        if ($rows instanceof Arrayable) {
            $rows = $rows->toArray();
        }

        $table->setHeaders($headers)->setRows($rows)->setStyle($style)->render();
    }
    
    /**
    * @return String
     */
    public function getOutputContent() {
        if (empty($this->outputContent) and $this->getOutput() instanceof BufferedOutput) {
            $this->outputContent = $this->getOutput()->fetch();
        }
        
        return $this->outputContent;
    }
    
    /**
    * @param Model $model
    */
    public function printDirty(Model $model) {
        $this->warn(get_class($model).' at #'.$model->id);
        $this->fields('Dirty Fields in '.get_class($model).'：',$model->getDirty());
    }

    /**
     * @param OutputInterface $output
     */
    public function setOutput(OutputInterface $output) {
        $this->output = $output;
    }
}