<?php
namespace Gpupo\Common\Traits;

use Gpupo\Common\Entity\Collection;

trait OptionsTrait
{
    protected $options = [];

    public function getOptions()
    {
        if (!$this->options instanceof Collection) {
            $this->setOptions($this->options);
        }
        
        return $this->options;
    }
    
    public function getDefaultOptions()
    {
        return [];
    }
    
    public function setOptions(Array $options = [])
    {
        $list = array_merge($this->getDefaultOptions(), $options);

        $this->options = new Collection($list);

        return $this;
    }
}
