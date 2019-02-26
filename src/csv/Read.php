<?php
namespace Soar\Csv\Csv;
/**
 * Desc: 分批读取CSV 文件内容
 * Date: 2018/12/25 Time: 10:16
 */
class Read
{
    /**
     * 文件路径
     *
     * @var string
     */
    private $file = '';

    /**
     * @var \SplFileObject null
     */
    private $fileObject = null;

    /**
     * ReadCsv constructor.
     * @param $file
     * @throws \Exception
     */
    public function __construct($file)
    {
        if (file_exists($file)) {
            $this->file = $file;
            $this->openFile();
        } else {
            throw new \Exception("文件不存在", -1);
        }
    }

    /**
     * openFile 获取SplFileObject对象
     * Date: 2018/12/27 Time: 11:38
     */
    public function openFile()
    {
        if (is_null($this->fileObject)) {
            $this->fileObject = new \SplFileObject($this->file, 'rb');
        }
    }

    /**
     * getLine
     * @return int
     * Date: 2018/12/27 Time: 11:38
     */
    public function getLine()
    {
        $this->fileObject->seek(filesize($this->file));
        return $this->fileObject->key();
    }

    /**
     * getData 按行读取
     * @param $count integer 读取的行数
     * @param int $startLine 开始行数
     * @return array
     * Date: 2018/12/27 Time: 11:38
     */
    public function getData($count, $startLine = 1)
    {
        $content = array();
        // 转到第N行, seek方法参数从0开始计数
        $this->fileObject->seek($startLine-1);
        for ($i = 0; $i < $count; ++$i) {
            // current()获取当前行内容
            $content[] = trim($this->fileObject->current());
            // 下一行
            $this->fileObject->next();
        }
        // array_filter过滤：false,null,''
        return array_filter($content);
    }
}
