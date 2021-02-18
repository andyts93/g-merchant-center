<?php


namespace Andyts93\GMerchantCenter;


use Sabre\Xml\Service;

class Feed
{
    CONST XML_NAMESPACE = 'http://base.google.com/ns/1.0';

    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $link;
    /**
     * @var string
     */
    private $description;

    /**
     * @var Product[]
     */
    private $products = [];

    public function __construct(string $title, string $link, string $description)
    {
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function build()
    {
        $xml = new Service();
        $xml->namespaceMap[self::XML_NAMESPACE] = 'g';

        $structure = [
            'channel' => [
                ['title' => $this->title],
                ['link' => $this->link],
                ['description' => $this->description]
            ]
        ];

        foreach ($this->products as $product) {
            $structure['channel'][] = $product->getXmlStructure('{' . self::XML_NAMESPACE . '}');
        }

        return $xml->write('rss', $structure);
    }
}
