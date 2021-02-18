<?php

namespace Andyts93\GMerchantCenter;

use Sabre\Xml\Element\Cdata;

trait HasAttibutes
{
    /**
     * @var ProductAttribute[]
     */
    private $attributes = [];

    public function setAttribute($name, $value, $isCData = false)
    {
        $attribute = new ProductAttribute($name, $value, $isCData);
        $this->attributes[strtolower($name)] = $attribute;
        return $this;
    }

    public function addAttribute($name, $value, $isCData = false)
    {
        $attribute = new ProductAttribute($name, $value, $isCData);
        $attributeName = strtolower($name);
        if (!isset($this->attributes[$attributeName])) {
            $this->attributes[$attributeName] = [$attribute];
            return $this;
        }

        if (!is_array($this->attributes[$attributeName])) {
            $this->attributes[$attributeName] = [$this->attributes[$attributeName], $attribute];
            return $this;
        }

        $this->attributes[$attributeName][] = $attribute;
        return $this;
    }

    public function getAttributesXmlStructure($namespace)
    {
        $result = [];

        foreach ($this->attributes as $attribute) {
            if (is_object($attribute) && $attribute->getValue() instanceof ProductAttributeGroup) {
                $result[] = [
                    'name' => $namespace . $attribute->getName(),
                    'value' => $attribute->getValue()->getAttributesXmlStructure($namespace)
                ];
            }
            else {
                $attributes = is_array($attribute) ? $attribute : [$attribute];
                foreach ($attributes as $item) {
                    $result[] = $item->getXmlStructure($namespace);
                }
            }
        }

        return $result;
    }

    public function getProductAttributeGroup()
    {
        $attributeGroup = new ProductAttributeGroup();
        foreach ($this->attributes as $attribute) {
            $attributes = is_array($attribute) ? $attribute : [$attribute];
            foreach ($attributes as $attribute) {
                $value = $attribute->isCdata() ? new Cdata($attribute->getValue()) : $attribute->getValue();
                $attributeGroup->addAttribute($attribute->getName(), $value, $attribute->isCData());
            }
        }
        return $attributeGroup;
    }
}
