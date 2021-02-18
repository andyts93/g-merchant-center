<?php


namespace Andyts93\GMerchantCenter;


use Sabre\Xml\Element\Cdata;

class ProductAttribute
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $value;
    /**
     * @var bool
     */
    private $isCData;

    /**
     * ProductAttribute constructor.
     * @param string $name
     * @param mixed $value
     * @param bool $isCData
     */
    public function __construct(string $name, $value, bool $isCData = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->isCData = $isCData;
    }

    /**
     * @return bool
     */
    public function isCData(): bool
    {
        return $this->isCData;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function getXmlStructure($namespace)
    {
        return [
            'name' => $namespace . $this->getName(),
            'value' => $this->isCData() ? new Cdata($this->getValue()) : $this->getValue()
        ];
    }
}
