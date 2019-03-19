<?php

namespace MWL\Ebay\Services;

use \DTS\eBaySDK\Finding\Services;
use \DTS\eBaySDK\Finding\Types;

class ShoppingService extends Service
{
    protected $service;

    public function __construct(array $config)
    {
        $this->service = new Services\FindingService([
            'credentials' => $config['credentials'],
            'globalId'     => $config['globalId']
        ]);
    }

    public function searchItemsByStore($storeName, $page = 1, $pageSize = 1)
    {
        $request = new Types\FindItemsIneBayStoresRequest([
            'storeName' => $storeName,
            'paginationInput' => $this->getPaginationInput($page, $pageSize)
        ]);
        return $this->getResponse($this->service->findItemsIneBayStores($request));
    }

    public function getPosition($keywords, $itemId) 
    {
        $pageSize = 100;
        for($i = 1; $i < 10; $i++) {
            $response = $this->searchItemsBykeywords($keywords, $i, $pageSize);
            foreach ($response->searchResult->item as $key => $item) {
                if ($item->itemId == $itemId) {
                    return ($i-1)*$pageSize + ($key+1);
                }
            }
            if ($i >= $response->paginationOutput->totalPages) {
                break;
            }
        }
        return null;
    }
    
    public function getAllItemsByStroe($storeName) : array
    {
        $items = [];
        for($i = 1; $i< 200; $i++) {
            $response = $this->searchItemsByStore($storeName, $i, 100);
            foreach ($response->searchResult->item as $item) {
                $items[$item->itemId] = $item->title;
            }
            if ($i >= $response->paginationOutput->totalPages) {
                break;
            }
        }
        return $items;
    }

    protected function getPaginationInput($page, $pageSize)
    {
        return  new Types\PaginationInput([
            'entriesPerPage' => $pageSize,
            'pageNumber'     => $page
        ]);
    }

    public function searchItemsBykeywords($keywords, $page = 1, $pageSize = 1)
    {
        $request = new Types\FindItemsByKeywordsRequest([
            'keywords' => $keywords,
            'paginationInput' => $this->getPaginationInput($page, $pageSize)
        ]);
        return $this->getResponse($this->service->findItemsByKeywords($request));
    }

    protected function getResponse($response) 
    {
        if ($response->ack !== 'Success') {
            $msgs = [];
            foreach ($response->errorMessage->error as $error) {
                $msgs[] = $error->message;
            }
            throw new \Exception(printf("Error: %s<br/>", implode("<br/>", $msgs)), 1);
        } 
        return $response;
    }
}