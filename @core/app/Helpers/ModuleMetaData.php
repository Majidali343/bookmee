<?php

namespace App\Helpers;
//                "settingsBlade": "AzulPaymentGateway::backend.azulpaymentgateway",
class ModuleMetaData
{
    public function __construct(public ?string $moduleName = null)
    {

    }

    public function paymentGatewayData(){
        $allMetaData = $this->getMetaData();
        if (property_exists($allMetaData,'BookmiMetadata')){
            //todo: check payment meta is available or not
            $metaInstance = $allMetaData->BookmiMetadata;
            return $this->getPaymentMetaInfo($metaInstance);
        }
        return null;
    }

    private function getMetaData()
    {
        if (moduleExists($this->moduleName)){
            return $this->getIndividualModuleMetaData($this->moduleName);
        }

        return null;
    }

    public function renderAllPaymentGatewaySettingsBlade(){
        //todo return blade partials to render it in
        $outputMarkup = '';
        $allMetaInformation = $this->getAllMetaData();
        foreach ($allMetaInformation as $metaInfo){
            $paymentMeta = $this->getPaymentMetaInfo($metaInfo);
            foreach ($paymentMeta as $inPay){
                if (property_exists($inPay,'settingsBlade')){
                    if (view()->exists($inPay->settingsBlade)){
                        $outputMarkup .= view($inPay->settingsBlade)->render();
                    }
                }
            }
        }
        return $outputMarkup;
    }
    public function getChargeCustomerMethodNameByPaymentGatewayName($gateway){
        //todo return blade partials to render it in
        $allMetaInformation = $this->getAllMetaData();
        foreach ($allMetaInformation as $metaInfo){
            $paymentMeta = $this->getPaymentMetaInfo($metaInfo);
            if ($gateway !== current($paymentMeta)->name){
                continue;
            }
            return current($paymentMeta)->chargeCustomerMethod;
        }
        return '';
    }

    public function renderAllPaymentGatewayExtraInforBlade(){
        //todo return blade partials to render it in
        $outputMarkup = '';
        $allMetaInformation = $this->getAllMetaData();
        foreach ($allMetaInformation as $metaInfo){
            $paymentMeta = $this->getPaymentMetaInfo($metaInfo);
            foreach ($paymentMeta as $inPay){
                if (property_exists($inPay,'extraInfoMarkupBlade')){
                    if (view()->exists($inPay->extraInfoMarkupBlade)){
                        $outputMarkup .= view($inPay->extraInfoMarkupBlade)->render();
                    }
                }
            }
        }
        return $outputMarkup;
    }

    public function saveAllPaymentGatewaySettings(){
        $outputMarkup = [];
        $allMetaInformation = $this->getAllMetaData();
        foreach ($allMetaInformation as $metaInfo){
            $paymentMeta = $this->getPaymentMetaInfo($metaInfo);
            foreach ($paymentMeta as $inPay){
                if (property_exists($inPay,'settingsData')){
                    $outputMarkup[] = $inPay->settingsData;
                }
            }
        }
        return $outputMarkup;
    }

    public function getAllPaymentGatewayList(){
        $outputMarkup = [];
        $allMetaInformation = $this->getAllMetaData();
        foreach ($allMetaInformation as $metaInfo){
            $paymentMeta = $this->getPaymentMetaInfo($metaInfo);
            foreach ($paymentMeta as $inPay){
                if (property_exists($inPay,'name')){
                    $outputMarkup[] = $inPay->name;
                }
            }
        }
        return $outputMarkup;
    }

    private function getPaymentMetaInfo($metaInstance){
        if(property_exists($metaInstance,'paymentGateway')){
            return $metaInstance->paymentGateway;
        }
    }

    public function getAllMetaData(){
        $allModuleMeta = [];
        $allDirectories = glob(base_path().'/Modules/*',GLOB_ONLYDIR);

        foreach ($allDirectories as $dire){
            //todo scan all the json file
            $currFolderName = pathinfo($dire,PATHINFO_BASENAME);
            $metaInformation = $this->getIndividualModuleMetaData($currFolderName);
            if (property_exists($metaInformation,'BookmiMetadata')){
                $allModuleMeta[$currFolderName] = $metaInformation->BookmiMetadata;
            }
        }
        return $allModuleMeta;
    }

    private function getIndividualModuleMetaData(string $moduleName,bool $returnType = false){
        $filePath =  module_path($moduleName).'/module.json';
        if (file_exists($filePath) && !is_dir($filePath)){
            return json_decode(file_get_contents($filePath),$returnType);
        }
    }
}