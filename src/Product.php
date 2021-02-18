<?php


namespace Andyts93\GMerchantCenter;


use Andyts93\GMerchantCenter\Product\ProductAvailability;
use Andyts93\GMerchantCenter\Product\ProductCondition;
use Andyts93\GMerchantCenter\Product\ProductYesNo;
use http\Exception\InvalidArgumentException;

class Product
{
    use HasAttibutes;

    public function setId($id)
    {
        $this->setAttribute('id', $id);
        return $this;
    }

    public function setTitle($title)
    {
        $this->setAttribute('title', $title, true);
        return $this;
    }

    public function setDescription($description)
    {
        $this->setAttribute('description', $description, true);
        return $this;
    }

    public function setLink($link)
    {
        $this->setAttribute('link', $link, true);
        return $this;
    }

    public function setImageLink($imageLink)
    {
        $this->setAttribute('image_link', $imageLink, true);
        return $this;
    }

    public function setPrice($price, $currency = 'EUR')
    {
        $this->setAttribute('price', number_format($price, 2, '.', '') . ' ' . $currency);
        return $this;
    }

    public function setBrand($brand)
    {
        $this->setAttribute('brand', $brand, true);
        return $this;
    }

    public function setAvailability($availability)
    {
        if (!in_array($availability, [ProductAvailability::INSTOCK, ProductAvailability::OUTOFSTOCK, ProductAvailability::PREORDER])) {
            throw new InvalidArgumentException("Invalid availability attribute value");
        }
        $this->setAttribute('availability', $availability);
        return $this;
    }

    public function setIdentifierExists($exists)
    {
        if (!in_array($exists, [ProductYesNo::YES, ProductYesNo::NO])) {
            throw new InvalidArgumentException("Invalid identifier_exists attribute value");
        }
        $this->setAttribute('identifier_exists', $exists);
        return $this;
    }

    public function setCondition($condition)
    {
        if (!in_array($condition, [ProductCondition::NEW, ProductCondition::REFURBISHED, ProductCondition::USED])) {
            throw new InvalidArgumentException("Invalid condition attribute value");
        }
        $this->setAttribute('condition', $condition);
        return $this;
    }

    public function setAdult($adult) {
        if (!in_array($adult, [ProductYesNo::YES, ProductYesNo::NO])) {
            throw new InvalidArgumentException("Invalid adult attribute value");
        }
        $this->setAttribute('adult', $adult);
        return $this;
    }

    public function setShipping(Shipping $shipping) {
        $attributeGroup = $shipping->getProductAttributeGroup()->setName('shipping');
        $this->setAttribute('shipping', $attributeGroup);
        return $this;
    }

    public function getXmlStructure($namespace)
    {
        return [
            'item' => $this->getAttributesXmlStructure($namespace)
        ];
    }
}
