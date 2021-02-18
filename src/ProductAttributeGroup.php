<?php


namespace Andyts93\GMerchantCenter;


class ProductAttributeGroup
{
    use HasAttibutes;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ProductAttributeGroup
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }


}
