<?php


use Andyts93\GMerchantCenter\Feed;
use Andyts93\GMerchantCenter\Product;
use Andyts93\GMerchantCenter\Shipping;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    const PRODUCT_NAMESPACE = '{http://base.google.com/ns/1.0}';

    public function testSetAttribute()
    {
        $product = new Product();

        $product->setAttribute('id', 123);
        $this->assertEquals([
            'item' => [
                ['name' => self::PRODUCT_NAMESPACE . 'id', 'value' => 123]
            ]
        ], $product->getXmlStructure(self::PRODUCT_NAMESPACE));
    }

    public function testAddAttribute()
    {
        $product = new Product();

        $product->setAttribute('additional_image_link', 'https://example.org/image1.jpg');
        $this->assertEquals([
            'item' => [
                ['name' => self::PRODUCT_NAMESPACE . 'additional_image_link', 'value' => 'https://example.org/image1.jpg']
            ]
        ], $product->getXmlStructure(self::PRODUCT_NAMESPACE));

        $product->addAttribute('additional_image_link', 'https://example.org/image2.jpg');
        $this->assertEquals([
            'item' => [
                ['name' => self::PRODUCT_NAMESPACE . 'additional_image_link', 'value' => 'https://example.org/image1.jpg'],
                ['name' => self::PRODUCT_NAMESPACE . 'additional_image_link', 'value' => 'https://example.org/image2.jpg']
            ]
        ], $product->getXmlStructure(self::PRODUCT_NAMESPACE));
    }


//    public function testGenerateFeed()
//    {
//        $product = new Product();
//        $product->setId(123)
//            ->setTitle('Prodotto prova')
//            ->setDescription('Descrizione prova')
//            ->setLink('http://autodemolizionepollini.it')
//            ->setImageLink('http://autodemolizionepollini.it')
//            ->setCondition(Product\ProductCondition::USED)
//            ->setAvailability(Product\ProductAvailability::INSTOCK)
//            ->setPrice(100)
//            ->setIdentifierExists(Product\ProductYesNo::NO)
//            ->setAdult(Product\ProductYesNo::NO)
//            ->setShipping(
//                (new Shipping())
//                    ->setCountry('IT')
//                    ->setPrice(10)
//            );
//
//        $feed = new Feed('Prova', 'test', 'test');
//
//        $feed->addProduct($product);
//
//        echo $feed->build();
//    }

}
