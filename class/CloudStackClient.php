<?php

/*
 * This file is part of the CloudStack PHP Client.
 *
 * (c) Vexora Solutions LLP <vexorasolutions@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

require_once dirname(__FILE__) . "/BaseCloudStackClient.php";
require_once dirname(__FILE__) . "/CloudStackClientException.php";

class CloudStackClient extends BaseCloudStackClient {

    /**
     * Creates and automatically starts a virtual machine based on a service offering, disk offering, and template.
     *
     * @param string $serviceOfferingId the ID of the service offering for the virtual 
     *        machine
     * @param string $templateId the ID of the template for the virtual machine
     * @param string $zoneId availability zone for the virtual machine
     * @param string $account an optional account for the virtual machine. Must be used
     *         with domainId.
     * @param string $diskOfferingId the ID of the disk offering for the virtual machin
     *        e. If the template is of ISO format, the diskOfferingId is for the root disk vol
     *        ume. Otherwise this parameter is used to indicate the offering for the data disk
     *         volume. If the templateId parameter passed is from a Template object, the diskO
     *        fferingId refers to a DATA Disk Volume created. If the templateId parameter pass
     *        ed is from an ISO object, the diskOfferingId refers to a ROOT Disk Volume create
     *        d.
     * @param string $displayName an optional user generated name for the virtual machi
     *        ne
     * @param string $domainId an optional domainId for the virtual machine. If the acc
     *        ount parameter is used, domainId must also be used.
     * @param string $group an optional group for the virtual machine
     * @param string $hostId destination Host ID to deploy the VM to - parameter availa
     *        ble for root admin only
     * @param string $hypervisor the hypervisor on which to deploy the virtual machine
     * @param string $keyPair name of the ssh key pair used to login to the virtual mac
     *        hine
     * @param string $name host name for the virtual machine
     * @param string $networkIds list of network ids used by virtual machine
     * @param string $securityGroupIds comma separated list of security groups id that
     *        going to be applied to the virtual machine. Should be passed only when vm is cre
     *        ated from a zone with Basic Network support. Mutually exclusive with securitygro
     *        upnames parameter
     * @param string $securityGroupNames comma separated list of security groups names
     *        that going to be applied to the virtual machine. Should be passed only when vm i
     *        s created from a zone with Basic Network support. Mutually exclusive with securi
     *        tygroupids parameter
     * @param string $size the arbitrary size for the DATADISK volume. Mutually exclusi
     *        ve with diskOfferingId
     * @param string $userData an optional binary data that can be sent to the virtual
     *        machine upon a successful deployment. This binary data must be base64 encoded be
     *        fore adding it to the request. Currently only HTTP GET is supported. Using HTTP 
     *        GET (via querystring), you can send up to 2KB of data after base64 encoding.
     */
    public function deployVirtualMachine(string $serviceOfferingId, string $templateId, string $zoneId, ?string $account = null, ?string $diskOfferingId = null, ?string $displayName = null, ?string $domainId = null, ?string $group = null, ?string $hostId = null, ?string $hypervisor = null, ?string $keyPair = null, ?string $name = null, ?string $networkIds = null, ?string $securityGroupIds = null, ?string $securityGroupNames = null, ?string $size = null, ?string $userData = null, ?string $memory = null, ?string $password = null, ?string $passwordenabled = null) {
        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "serviceOfferingId");
        }
        if (empty($templateId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "templateId");
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "zoneId");
        }
        return $this->request("deployVirtualMachine", [
            'serviceofferingid' => $serviceOfferingId,
            'templateid' => $templateId,
            'zoneid' => $zoneId,
            'account' => $account,
            'diskofferingid' => $diskOfferingId,
            'displayname' => $displayName,
            'domainid' => $domainId,
            'group' => $group,
            'hostid' => $hostId,
            'hypervisor' => $hypervisor,
            'keypair' => $keyPair,
            'name' => $name,
            'networkids' => $networkIds,
            'securitygroupids' => $securityGroupIds,
            'securitygroupnames' => $securityGroupNames,
            'size' => $size,
            'userdata' => $userData,
            'memory' => $memory,
            'password' => $password,
            'passwordenabled' => $passwordenabled
        ]);
    }

    /**
     * Destroys a virtual machine. Once destroyed, only the administrator can recover it.
     *
     * @param string $id The ID of the virtual machine
     */
    public function destroyVirtualMachine(string $id) {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }
        return $this->request("destroyVirtualMachine", ['id' => $id]);
    }

    /**
     * Reboots a virtual machine.
     *
     * @param string $id The ID of the virtual machine
     */
    public function rebootVirtualMachine(string $id) {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }
        return $this->request("rebootVirtualMachine", ['id' => $id]);
    }

    /**
     * Starts a virtual machine.
     *
     * @param string $id The ID of the virtual machine
     */
    public function startVirtualMachine(string $id) {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }
        return $this->request("startVirtualMachine", ['id' => $id]);
    }

    /**
     * Stops a virtual machine.
     *
     * @param string $id The ID of the virtual machine
     * @param string $forced Force stop the VM.  The caller knows the VM is stopped.
     */
    public function stopVirtualMachine(string $id, ?string $forced = null) {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }
        return $this->request("stopVirtualMachine", ['id' => $id, 'forced' => $forced]);
    }

    /**
     * Resets the password for virtual machine. The virtual machine must be in a "Stopped" state and the template must already support this feature for this command to take effect. [async]
     *
     * @param string $id The ID of the virtual machine
     */
    public function resetPasswordForVirtualMachine(string $id) {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }
        return $this->request("resetPasswordForVirtualMachine", ['id' => $id]);
    }

    /**
     * Changes the service offering for a virtual machine. The virtual machine must be in a "Stopped" state for this command to take effect.
     *
     * @param string $id The ID of the virtual machine
     * @param string $serviceOfferingId the service offering ID to apply to the virtual
     *         machine
     */
    public function changeServiceForVirtualMachine(string $id, string $serviceOfferingId) {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }
        if (empty($serviceOfferingId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "serviceOfferingId");
        }
        return $this->request("changeServiceForVirtualMachine", ['id' => $id, 'serviceofferingid' => $serviceOfferingId]);
    }

    /**
     * Updates parameters of a virtual machine.
     *
     * @param string $id The ID of the virtual machine
     * @param string $displayName user generated name
     * @param string $group group of the virtual machine
     * @param string $haEnable true if high-availability is enabled for the virtual mac
     *        hine, false otherwise
     * @param string $osTypeId the ID of the OS type that best represents this VM.
     */
    public function updateVirtualMachine(string $id, ?string $displayName = null, ?string $group = null, ?string $haEnable = null, ?string $osTypeId = null) {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }
        return $this->request("updateVirtualMachine", ['id' => $id, 'displayname' => $displayName, 'group' => $group, 'haenable' => $haEnable, 'ostypeid' => $osTypeId]);
    }

    /**
     * List the virtual machines owned by the account.
     *
     * @param string $account account. Must be used with the domainId parameter.
     * @param string $domainId the domain ID. If used with the account parameter, lists
     *         virtual machines for the specified account in this domain.
     * @param string $forVirtualNetwork list by network type; true if need to list vms 
     *        using Virtual Network, false otherwise
     * @param string $groupId the group ID
     * @param string $hostId the host ID
     * @param string $hypervisor the target hypervisor for the template
     * @param string $id the ID of the virtual machine
     * @param string $isRecursive Must be used with domainId parameter. Defaults to fal
     *        se, but if true, lists all vms from the parent specified by the domain id till l
     *        eaves.
     * @param string $keyword List by keyword
     * @param string $name name of the virtual machine
     * @param string $networkId list by network id
     * @param string $page 
     * @param string $pageSize 
     * @param string $podId the pod ID
     * @param string $state state of the virtual machine
     * @param string $storageId the storage ID where vm&#039;s volumes belong to
     * @param string $zoneId the availability zone ID
     * @param string $page Pagination
     */
    public function listVirtualMachines($account = null, $domainId = null, $forVirtualNetwork = null, $groupId = null, $hostId = null, $hypervisor = null, $id = null, $isRecursive = null, $keyword = null, $name = null, $networkId = null, $page = null, $pageSize = null, $podId = null, $state = null, $storageId = null, $zoneId = null) {

        return $this->request("listVirtualMachines", array(
                    'account' => $account,
                    'domainid' => $domainId,
                    'forvirtualnetwork' => $forVirtualNetwork,
                    'groupid' => $groupId,
                    'hostid' => $hostId,
                    'hypervisor' => $hypervisor,
                    'id' => $id,
                    'isrecursive' => $isRecursive,
                    'keyword' => $keyword,
                    'name' => $name,
                    'networkid' => $networkId,
                    'page' => $page,
                    'pagesize' => $pageSize,
                    'podid' => $podId,
                    'state' => $state,
                    'storageid' => $storageId,
                    'zoneid' => $zoneId,
        ));
    }

    /**
     * Returns an encrypted password for the VM
     *
     * @param string $id The ID of the virtual machine
     */
    public function getVMPassword(string $id) {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }
        return $this->request("getVMPassword", ['id' => $id]);
    }

    /**
     * Creates a template of a virtual machine. The virtual machine must be in a STOPPED state. A template created from this command is automatically designated as a private template visible to the account that created it.
     *
     * @param string $displayText the display text of the template. This is usually use
     *        d for display purposes.
     * @param string $name the name of the template
     * @param string $osTypeId the ID of the OS Type that best represents the OS of thi
     *        s template.
     * @param string $bits 32 or 64 bit
     * @param string $isFeatured true if this template is a featured template, false ot
     *        herwise
     * @param string $isPublic true if this template is a public template, false otherw
     *        ise
     * @param string $passwordEnabled true if the template supports the password reset 
     *        feature; default is false
     * @param string $requireShvm true if the template requres HVM, false otherwise
     * @param string $snapshotId the ID of the snapshot the template is being created f
     *        rom
     * @param string $volumeId the ID of the disk volume the template is being created 
     *        from
     */
    public function createTemplate(
        string $displayText,
        string $name,
        string $osTypeId,
        ?int $bits = null,
        ?bool $isFeatured = null,
        ?bool $isPublic = null,
        ?bool $passwordEnabled = null,
        ?bool $requireShvm = null,
        ?string $snapshotId = null,
        ?string $volumeId = null
    ): array {
        if (empty($displayText)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "displayText");
        }
        if (empty($name)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "name");
        }
        if (empty($osTypeId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "osTypeId");
        }

        return $this->request("createTemplate", [
            'displaytext' => $displayText,
            'name' => $name,
            'ostypeid' => $osTypeId,
            'bits' => $bits,
            'isfeatured' => $isFeatured,
            'ispublic' => $isPublic,
            'passwordenabled' => $passwordEnabled,
            'requireshvm' => $requireShvm,
            'snapshotid' => $snapshotId,
            'volumeid' => $volumeId,
        ]);
    }


    /**
     * Registers an existing template into the Cloud.com cloud.
     *
     * @param string $displayText the display text of the template. This is usually use
     *        d for display purposes.
     * @param string $format the format for the template. Possible values include QCOW2
     *        , RAW, and VHD.
     * @param string $hypervisor the target hypervisor for the template
     * @param string $name the name of the template
     * @param string $osTypeId the ID of the OS Type that best represents the OS of thi
     *        s template.
     * @param string $url the URL of where the template is hosted. Possible URL include
     *         http:// and https://
     * @param string $zoneId the ID of the zone the template is to be hosted on
     * @param string $account an optional accountName. Must be used with domainId.
     * @param string $bits 32 or 64 bits support. 64 by default
     * @param string $checksum the MD5 checksum value of this template
     * @param string $domainId an optional domainId. If the account parameter is used, 
     *        domainId must also be used.
     * @param string $isExtractable true if the template or its derivatives are extract
     *        able; default is false
     * @param string $isFeatured true if this template is a featured template, false ot
     *        herwise
     * @param string $isPublic true if the template is available to all accounts; defau
     *        lt is true
     * @param string $passwordEnabled true if the template supports the password reset 
     *        feature; default is false
     * @param string $requireShvm true if this template requires HVM
     */
    public function registerTemplate(
        string $displayText,
        string $format,
        string $hypervisor,
        string $name,
        string $osTypeId,
        string $url,
        string $zoneId,
        ?string $account = null,
        ?int $bits = null,
        ?string $checksum = null,
        ?string $domainId = null,
        ?bool $isExtractable = null,
        ?bool $isFeatured = null,
        ?bool $isPublic = null,
        ?bool $passwordEnabled = null,
        ?bool $requireShvm = null
    ): array {
        if (empty($displayText)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "displayText");
        }
        if (empty($format)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "format");
        }
        if (empty($hypervisor)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "hypervisor");
        }
        if (empty($name)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "name");
        }
        if (empty($osTypeId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "osTypeId");
        }
        if (empty($url)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "url");
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "zoneId");
        }

        return $this->request("registerTemplate", [
            'displaytext' => $displayText,
            'format' => $format,
            'hypervisor' => $hypervisor,
            'name' => $name,
            'ostypeid' => $osTypeId,
            'url' => $url,
            'zoneid' => $zoneId,
            'account' => $account,
            'bits' => $bits,
            'checksum' => $checksum,
            'domainid' => $domainId,
            'isextractable' => $isExtractable,
            'isfeatured' => $isFeatured,
            'ispublic' => $isPublic,
            'passwordenabled' => $passwordEnabled,
            'requireshvm' => $requireShvm,
        ]);
    }


    /**
     * Updates attributes of a template.
     *
     * @param string $id the ID of the image file
     * @param string $bootable true if image is bootable, false otherwise
     * @param string $displayText the display text of the image
     * @param string $format the format for the image
     * @param string $name the name of the image file
     * @param string $osTypeId the ID of the OS type that best represents the OS of thi
     *        s image.
     * @param string $passwordEnabled true if the image supports the password reset fea
     *        ture; default is false
     */
    public function updateTemplate(
        string $id,
        ?bool $bootable = null,
        ?string $displayText = null,
        ?string $format = null,
        ?string $name = null,
        ?string $osTypeId = null,
        ?bool $passwordEnabled = null
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("updateTemplate", [
            'id' => $id,
            'bootable' => $bootable,
            'displaytext' => $displayText,
            'format' => $format,
            'name' => $name,
            'ostypeid' => $osTypeId,
            'passwordenabled' => $passwordEnabled,
        ]);
    }

    /**
     * Copies a template from one zone to another.
     *
     * @param string $id Template ID.
     * @param string $destzoneId ID of the zone the template is being copied to.
     * @param string $sourceZoneId ID of the zone the template is currently hosted on.
     */
    public function copyTemplate(
        string $id,
        string $destzoneId,
        string $sourceZoneId
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }
        if (empty($destzoneId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "destzoneId");
        }
        if (empty($sourceZoneId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "sourceZoneId");
        }

        return $this->request("copyTemplate", [
            'id' => $id,
            'destzoneid' => $destzoneId,
            'sourcezoneid' => $sourceZoneId,
        ]);
    }

    /**
     * Deletes a template from the system. All virtual machines using the deleted template will not be affected.
     *
     * @param string $id the ID of the template
     * @param string $zoneId the ID of zone of the template
     */
    public function deleteTemplate(
        string $id,
        ?string $zoneId = null
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("deleteTemplate", [
            'id' => $id,
            'zoneid' => $zoneId,
        ]);
    }


    /**
     * List all public, private, and privileged templates.
     *
     * @param string $templateFilter possible values are &quot;featured&quot;, &quot;se
     *        lf&quot;, &quot;self-executable&quot;, &quot;executable&quot;, and &quot;communi
     *        ty&quot;.* featured-templates that are featured and are public* self-templates t
     *        hat have been registered/created by the owner* selfexecutable-templates that hav
     *        e been registered/created by the owner that can be used to deploy a new VM* exec
     *        utable-all templates that can be used to deploy a new VM* community-templates th
     *        at are public.
     * @param string $account list template by account. Must be used with the domainId 
     *        parameter.
     * @param string $domainId list all templates in specified domain. If used with the
     *         account parameter, lists all templates for an account in the specified domain.
     * @param string $hypervisor the hypervisor for which to restrict the search
     * @param string $id the template ID
     * @param string $keyword List by keyword
     * @param string $name the template name
     * @param string $page 
     * @param string $pageSize 
     * @param string $zoneId list templates by zoneId
     * @param string $page Pagination
     */
    public function listTemplates(
        string $templateFilter,
        ?string $account = null,
        ?string $domainId = null,
        ?string $hypervisor = null,
        ?string $id = null,
        ?string $keyword = null,
        ?string $name = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $zoneId = null
    ): array {
        if (empty($templateFilter)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "templateFilter");
        }

        return $this->request("listTemplates", [
            'templatefilter' => $templateFilter,
            'account' => $account,
            'domainid' => $domainId,
            'hypervisor' => $hypervisor,
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'zoneid' => $zoneId,
        ]);
    }


    /**
     * Updates a template visibility permissions. A public template is visible to all accounts within the same domain. A private template is visible only to the owner of the template. A priviledged template is a private template with account permissions added. Only accounts specified under the template permissions are visible to them.
     *
     * @param string $id the template ID
     * @param string $accounts a comma delimited list of accounts
     * @param string $isFeatured true for featured templates/isos, false otherwise
     * @param string $isPublic true for public templates/isos, false for private templa
     *        tes/isos
     * @param string $op permission operator (add, remove, reset)
     */
    public function updateTemplatePermissions(
        string $id,
        ?string $accounts = null,
        ?bool $isFeatured = null,
        ?bool $isPublic = null,
        ?string $op = null
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("updateTemplatePermissions", [
            'id' => $id,
            'accounts' => $accounts,
            'isfeatured' => $isFeatured,
            'ispublic' => $isPublic,
            'op' => $op,
        ]);
    }


    /**
     * List template visibility and all accounts that have permissions to view this template.
     *
     * @param string $id the template ID
     * @param string $account List template visibility and permissions for the specifie
     *        d account. Must be used with the domainId parameter.
     * @param string $domainId List template visibility and permissions by domain. If u
     *        sed with the account parameter, specifies in which domain the specified account 
     *        exists.
     * @param string $page Pagination
     */
    public function listTemplatePermissions(
        string $id,
        ?string $account = null,
        ?string $domainId = null,
        ?int $page = null
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("listTemplatePermissions", [
            'id' => $id,
            'account' => $account,
            'domainid' => $domainId,
            'page' => $page,
        ]);
    }


    /**
     * Extracts a template
     *
     * @param string $id the ID of the template
     * @param string $mode the mode of extraction - HTTP_DOWNLOAD or FTP_UPLOAD
     * @param string $zoneId the ID of the zone where the ISO is originally located
     * @param string $url the url to which the ISO would be extracted
     */
    public function extractTemplate(
        string $id,
        string $mode,
        string $zoneId,
        ?string $url = null
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }
        if (empty($mode)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "mode");
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "zoneId");
        }

        return $this->request("extractTemplate", [
            'id' => $id,
            'mode' => $mode,
            'zoneid' => $zoneId,
            'url' => $url,
        ]);
    }


    /**
     * Attaches an ISO to a virtual machine.
     *
     * @param string $id the ID of the ISO file
     * @param string $virtualMachineId the ID of the virtual machine
     */
    public function attachIso(
        string $id,
        string $virtualMachineId
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "virtualMachineId");
        }

        return $this->request("attachIso", [
            'id' => $id,
            'virtualmachineid' => $virtualMachineId,
        ]);
    }


    /**
     * Detaches any ISO file (if any) currently attached to a virtual machine.
     *
     * @param string $virtualMachineId The ID of the virtual machine
     */
    public function detachIso(string $virtualMachineId): array {
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "virtualMachineId");
        }

        return $this->request("detachIso", [
            'virtualmachineid' => $virtualMachineId,
        ]);
    }


    /**
     * Lists all available ISO files.
     *
     * @param string $account the account of the ISO file. Must be used with the domain
     *        Id parameter.
     * @param string $bootable true if the ISO is bootable, false otherwise
     * @param string $domainId lists all available ISO files by ID of a domain. If used
     *         with the account parameter, lists all available ISO files for the account in th
     *        e ID of a domain.
     * @param string $hypervisor the hypervisor for which to restrict the search
     * @param string $id list all isos by id
     * @param string $isoFilter possible values are &quot;featured&quot;, &quot;self&qu
     *        ot;, &quot;self-executable&quot;,&quot;executable&quot;, and &quot;community&quo
     *        t;. * featured-ISOs that are featured and are publicself-ISOs that have been reg
     *        istered/created by the owner. * selfexecutable-ISOs that have been registered/cr
     *        eated by the owner that can be used to deploy a new VM. * executable-all ISOs th
     *        at can be used to deploy a new VM * community-ISOs that are public.
     * @param string $isPublic true if the ISO is publicly available to all users, fals
     *        e otherwise.
     * @param string $isReady true if this ISO is ready to be deployed
     * @param string $keyword List by keyword
     * @param string $name list all isos by name
     * @param string $page 
     * @param string $pageSize 
     * @param string $zoneId the ID of the zone
     * @param string $page Pagination
     */
    public function listIsos(
        ?string $account = null,
        ?bool $bootable = null,
        ?string $domainId = null,
        ?string $hypervisor = null,
        ?string $id = null,
        ?string $isoFilter = null,
        ?bool $isPublic = null,
        ?bool $isReady = null,
        ?string $keyword = null,
        ?string $name = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $zoneId = null
    ): array {
        return $this->request("listIsos", [
            'account' => $account,
            'bootable' => $bootable,
            'domainid' => $domainId,
            'hypervisor' => $hypervisor,
            'id' => $id,
            'isofilter' => $isoFilter,
            'ispublic' => $isPublic,
            'isready' => $isReady,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'zoneid' => $zoneId,
        ]);
    }


    /**
     * Registers an existing ISO into the Cloud.com Cloud.
     *
     * @param string $displayText the display text of the ISO. This is usually used for
     *         display purposes.
     * @param string $name the name of the ISO
     * @param string $url the URL to where the ISO is currently being hosted
     * @param string $zoneId the ID of the zone you wish to register the ISO to.
     * @param string $account an optional account name. Must be used with domainId.
     * @param string $bootable true if this ISO is bootable
     * @param string $domainId an optional domainId. If the account parameter is used, 
     *        domainId must also be used.
     * @param string $isFeatured true if you want this ISO to be featured
     * @param string $isPublic true if you want to register the ISO to be publicly avai
     *        lable to all users, false otherwise.
     * @param string $osTypeId the ID of the OS Type that best represents the OS of thi
     *        s ISO
     */
    public function registerIso(
        string $displayText,
        string $name,
        string $url,
        string $zoneId,
        ?string $account = null,
        ?bool $bootable = null,
        ?string $domainId = null,
        ?bool $isFeatured = null,
        ?bool $isPublic = null,
        ?string $osTypeId = null
    ): array {
        if (empty($displayText)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "displayText");
        }
        if (empty($name)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "name");
        }
        if (empty($url)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "url");
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "zoneId");
        }

        return $this->request("registerIso", [
            'displaytext' => $displayText,
            'name' => $name,
            'url' => $url,
            'zoneid' => $zoneId,
            'account' => $account,
            'bootable' => $bootable,
            'domainid' => $domainId,
            'isfeatured' => $isFeatured,
            'ispublic' => $isPublic,
            'ostypeid' => $osTypeId,
        ]);
    }


    /**
     * Updates an ISO file.
     *
     * @param string $id the ID of the image file
     * @param string $bootable true if image is bootable, false otherwise
     * @param string $displayText the display text of the image
     * @param string $format the format for the image
     * @param string $name the name of the image file
     * @param string $osTypeId the ID of the OS type that best represents the OS of thi
     *        s image.
     * @param string $passwordEnabled true if the image supports the password reset fea
     *        ture; default is false
     */
    public function updateIso(
        string $id,
        ?bool $bootable = null,
        ?string $displayText = null,
        ?string $format = null,
        ?string $name = null,
        ?string $osTypeId = null,
        ?bool $passwordEnabled = null
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("updateIso", [
            'id' => $id,
            'bootable' => $bootable,
            'displaytext' => $displayText,
            'format' => $format,
            'name' => $name,
            'ostypeid' => $osTypeId,
            'passwordenabled' => $passwordEnabled,
        ]);
    }


    /**
     * Deletes an ISO file.
     *
     * @param string $id the ID of the ISO file
     * @param string $zoneId the ID of the zone of the ISO file. If not specified, the 
     *        ISO will be deleted from all the zones
     */
    public function deleteIso(string $id, ?string $zoneId = null): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("deleteIso", [
            'id' => $id,
            'zoneid' => $zoneId,
        ]);
    }


    /**
     * Copies an ISO file.
     *
     * @param string $id the ID of the ISO file
     * @param string $destzoneId the ID of the destination zone to which the ISO file w
     *        ill be copied
     * @param string $sourceZoneId the ID of the source zone from which the ISO file wi
     *        ll be copied
     */
    public function copyIso(string $id, string $destzoneId, string $sourceZoneId): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        if (empty($destzoneId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "destzoneId");
        }

        if (empty($sourceZoneId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "sourceZoneId");
        }

        return $this->request("copyIso", [
            'id' => $id,
            'destzoneid' => $destzoneId,
            'sourcezoneid' => $sourceZoneId,
        ]);
    }


    /**
     * Updates iso permissions
     *
     * @param string $id the template ID
     * @param string $accounts a comma delimited list of accounts
     * @param string $isFeatured true for featured templates/isos, false otherwise
     * @param string $isPublic true for public templates/isos, false for private templa
     *        tes/isos
     * @param string $op permission operator (add, remove, reset)
     */
    public function updateIsoPermissions(
        string $id,
        ?string $accounts = null,
        ?bool $isFeatured = null,
        ?bool $isPublic = null,
        ?string $op = null
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("updateIsoPermissions", [
            'id' => $id,
            'accounts' => $accounts,
            'isfeatured' => $isFeatured,
            'ispublic' => $isPublic,
            'op' => $op,
        ]);
    }


    /**
     * List template visibility and all accounts that have permissions to view this template.
     *
     * @param string $id the template ID
     * @param string $account List template visibility and permissions for the specifie
     *        d account. Must be used with the domainId parameter.
     * @param string $domainId List template visibility and permissions by domain. If u
     *        sed with the account parameter, specifies in which domain the specified account 
     *        exists.
     * @param string $page Pagination
     */
    public function listIsoPermissions(string $id, ?string $account = null, ?string $domainId = null, ?string $page = null): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("listIsoPermissions", [
            'id' => $id,
            'account' => $account,
            'domainid' => $domainId,
            'page' => $page,
        ]);
    }


    /**
     * Extracts an ISO
     *
     * @param string $id the ID of the ISO file
     * @param string $mode the mode of extraction - HTTP_DOWNLOAD or FTP_UPLOAD
     * @param string $zoneId the ID of the zone where the ISO is originally located
     * @param string $url the url to which the ISO would be extracted
     */
    public function extractIso(
        string $id,
        string $mode,
        string $zoneId,
        ?string $url = null
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }
        if (empty($mode)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "mode");
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "zoneId");
        }

        return $this->request("extractIso", [
            'id' => $id,
            'mode' => $mode,
            'zoneid' => $zoneId,
            'url' => $url,
        ]);
    }


    /**
     * Attaches a disk volume to a virtual machine.
     *
     * @param string $id the ID of the disk volume
     * @param string $virtualMachineId the ID of the virtual machine
     * @param string $deviceId the ID of the device to map the volume to within the gue
     *        st OS. If no deviceId is passed in, the next available deviceId will be chosen. 
     *        Possible values for a Linux OS are:* 1 - /dev/xvdb* 2 - /dev/xvdc* 4 - /dev/xvde
     *        * 5 - /dev/xvdf* 6 - /dev/xvdg* 7 - /dev/xvdh* 8 - /dev/xvdi* 9 - /dev/xvdj
     */
    public function attachVolume(
        string $id,
        string $virtualMachineId,
        ?int $deviceId = null
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }
        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "virtualMachineId");
        }

        return $this->request("attachVolume", [
            'id' => $id,
            'virtualmachineid' => $virtualMachineId,
            'deviceid' => $deviceId,
        ]);
    }


    /**
     * Detaches a disk volume from a virtual machine.
     *
     * @param string $deviceId the device ID on the virtual machine where volume is det
     *        ached from
     * @param string $id the ID of the disk volume
     * @param string $virtualMachineId the ID of the virtual machine where the volume i
     *        s detached from
     */
    public function detachVolume(
        ?int $deviceId = null,
        ?string $id = null,
        ?string $virtualMachineId = null
    ): array {
        return $this->request("detachVolume", [
            'deviceid' => $deviceId,
            'id' => $id,
            'virtualmachineid' => $virtualMachineId,
        ]);
    }


    /**
     * Creates a disk volume from a disk offering. This disk volume must still be attached to a virtual machine to make use of it.
     *
     * @param string $name the name of the disk volume
     * @param string $account the account associated with the disk volume. Must be used
     *         with the domainId parameter.
     * @param string $diskOfferingId the ID of the disk offering. Either diskOfferingId
     *         or snapshotId must be passed in.
     * @param string $domainId the domain ID associated with the disk offering. If used
     *         with the account parameter returns the disk volume associated with the account 
     *        for the specified domain.
     * @param string $size Arbitrary volume size. Mutually exclusive with diskOfferingI
     *        d
     * @param string $snapshotId the snapshot ID for the disk volume. Either diskOfferi
     *        ngId or snapshotId must be passed in.
     * @param string $zoneId the ID of the availability zone
     */
    public function createVolume(
        string $name,
        ?string $account = null,
        ?string $diskOfferingId = null,
        ?string $domainId = null,
        ?int $size = null,
        ?string $snapshotId = null,
        ?string $zoneId = null
    ): array {
        if (empty($name)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "name");
        }

        return $this->request("createVolume", [
            'name' => $name,
            'account' => $account,
            'diskofferingid' => $diskOfferingId,
            'domainid' => $domainId,
            'size' => $size,
            'snapshotid' => $snapshotId,
            'zoneid' => $zoneId,
        ]);
    }


    /**
     * Deletes a detached disk volume.
     *
     * @param string $id The ID of the disk volume
     */
    public function deleteVolume(string $id): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("deleteVolume", [
            'id' => $id,
        ]);
    }


    /**
     * Lists all volumes.
     *
     * @param string $account the account associated with the disk volume. Must be used
     *         with the domainId parameter.
     * @param string $domainId Lists all disk volumes for the specified domain ID. If u
     *        sed with the account parameter, returns all disk volumes for an account in the s
     *        pecified domain ID.
     * @param string $hostId list volumes on specified host
     * @param string $id the ID of the disk volume
     * @param string $isRecursive defaults to false, but if true, lists all volumes fro
     *        m the parent specified by the domain id till leaves.
     * @param string $keyword List by keyword
     * @param string $name the name of the disk volume
     * @param string $page 
     * @param string $pageSize 
     * @param string $podId the pod id the disk volume belongs to
     * @param string $type the type of disk volume
     * @param string $virtualMachineId the ID of the virtual machine
     * @param string $zoneId the ID of the availability zone
     * @param string $page Pagination
     */
    public function listVolumes(
        ?string $account = null,
        ?string $domainId = null,
        ?string $hostId = null,
        ?string $id = null,
        ?bool $isRecursive = null,
        ?string $keyword = null,
        ?string $name = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $podId = null,
        ?string $type = null,
        ?string $virtualMachineId = null,
        ?string $zoneId = null
    ): array {
        return $this->request("listVolumes", [
            'account' => $account,
            'domainid' => $domainId,
            'hostid' => $hostId,
            'id' => $id,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'podid' => $podId,
            'type' => $type,
            'virtualmachineid' => $virtualMachineId,
            'zoneid' => $zoneId,
        ]);
    }


    /**
     * Extracts volume
     *
     * @param string $id the ID of the volume
     * @param string $mode the mode of extraction - HTTP_DOWNLOAD or FTP_UPLOAD
     * @param string $zoneId the ID of the zone where the volume is located
     * @param string $url the url to which the volume would be extracted
     */
    public function extractVolume(
        string $id,
        string $mode,
        string $zoneId,
        ?string $url = null
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }
        if (empty($mode)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "mode");
        }
        if (empty($zoneId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "zoneId");
        }

        return $this->request("extractVolume", [
            'id' => $id,
            'mode' => $mode,
            'zoneid' => $zoneId,
            'url' => $url,
        ]);
    }


    /**
     * Creates a security group
     *
     * @param string $name name of the security group
     * @param string $account an optional account for the security group. Must be used 
     *        with domainId.
     * @param string $description the description of the security group
     * @param string $domainId an optional domainId for the security group. If the acco
     *        unt parameter is used, domainId must also be used.
     */
    public function createSecurityGroup(
        string $name,
        ?string $account = null,
        ?string $description = null,
        ?string $domainId = null
    ): array {
        if (empty($name)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "name");
        }

        return $this->request("createSecurityGroup", [
            'name' => $name,
            'account' => $account,
            'description' => $description,
            'domainid' => $domainId,
        ]);
    }


    /**
     * Deletes security group
     *
     * @param string $account the account of the security group. Must be specified with
     *         domain ID
     * @param string $domainId the domain ID of account owning the security group
     * @param string $id The ID of the security group. Mutually exclusive with name par
     *        ameter
     * @param string $name The ID of the security group. Mutually exclusive with id par
     *        ameter
     */
    public function deleteSecurityGroup(
        ?string $account = null,
        ?string $domainId = null,
        ?string $id = null,
        ?string $name = null
    ): array {
        return $this->request("deleteSecurityGroup", [
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'name' => $name,
        ]);
    }

    /**
     * Authorizes a particular ingress rule for this security group
     *
     * @param string $account an optional account for the security group. Must be used 
     *        with domainId.
     * @param string $cidrList the cidr list associated
     * @param string $domainId an optional domainId for the security group. If the acco
     *        unt parameter is used, domainId must also be used.
     * @param string $endPort end port for this ingress rule
     * @param string $icmpCode error code for this icmp message
     * @param string $icmpType type of the icmp message being sent
     * @param string $protocol TCP is default. UDP is the other supported protocol
     * @param string $securityGroupId The ID of the security group. Mutually exclusive 
     *        with securityGroupName parameter
     * @param string $securityGroupName The name of the security group. Mutually exclus
     *        ive with securityGroupName parameter
     * @param string $startPort start port for this ingress rule
     * @param string $userSecurityGroupList user to security group mapping
     */
    public function authorizeSecurityGroupIngress(
        ?string $account = null,
        ?string $cidrList = null,
        ?string $domainId = null,
        ?int $endPort = null,
        ?int $icmpCode = null,
        ?int $icmpType = null,
        ?string $protocol = null,
        ?string $securityGroupId = null,
        ?string $securityGroupName = null,
        ?int $startPort = null,
        ?string $userSecurityGroupList = null
    ): array {
        return $this->request("authorizeSecurityGroupIngress", [
            'account' => $account,
            'cidrlist' => $cidrList,
            'domainid' => $domainId,
            'endport' => $endPort,
            'icmpcode' => $icmpCode,
            'icmptype' => $icmpType,
            'protocol' => $protocol,
            'securitygroupid' => $securityGroupId,
            'securitygroupname' => $securityGroupName,
            'startport' => $startPort,
            'usersecuritygrouplist' => $userSecurityGroupList,
        ]);
    }


    /**
     * Deletes a particular ingress rule from this security group
     *
     * @param string $id The ID of the ingress rule
     * @param string $account an optional account for the security group. Must be used 
     *        with domainId.
     * @param string $domainId an optional domainId for the security group. If the acco
     *        unt parameter is used, domainId must also be used.
     */
    public function revokeSecurityGroupIngress(
        string $id,
        ?string $account = null,
        ?string $domainId = null
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("revokeSecurityGroupIngress", [
            'id' => $id,
            'account' => $account,
            'domainid' => $domainId,
        ]);
    }


    /**
     * Lists security groups
     *
     * @param string $account lists all available port security groups for the account.
     *         Must be used with domainID parameter
     * @param string $domainId lists all available security groups for the domain ID. I
     *        f used with the account parameter, lists all available security groups for the a
     *        ccount in the specified domain ID.
     * @param string $id list the security group by the id provided
     * @param string $keyword List by keyword
     * @param string $page 
     * @param string $pageSize 
     * @param string $securityGroupName lists security groups by name
     * @param string $virtualMachineId lists security groups by virtual machine id
     * @param string $page Pagination
     */
    public function listSecurityGroups(
        ?string $account = null,
        ?string $domainId = null,
        ?string $id = null,
        ?string $keyword = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $securityGroupName = null,
        ?string $virtualMachineId = null
    ): array {
        return $this->request("listSecurityGroups", [
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'securitygroupname' => $securityGroupName,
            'virtualmachineid' => $virtualMachineId,
        ]);
    }


    /**
     * Lists accounts and provides detailed account information for listed accounts
     *
     * @param string $accountType list accounts by account type. Valid account types ar
     *        e 1 (admin), 2 (domain-admin), and 0 (user).
     * @param string $domainId list all accounts in specified domain. If used with the 
     *        name parameter, retrieves account information for the account with specified nam
     *        e in specified domain.
     * @param string $id list account by account ID
     * @param string $isCleanUpRequired list accounts by cleanuprequred attribute (valu
     *        es are true or false)
     * @param string $isRecursive defaults to false, but if true, lists all accounts fr
     *        om the parent specified by the domain id till leaves.
     * @param string $keyword List by keyword
     * @param string $name list account by account name
     * @param string $page 
     * @param string $pageSize 
     * @param string $state list accounts by state. Valid states are enabled, disabled,
     *         and locked.
     * @param string $page Pagination
     */
    public function listAccounts(
        ?int $accountType = null,
        ?string $domainId = null,
        ?string $id = null,
        ?bool $isCleanUpRequired = null,
        ?bool $isRecursive = null,
        ?string $keyword = null,
        ?string $name = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $state = null
    ): array {
        return $this->request("listAccounts", [
            'accounttype' => $accountType,
            'domainid' => $domainId,
            'id' => $id,
            'iscleanuprequired' => $isCleanUpRequired,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'state' => $state,
        ]);
    }


    /**
     * Creates an instant snapshot of a volume.
     *
     * @param string $volumeId The ID of the disk volume
     * @param string $account The account of the snapshot. The account parameter must b
     *        e used with the domainId parameter.
     * @param string $domainId The domain ID of the snapshot. If used with the account 
     *        parameter, specifies a domain for the account associated with the disk volume.
     * @param string $policyId policy id of the snapshot, if this is null, then use MAN
     *        UAL_POLICY.
     */
    public function createSnapshot(
        string $volumeId,
        ?string $account = null,
        ?string $domainId = null,
        ?string $policyId = null
    ): array {
        if (empty($volumeId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "volumeId");
        }

        return $this->request("createSnapshot", [
            'volumeid' => $volumeId,
            'account' => $account,
            'domainid' => $domainId,
            'policyid' => $policyId,
        ]);
    }


    /**
     * Lists all available snapshots for the account.
     *
     * @param string $account lists snapshot belongig to the specified account. Must be
     *         used with the domainId parameter.
     * @param string $domainId the domain ID. If used with the account parameter, lists
     *         snapshots for the specified account in this domain.
     * @param string $id lists snapshot by snapshot ID
     * @param string $intervalType valid values are HOURLY, DAILY, WEEKLY, and MONTHLY.
     *        
     * @param string $isRecursive defaults to false, but if true, lists all snapshots f
     *        rom the parent specified by the domain id till leaves.
     * @param string $keyword List by keyword
     * @param string $name lists snapshot by snapshot name
     * @param string $page 
     * @param string $pageSize 
     * @param string $snapshotType valid values are MANUAL or RECURRING.
     * @param string $volumeId the ID of the disk volume
     * @param string $page Pagination
     */
    public function listSnapshots(
        ?string $account = null,
        ?string $domainId = null,
        ?string $id = null,
        ?string $intervalType = null,
        ?bool $isRecursive = null,
        ?string $keyword = null,
        ?string $name = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $snapshotType = null,
        ?string $volumeId = null
    ): array {
        return $this->request("listSnapshots", [
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'intervaltype' => $intervalType,
            'isrecursive' => $isRecursive,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'snapshottype' => $snapshotType,
            'volumeid' => $volumeId,
        ]);
    }


    /**
     * Deletes a snapshot of a disk volume.
     *
     * @param string $id The ID of the snapshot
     */
    public function deleteSnapshot(string $id): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("deleteSnapshot", [
            'id' => $id,
        ]);
    }


    /**
     * Creates a snapshot policy for the account.
     *
     * @param string $intervalType valid values are HOURLY, DAILY, WEEKLY, and MONTHLY
     * @param string $maxSnaps maximum number of snapshots to retain
     * @param string $schedule time the snapshot is scheduled to be taken. Format is:* 
     *        if HOURLY, MM* if DAILY, MM:HH* if WEEKLY, MM:HH:DD (1-7)* if MONTHLY, MM:HH:DD 
     *        (1-28)
     * @param string $timezone Specifies a timezone for this command. For more informat
     *        ion on the timezone parameter, see Time Zone Format.
     * @param string $volumeId the ID of the disk volume
     */
    public function createSnapshotPolicy(
        string $intervalType,
        int $maxSnaps,
        string $schedule,
        string $timezone,
        string $volumeId
    ): array {
        if (empty($intervalType)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "intervalType");
        }
        if (empty($maxSnaps)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "maxSnaps");
        }
        if (empty($schedule)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "schedule");
        }
        if (empty($timezone)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "timezone");
        }
        if (empty($volumeId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "volumeId");
        }

        return $this->request("createSnapshotPolicy", [
            'intervaltype' => $intervalType,
            'maxsnaps' => $maxSnaps,
            'schedule' => $schedule,
            'timezone' => $timezone,
            'volumeid' => $volumeId,
        ]);
    }


    /**
     * Deletes snapshot policies for the account.
     *
     * @param string $id the Id of the snapshot
     * @param string $ids list of snapshots IDs separated by comma
     */
    public function deleteSnapshotPolicies(
        ?string $id = null,
        ?string $ids = null
    ): array {
        return $this->request("deleteSnapshotPolicies", [
            'id' => $id,
            'ids' => $ids,
        ]);
    }


    /**
     * Lists snapshot policies.
     *
     * @param string $volumeId the ID of the disk volume
     * @param string $account lists snapshot policies for the specified account. Must b
     *        e used with domainid parameter.
     * @param string $domainId the domain ID. If used with the account parameter, lists
     *         snapshot policies for the specified account in this domain.
     * @param string $keyword List by keyword
     * @param string $page 
     * @param string $pageSize 
     * @param string $page Pagination
     */
    public function listSnapshotPolicies(
        string $volumeId,
        ?string $account = null,
        ?string $domainId = null,
        ?string $keyword = null,
        ?int $page = null,
        ?int $pageSize = null
    ): array {
        if (empty($volumeId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "volumeId");
        }

        return $this->request("listSnapshotPolicies", [
            'volumeid' => $volumeId,
            'account' => $account,
            'domainid' => $domainId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ]);
    }


    /**
     * Retrieves the current status of asynchronous job.
     *
     * @param string $jobId the ID of the asychronous job
     */
    public function queryAsyncJobResult(string $jobId): array {
        if (empty($jobId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "jobId");
        }

        return $this->request("queryAsyncJobResult", [
            'jobid' => $jobId,
        ]);
    }


    /**
     * Lists all pending asynchronous jobs for the account.
     *
     * @param string $account the account associated with the async job. Must be used w
     *        ith the domainId parameter.
     * @param string $domainId the domain ID associated with the async job.  If used wi
     *        th the account parameter, returns async jobs for the account in the specified do
     *        main.
     * @param string $keyword List by keyword
     * @param string $page 
     * @param string $pageSize 
     * @param string $startDate the start date of the async job
     * @param string $page Pagination
     */
    public function listAsyncJobs(
        ?string $account = null,
        ?string $domainId = null,
        ?string $keyword = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $startDate = null
    ): array {
        return $this->request("listAsyncJobs", [
            'account' => $account,
            'domainid' => $domainId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'startdate' => $startDate,
        ]);
    }


    /**
     * A command to list events.
     *
     * @param string $account the account for the event. Must be used with the domainId
     *         parameter.
     * @param string $domainId the domain ID for the event. If used with the account pa
     *        rameter, returns all events for an account in the specified domain ID.
     * @param string $duration the duration of the event
     * @param string $endDate the end date range of the list you want to retrieve (use 
     *        format &quot;yyyy-MM-dd&quot;)
     * @param string $entryTime the time the event was entered
     * @param string $id the ID of the event
     * @param string $keyword List by keyword
     * @param string $level the event level (INFO, WARN, ERROR)
     * @param string $page 
     * @param string $pageSize 
     * @param string $startDate the start date range of the list you want to retrieve (
     *        use format &quot;yyyy-MM-dd&quot;)
     * @param string $type the event type (see event types)
     * @param string $page Pagination
     */
    public function listEvents(
        ?string $account = null,
        ?string $domainId = null,
        ?string $duration = null,
        ?string $endDate = null,
        ?string $entryTime = null,
        ?string $id = null,
        ?string $keyword = null,
        ?string $level = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $startDate = null,
        ?string $type = null
    ): array {
        return $this->request("listEvents", [
            'account' => $account,
            'domainid' => $domainId,
            'duration' => $duration,
            'enddate' => $endDate,
            'entrytime' => $entryTime,
            'id' => $id,
            'keyword' => $keyword,
            'level' => $level,
            'page' => $page,
            'pagesize' => $pageSize,
            'startdate' => $startDate,
            'type' => $type,
        ]);
    }


    /**
     * Lists all supported OS types for this cloud.
     *
     * @param string $id list by Os type Id
     * @param string $keyword List by keyword
     * @param string $osCategoryId list by Os Category id
     * @param string $page 
     * @param string $pageSize 
     * @param string $page Pagination
     */
    public function listOsTypes(
        ?string $id = null,
        ?string $keyword = null,
        ?string $osCategoryId = null,
        ?int $page = null,
        ?int $pageSize = null
    ): array {
        return $this->request("listOsTypes", [
            'id' => $id,
            'keyword' => $keyword,
            'oscategoryid' => $osCategoryId,
            'page' => $page,
            'pagesize' => $pageSize,
        ]);
    }


    /**
     * Lists all supported OS categories for this cloud.
     *
     * @param string $id list Os category by id
     * @param string $keyword List by keyword
     * @param string $page 
     * @param string $pageSize 
     * @param string $page Pagination
     */
    public function listOsCategories(
        ?string $id = null,
        ?string $keyword = null,
        ?int $page = null,
        ?int $pageSize = null
    ): array {
        return $this->request("listOsCategories", [
            'id' => $id,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ]);
    }


    /**
     * Lists all available service offerings.
     *
     * @param string $domainId the ID of the domain associated with the service offerin
     *        g
     * @param string $id ID of the service offering
     * @param string $keyword List by keyword
     * @param string $name name of the service offering
     * @param string $page 
     * @param string $pageSize 
     * @param string $virtualMachineId the ID of the virtual machine. Pass this in if y
     *        ou want to see the available service offering that a virtual machine can be chan
     *        ged to.
     * @param string $page Pagination
     */
    public function listServiceOfferings(
        ?string $domainId = null,
        ?string $id = null,
        ?string $keyword = null,
        ?string $name = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $virtualMachineId = null
    ): array {
        return $this->request("listServiceOfferings", [
            'domainid' => $domainId,
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'virtualmachineid' => $virtualMachineId,
        ]);
    }


    /**
     * Lists all available disk offerings.
     *
     * @param string $domainId the ID of the domain of the disk offering.
     * @param string $id ID of the disk offering
     * @param string $keyword List by keyword
     * @param string $name name of the disk offering
     * @param string $page 
     * @param string $pageSize 
     * @param string $page Pagination
     */
    public function listDiskOfferings(
        ?string $domainId = null,
        ?string $id = null,
        ?string $keyword = null,
        ?string $name = null,
        ?int $page = null,
        ?int $pageSize = null
    ): array {
        return $this->request("listDiskOfferings", [
            'domainid' => $domainId,
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
        ]);
    }


    /**
     * Creates a l2tp/ipsec remote access vpn
     *
     * @param string $publicIpId public ip address id of the vpn server
     * @param string $account an optional account for the VPN. Must be used with domain
     *        Id.
     * @param string $domainId an optional domainId for the VPN. If the account paramet
     *        er is used, domainId must also be used.
     * @param string $ipRange the range of ip addresses to allocate to vpn clients. The
     *         first ip in the range will be taken by the vpn server
     */
    public function createRemoteAccessVpn(
        string $publicIpId,
        ?string $account = null,
        ?string $domainId = null,
        ?string $ipRange = null
    ): array {
        if (empty($publicIpId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "publicIpId");
        }

        return $this->request("createRemoteAccessVpn", [
            'publicipid' => $publicIpId,
            'account' => $account,
            'domainid' => $domainId,
            'iprange' => $ipRange,
        ]);
    }


    /**
     * Destroys a l2tp/ipsec remote access vpn
     *
     * @param string $publicIpId public ip address id of the vpn server
     */
    public function deleteRemoteAccessVpn(string $publicIpId): array {
        if (empty($publicIpId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "publicIpId");
        }

        return $this->request("deleteRemoteAccessVpn", [
            'publicipid' => $publicIpId,
        ]);
    }

    /**
     * Lists remote access vpns
     *
     * @param string $publicIpId public ip address id of the vpn server
     * @param string $account the account of the remote access vpn. Must be used with t
     *        he domainId parameter.
     * @param string $domainId the domain ID of the remote access vpn rule. If used wit
     *        h the account parameter, lists remote access vpns for the account in the specifi
     *        ed domain.
     * @param string $keyword List by keyword
     * @param string $page 
     * @param string $pageSize 
     * @param string $page Pagination
     */
    public function listRemoteAccessVpns(
        string $publicIpId,
        ?string $account = null,
        ?string $domainId = null,
        ?string $keyword = null,
        ?int $page = null,
        ?int $pageSize = null
    ): array {
        if (empty($publicIpId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "publicIpId");
        }

        return $this->request("listRemoteAccessVpns", [
            'publicipid' => $publicIpId,
            'account' => $account,
            'domainid' => $domainId,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ]);
    }


    /**
     * Adds vpn users
     *
     * @param string $password password for the username
     * @param string $userName username for the vpn user
     * @param string $account an optional account for the vpn user. Must be used with d
     *        omainId.
     * @param string $domainId an optional domainId for the vpn user. If the account pa
     *        rameter is used, domainId must also be used.
     */
    public function addVpnUser(
        string $password,
        string $userName,
        ?string $account = null,
        ?string $domainId = null
    ): array {
        if (empty($password)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "password");
        }
        if (empty($userName)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "userName");
        }

        return $this->request("addVpnUser", [
            'password' => $password,
            'username' => $userName,
            'account' => $account,
            'domainid' => $domainId,
        ]);
    }


    /**
     * Removes vpn user
     *
     * @param string $userName username for the vpn user
     * @param string $account an optional account for the vpn user. Must be used with d
     *        omainId.
     * @param string $domainId an optional domainId for the vpn user. If the account pa
     *        rameter is used, domainId must also be used.
     */
    public function removeVpnUser(string $userName, ?string $account = null, ?string $domainId = null): array {
        if (empty($userName)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "userName");
        }

        return $this->request("removeVpnUser", [
            'username' => $userName,
            'account' => $account,
            'domainid' => $domainId,
        ]);
    }


    /**
     * Lists vpn users
     *
     * @param string $account the account of the remote access vpn. Must be used with t
     *        he domainId parameter.
     * @param string $domainId the domain ID of the remote access vpn. If used with the
     *         account parameter, lists remote access vpns for the account in the specified do
     *        main.
     * @param string $id the ID of the vpn user
     * @param string $keyword List by keyword
     * @param string $page 
     * @param string $pageSize 
     * @param string $userName the username of the vpn user.
     * @param string $page Pagination
     */
    public function listVpnUsers(
        ?string $account = null,
        ?string $domainId = null,
        ?string $id = null,
        ?string $keyword = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $userName = null
    ): array {
        return $this->request("listVpnUsers", [
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'username' => $userName,
        ]);
    }


    /**
     * Acquires and associates a public IP to an account.
     *
     * @param string $zoneId the ID of the availability zone you want to acquire an pub
     *        lic IP address from
     * @param string $account the account to associate with this IP address
     * @param string $domainId the ID of the domain to associate with this IP address
     * @param string $networkId The network this ip address should be associated to.
     */
    public function associateIpAddress(
        string $zoneId,
        ?string $account = null,
        ?string $domainId = null,
        ?string $networkId = null
    ): array {
        if (empty($zoneId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "zoneId");
        }

        return $this->request("associateIpAddress", [
            'zoneid' => $zoneId,
            'account' => $account,
            'domainid' => $domainId,
            'networkid' => $networkId,
        ]);
    }


    /**
     * Disassociates an ip address from the account.
     *
     * @param string $id the id of the public ip address to disassociate
     */
    public function disassociateIpAddress(string $id): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("disassociateIpAddress", [
            'id' => $id,
        ]);
    }


    /**
     * Lists all public ip addresses
     *
     * @param string $account lists all public IP addresses by account. Must be used wi
     *        th the domainId parameter.
     * @param string $allocatedOnly limits search results to allocated public IP addres
     *        ses
     * @param string $domainId lists all public IP addresses by domain ID. If used with
     *         the account parameter, lists all public IP addresses by account for specified d
     *        omain.
     * @param string $forVirtualNetwork the virtual network for the IP address
     * @param string $id lists ip address by id
     * @param string $ipAddress lists the specified IP address
     * @param string $keyword List by keyword
     * @param string $page 
     * @param string $pageSize 
     * @param string $vlanId lists all public IP addresses by VLAN ID
     * @param string $zoneId lists all public IP addresses by Zone ID
     * @param string $page Pagination
     */
    public function listPublicIpAddresses(
        ?string $account = null,
        ?bool $allocatedOnly = null,
        ?string $domainId = null,
        ?bool $forVirtualNetwork = null,
        ?string $id = null,
        ?string $ipAddress = null,
        ?string $keyword = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $vlanId = null,
        ?string $zoneId = null
    ): array {
        return $this->request("listPublicIpAddresses", [
            'account' => $account,
            'allocatedonly' => $allocatedOnly,
            'domainid' => $domainId,
            'forvirtualnetwork' => $forVirtualNetwork,
            'id' => $id,
            'ipaddress' => $ipAddress,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'vlanid' => $vlanId,
            'zoneid' => $zoneId,
        ]);
    }


    /**
     * Lists all port forwarding rules for an IP address.
     *
     * @param string $account account. Must be used with the domainId parameter.
     * @param string $domainId the domain ID. If used with the account parameter, lists
     *         port forwarding rules for the specified account in this domain.
     * @param string $id Lists rule with the specified ID.
     * @param string $ipAddressId the id of IP address of the port forwarding services
     * @param string $keyword List by keyword
     * @param string $page 
     * @param string $pageSize 
     * @param string $page Pagination
     */
    public function listPortForwardingRules($account = null, $domainId = null, $id = null, $ipAddressId = null, $keyword = null, $page = null, $pageSize = null) {

        return $this->request("listPortForwardingRules", array(
                    'account' => $account,
                    'domainid' => $domainId,
                    'id' => $id,
                    'ipaddressid' => $ipAddressId,
                    'keyword' => $keyword,
                    'page' => $page,
                    'pagesize' => $pageSize
        ));
    }

    /**
     * Creates a port forwarding rule
     *
     * @param string $ipAddressId the IP address id of the port forwarding rule
     * @param string $privatePort the private port of the port forwarding rule
     * @param string $protocol the protocol for the port fowarding rule. Valid values a
     *        re TCP or UDP.
     * @param string $publicPort the public port of the port forwarding rule
     * @param string $virtualMachineId the ID of the virtual machine for the port forwa
     *        rding rule
     */

    public function createPortForwardingRule(
        string $ipAddressId,
        string $privatePort,
        string $protocol,
        string $publicPort,
        string $virtualMachineId
    ): array {
        if (empty($ipAddressId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "ipAddressId");
        }

        if (empty($privatePort)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "privatePort");
        }

        if (empty($protocol)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "protocol");
        }

        if (empty($publicPort)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "publicPort");
        }

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "virtualMachineId");
        }

        return $this->request("createPortForwardingRule", [
            'ipaddressid' => $ipAddressId,
            'privateport' => $privatePort,
            'protocol' => $protocol,
            'publicport' => $publicPort,
            'virtualmachineid' => $virtualMachineId,
        ]);
    }


    /**
     * Deletes a port forwarding rule
     *
     * @param string $id the ID of the port forwarding rule
     */
    public function deletePortForwardingRule(string $id): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("deletePortForwardingRule", [
            'id' => $id,
        ]);
    }

    /**
     * Enables static nat for given ip address
     *
     * @param string $ipAddressId the public IP address id for which static nat feature
     *         is being enabled
     * @param string $virtualMachineId the ID of the virtual machine for enabling stati
     *        c nat feature
     */
    public function enableStaticNat(string $ipAddressId, string $virtualMachineId): array {
        if (empty($ipAddressId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "ipAddressId");
        }

        if (empty($virtualMachineId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "virtualMachineId");
        }

        return $this->request("enableStaticNat", [
            'ipaddressid' => $ipAddressId,
            'virtualmachineid' => $virtualMachineId,
        ]);
    }


    /**
     * Creates an ip forwarding rule
     *
     * @param string $ipAddressId the public IP address id of the forwarding rule, alre
     *        ady associated via associateIp
     * @param string $protocol the protocol for the rule. Valid values are TCP or UDP.
     * @param string $startPort the start port for the rule
     * @param string $endPort the end port for the rule
     */
    public function createIpForwardingRule(
        string $ipAddressId,
        string $protocol,
        string $startPort,
        ?string $endPort = null
    ): array {
        if (empty($ipAddressId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "ipAddressId");
        }

        if (empty($protocol)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "protocol");
        }

        if (empty($startPort)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "startPort");
        }

        return $this->request("createIpForwardingRule", [
            'ipaddressid' => $ipAddressId,
            'protocol' => $protocol,
            'startport' => $startPort,
            'endport' => $endPort,
        ]);
    }

    /**
     * Deletes an ip forwarding rule
     *
     * @param string $id the id of the forwarding rule
     */
    public function deleteIpForwardingRule(string $id): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("deleteIpForwardingRule", [
            'id' => $id,
        ]);
    }


    /**
     * List the ip forwarding rules
     *
     * @param string $account the account associated with the ip forwarding rule. Must 
     *        be used with the domainId parameter.
     * @param string $domainId Lists all rules for this id. If used with the account pa
     *        rameter, returns all rules for an account in the specified domain ID.
     * @param string $id Lists rule with the specified ID.
     * @param string $ipAddressId list the rule belonging to this public ip address
     * @param string $keyword List by keyword
     * @param string $page 
     * @param string $pageSize 
     * @param string $virtualMachineId Lists all rules applied to the specified Vm.
     * @param string $page Pagination
     */
    public function listIpForwardingRules($account = null, $domainId = null, $id = null, $ipAddressId = null, $keyword = null, $page = null, $pageSize = null, $virtualMachineId = null) {

        return $this->request("listIpForwardingRules", array(
                    'account' => $account,
                    'domainid' => $domainId,
                    'id' => $id,
                    'ipaddressid' => $ipAddressId,
                    'keyword' => $keyword,
                    'page' => $page,
                    'pagesize' => $pageSize,
                    'virtualmachineid' => $virtualMachineId
        ));
    }

    /**
     * Disables static rule for given ip address
     *
     * @param string $ipAddressId the public IP address id for which static nat feature
     *         is being disableed
     */
    public function disableStaticNat(string $ipAddressId): array {
        if (empty($ipAddressId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "ipAddressId");
        }

        return $this->request("disableStaticNat", [
            'ipaddressid' => $ipAddressId,
        ]);
    }


    /**
     * Creates a load balancer rule
     *
     * @param string $algorithm load balancer algorithm (source, roundrobin, leastconn)
     *        
     * @param string $name name of the load balancer rule
     * @param string $privatePort the private port of the private ip address/virtual ma
     *        chine where the network traffic will be load balanced to
     * @param string $publicIpId public ip address id from where the network traffic wi
     *        ll be load balanced from
     * @param string $publicPort the public port from where the network traffic will be
     *         load balanced from
     * @param string $description the description of the load balancer rule
     */
    public function createLoadBalancerRule(
        string $algorithm,
        string $name,
        string $privatePort,
        string $publicIpId,
        string $publicPort,
        ?string $description = null
    ): array {
        if (empty($algorithm)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "algorithm");
        }

        if (empty($name)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "name");
        }

        if (empty($privatePort)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "privatePort");
        }

        if (empty($publicIpId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "publicIpId");
        }

        if (empty($publicPort)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "publicPort");
        }

        return $this->request("createLoadBalancerRule", [
            'algorithm' => $algorithm,
            'name' => $name,
            'privateport' => $privatePort,
            'publicipid' => $publicIpId,
            'publicport' => $publicPort,
            'description' => $description,
        ]);
    }


    /**
     * Deletes a load balancer rule.
     *
     * @param string $id the ID of the load balancer rule
     */
    public function deleteLoadBalancerRule(string $id): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("deleteLoadBalancerRule", [
            'id' => $id,
        ]);
    }


    /**
     * Removes a virtual machine or a list of virtual machines from a load balancer rule.
     *
     * @param string $id The ID of the load balancer rule
     * @param string $virtualMachineIds the list of IDs of the virtual machines that ar
     *        e being removed from the load balancer rule (i.e. virtualMachineIds=1,2,3)
     */
    public function removeFromLoadBalancerRule(string $id, string $virtualMachineIds): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        if (empty($virtualMachineIds)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "virtualMachineIds");
        }

        return $this->request("removeFromLoadBalancerRule", [
            'id' => $id,
            'virtualmachineids' => $virtualMachineIds,
        ]);
    }


    /**
     * Assigns virtual machine or a list of virtual machines to a load balancer rule.
     *
     * @param string $id the ID of the load balancer rule
     * @param string $virtualMachineIds the list of IDs of the virtual machine that are
     *         being assigned to the load balancer rule(i.e. virtualMachineIds=1,2,3)
     */
    public function assignToLoadBalancerRule(string $id, string $virtualMachineIds): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        if (empty($virtualMachineIds)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "virtualMachineIds");
        }

        return $this->request("assignToLoadBalancerRule", [
            'id' => $id,
            'virtualmachineids' => $virtualMachineIds,
        ]);
    }


    /**
     * Lists load balancer rules.
     *
     * @param string $account the account of the load balancer rule. Must be used with 
     *        the domainId parameter.
     * @param string $domainId the domain ID of the load balancer rule. If used with th
     *        e account parameter, lists load balancer rules for the account in the specified 
     *        domain.
     * @param string $id the ID of the load balancer rule
     * @param string $keyword List by keyword
     * @param string $name the name of the load balancer rule
     * @param string $page 
     * @param string $pageSize 
     * @param string $publicIpId the public IP address id of the load balancer rule
     * @param string $virtualMachineId the ID of the virtual machine of the load balanc
     *        er rule
     * @param string $page Pagination
     */
    public function listLoadBalancerRules($account = null, $domainId = null, $id = null, $keyword = null, $name = null, $page = null, $pageSize = null, $publicIpId = null, $virtualMachineId = null) {

        return $this->request("listLoadBalancerRules", array(
                    'account' => $account,
                    'domainid' => $domainId,
                    'id' => $id,
                    'keyword' => $keyword,
                    'name' => $name,
                    'page' => $page,
                    'pagesize' => $pageSize,
                    'publicipid' => $publicIpId,
                    'virtualmachineid' => $virtualMachineId
        ));
    }

    /**
     * List all virtual machine instances that are assigned to a load balancer rule.
     *
     * @param string $id the ID of the load balancer rule
     * @param string $applied true if listing all virtual machines currently applied to
     *         the load balancer rule; default is true
     * @param string $keyword List by keyword
     * @param string $page 
     * @param string $pageSize 
     * @param string $page Pagination
     */
    public function listLoadBalancerRuleInstances(
        string $id,
        ?bool $applied = null,
        ?string $keyword = null,
        ?int $page = null,
        ?int $pageSize = null
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("listLoadBalancerRuleInstances", [
            'id' => $id,
            'applied' => $applied,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ]);
    }


    /**
     * Updates load balancer
     *
     * @param string $id the id of the load balancer rule to update
     * @param string $algorithm load balancer algorithm (source, roundrobin, leastconn)
     *        
     * @param string $description the description of the load balancer rule
     * @param string $name the name of the load balancer rule
     */
    public function updateLoadBalancerRule(
        string $id,
        ?string $algorithm = null,
        ?string $description = null,
        ?string $name = null
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("updateLoadBalancerRule", [
            'id' => $id,
            'algorithm' => $algorithm,
            'description' => $description,
            'name' => $name,
        ]);
    }


    /**
     * Register a public key in a keypair under a certain name
     *
     * @param string $name Name of the keypair
     * @param string $publicKey Public key material of the keypair
     */
    public function registerSSHKeyPair(string $name, string $publicKey): array {
        if (empty($name)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "name");
        }

        if (empty($publicKey)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "publicKey");
        }

        return $this->request("registerSSHKeyPair", [
            'name' => $name,
            'publickey' => $publicKey,
        ]);
    }


    /**
     * Create a new keypair and returns the private key
     *
     * @param string $name Name of the keypair
     * @param string $account an optional account for the ssh key. Must be used with do
     *        mainId.
     * @param string $domainId an optional domainId for the ssh key. If the account par
     *        ameter is used, domainId must also be used.
     */
    public function createSSHKeyPair(string $name, ?string $account = null, ?string $domainId = null): array {
        if (empty($name)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "name");
        }

        return $this->request("createSSHKeyPair", [
            'name' => $name,
            'account' => $account,
            'domainid' => $domainId,
        ]);
    }


    /**
     * Deletes a keypair by name
     *
     * @param string $name Name of the keypair
     * @param string $account the account associated with the keypair. Must be used wit
     *        h the domainId parameter.
     * @param string $domainId the domain ID associated with the keypair
     */
    public function deleteSSHKeyPair(string $name, ?string $account = null, ?string $domainId = null): array {
        if (empty($name)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "name");
        }

        return $this->request("deleteSSHKeyPair", [
            'name' => $name,
            'account' => $account,
            'domainid' => $domainId,
        ]);
    }


    /**
     * List registered keypairs
     *
     * @param string $fingerprint A public key fingerprint to look for
     * @param string $keyword List by keyword
     * @param string $name A key pair name to look for
     * @param string $page 
     * @param string $pageSize 
     * @param string $page Pagination
     */
    public function listSSHKeyPairs(
        ?string $fingerprint = null,
        ?string $keyword = null,
        ?string $name = null,
        ?int $page = null,
        ?int $pageSize = null
    ): array {
        return $this->request("listSSHKeyPairs", [
            'fingerprint' => $fingerprint,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
        ]);
    }


    /**
     * Creates a vm group
     *
     * @param string $name the name of the instance group
     * @param string $account the account of the instance group. The account parameter 
     *        must be used with the domainId parameter.
     * @param string $domainId the domain ID of account owning the instance group
     */
    public function createInstanceGroup(string $name, ?string $account = null, ?string $domainId = null): array {
        if (empty($name)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "name");
        }

        return $this->request("createInstanceGroup", [
            'name' => $name,
            'account' => $account,
            'domainid' => $domainId,
        ]);
    }


    /**
     * Deletes a vm group
     *
     * @param string $id the ID of the instance group
     */
    public function deleteInstanceGroup(string $id): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("deleteInstanceGroup", [
            'id' => $id,
        ]);
    }


    /**
     * Updates a vm group
     *
     * @param string $id Instance group ID
     * @param string $name new instance group name
     */
    public function updateInstanceGroup(string $id, ?string $name = null): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("updateInstanceGroup", [
            'id' => $id,
            'name' => $name,
        ]);
    }


    /**
     * Lists vm groups
     *
     * @param string $account list instance group belonging to the specified account. M
     *        ust be used with domainid parameter
     * @param string $domainId the domain ID. If used with the account parameter, lists
     *         virtual machines for the specified account in this domain.
     * @param string $id list instance groups by ID
     * @param string $keyword List by keyword
     * @param string $name list instance groups by name
     * @param string $page 
     * @param string $pageSize 
     * @param string $page Pagination
     */
    public function listInstanceGroups(
        ?string $account = null,
        ?string $domainId = null,
        ?string $id = null,
        ?string $keyword = null,
        ?string $name = null,
        ?int $page = null,
        ?int $pageSize = null
    ): array {
        return $this->request("listInstanceGroups", [
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
        ]);
    }


    /**
     * Creates a network
     *
     * @param string $displayText the display text of the network
     * @param string $name the name of the network
     * @param string $networkOfferingId the network offering id
     * @param string $zoneId the Zone ID for the network
     * @param string $account account who will own the network
     * @param string $domainId domain ID of the account owning a network
     * @param string $endIp the ending IP address in the network IP range. If not speci
     *        fied, will be defaulted to startIP
     * @param string $gateway the gateway of the network
     * @param string $isDefault true if network is default, false otherwise
     * @param string $isShared true is network is shared across accounts in the Zone
     * @param string $netmask the netmask of the network
     * @param string $networkDomain network domain
     * @param string $startIp the beginning IP address in the network IP range
     * @param string $vlan the ID or VID of the network
     */

    public function createNetwork(
        string $displayText,
        string $name,
        string $networkOfferingId,
        string $zoneId,
        string $account,
        string $acltype,
        ?string $domainId = null,
        ?string $endIp = null,
        ?string $gateway = null,
        ?bool $isDefault = null,
        ?bool $isShared = null,
        ?string $netmask = null,
        ?string $networkDomain = null,
        ?string $startIp = null,
        ?string $vlan = null
    ): array {
        if (empty($displayText)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "displayText");
        }

        if (empty($name)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "name");
        }

        if (empty($networkOfferingId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "networkOfferingId");
        }

        if (empty($zoneId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "zoneId");
        }

        return $this->request("createNetwork", [
            'displaytext' => $displayText,
            'name' => $name,
            'networkofferingid' => $networkOfferingId,
            'zoneid' => $zoneId,
            'account' => $account,
            'acltype' => $acltype,
            'domainid' => $domainId,
            'endip' => $endIp,
            'gateway' => $gateway,
            'isdefault' => $isDefault,
            'isshared' => $isShared,
            'netmask' => $netmask,
            'networkdomain' => $networkDomain,
            'startip' => $startIp,
            'vlan' => $vlan,
        ]);
    }


    /**
     * Deletes a network
     *
     * @param string $id the ID of the network
     */
    public function deleteNetwork(string $id): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("deleteNetwork", [
            'id' => $id,
        ]);
    }


    /**
     * Lists all available networks.
     *
     * @param string $account account who will own the VLAN. If VLAN is Zone wide, this
     *         parameter should be ommited
     * @param string $domainId domain ID of the account owning a VLAN
     * @param string $id list networks by id
     * @param string $isDefault true if network is default, false otherwise
     * @param string $isShared true if network is shared across accounts in the Zone, f
     *        alse otherwise
     * @param string $isSystem true if network is system, false otherwise
     * @param string $keyword List by keyword
     * @param string $page 
     * @param string $pageSize 
     * @param string $trafficType type of the traffic
     * @param string $type the type of the network
     * @param string $zoneId the Zone ID of the network
     * @param string $page Pagination
     */
    public function listNetworks(
        ?string $account = null,
        ?string $domainId = null,
        ?string $id = null,
        ?bool $isDefault = null,
        ?bool $isShared = null,
        ?bool $isSystem = null,
        ?string $keyword = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $trafficType = null,
        ?string $type = null,
        ?string $zoneId = null
    ): array {
        return $this->request("listNetworks", [
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'isdefault' => $isDefault,
            'isshared' => $isShared,
            'issystem' => $isSystem,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'traffictype' => $trafficType,
            'type' => $type,
            'zoneid' => $zoneId,
        ]);
    }


    /**
     * Reapplies all ip addresses for the particular network
     *
     * @param string $id The network this ip address should be associated to.
     */
    public function restartNetwork(string $id): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("restartNetwork", [
            'id' => $id,
        ]);
    }

    /**
     * Updates a network
     *
     * @param string $id the ID of the network
     * @param string $displayText the new display text for the network
     * @param string $name the new name for the network
     */
    public function updateNetwork(
        string $id,
        ?string $displayText = null,
        ?string $name = null
    ): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("updateNetwork", [
            'id' => $id,
            'displaytext' => $displayText,
            'name' => $name,
        ]);
    }


    /**
     * List hypervisors
     *
     * @param string $zoneId the zone id for listing hypervisors.
     * @param string $page Pagination
     */
    public function listHypervisors(?string $zoneId = null, ?int $page = null): array {
        return $this->request("listHypervisors", [
            'zoneid' => $zoneId,
            'page' => $page,
        ]);
    }


    /**
     * Lists zones
     *
     * @param string $available true if you want to retrieve all available Zones. False
     *         if you only want to return the Zones from which you have at least one VM. Defau
     *        lt is false.
     * @param string $domainId the ID of the domain associated with the zone
     * @param string $id the ID of the zone
     * @param string $keyword List by keyword
     * @param string $page 
     * @param string $pageSize 
     * @param string $page Pagination
     */
    public function listZones(
        ?bool $available = null,
        ?string $domainId = null,
        ?string $id = null,
        ?string $keyword = null,
        ?int $page = null,
        ?int $pageSize = null
    ): array {
        return $this->request("listZones", [
            'available' => $available,
            'domainid' => $domainId,
            'id' => $id,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
        ]);
    }


    /**
     * Lists all available network offerings.
     *
     * @param string $availability the availability of network offering. Default value 
     *        is Required
     * @param string $displayText list network offerings by display text
     * @param string $guestIpType the guest ip type for the network offering, supported
     *         types are Direct and Virtual.
     * @param string $id list network offerings by id
     * @param string $isDefault true if need to list only default network offerings. De
     *        fault value is false
     * @param string $isShared true is network offering supports vlans
     * @param string $keyword List by keyword
     * @param string $name list network offerings by name
     * @param string $page 
     * @param string $pageSize 
     * @param string $specifyVlan the tags for the network offering.
     * @param string $trafficType list by traffic type
     * @param string $zoneId list netowrk offerings available for network creation in s
     *        pecific zone
     * @param string $page Pagination
     */
    public function listNetworkOfferings(
        ?string $availability = null,
        ?string $displayText = null,
        ?string $guestIpType = null,
        ?string $id = null,
        ?bool $isDefault = null,
        ?bool $isShared = null,
        ?string $keyword = null,
        ?string $name = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?string $specifyVlan = null,
        ?string $trafficType = null,
        ?string $zoneId = null
    ): array {
        return $this->request("listNetworkOfferings", [
            'availability' => $availability,
            'displaytext' => $displayText,
            'guestiptype' => $guestIpType,
            'id' => $id,
            'isdefault' => $isDefault,
            'isshared' => $isShared,
            'keyword' => $keyword,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
            'specifyvlan' => $specifyVlan,
            'traffictype' => $trafficType,
            'zoneid' => $zoneId,
        ]);
    }


    /**
     * Lists capabilities
     *
     * @param string $page Pagination
     */
    public function listCapabilities(?int $page = null): array {
        return $this->request("listCapabilities", [
            'page' => $page,
        ]);
    }


    /**
     * Lists resource limits.
     *
     * @param string $account Lists resource limits by account. Must be used with the d
     *        omainId parameter.
     * @param string $domainId Lists resource limits by domain ID. If used with the acc
     *        ount parameter, lists resource limits for a specified account in a specified dom
     *        ain.
     * @param string $id Lists resource limits by ID.
     * @param string $keyword List by keyword
     * @param string $page 
     * @param string $pageSize 
     * @param string $resourceType Type of resource to update. Values are 0, 1, 2, 3, a
     *        nd 4. 0 - Instance. Number of instances a user can create. 1 - IP. Number of pub
     *        lic IP addresses a user can own. 2 - Volume. Number of disk volumes a user can c
     *        reate.3 - Snapshot. Number of snapshots a user can create.4 - Template. Number o
     *        f templates that a user can register/create.
     * @param string $page Pagination
     */
    public function listResourceLimits(
        ?string $account = null,
        ?string $domainId = null,
        ?string $id = null,
        ?string $keyword = null,
        ?int $page = null,
        ?int $pageSize = null,
        ?int $resourceType = null
    ): array {
        return $this->request("listResourceLimits", [
            'account' => $account,
            'domainid' => $domainId,
            'id' => $id,
            'keyword' => $keyword,
            'page' => $page,
            'pagesize' => $pageSize,
            'resourcetype' => $resourceType,
        ]);
    }


    /**
     * Retrieves a cloud identifier.
     *
     * @param string $userId the user ID for the cloud identifier
     */
    public function getCloudIdentifier(string $userId): array {
        if (empty($userId)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "userId");
        }

        return $this->request("getCloudIdentifier", [
            'userid' => $userId,
        ]);
    }


    public function listDomains(
        ?string $id = null,
        ?string $keyword = null,
        ?int $level = null,
        ?bool $listall = null,
        ?string $name = null,
        ?int $page = null,
        ?int $pageSize = null
    ): array {
        return $this->request("listDomains", [
            'id' => $id,
            'keyword' => $keyword,
            'level' => $level,
            'listall' => $listall,
            'name' => $name,
            'page' => $page,
            'pagesize' => $pageSize,
        ]);
    }

    public function createDomain(
        ?string $name = null,
        ?string $domainid = null,
        ?string $networkdomain = null,
        ?string $parentdomainid = null
    ): array {
        return $this->request("createDomain", [
            'name' => $name,
            'domainid' => $domainid,
            'networkdomain' => $networkdomain,
            'parentdomainid' => $parentdomainid,
        ]);
    }


    public function createAccount(
        string $accounttype,
        string $email,
        string $firstname,
        string $lastname,
        string $password,
        string $username,
        string $account,
        string $domain
    ): array {
        if (empty($accounttype)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "accounttype");
        }
        if (empty($email)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "email");
        }
        if (empty($firstname)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "firstname");
        }
        if (empty($lastname)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "lastname");
        }
        if (empty($password)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "password");
        }
        if (empty($username)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "username");
        }
        if (empty($account)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "account");
        }
        if (empty($domain)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "domain");
        }

        return $this->request("createAccount", [
            'accounttype' => $accounttype,
            'email' => $email,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'password' => $password,
            'username' => $username,
            'account' => $account,
            'domainid' => $domain,
        ]);
    }


    public function disableAccount(
        ?bool $lock = null,
        ?string $account = null,
        ?string $domainid = null,
        ?string $id = null
    ): array {
        if (empty($account) && empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "account or id");
        }

        return $this->request("disableAccount", [
            'lock' => $lock,
            'account' => $account,
            'domainid' => $domainid,
            'id' => $id,
        ]);
    }


    public function enableAccount(
        ?string $account = null,
        ?string $domainid = null,
        ?string $id = null
    ): array {
        if (empty($account) && empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "account or id");
        }

        return $this->request("enableAccount", [
            'account' => $account,
            'domainid' => $domainid,
            'id' => $id,
        ]);
    }


    public function deleteAccount(string $id): array {
        if (empty($id)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "id");
        }

        return $this->request("deleteAccount", [
            'id' => $id,
        ]);
    }


    /**
     * Logs a user into the CloudStack. A successful login attempt will generate a JSESSIONID cookie value that can be passed in subsequent Query command calls until the "logout" command has been issued or the session has expired.
     *
     * @param string $userName Username
     * @param string $password Password
     * @param string $domain path of the domain that the user belongs to. Example: domain
     *        in=/com/cloud/internal.  If no domain is passed in, the ROOT domain is assumed.
     */
    public function login(string $userName, string $password, ?string $domain = null): array {
        if (empty($userName)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "userName");
        }

        if (empty($password)) {
            throw new CloudStackClientException(CloudStackError::MISSING_ARGUMENT, "password");
        }

        return $this->request("login", [
            'username' => $userName,
            'password' => $password,
            'domain' => $domain,
        ]);
    }

    /**
     * Logs out the user
     *
     */
    public function logout(): array {
        return $this->request("logout", []);
    }


}
