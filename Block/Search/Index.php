<?php
/**
 * Copyright © 2015 Dd . All rights reserved.
 */
namespace Klevu\Search\Block\Search;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\App\RequestInterface;

class Index extends \Magento\Framework\View\Element\Template
{
    const KlEVUPRESERVELAYOUT    = 1;
    const DISABLE     = 0;
    const KlEVUTEMPLATE = 2;
    
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    
    public function isExtensionConfigured()
    {
        return \Magento\Framework\App\ObjectManager::getInstance()->get('Klevu\Search\Helper\Config')->isExtensionConfigured();
    }
    
    public function isLandingEnabled()
    {
        return \Magento\Framework\App\ObjectManager::getInstance()->get('Klevu\Search\Helper\Config')->isLandingEnabled();
    }
    
    public function getJsApiKey()
    {
        return \Magento\Framework\App\ObjectManager::getInstance()->get('Klevu\Search\Helper\Config')->getJsApiKey();
    }
    
    public function getModuleInfo()
    {
        $moduleInfo = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\Module\ModuleList')->getOne('Klevu_Search');
        return $moduleInfo['setup_version'];
    }
    
    public function getJsUrl()
    {
        return \Magento\Framework\App\ObjectManager::getInstance()->get('Klevu\Search\Helper\Config')->getJsUrl();
    }
    
    public function getStoreLanguage()
    {
        return \Magento\Framework\App\ObjectManager::getInstance()->get('Klevu\Search\Helper\Data')->getStoreLanguage();
    }
    
    public function getCurrentCurrencyCode()
    {
        $store = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Store\Model\StoreManagerInterface')->getStore();
        return $store->getCurrentCurrencyCode();
    }
    
    public function getCurrencyData()
    {
        $store = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Store\Model\StoreManagerInterface')->getStore();
        return \Magento\Framework\App\ObjectManager::getInstance()->get('Klevu\Search\Helper\Data')->getCurrencyData($store);
    }
	
	public function getKlevuSync()
    {
        return \Magento\Framework\App\ObjectManager::getInstance()->get('Klevu\Search\Model\Sync');
    }
	public function getKlevuRequestParam($key)
    {
		$om = \Magento\Framework\App\ObjectManager::getInstance();
		$request = $om->get('Magento\Framework\App\RequestInterface');
		$store_id = $request->getParam('store');
		$store = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Store\Model\StoreManagerInterface');
		$store_view = $store->getStore($store_id);
		$value = $request->getParam($key);
		return $value;
	}
	
	public function getStoreParam()
    {
		$om = \Magento\Framework\App\ObjectManager::getInstance();
		$request = $om->get('Magento\Framework\App\RequestInterface');
		$store_id = $request->getParam('store');
		return $store_id;
	}
	
	public function getRestApiParam()
    {
		$om = \Magento\Framework\App\ObjectManager::getInstance();
		$request = $om->get('Magento\Framework\App\RequestInterface');
		$restapi = $request->getParam('restapi');
		return $restapi;
	}
	
	public function getRestApi($store_id)
    {
		$om = \Magento\Framework\App\ObjectManager::getInstance();
		$rest_api = $om->get('\Klevu\Search\Model\Sync')->getHelper()->getConfigHelper()->getRestApiKey($store_id);
		return $rest_api;
	}
    
    public function isPubInUse()
    {
        $check_pub = explode('/', $_SERVER["DOCUMENT_ROOT"]);
        $filter = array_filter($check_pub);
        $folder_name = end($filter);
        if ($folder_name == "pub") {
            return true;
        }
        return false;
    }
}
