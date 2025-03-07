<?php

declare(strict_types=1);

use WHMCS\Database\Capsule;

add_hook('AdminAreaPage', 1, function (array $vars): void {
    if ($_POST['ajaxpage'] ?? '' === 'createconfig') {
        require_once 'cloudstack.php';

        $productId = (int) ($_POST['productid'] ?? 0);
        if ($productId <= 0) {
            echo "Invalid product ID";
            exit();
        }

        $data = Capsule::table('tblproducts')
            ->where('id', '=', $productId)
            ->where('servertype', '=', 'cloudstack')
            ->first();

        if (!$data) {
            echo "Product not found or invalid server type";
            exit();
        }

        $params = [
            'configoption3' => $data->configoption3,
            'configoption1' => $data->configoption1,
            'configoption2' => $data->configoption2,
            'data' => $data->configoption2
        ];

        $cloudstack = request($params);

        $zones = $cloudstack->listZones(); // Zones list
        $zone = [];
        foreach ($zones->listzonesresponse->zone ?? [] as $zonename) {
            $zone[$zonename->id] = $zonename->name;
        }

        $serviceoffers = $cloudstack->listServiceOfferings(); // Disk offers
        $soffer = [];
        foreach ($serviceoffers->listserviceofferingsresponse->serviceoffering ?? [] as $serviceoffer) {
            $soffer[$serviceoffer->id] = $serviceoffer->name;
        }

        $disk = [];
        $diskoffers = $cloudstack->listDiskOfferings(); // Disk offers
        foreach ($diskoffers->listdiskofferingsresponse->diskoffering ?? [] as $diskoffer) {
            $disk[$diskoffer->id] = $diskoffer->name;
        }

        $temp = [];
        $templates = $cloudstack->listTemplates('all');
        foreach ($templates->listtemplatesresponse->template ?? [] as $template) {
            $temp[$template->id] = $template->name;
        }

        cloustack_generateconfigoption('Zones', $productId, $zone);
        cloustack_generateconfigoption('ServiceOffer', $productId, $soffer);
        cloustack_generateconfigoption('DiskOffer', $productId, $disk);
        cloustack_generateconfigoption('Template', $productId, $temp);

        echo "success";
        exit();
    }
});
