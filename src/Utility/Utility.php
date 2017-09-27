<?php
declare(strict_types=1);
namespace Thunder\Currenz\Utility;

final class Utility
{
    public static function xmlToArray(string $xmlString): array
    {
        $xml = new \DOMDocument();
        $xml->loadXML($xmlString);

        $value = function(\DOMElement $node, string $name): ?string {
            return $node->getElementsByTagName($name)->item(0)->nodeValue ?? null;
        };

        $data = [];
        /** @var \DOMElement $node */
        foreach($xml->childNodes[0]->childNodes[1]->childNodes as $node) {
            if(XML_ELEMENT_NODE !== $node->nodeType) {
                continue;
            }

            $code = $value($node, 'Ccy');
            $country = $value($node, 'CtryNm');
            if(false === array_key_exists($code, $data)) {
                $data[$code] = [
                    'code' => $code,
                    'countries' => [$country],
                    'name' => $value($node, 'CcyNm'),
                    'id' => $value($node, 'CcyNbr'),
                    'units' => $value($node, 'CcyMnrUnts'),
                ];
            }
            if(false === in_array($country, $data[$code]['countries'], true)) {
                $data[$code]['countries'][] = $country;
            }
        }

        return $data;
    }
}
