<?php

declare(strict_types=1);

namespace Bounteous\Exercise\Controller\Submit;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\HTTP\Client\Curl;

class Index extends Action
{
    CONST URL = 'https://api.openweathermap.org/data/2.5/weather';
    CONST APIKEY = '2869a1bb8f37678c4028672b496221f6';
    /**
     * @var Curl
     */
    protected $curl;

    public function __construct(
        Context $context,
        Curl $curl
    )
    {
        $this->curl = $curl;
        parent::__construct($context);
    }

    public function execute()
    {
        $post = (array) $this->getRequest()->getPost();

        if (!empty($post)) {
            $temp   = (float)$post['temp'];
            $wind    = (float)$post['wind'];
            $countryCode       = $post['countryCode'];
            $zip = $post['zip'];
            $params = [
                'zip'=>$zip.','.$countryCode,
                'appid'=>$this::APIKEY
            ];
            $url=$this::URL.'?zip='.$zip.','.$countryCode.'&appid='.$this::APIKEY;
            $this->curl->post($url,$params);
            $result = json_decode($this->curl->getBody(), true);
            if($result['cod']==200){
                $temperature = $result['main']['temp'];
                $windSpeed = $result['wind']['speed'];
                $msg = '';
                if($temperature<$temp || $windSpeed>$wind){
                    $msg = 'Yes, you should wear a jacket today.'
                        ;
                }else{
                    $msg = 'Yes, you should wear a jacket today.';
                }
                $msg .= ' Current temperature is '.$temperature
                .'°F and wind spped is '.$windSpeed.' mph.';
                $this->messageManager->addSuccessMessage($msg);
            }else{
                $this->messageManager->addErrorMessage($result['message']);
            }
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl('/exercise');

            return $resultRedirect;
        }
    }
}
