<?php

namespace AlibabaCloud\Rds\V20140815;

use AlibabaCloud\Client\Resolver\ApiResolver;

/**
 * @method ActivateMigrationTargetInstance activateMigrationTargetInstance(array $options = [])
 * @method AddTagsToResource addTagsToResource(array $options = [])
 * @method AllocateInstancePublicConnection allocateInstancePublicConnection(array $options = [])
 * @method AllocateReadWriteSplittingConnection allocateReadWriteSplittingConnection(array $options = [])
 * @method CalculateDBInstanceWeight calculateDBInstanceWeight(array $options = [])
 * @method CancelImport cancelImport(array $options = [])
 * @method CheckAccountNameAvailable checkAccountNameAvailable(array $options = [])
 * @method CheckCloudResourceAuthorized checkCloudResourceAuthorized(array $options = [])
 * @method CheckCreateDdrDBInstance checkCreateDdrDBInstance(array $options = [])
 * @method CheckDBNameAvailable checkDBNameAvailable(array $options = [])
 * @method CheckInstanceExist checkInstanceExist(array $options = [])
 * @method CheckServiceLinkedRole checkServiceLinkedRole(array $options = [])
 * @method CloneDBInstance cloneDBInstance(array $options = [])
 * @method CloneParameterGroup cloneParameterGroup(array $options = [])
 * @method ConfirmNotify confirmNotify(array $options = [])
 * @method CopyDatabase copyDatabase(array $options = [])
 * @method CopyDatabaseBetweenInstances copyDatabaseBetweenInstances(array $options = [])
 * @method CreateAccount createAccount(array $options = [])
 * @method CreateBackup createBackup(array $options = [])
 * @method CreateCloudMigrationPrecheckTask createCloudMigrationPrecheckTask(array $options = [])
 * @method CreateCloudMigrationTask createCloudMigrationTask(array $options = [])
 * @method CreateDatabase createDatabase(array $options = [])
 * @method CreateDBInstance createDBInstance(array $options = [])
 * @method CreateDBInstanceEndpoint createDBInstanceEndpoint(array $options = [])
 * @method CreateDBInstanceEndpointAddress createDBInstanceEndpointAddress(array $options = [])
 * @method CreateDBNodes createDBNodes(array $options = [])
 * @method CreateDBProxyEndpointAddress createDBProxyEndpointAddress(array $options = [])
 * @method CreateDdrInstance createDdrInstance(array $options = [])
 * @method CreateDiagnosticReport createDiagnosticReport(array $options = [])
 * @method CreateGADInstance createGADInstance(array $options = [])
 * @method CreateGadInstanceMember createGadInstanceMember(array $options = [])
 * @method CreateMigrateTask createMigrateTask(array $options = [])
 * @method CreateOnlineDatabaseTask createOnlineDatabaseTask(array $options = [])
 * @method CreateParameterGroup createParameterGroup(array $options = [])
 * @method CreateReadOnlyDBInstance createReadOnlyDBInstance(array $options = [])
 * @method CreateSecret createSecret(array $options = [])
 * @method CreateServiceLinkedRole createServiceLinkedRole(array $options = [])
 * @method CreateTempDBInstance createTempDBInstance(array $options = [])
 * @method DeleteAccount deleteAccount(array $options = [])
 * @method DeleteADSetting deleteADSetting(array $options = [])
 * @method DeleteBackup deleteBackup(array $options = [])
 * @method DeleteBackupFile deleteBackupFile(array $options = [])
 * @method DeleteDatabase deleteDatabase(array $options = [])
 * @method DeleteDBInstance deleteDBInstance(array $options = [])
 * @method DeleteDBInstanceEndpoint deleteDBInstanceEndpoint(array $options = [])
 * @method DeleteDBInstanceEndpointAddress deleteDBInstanceEndpointAddress(array $options = [])
 * @method DeleteDBNodes deleteDBNodes(array $options = [])
 * @method DeleteDBProxyEndpointAddress deleteDBProxyEndpointAddress(array $options = [])
 * @method DeleteGadInstance deleteGadInstance(array $options = [])
 * @method DeleteParameterGroup deleteParameterGroup(array $options = [])
 * @method DeleteSecret deleteSecret(array $options = [])
 * @method DeleteUserBackupFile deleteUserBackupFile(array $options = [])
 * @method DescibeImportsFromDatabase descibeImportsFromDatabase(array $options = [])
 * @method DescribeAccounts describeAccounts(array $options = [])
 * @method DescribeActionEventPolicy describeActionEventPolicy(array $options = [])
 * @method DescribeADInfo describeADInfo(array $options = [])
 * @method DescribeAnalyticdbByPrimaryDBInstance describeAnalyticdbByPrimaryDBInstance(array $options = [])
 * @method DescribeAvailableClasses describeAvailableClasses(array $options = [])
 * @method DescribeAvailableCrossRegion describeAvailableCrossRegion(array $options = [])
 * @method DescribeAvailableMetrics describeAvailableMetrics(array $options = [])
 * @method DescribeAvailableRecoveryTime describeAvailableRecoveryTime(array $options = [])
 * @method DescribeAvailableZones describeAvailableZones(array $options = [])
 * @method DescribeBackupDatabase describeBackupDatabase(array $options = [])
 * @method DescribeBackupPolicy describeBackupPolicy(array $options = [])
 * @method DescribeBackups describeBackups(array $options = [])
 * @method DescribeBackupTasks describeBackupTasks(array $options = [])
 * @method DescribeBinlogFiles describeBinlogFiles(array $options = [])
 * @method DescribeCharacterSetName describeCharacterSetName(array $options = [])
 * @method DescribeCloudMigrationPrecheckResult describeCloudMigrationPrecheckResult(array $options = [])
 * @method DescribeCloudMigrationResult describeCloudMigrationResult(array $options = [])
 * @method DescribeCollationTimeZones describeCollationTimeZones(array $options = [])
 * @method DescribeCrossBackupMetaList describeCrossBackupMetaList(array $options = [])
 * @method DescribeCrossRegionBackupDBInstance describeCrossRegionBackupDBInstance(array $options = [])
 * @method DescribeCrossRegionBackups describeCrossRegionBackups(array $options = [])
 * @method DescribeCrossRegionLogBackupFiles describeCrossRegionLogBackupFiles(array $options = [])
 * @method DescribeDatabases describeDatabases(array $options = [])
 * @method DescribeDBInstanceAttribute describeDBInstanceAttribute(array $options = [])
 * @method DescribeDBInstanceByTags describeDBInstanceByTags(array $options = [])
 * @method DescribeDBInstanceDetail describeDBInstanceDetail(array $options = [])
 * @method DescribeDBInstanceEncryptionKey describeDBInstanceEncryptionKey(array $options = [])
 * @method DescribeDBInstanceEndpoints describeDBInstanceEndpoints(array $options = [])
 * @method DescribeDBInstanceHAConfig describeDBInstanceHAConfig(array $options = [])
 * @method DescribeDBInstanceIPArrayList describeDBInstanceIPArrayList(array $options = [])
 * @method DescribeDBInstanceIpHostname describeDBInstanceIpHostname(array $options = [])
 * @method DescribeDBInstanceMetrics describeDBInstanceMetrics(array $options = [])
 * @method DescribeDBInstanceMonitor describeDBInstanceMonitor(array $options = [])
 * @method DescribeDBInstanceNetInfo describeDBInstanceNetInfo(array $options = [])
 * @method DescribeDBInstanceNetInfoForChannel describeDBInstanceNetInfoForChannel(array $options = [])
 * @method DescribeDBInstancePerformance describeDBInstancePerformance(array $options = [])
 * @method DescribeDBInstancePromoteActivity describeDBInstancePromoteActivity(array $options = [])
 * @method DescribeDBInstanceProxyConfiguration describeDBInstanceProxyConfiguration(array $options = [])
 * @method DescribeDBInstances describeDBInstances(array $options = [])
 * @method DescribeDBInstancesAsCsv describeDBInstancesAsCsv(array $options = [])
 * @method DescribeDBInstancesByExpireTime describeDBInstancesByExpireTime(array $options = [])
 * @method DescribeDBInstancesByPerformance describeDBInstancesByPerformance(array $options = [])
 * @method DescribeDBInstancesForClone describeDBInstancesForClone(array $options = [])
 * @method DescribeDBInstanceSSL describeDBInstanceSSL(array $options = [])
 * @method DescribeDBInstanceTDE describeDBInstanceTDE(array $options = [])
 * @method DescribeDBMiniEngineVersions describeDBMiniEngineVersions(array $options = [])
 * @method DescribeDBProxy describeDBProxy(array $options = [])
 * @method DescribeDBProxyEndpoint describeDBProxyEndpoint(array $options = [])
 * @method DescribeDBProxyPerformance describeDBProxyPerformance(array $options = [])
 * @method DescribeDedicatedHostGroups describeDedicatedHostGroups(array $options = [])
 * @method DescribeDedicatedHosts describeDedicatedHosts(array $options = [])
 * @method DescribeDetachedBackups describeDetachedBackups(array $options = [])
 * @method DescribeDiagnosticReportList describeDiagnosticReportList(array $options = [])
 * @method DescribeDTCSecurityIpHostsForSQLServer describeDTCSecurityIpHostsForSQLServer(array $options = [])
 * @method DescribeErrorLogs describeErrorLogs(array $options = [])
 * @method DescribeEvents describeEvents(array $options = [])
 * @method DescribeGadInstances describeGadInstances(array $options = [])
 * @method DescribeHADiagnoseConfig describeHADiagnoseConfig(array $options = [])
 * @method DescribeHASwitchConfig describeHASwitchConfig(array $options = [])
 * @method DescribeInstanceAutoRenewalAttribute describeInstanceAutoRenewalAttribute(array $options = [])
 * @method DescribeInstanceCrossBackupPolicy describeInstanceCrossBackupPolicy(array $options = [])
 * @method DescribeInstanceKeywords describeInstanceKeywords(array $options = [])
 * @method DescribeLocalAvailableRecoveryTime describeLocalAvailableRecoveryTime(array $options = [])
 * @method DescribeLogBackupFiles describeLogBackupFiles(array $options = [])
 * @method DescribeMetaList describeMetaList(array $options = [])
 * @method DescribeMigrateTaskById describeMigrateTaskById(array $options = [])
 * @method DescribeMigrateTasks describeMigrateTasks(array $options = [])
 * @method DescribeModifyParameterLog describeModifyParameterLog(array $options = [])
 * @method DescribeModifyPGHbaConfigLog describeModifyPGHbaConfigLog(array $options = [])
 * @method DescribeOssDownloads describeOssDownloads(array $options = [])
 * @method DescribeParameterGroup describeParameterGroup(array $options = [])
 * @method DescribeParameterGroups describeParameterGroups(array $options = [])
 * @method DescribeParameters describeParameters(array $options = [])
 * @method DescribeParameterTemplates describeParameterTemplates(array $options = [])
 * @method DescribePGHbaConfig describePGHbaConfig(array $options = [])
 * @method DescribePrice describePrice(array $options = [])
 * @method DescribeRdsResourceSettings describeRdsResourceSettings(array $options = [])
 * @method DescribeReadDBInstanceDelay describeReadDBInstanceDelay(array $options = [])
 * @method DescribeRegionInfos describeRegionInfos(array $options = [])
 * @method DescribeRegions describeRegions(array $options = [])
 * @method DescribeRenewalPrice describeRenewalPrice(array $options = [])
 * @method DescribeResourceUsage describeResourceUsage(array $options = [])
 * @method DescribeSecrets describeSecrets(array $options = [])
 * @method DescribeSecurityGroupConfiguration describeSecurityGroupConfiguration(array $options = [])
 * @method DescribeSlowLogRecords describeSlowLogRecords(array $options = [])
 * @method DescribeSlowLogs describeSlowLogs(array $options = [])
 * @method DescribeSQLCollectorPolicy describeSQLCollectorPolicy(array $options = [])
 * @method DescribeSQLCollectorRetention describeSQLCollectorRetention(array $options = [])
 * @method DescribeSQLLogFiles describeSQLLogFiles(array $options = [])
 * @method DescribeSQLLogRecords describeSQLLogRecords(array $options = [])
 * @method DescribeSQLLogReportList describeSQLLogReportList(array $options = [])
 * @method DescribeTags describeTags(array $options = [])
 * @method DescribeTasks describeTasks(array $options = [])
 * @method DescribeUpgradeMajorVersionPrecheckTask describeUpgradeMajorVersionPrecheckTask(array $options = [])
 * @method DescribeUpgradeMajorVersionTasks describeUpgradeMajorVersionTasks(array $options = [])
 * @method DescribeVSwitches describeVSwitches(array $options = [])
 * @method DestroyDBInstance destroyDBInstance(array $options = [])
 * @method DetachGadInstanceMember detachGadInstanceMember(array $options = [])
 * @method GetDBInstanceTopology getDBInstanceTopology(array $options = [])
 * @method GetDbProxyInstanceSsl getDbProxyInstanceSsl(array $options = [])
 * @method GrantAccountPrivilege grantAccountPrivilege(array $options = [])
 * @method GrantOperatorPermission grantOperatorPermission(array $options = [])
 * @method ImportDatabaseBetweenInstances importDatabaseBetweenInstances(array $options = [])
 * @method ImportUserBackupFile importUserBackupFile(array $options = [])
 * @method ListClasses listClasses(array $options = [])
 * @method ListTagResources listTagResources(array $options = [])
 * @method ListUserBackupFiles listUserBackupFiles(array $options = [])
 * @method LockAccount lockAccount(array $options = [])
 * @method MigrateConnectionToOtherZone migrateConnectionToOtherZone(array $options = [])
 * @method MigrateDBInstance migrateDBInstance(array $options = [])
 * @method MigrateSecurityIPMode migrateSecurityIPMode(array $options = [])
 * @method MigrateToOtherZone migrateToOtherZone(array $options = [])
 * @method ModifyAccountDescription modifyAccountDescription(array $options = [])
 * @method ModifyActionEventPolicy modifyActionEventPolicy(array $options = [])
 * @method ModifyADInfo modifyADInfo(array $options = [])
 * @method ModifyBackupPolicy modifyBackupPolicy(array $options = [])
 * @method ModifyCollationTimeZone modifyCollationTimeZone(array $options = [])
 * @method ModifyDasInstanceConfig modifyDasInstanceConfig(array $options = [])
 * @method ModifyDBDescription modifyDBDescription(array $options = [])
 * @method ModifyDBInstanceAutoUpgradeMinorVersion modifyDBInstanceAutoUpgradeMinorVersion(array $options = [])
 * @method ModifyDBInstanceConnectionMode modifyDBInstanceConnectionMode(array $options = [])
 * @method ModifyDBInstanceConnectionString modifyDBInstanceConnectionString(array $options = [])
 * @method ModifyDBInstanceDelayedReplicationTime modifyDBInstanceDelayedReplicationTime(array $options = [])
 * @method ModifyDBInstanceDeletionProtection modifyDBInstanceDeletionProtection(array $options = [])
 * @method ModifyDBInstanceDescription modifyDBInstanceDescription(array $options = [])
 * @method ModifyDBInstanceEndpoint modifyDBInstanceEndpoint(array $options = [])
 * @method ModifyDBInstanceEndpointAddress modifyDBInstanceEndpointAddress(array $options = [])
 * @method ModifyDBInstanceHAConfig modifyDBInstanceHAConfig(array $options = [])
 * @method ModifyDBInstanceMaintainTime modifyDBInstanceMaintainTime(array $options = [])
 * @method ModifyDBInstanceMetrics modifyDBInstanceMetrics(array $options = [])
 * @method ModifyDBInstanceMonitor modifyDBInstanceMonitor(array $options = [])
 * @method ModifyDBInstanceNetworkExpireTime modifyDBInstanceNetworkExpireTime(array $options = [])
 * @method ModifyDBInstanceNetworkType modifyDBInstanceNetworkType(array $options = [])
 * @method ModifyDBInstancePayType modifyDBInstancePayType(array $options = [])
 * @method ModifyDBInstanceProxyConfiguration modifyDBInstanceProxyConfiguration(array $options = [])
 * @method ModifyDBInstanceSpec modifyDBInstanceSpec(array $options = [])
 * @method ModifyDBInstanceSSL modifyDBInstanceSSL(array $options = [])
 * @method ModifyDBInstanceTDE modifyDBInstanceTDE(array $options = [])
 * @method ModifyDBProxy modifyDBProxy(array $options = [])
 * @method ModifyDBProxyEndpoint modifyDBProxyEndpoint(array $options = [])
 * @method ModifyDBProxyEndpointAddress modifyDBProxyEndpointAddress(array $options = [])
 * @method ModifyDBProxyInstance modifyDBProxyInstance(array $options = [])
 * @method ModifyDbProxyInstanceSsl modifyDbProxyInstanceSsl(array $options = [])
 * @method ModifyDTCSecurityIpHostsForSQLServer modifyDTCSecurityIpHostsForSQLServer(array $options = [])
 * @method ModifyHADiagnoseConfig modifyHADiagnoseConfig(array $options = [])
 * @method ModifyHASwitchConfig modifyHASwitchConfig(array $options = [])
 * @method ModifyInstanceAutoRenewalAttribute modifyInstanceAutoRenewalAttribute(array $options = [])
 * @method ModifyInstanceCrossBackupPolicy modifyInstanceCrossBackupPolicy(array $options = [])
 * @method ModifyParameter modifyParameter(array $options = [])
 * @method ModifyParameterGroup modifyParameterGroup(array $options = [])
 * @method ModifyPGHbaConfig modifyPGHbaConfig(array $options = [])
 * @method ModifyReadonlyInstanceDelayReplicationTime modifyReadonlyInstanceDelayReplicationTime(array $options = [])
 * @method ModifyReadWriteSplittingConnection modifyReadWriteSplittingConnection(array $options = [])
 * @method ModifyResourceGroup modifyResourceGroup(array $options = [])
 * @method ModifySecurityGroupConfiguration modifySecurityGroupConfiguration(array $options = [])
 * @method ModifySecurityIps modifySecurityIps(array $options = [])
 * @method ModifySQLCollectorPolicy modifySQLCollectorPolicy(array $options = [])
 * @method ModifySQLCollectorRetention modifySQLCollectorRetention(array $options = [])
 * @method PurgeDBInstanceLog purgeDBInstanceLog(array $options = [])
 * @method QueryNotify queryNotify(array $options = [])
 * @method RebuildDBInstance rebuildDBInstance(array $options = [])
 * @method ReceiveDBInstance receiveDBInstance(array $options = [])
 * @method RecoveryDBInstance recoveryDBInstance(array $options = [])
 * @method ReleaseInstanceConnection releaseInstanceConnection(array $options = [])
 * @method ReleaseInstancePublicConnection releaseInstancePublicConnection(array $options = [])
 * @method ReleaseReadWriteSplittingConnection releaseReadWriteSplittingConnection(array $options = [])
 * @method RemoveTagsFromResource removeTagsFromResource(array $options = [])
 * @method RenewInstance renewInstance(array $options = [])
 * @method RequestServiceOfCloudDBA requestServiceOfCloudDBA(array $options = [])
 * @method ResetAccount resetAccount(array $options = [])
 * @method ResetAccountPassword resetAccountPassword(array $options = [])
 * @method RestartDBInstance restartDBInstance(array $options = [])
 * @method RestoreDdrTable restoreDdrTable(array $options = [])
 * @method RestoreTable restoreTable(array $options = [])
 * @method RevokeAccountPrivilege revokeAccountPrivilege(array $options = [])
 * @method RevokeOperatorPermission revokeOperatorPermission(array $options = [])
 * @method StartDBInstance startDBInstance(array $options = [])
 * @method StopDBInstance stopDBInstance(array $options = [])
 * @method SwitchDBInstanceHA switchDBInstanceHA(array $options = [])
 * @method SwitchDBInstanceNetType switchDBInstanceNetType(array $options = [])
 * @method SwitchDBInstanceVpc switchDBInstanceVpc(array $options = [])
 * @method SwitchGuardToMasterInstance switchGuardToMasterInstance(array $options = [])
 * @method TagResources tagResources(array $options = [])
 * @method TerminateMigrateTask terminateMigrateTask(array $options = [])
 * @method TransformDBInstancePayType transformDBInstancePayType(array $options = [])
 * @method UnlockAccount unlockAccount(array $options = [])
 * @method UntagResources untagResources(array $options = [])
 * @method UpdateUserBackupFile updateUserBackupFile(array $options = [])
 * @method UpgradeDBInstanceEngineVersion upgradeDBInstanceEngineVersion(array $options = [])
 * @method UpgradeDBInstanceKernelVersion upgradeDBInstanceKernelVersion(array $options = [])
 * @method UpgradeDBInstanceMajorVersion upgradeDBInstanceMajorVersion(array $options = [])
 * @method UpgradeDBInstanceMajorVersionPrecheck upgradeDBInstanceMajorVersionPrecheck(array $options = [])
 * @method UpgradeDBProxyInstanceKernelVersion upgradeDBProxyInstanceKernelVersion(array $options = [])
 */
class RdsApiResolver extends ApiResolver
{
}

class Rpc extends \AlibabaCloud\Client\Resolver\Rpc
{
    /** @var string */
    public $product = 'Rds';

    /** @var string */
    public $version = '2014-08-15';

    /** @var string */
    public $method = 'POST';

    /** @var string */
    public $serviceCode = 'rds';
}

/**
 * @method string getDBInstanceName()
 * @method $this withDBInstanceName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getForceSwitch()
 * @method $this withForceSwitch($value)
 * @method string getSwitchTimeMode()
 * @method $this withSwitchTimeMode($value)
 * @method string getSwitchTime()
 * @method $this withSwitchTime($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ActivateMigrationTargetInstance extends Rpc
{
}

/**
 * @method string getTag4value()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTag2key()
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getTag3key()
 * @method string getTag1value()
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getTag3value()
 * @method string getProxyId()
 * @method string getTag5key()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTag5value()
 * @method string getTags()
 * @method $this withTags($value)
 * @method string getTag1key()
 * @method string getTag2value()
 * @method string getTag4key()
 */
class AddTagsToResource extends Rpc
{

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag4value($value)
    {
        $this->data['Tag4value'] = $value;
        $this->options['query']['Tag.4.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag2key($value)
    {
        $this->data['Tag2key'] = $value;
        $this->options['query']['Tag.2.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag3key($value)
    {
        $this->data['Tag3key'] = $value;
        $this->options['query']['Tag.3.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag1value($value)
    {
        $this->data['Tag1value'] = $value;
        $this->options['query']['Tag.1.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag3value($value)
    {
        $this->data['Tag3value'] = $value;
        $this->options['query']['Tag.3.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProxyId($value)
    {
        $this->data['ProxyId'] = $value;
        $this->options['query']['proxyId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag5key($value)
    {
        $this->data['Tag5key'] = $value;
        $this->options['query']['Tag.5.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag5value($value)
    {
        $this->data['Tag5value'] = $value;
        $this->options['query']['Tag.5.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag1key($value)
    {
        $this->data['Tag1key'] = $value;
        $this->options['query']['Tag.1.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag2value($value)
    {
        $this->data['Tag2value'] = $value;
        $this->options['query']['Tag.2.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag4key($value)
    {
        $this->data['Tag4key'] = $value;
        $this->options['query']['Tag.4.key'] = $value;

        return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getConnectionStringPrefix()
 * @method $this withConnectionStringPrefix($value)
 * @method string getGeneralGroupName()
 * @method $this withGeneralGroupName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getBabelfishPort()
 * @method $this withBabelfishPort($value)
 * @method string getPort()
 * @method $this withPort($value)
 */
class AllocateInstancePublicConnection extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getConnectionStringPrefix()
 * @method $this withConnectionStringPrefix($value)
 * @method string getDistributionType()
 * @method $this withDistributionType($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getWeight()
 * @method $this withWeight($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getPort()
 * @method $this withPort($value)
 * @method string getNetType()
 * @method $this withNetType($value)
 * @method string getMaxDelayTime()
 * @method $this withMaxDelayTime($value)
 */
class AllocateReadWriteSplittingConnection extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class CalculateDBInstanceWeight extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getImportId()
 * @method $this withImportId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class CancelImport extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class CheckAccountNameAvailable extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTargetRegionId()
 * @method $this withTargetRegionId($value)
 */
class CheckCloudResourceAuthorized extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceStorage()
 * @method $this withDBInstanceStorage($value)
 * @method string getSourceDBInstanceName()
 * @method $this withSourceDBInstanceName($value)
 * @method string getHostType()
 * @method $this withHostType($value)
 * @method string getBinlogRole()
 * @method $this withBinlogRole($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getUserBakSetURL()
 * @method $this withUserBakSetURL($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getBackupSetRegion()
 * @method $this withBackupSetRegion($value)
 * @method string getBackupSetType()
 * @method $this withBackupSetType($value)
 * @method string getRestoreTime()
 * @method $this withRestoreTime($value)
 * @method string getBakSetName()
 * @method $this withBakSetName($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupSetId()
 * @method $this withBackupSetId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getBinlogPosition()
 * @method $this withBinlogPosition($value)
 * @method string getDBInstanceClass()
 * @method $this withDBInstanceClass($value)
 * @method string getRestoreType()
 * @method $this withRestoreType($value)
 * @method string getBinlogName()
 * @method $this withBinlogName($value)
 * @method string getSourceRegion()
 * @method $this withSourceRegion($value)
 */
class CheckCreateDdrDBInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBName()
 * @method $this withDBName($value)
 */
class CheckDBNameAvailable extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class CheckInstanceExist extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getServiceLinkedRole()
 * @method $this withServiceLinkedRole($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class CheckServiceLinkedRole extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceStorage()
 * @method $this withDBInstanceStorage($value)
 * @method string getDeletionProtection()
 * @method $this withDeletionProtection($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceDescription()
 * @method $this withDBInstanceDescription($value)
 * @method string getBackupType()
 * @method $this withBackupType($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceClass()
 * @method $this withDBInstanceClass($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getInstanceNetworkType()
 * @method $this withInstanceNetworkType($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getZoneIdSlave1()
 * @method $this withZoneIdSlave1($value)
 * @method string getZoneIdSlave2()
 * @method $this withZoneIdSlave2($value)
 * @method string getTableMeta()
 * @method $this withTableMeta($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDBInstanceStorageType()
 * @method $this withDBInstanceStorageType($value)
 * @method string getDedicatedHostGroupId()
 * @method $this withDedicatedHostGroupId($value)
 * @method string getRestoreTime()
 * @method $this withRestoreTime($value)
 * @method string getServerlessConfig()
 * @method $this withServerlessConfig($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getRestoreTable()
 * @method $this withRestoreTable($value)
 * @method string getUsedTime()
 * @method $this withUsedTime($value)
 * @method string getDbNames()
 * @method $this withDbNames($value)
 * @method string getVPCId()
 * @method $this withVPCId($value)
 * @method string getCategory()
 * @method $this withCategory($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 */
class CloneDBInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getParameterGroupId()
 * @method $this withParameterGroupId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTargetRegionId()
 * @method $this withTargetRegionId($value)
 * @method string getParameterGroupName()
 * @method $this withParameterGroupName($value)
 * @method string getParameterGroupDesc()
 * @method $this withParameterGroupDesc($value)
 */
class CloneParameterGroup extends Rpc
{
}

/**
 * @method string getNotifyIdList()
 * @method string getConfirmor()
 */
class ConfirmNotify extends Rpc
{

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withNotifyIdList($value)
    {
        $this->data['NotifyIdList'] = $value;
        $this->options['form_params']['NotifyIdList'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConfirmor($value)
    {
        $this->data['Confirmor'] = $value;
        $this->options['form_params']['Confirmor'] = $value;

        return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class CopyDatabase extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getRestoreTime()
 * @method $this withRestoreTime($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSyncUserPrivilege()
 * @method $this withSyncUserPrivilege($value)
 * @method string getDbNames()
 * @method $this withDbNames($value)
 * @method string getTargetDBInstanceId()
 * @method $this withTargetDBInstanceId($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 */
class CopyDatabaseBetweenInstances extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getAccountType()
 * @method $this withAccountType($value)
 * @method string getAccountDescription()
 * @method $this withAccountDescription($value)
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAccountPassword()
 * @method $this withAccountPassword($value)
 */
class CreateAccount extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getBackupStrategy()
 * @method $this withBackupStrategy($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getBackupType()
 * @method $this withBackupType($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getBackupMethod()
 * @method $this withBackupMethod($value)
 * @method string getDBName()
 * @method $this withDBName($value)
 */
class CreateBackup extends Rpc
{
}

/**
 * @method string getDBInstanceName()
 * @method $this withDBInstanceName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTaskName()
 * @method $this withTaskName($value)
 * @method string getSourceAccount()
 * @method $this withSourceAccount($value)
 * @method string getSourcePort()
 * @method $this withSourcePort($value)
 * @method string getSourcePassword()
 * @method $this withSourcePassword($value)
 * @method string getSourceIpAddress()
 * @method $this withSourceIpAddress($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSourceCategory()
 * @method $this withSourceCategory($value)
 */
class CreateCloudMigrationPrecheckTask extends Rpc
{
}

/**
 * @method string getDBInstanceName()
 * @method $this withDBInstanceName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTaskName()
 * @method $this withTaskName($value)
 * @method string getSourceAccount()
 * @method $this withSourceAccount($value)
 * @method string getSourcePort()
 * @method $this withSourcePort($value)
 * @method string getSourcePassword()
 * @method $this withSourcePassword($value)
 * @method string getSourceIpAddress()
 * @method $this withSourceIpAddress($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSourceCategory()
 * @method $this withSourceCategory($value)
 */
class CreateCloudMigrationTask extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDBDescription()
 * @method $this withDBDescription($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBName()
 * @method $this withDBName($value)
 * @method string getCharacterSetName()
 * @method $this withCharacterSetName($value)
 */
class CreateDatabase extends Rpc
{
}

/**
 * @method string getDBParamGroupId()
 * @method $this withDBParamGroupId($value)
 * @method string getBabelfishConfig()
 * @method $this withBabelfishConfig($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceStorage()
 * @method $this withDBInstanceStorage($value)
 * @method string getSystemDBCharset()
 * @method $this withSystemDBCharset($value)
 * @method string getConnectionString()
 * @method $this withConnectionString($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getDeletionProtection()
 * @method $this withDeletionProtection($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getTargetDedicatedHostIdForMaster()
 * @method $this withTargetDedicatedHostIdForMaster($value)
 * @method string getDBInstanceDescription()
 * @method $this withDBInstanceDescription($value)
 * @method array getTag()
 * @method string getBusinessInfo()
 * @method $this withBusinessInfo($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getDryRun()
 * @method $this withDryRun($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getEncryptionKey()
 * @method $this withEncryptionKey($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceClass()
 * @method $this withDBInstanceClass($value)
 * @method string getSecurityIPList()
 * @method $this withSecurityIPList($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getTargetDedicatedHostIdForLog()
 * @method $this withTargetDedicatedHostIdForLog($value)
 * @method string getAutoRenew()
 * @method $this withAutoRenew($value)
 * @method string getRoleARN()
 * @method $this withRoleARN($value)
 * @method string getTunnelId()
 * @method $this withTunnelId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getStorageAutoScale()
 * @method $this withStorageAutoScale($value)
 * @method string getInstanceNetworkType()
 * @method $this withInstanceNetworkType($value)
 * @method string getConnectionMode()
 * @method $this withConnectionMode($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getTargetDedicatedHostIdForSlave()
 * @method $this withTargetDedicatedHostIdForSlave($value)
 * @method string getZoneIdSlave1()
 * @method $this withZoneIdSlave1($value)
 * @method string getZoneIdSlave2()
 * @method $this withZoneIdSlave2($value)
 * @method string getDBIsIgnoreCase()
 * @method $this withDBIsIgnoreCase($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getDBTimeZone()
 * @method $this withDBTimeZone($value)
 * @method string getDBInstanceStorageType()
 * @method $this withDBInstanceStorageType($value)
 * @method string getDedicatedHostGroupId()
 * @method $this withDedicatedHostGroupId($value)
 * @method string getCreateStrategy()
 * @method $this withCreateStrategy($value)
 * @method string getDBInstanceNetType()
 * @method $this withDBInstanceNetType($value)
 * @method string getAmount()
 * @method $this withAmount($value)
 * @method string getServerlessConfig()
 * @method $this withServerlessConfig($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getUsedTime()
 * @method $this withUsedTime($value)
 * @method string getTargetMinorVersion()
 * @method $this withTargetMinorVersion($value)
 * @method string getUserBackupId()
 * @method $this withUserBackupId($value)
 * @method string getStorageUpperBound()
 * @method $this withStorageUpperBound($value)
 * @method string getStorageThreshold()
 * @method $this withStorageThreshold($value)
 * @method string getVPCId()
 * @method $this withVPCId($value)
 * @method string getCategory()
 * @method $this withCategory($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 */
class CreateDBInstance extends Rpc
{

    /**
     * @param array $tag
     *
     * @return $this
     */
	public function withTag(array $tag)
	{
	    $this->data['Tag'] = $tag;
		foreach ($tag as $depth1 => $depth1Value) {
			if(isset($depth1Value['Value'])){
				$this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
			}
			if(isset($depth1Value['Key'])){
				$this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
			}
		}

		return $this;
    }
}

/**
 * @method string getConnectionStringPrefix()
 * @method $this withConnectionStringPrefix($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDBInstanceEndpointDescription()
 * @method $this withDBInstanceEndpointDescription($value)
 * @method string getDBInstanceEndpointType()
 * @method $this withDBInstanceEndpointType($value)
 * @method string getNodeItems()
 * @method $this withNodeItems($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getPort()
 * @method $this withPort($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 */
class CreateDBInstanceEndpoint extends Rpc
{
}

/**
 * @method string getConnectionStringPrefix()
 * @method $this withConnectionStringPrefix($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getIpType()
 * @method $this withIpType($value)
 * @method string getDBInstanceEndpointId()
 * @method $this withDBInstanceEndpointId($value)
 * @method string getPort()
 * @method $this withPort($value)
 */
class CreateDBInstanceEndpointAddress extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getSourceBiz()
 * @method $this withSourceBiz($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBNode()
 * @method $this withDBNode($value)
 */
class CreateDBNodes extends Rpc
{
}

/**
 * @method string getConnectionStringPrefix()
 * @method $this withConnectionStringPrefix($value)
 * @method string getDBProxyConnectStringNetType()
 * @method $this withDBProxyConnectStringNetType($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDBProxyNewConnectStringPort()
 * @method $this withDBProxyNewConnectStringPort($value)
 * @method string getDBProxyEngineType()
 * @method $this withDBProxyEngineType($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getDBProxyEndpointId()
 * @method $this withDBProxyEndpointId($value)
 * @method string getVPCId()
 * @method $this withVPCId($value)
 */
class CreateDBProxyEndpointAddress extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceStorage()
 * @method $this withDBInstanceStorage($value)
 * @method string getSystemDBCharset()
 * @method $this withSystemDBCharset($value)
 * @method string getBinlogRole()
 * @method $this withBinlogRole($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getUserBakSetURL()
 * @method $this withUserBakSetURL($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceDescription()
 * @method $this withDBInstanceDescription($value)
 * @method string getBackupSetRegion()
 * @method $this withBackupSetRegion($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getBackupSetId()
 * @method $this withBackupSetId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceClass()
 * @method $this withDBInstanceClass($value)
 * @method string getSecurityIPList()
 * @method $this withSecurityIPList($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getBinlogName()
 * @method $this withBinlogName($value)
 * @method string getTunnelId()
 * @method $this withTunnelId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getInstanceNetworkType()
 * @method $this withInstanceNetworkType($value)
 * @method string getConnectionMode()
 * @method $this withConnectionMode($value)
 * @method string getSourceDBInstanceName()
 * @method $this withSourceDBInstanceName($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getHostType()
 * @method $this withHostType($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getDBInstanceStorageType()
 * @method $this withDBInstanceStorageType($value)
 * @method string getDBInstanceNetType()
 * @method $this withDBInstanceNetType($value)
 * @method string getBackupSetType()
 * @method $this withBackupSetType($value)
 * @method string getRestoreTime()
 * @method $this withRestoreTime($value)
 * @method string getBakSetName()
 * @method $this withBakSetName($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getUsedTime()
 * @method $this withUsedTime($value)
 * @method string getBinlogPosition()
 * @method $this withBinlogPosition($value)
 * @method string getRestoreType()
 * @method $this withRestoreType($value)
 * @method string getVPCId()
 * @method $this withVPCId($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 * @method string getSourceRegion()
 * @method $this withSourceRegion($value)
 */
class CreateDdrInstance extends Rpc
{
}

/**
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getCategory()
 * @method $this withCategory($value)
 */
class CreateDiagnosticReport extends Rpc
{
}

/**
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getCentralRdsDtsAdminAccount()
 * @method $this withCentralRdsDtsAdminAccount($value)
 * @method string getCentralRegionId()
 * @method $this withCentralRegionId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method array getTag()
 * @method array getUnitNode()
 * @method string getDBList()
 * @method $this withDBList($value)
 * @method string getCentralDBInstanceId()
 * @method $this withCentralDBInstanceId($value)
 * @method string getCentralRdsDtsAdminPassword()
 * @method $this withCentralRdsDtsAdminPassword($value)
 */
class CreateGADInstance extends Rpc
{

    /**
     * @param array $tag
     *
     * @return $this
     */
	public function withTag(array $tag)
	{
	    $this->data['Tag'] = $tag;
		foreach ($tag as $depth1 => $depth1Value) {
			if(isset($depth1Value['Value'])){
				$this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
			}
			if(isset($depth1Value['Key'])){
				$this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
			}
		}

		return $this;
    }

    /**
     * @param array $unitNode
     *
     * @return $this
     */
	public function withUnitNode(array $unitNode)
	{
	    $this->data['UnitNode'] = $unitNode;
		foreach ($unitNode as $depth1 => $depth1Value) {
			if(isset($depth1Value['DBInstanceStorage'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.DBInstanceStorage'] = $depth1Value['DBInstanceStorage'];
			}
			if(isset($depth1Value['ZoneIDSlave1'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.ZoneIDSlave1'] = $depth1Value['ZoneIDSlave1'];
			}
			if(isset($depth1Value['ZoneIDSlave2'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.ZoneIDSlave2'] = $depth1Value['ZoneIDSlave2'];
			}
			if(isset($depth1Value['EngineVersion'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.EngineVersion'] = $depth1Value['EngineVersion'];
			}
			if(isset($depth1Value['DbInstanceClass'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.DbInstanceClass'] = $depth1Value['DbInstanceClass'];
			}
			if(isset($depth1Value['SecurityIPList'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.SecurityIPList'] = $depth1Value['SecurityIPList'];
			}
			if(isset($depth1Value['VSwitchID'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.VSwitchID'] = $depth1Value['VSwitchID'];
			}
			if(isset($depth1Value['RegionID'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.RegionID'] = $depth1Value['RegionID'];
			}
			if(isset($depth1Value['Engine'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.Engine'] = $depth1Value['Engine'];
			}
			if(isset($depth1Value['DtsInstanceClass'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.DtsInstanceClass'] = $depth1Value['DtsInstanceClass'];
			}
			if(isset($depth1Value['VpcID'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.VpcID'] = $depth1Value['VpcID'];
			}
			if(isset($depth1Value['ZoneID'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.ZoneID'] = $depth1Value['ZoneID'];
			}
			if(isset($depth1Value['DBInstanceDescription'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.DBInstanceDescription'] = $depth1Value['DBInstanceDescription'];
			}
			if(isset($depth1Value['PayType'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.PayType'] = $depth1Value['PayType'];
			}
			if(isset($depth1Value['DtsConflict'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.DtsConflict'] = $depth1Value['DtsConflict'];
			}
		}

		return $this;
    }
}

/**
 * @method string getDBList()
 * @method $this withDBList($value)
 * @method string getCentralDBInstanceId()
 * @method $this withCentralDBInstanceId($value)
 * @method string getCentralRdsDtsAdminPassword()
 * @method $this withCentralRdsDtsAdminPassword($value)
 * @method string getCentralRdsDtsAdminAccount()
 * @method $this withCentralRdsDtsAdminAccount($value)
 * @method string getCentralRegionId()
 * @method $this withCentralRegionId($value)
 * @method string getGadInstanceId()
 * @method $this withGadInstanceId($value)
 * @method array getUnitNode()
 */
class CreateGadInstanceMember extends Rpc
{

    /**
     * @param array $unitNode
     *
     * @return $this
     */
	public function withUnitNode(array $unitNode)
	{
	    $this->data['UnitNode'] = $unitNode;
		foreach ($unitNode as $depth1 => $depth1Value) {
			if(isset($depth1Value['DBInstanceStorage'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.DBInstanceStorage'] = $depth1Value['DBInstanceStorage'];
			}
			if(isset($depth1Value['ZoneIDSlave1'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.ZoneIDSlave1'] = $depth1Value['ZoneIDSlave1'];
			}
			if(isset($depth1Value['ZoneIDSlave2'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.ZoneIDSlave2'] = $depth1Value['ZoneIDSlave2'];
			}
			if(isset($depth1Value['EngineVersion'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.EngineVersion'] = $depth1Value['EngineVersion'];
			}
			if(isset($depth1Value['DbInstanceClass'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.DbInstanceClass'] = $depth1Value['DbInstanceClass'];
			}
			if(isset($depth1Value['VSwitchID'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.VSwitchID'] = $depth1Value['VSwitchID'];
			}
			if(isset($depth1Value['SecurityIPList'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.SecurityIPList'] = $depth1Value['SecurityIPList'];
			}
			if(isset($depth1Value['RegionID'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.RegionID'] = $depth1Value['RegionID'];
			}
			if(isset($depth1Value['Engine'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.Engine'] = $depth1Value['Engine'];
			}
			if(isset($depth1Value['DtsInstanceClass'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.DtsInstanceClass'] = $depth1Value['DtsInstanceClass'];
			}
			if(isset($depth1Value['VpcID'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.VpcID'] = $depth1Value['VpcID'];
			}
			if(isset($depth1Value['ZoneID'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.ZoneID'] = $depth1Value['ZoneID'];
			}
			if(isset($depth1Value['DBInstanceDescription'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.DBInstanceDescription'] = $depth1Value['DBInstanceDescription'];
			}
			if(isset($depth1Value['DtsConflict'])){
				$this->options['query']['UnitNode.' . ($depth1 + 1) . '.DtsConflict'] = $depth1Value['DtsConflict'];
			}
		}

		return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getIsOnlineDB()
 * @method $this withIsOnlineDB($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getMigrateTaskId()
 * @method $this withMigrateTaskId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getOssObjectPositions()
 * @method $this withOssObjectPositions($value)
 * @method string getOSSUrls()
 * @method $this withOSSUrls($value)
 * @method string getDBName()
 * @method $this withDBName($value)
 * @method string getBackupMode()
 * @method $this withBackupMode($value)
 * @method string getCheckDBMode()
 * @method $this withCheckDBMode($value)
 */
class CreateMigrateTask extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getMigrateTaskId()
 * @method $this withMigrateTaskId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBName()
 * @method $this withDBName($value)
 * @method string getCheckDBMode()
 * @method $this withCheckDBMode($value)
 */
class CreateOnlineDatabaseTask extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getParameterGroupName()
 * @method $this withParameterGroupName($value)
 * @method string getParameters()
 * @method $this withParameters($value)
 * @method string getParameterGroupDesc()
 * @method $this withParameterGroupDesc($value)
 */
class CreateParameterGroup extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceStorage()
 * @method $this withDBInstanceStorage($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getInstructionSetArch()
 * @method $this withInstructionSetArch($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getDeletionProtection()
 * @method $this withDeletionProtection($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getTddlRegionConfig()
 * @method $this withTddlRegionConfig($value)
 * @method string getTargetDedicatedHostIdForMaster()
 * @method $this withTargetDedicatedHostIdForMaster($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDBInstanceDescription()
 * @method $this withDBInstanceDescription($value)
 * @method string getGdnInstanceName()
 * @method $this withGdnInstanceName($value)
 * @method string getDBInstanceStorageType()
 * @method $this withDBInstanceStorageType($value)
 * @method string getDedicatedHostGroupId()
 * @method $this withDedicatedHostGroupId($value)
 * @method string getTddlBizType()
 * @method $this withTddlBizType($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getUsedTime()
 * @method $this withUsedTime($value)
 * @method string getDBInstanceClass()
 * @method $this withDBInstanceClass($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getAutoRenew()
 * @method $this withAutoRenew($value)
 * @method string getVPCId()
 * @method $this withVPCId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getCategory()
 * @method $this withCategory($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 * @method string getInstanceNetworkType()
 * @method $this withInstanceNetworkType($value)
 */
class CreateReadOnlyDBInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDescription()
 * @method $this withDescription($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPassword()
 * @method $this withPassword($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getDbInstanceId()
 * @method $this withDbInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDbNames()
 * @method $this withDbNames($value)
 * @method string getSecretName()
 * @method $this withSecretName($value)
 * @method string getUsername()
 * @method $this withUsername($value)
 */
class CreateSecret extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getServiceLinkedRole()
 * @method $this withServiceLinkedRole($value)
 */
class CreateServiceLinkedRole extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getRestoreTime()
 * @method $this withRestoreTime($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class CreateTempDBInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DeleteAccount extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DeleteADSetting extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DeleteBackup extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getBackupTime()
 * @method $this withBackupTime($value)
 * @method string getDBName()
 * @method $this withDBName($value)
 */
class DeleteBackupFile extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBName()
 * @method $this withDBName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DeleteDatabase extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getReleasedKeepPolicy()
 * @method $this withReleasedKeepPolicy($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DeleteDBInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceEndpointId()
 * @method $this withDBInstanceEndpointId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DeleteDBInstanceEndpoint extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getConnectionString()
 * @method string getDBInstanceEndpointId()
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DeleteDBInstanceEndpointAddress extends Rpc
{

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withConnectionString($value)
    {
        $this->data['ConnectionString'] = $value;
        $this->options['form_params']['ConnectionString'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withDBInstanceEndpointId($value)
    {
        $this->data['DBInstanceEndpointId'] = $value;
        $this->options['form_params']['DBInstanceEndpointId'] = $value;

        return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBNodeId()
 * @method $this withDBNodeId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getSourceBiz()
 * @method $this withSourceBiz($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DeleteDBNodes extends Rpc
{
}

/**
 * @method string getDBProxyConnectStringNetType()
 * @method $this withDBProxyConnectStringNetType($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDBProxyEngineType()
 * @method $this withDBProxyEngineType($value)
 * @method string getDBProxyEndpointId()
 * @method $this withDBProxyEndpointId($value)
 */
class DeleteDBProxyEndpointAddress extends Rpc
{
}

/**
 * @method string getGadInstanceName()
 * @method $this withGadInstanceName($value)
 */
class DeleteGadInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getParameterGroupId()
 * @method $this withParameterGroupId($value)
 */
class DeleteParameterGroup extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getSecretArn()
 * @method $this withSecretArn($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getDbInstanceId()
 * @method $this withDbInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSecretName()
 * @method $this withSecretName($value)
 */
class DeleteSecret extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getOpsServiceVersion()
 * @method $this withOpsServiceVersion($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 */
class DeleteUserBackupFile extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getImportId()
 * @method $this withImportId($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescibeImportsFromDatabase extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeAccounts extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeActionEventPolicy extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeADInfo extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeAnalyticdbByPrimaryDBInstance extends Rpc
{
}

/**
 * @method string getDBInstanceName()
 * @method $this withDBInstanceName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getUseSpecifyRegionFilterCommodityResource()
 * @method $this withUseSpecifyRegionFilterCommodityResource($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDBInstanceStorageType()
 * @method $this withDBInstanceStorageType($value)
 * @method string getInstanceChargeType()
 * @method $this withInstanceChargeType($value)
 * @method string getDispenseMode()
 * @method $this withDispenseMode($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getCommodityCode()
 * @method $this withCommodityCode($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getEvaluateResource()
 * @method $this withEvaluateResource($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getCategory()
 * @method $this withCategory($value)
 * @method string getOrderType()
 * @method $this withOrderType($value)
 */
class DescribeAvailableClasses extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeAvailableCrossRegion extends Rpc
{
}

/**
 * @method string getDBInstanceName()
 * @method $this withDBInstanceName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 */
class DescribeAvailableMetrics extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getCrossBackupId()
 * @method $this withCrossBackupId($value)
 */
class DescribeAvailableRecoveryTime extends Rpc
{
}

/**
 * @method string getDBInstanceName()
 * @method $this withDBInstanceName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getInstanceChargeType()
 * @method $this withInstanceChargeType($value)
 * @method string getDispenseMode()
 * @method $this withDispenseMode($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getCachedAsync()
 * @method $this withCachedAsync($value)
 * @method string getCommodityCode()
 * @method $this withCommodityCode($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getEvaluateResource()
 * @method $this withEvaluateResource($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getCategory()
 * @method $this withCategory($value)
 */
class DescribeAvailableZones extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeBackupDatabase extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getBackupPolicyMode()
 * @method $this withBackupPolicyMode($value)
 * @method string getReleasedKeepPolicy()
 * @method $this withReleasedKeepPolicy($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getCompressType()
 * @method $this withCompressType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeBackupPolicy extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getBackupLocation()
 * @method $this withBackupLocation($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getBackupType()
 * @method $this withBackupType($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getBackupStatus()
 * @method $this withBackupStatus($value)
 * @method string getBackupMode()
 * @method $this withBackupMode($value)
 */
class DescribeBackups extends Rpc
{
}

/**
 * @method string getBackupJobId()
 * @method $this withBackupJobId($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getFlag()
 * @method $this withFlag($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getBackupJobStatus()
 * @method $this withBackupJobStatus($value)
 * @method string getBackupMode()
 * @method $this withBackupMode($value)
 */
class DescribeBackupTasks extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getLatest()
 * @method $this withLatest($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeBinlogFiles extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 */
class DescribeCharacterSetName extends Rpc
{
}

/**
 * @method string getDBInstanceName()
 * @method $this withDBInstanceName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTaskName()
 * @method $this withTaskName($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getSourcePort()
 * @method $this withSourcePort($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getTaskId()
 * @method $this withTaskId($value)
 * @method string getSourceIpAddress()
 * @method $this withSourceIpAddress($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeCloudMigrationPrecheckResult extends Rpc
{
}

/**
 * @method string getDBInstanceName()
 * @method $this withDBInstanceName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTaskName()
 * @method $this withTaskName($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getSourcePort()
 * @method $this withSourcePort($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getTaskId()
 * @method $this withTaskId($value)
 * @method string getSourceIpAddress()
 * @method $this withSourceIpAddress($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeCloudMigrationResult extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeCollationTimeZones extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPattern()
 * @method $this withPattern($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getPageIndex()
 * @method $this withPageIndex($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupSetId()
 * @method $this withBackupSetId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getGetDbName()
 * @method $this withGetDbName($value)
 * @method string getRegion()
 * @method $this withRegion($value)
 */
class DescribeCrossBackupMetaList extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getNotEnabled()
 * @method $this withNotEnabled($value)
 * @method string getProduct()
 * @method $this withProduct($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeCrossRegionBackupDBInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getCrossBackupRegion()
 * @method $this withCrossBackupRegion($value)
 * @method string getCrossBackupId()
 * @method $this withCrossBackupId($value)
 */
class DescribeCrossRegionBackups extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getCrossBackupRegion()
 * @method $this withCrossBackupRegion($value)
 */
class DescribeCrossRegionLogBackupFiles extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBStatus()
 * @method $this withDBStatus($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBName()
 * @method $this withDBName($value)
 */
class DescribeDatabases extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getExpired()
 * @method $this withExpired($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeDBInstanceAttribute extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getProxyId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeDBInstanceByTags extends Rpc
{

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProxyId($value)
    {
        $this->data['ProxyId'] = $value;
        $this->options['query']['proxyId'] = $value;

        return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeDBInstanceDetail extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEncryptionKey()
 * @method $this withEncryptionKey($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTargetRegionId()
 * @method $this withTargetRegionId($value)
 */
class DescribeDBInstanceEncryptionKey extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceEndpointId()
 * @method $this withDBInstanceEndpointId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeDBInstanceEndpoints extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeDBInstanceHAConfig extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getWhitelistNetworkType()
 * @method $this withWhitelistNetworkType($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeDBInstanceIPArrayList extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeDBInstanceIpHostname extends Rpc
{
}

/**
 * @method string getDBInstanceName()
 * @method $this withDBInstanceName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 */
class DescribeDBInstanceMetrics extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeDBInstanceMonitor extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getFlag()
 * @method $this withFlag($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getGeneralGroupName()
 * @method $this withGeneralGroupName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceNetRWSplitType()
 * @method $this withDBInstanceNetRWSplitType($value)
 */
class DescribeDBInstanceNetInfo extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getFlag()
 * @method $this withFlag($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceNetRWSplitType()
 * @method $this withDBInstanceNetRWSplitType($value)
 */
class DescribeDBInstanceNetInfoForChannel extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getRoleId()
 * @method $this withRoleId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getNodeId()
 * @method $this withNodeId($value)
 * @method string getKey()
 * @method $this withKey($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getUseNullWhenMissingPoint()
 * @method $this withUseNullWhenMissingPoint($value)
 */
class DescribeDBInstancePerformance extends Rpc
{
}

/**
 * @method string getDbInstanceName()
 * @method $this withDbInstanceName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getAliUid()
 * @method $this withAliUid($value)
 */
class DescribeDBInstancePromoteActivity extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeDBInstanceProxyConfiguration extends Rpc
{
}

/**
 * @method string getTag4value()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTag2key()
 * @method string getConnectionString()
 * @method $this withConnectionString($value)
 * @method string getNeedVpcName()
 * @method $this withNeedVpcName($value)
 * @method string getTag3key()
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getTag1value()
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getProxyId()
 * @method string getTag5key()
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceType()
 * @method $this withDBInstanceType($value)
 * @method string getDBInstanceClass()
 * @method $this withDBInstanceClass($value)
 * @method string getTags()
 * @method $this withTags($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getTag4key()
 * @method string getMaxResults()
 * @method $this withMaxResults($value)
 * @method string getInstanceNetworkType()
 * @method $this withInstanceNetworkType($value)
 * @method string getConnectionMode()
 * @method $this withConnectionMode($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getInstanceLevel()
 * @method $this withInstanceLevel($value)
 * @method string getSearchKey()
 * @method $this withSearchKey($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getExpired()
 * @method $this withExpired($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceStatus()
 * @method $this withDBInstanceStatus($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDedicatedHostGroupId()
 * @method $this withDedicatedHostGroupId($value)
 * @method string getTag3value()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getDedicatedHostId()
 * @method $this withDedicatedHostId($value)
 * @method string getTag5value()
 * @method string getTag1key()
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getTag2value()
 * @method string getPayType()
 * @method $this withPayType($value)
 */
class DescribeDBInstances extends Rpc
{

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag4value($value)
    {
        $this->data['Tag4value'] = $value;
        $this->options['query']['Tag.4.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag2key($value)
    {
        $this->data['Tag2key'] = $value;
        $this->options['query']['Tag.2.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag3key($value)
    {
        $this->data['Tag3key'] = $value;
        $this->options['query']['Tag.3.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag1value($value)
    {
        $this->data['Tag1value'] = $value;
        $this->options['query']['Tag.1.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProxyId($value)
    {
        $this->data['ProxyId'] = $value;
        $this->options['query']['proxyId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag5key($value)
    {
        $this->data['Tag5key'] = $value;
        $this->options['query']['Tag.5.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag4key($value)
    {
        $this->data['Tag4key'] = $value;
        $this->options['query']['Tag.4.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag3value($value)
    {
        $this->data['Tag3value'] = $value;
        $this->options['query']['Tag.3.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag5value($value)
    {
        $this->data['Tag5value'] = $value;
        $this->options['query']['Tag.5.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag1key($value)
    {
        $this->data['Tag1key'] = $value;
        $this->options['query']['Tag.1.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag2value($value)
    {
        $this->data['Tag2value'] = $value;
        $this->options['query']['Tag.2.value'] = $value;

        return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeDBInstancesAsCsv extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getExpired()
 * @method $this withExpired($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getExpirePeriod()
 * @method $this withExpirePeriod($value)
 * @method string getProxyId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTags()
 * @method $this withTags($value)
 */
class DescribeDBInstancesByExpireTime extends Rpc
{

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProxyId($value)
    {
        $this->data['ProxyId'] = $value;
        $this->options['query']['proxyId'] = $value;

        return $this;
    }
}

/**
 * @method string getTag4value()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTag2key()
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getTag3key()
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getTag1value()
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSortKey()
 * @method $this withSortKey($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getTag3value()
 * @method string getProxyId()
 * @method string getTag5key()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTag5value()
 * @method string getTags()
 * @method $this withTags($value)
 * @method string getTag1key()
 * @method string getSortMethod()
 * @method $this withSortMethod($value)
 * @method string getTag2value()
 * @method string getTag4key()
 */
class DescribeDBInstancesByPerformance extends Rpc
{

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag4value($value)
    {
        $this->data['Tag4value'] = $value;
        $this->options['query']['Tag.4.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag2key($value)
    {
        $this->data['Tag2key'] = $value;
        $this->options['query']['Tag.2.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag3key($value)
    {
        $this->data['Tag3key'] = $value;
        $this->options['query']['Tag.3.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag1value($value)
    {
        $this->data['Tag1value'] = $value;
        $this->options['query']['Tag.1.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag3value($value)
    {
        $this->data['Tag3value'] = $value;
        $this->options['query']['Tag.3.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProxyId($value)
    {
        $this->data['ProxyId'] = $value;
        $this->options['query']['proxyId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag5key($value)
    {
        $this->data['Tag5key'] = $value;
        $this->options['query']['Tag.5.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag5value($value)
    {
        $this->data['Tag5value'] = $value;
        $this->options['query']['Tag.5.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag1key($value)
    {
        $this->data['Tag1key'] = $value;
        $this->options['query']['Tag.1.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag2value($value)
    {
        $this->data['Tag2value'] = $value;
        $this->options['query']['Tag.2.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag4key($value)
    {
        $this->data['Tag4key'] = $value;
        $this->options['query']['Tag.4.key'] = $value;

        return $this;
    }
}

/**
 * @method string getConnectionMode()
 * @method $this withConnectionMode($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getNodeType()
 * @method $this withNodeType($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getSearchKey()
 * @method $this withSearchKey($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getExpired()
 * @method $this withExpired($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getCurrentInstanceId()
 * @method $this withCurrentInstanceId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceStatus()
 * @method $this withDBInstanceStatus($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getProxyId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceType()
 * @method $this withDBInstanceType($value)
 * @method string getDBInstanceClass()
 * @method $this withDBInstanceClass($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 * @method string getInstanceNetworkType()
 * @method $this withInstanceNetworkType($value)
 */
class DescribeDBInstancesForClone extends Rpc
{

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProxyId($value)
    {
        $this->data['ProxyId'] = $value;
        $this->options['query']['proxyId'] = $value;

        return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeDBInstanceSSL extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeDBInstanceTDE extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getNodeType()
 * @method $this withNodeType($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getStorageType()
 * @method $this withStorageType($value)
 * @method string getMinorVersionTag()
 * @method $this withMinorVersionTag($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDedicatedHostGroupId()
 * @method $this withDedicatedHostGroupId($value)
 */
class DescribeDBMiniEngineVersions extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getDBProxyEngineType()
 * @method $this withDBProxyEngineType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeDBProxy extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBProxyConnectString()
 * @method $this withDBProxyConnectString($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getDBProxyEngineType()
 * @method $this withDBProxyEngineType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBProxyEndpointId()
 * @method $this withDBProxyEndpointId($value)
 */
class DescribeDBProxyEndpoint extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getMetricsName()
 * @method $this withMetricsName($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getDBProxyEngineType()
 * @method $this withDBProxyEngineType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBProxyInstanceType()
 * @method $this withDBProxyInstanceType($value)
 */
class DescribeDBProxyPerformance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getImageCategory()
 * @method $this withImageCategory($value)
 * @method string getDedicatedHostGroupId()
 * @method $this withDedicatedHostGroupId($value)
 */
class DescribeDedicatedHostGroups extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getHostType()
 * @method $this withHostType($value)
 * @method string getHostStatus()
 * @method $this withHostStatus($value)
 * @method string getAllocationStatus()
 * @method $this withAllocationStatus($value)
 * @method string getDedicatedHostGroupId()
 * @method $this withDedicatedHostGroupId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOrderId()
 * @method $this withOrderId($value)
 * @method string getDedicatedHostId()
 * @method $this withDedicatedHostId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 */
class DescribeDedicatedHosts extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getBackupLocation()
 * @method $this withBackupLocation($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getBackupStatus()
 * @method $this withBackupStatus($value)
 * @method string getBackupMode()
 * @method $this withBackupMode($value)
 * @method string getRegion()
 * @method $this withRegion($value)
 */
class DescribeDetachedBackups extends Rpc
{
}

/**
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeDiagnosticReportList extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeDTCSecurityIpHostsForSQLServer extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeErrorLogs extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeEvents extends Rpc
{
}

/**
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getGadInstanceName()
 * @method $this withGadInstanceName($value)
 */
class DescribeGadInstances extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeHADiagnoseConfig extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeHASwitchConfig extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getProxyId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeInstanceAutoRenewalAttribute extends Rpc
{

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProxyId($value)
    {
        $this->data['ProxyId'] = $value;
        $this->options['query']['proxyId'] = $value;

        return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeInstanceCrossBackupPolicy extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getKey()
 * @method $this withKey($value)
 */
class DescribeInstanceKeywords extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getRegion()
 * @method $this withRegion($value)
 */
class DescribeLocalAvailableRecoveryTime extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeLogBackupFiles extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getPattern()
 * @method $this withPattern($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getPageIndex()
 * @method $this withPageIndex($value)
 * @method string getRestoreTime()
 * @method $this withRestoreTime($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupSetID()
 * @method $this withBackupSetID($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getGetDbName()
 * @method $this withGetDbName($value)
 * @method string getRestoreType()
 * @method $this withRestoreType($value)
 */
class DescribeMetaList extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getMigrateTaskId()
 * @method $this withMigrateTaskId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeMigrateTaskById extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeMigrateTasks extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeModifyParameterLog extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeModifyPGHbaConfigLog extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getMigrateTaskId()
 * @method $this withMigrateTaskId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeOssDownloads extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getParameterGroupId()
 * @method $this withParameterGroupId($value)
 */
class DescribeParameterGroup extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 */
class DescribeParameterGroups extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeParameters extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getCategory()
 * @method $this withCategory($value)
 */
class DescribeParameterTemplates extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribePGHbaConfig extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceStorage()
 * @method $this withDBInstanceStorage($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDBInstanceStorageType()
 * @method $this withDBInstanceStorageType($value)
 * @method string getQuantity()
 * @method $this withQuantity($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getCommodityCode()
 * @method $this withCommodityCode($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getUsedTime()
 * @method $this withUsedTime($value)
 * @method string getDBInstanceClass()
 * @method $this withDBInstanceClass($value)
 * @method string getInstanceUsedType()
 * @method $this withInstanceUsedType($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getTimeType()
 * @method $this withTimeType($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 * @method string getDBNode()
 * @method $this withDBNode($value)
 * @method string getOrderType()
 * @method $this withOrderType($value)
 */
class DescribePrice extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getResourceNiche()
 * @method $this withResourceNiche($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeRdsResourceSettings extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getReadInstanceId()
 * @method $this withReadInstanceId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeReadDBInstanceDelay extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeRegionInfos extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAcceptLanguage()
 * @method $this withAcceptLanguage($value)
 */
class DescribeRegions extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getBusinessInfo()
 * @method $this withBusinessInfo($value)
 * @method string getQuantity()
 * @method $this withQuantity($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getCommodityCode()
 * @method $this withCommodityCode($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getUsedTime()
 * @method $this withUsedTime($value)
 * @method string getDBInstanceClass()
 * @method $this withDBInstanceClass($value)
 * @method string getPromotionCode()
 * @method $this withPromotionCode($value)
 * @method string getTimeType()
 * @method $this withTimeType($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 * @method string getOrderType()
 * @method $this withOrderType($value)
 */
class DescribeRenewalPrice extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeResourceUsage extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDbInstanceId()
 * @method $this withDbInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAcceptLanguage()
 * @method $this withAcceptLanguage($value)
 */
class DescribeSecrets extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DescribeSecurityGroupConfiguration extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBName()
 * @method $this withDBName($value)
 * @method string getSQLHASH()
 * @method $this withSQLHASH($value)
 */
class DescribeSlowLogRecords extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getSortKey()
 * @method $this withSortKey($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBName()
 * @method $this withDBName($value)
 */
class DescribeSlowLogs extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeSQLCollectorPolicy extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeSQLCollectorRetention extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getFileName()
 * @method $this withFileName($value)
 */
class DescribeSQLLogFiles extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getQueryKeywords()
 * @method $this withQueryKeywords($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getDatabase()
 * @method $this withDatabase($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getSQLId()
 * @method $this withSQLId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getForm()
 * @method $this withForm($value)
 * @method string getUser()
 * @method $this withUser($value)
 */
class DescribeSQLLogRecords extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class DescribeSQLLogReportList extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getProxyId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceType()
 * @method $this withResourceType($value)
 * @method string getTags()
 * @method $this withTags($value)
 */
class DescribeTags extends Rpc
{

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProxyId($value)
    {
        $this->data['ProxyId'] = $value;
        $this->options['query']['proxyId'] = $value;

        return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStartTime()
 * @method $this withStartTime($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getEndTime()
 * @method $this withEndTime($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTaskAction()
 * @method $this withTaskAction($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class DescribeTasks extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getTaskId()
 * @method $this withTaskId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTargetMajorVersion()
 * @method $this withTargetMajorVersion($value)
 */
class DescribeUpgradeMajorVersionPrecheckTask extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getTaskId()
 * @method $this withTaskId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTargetMajorVersion()
 * @method $this withTargetMajorVersion($value)
 */
class DescribeUpgradeMajorVersionTasks extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getPageNumber()
 * @method $this withPageNumber($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getPageSize()
 * @method $this withPageSize($value)
 * @method string getDedicatedHostGroupId()
 * @method $this withDedicatedHostGroupId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 */
class DescribeVSwitches extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class DestroyDBInstance extends Rpc
{
}

/**
 * @method string getMemberInstanceName()
 * @method $this withMemberInstanceName($value)
 * @method string getGadInstanceName()
 * @method $this withGadInstanceName($value)
 */
class DetachGadInstanceMember extends Rpc
{
}

/**
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class GetDBInstanceTopology extends Rpc
{
}

/**
 * @method string getDBProxyEngineType()
 * @method $this withDBProxyEngineType($value)
 * @method string getDbInstanceId()
 * @method $this withDbInstanceId($value)
 */
class GetDbProxyInstanceSsl extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getAccountPrivilege()
 * @method $this withAccountPrivilege($value)
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBName()
 * @method $this withDBName($value)
 */
class GrantAccountPrivilege extends Rpc
{
}

/**
 * @method string getPrivileges()
 * @method $this withPrivileges($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getExpiredTime()
 * @method $this withExpiredTime($value)
 */
class GrantOperatorPermission extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInfo()
 * @method $this withDBInfo($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSourceDBInstanceId()
 * @method $this withSourceDBInstanceId($value)
 */
class ImportDatabaseBetweenInstances extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getRetention()
 * @method $this withRetention($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupFile()
 * @method $this withBackupFile($value)
 * @method string getBucketRegion()
 * @method $this withBucketRegion($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getRestoreSize()
 * @method $this withRestoreSize($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getComment()
 * @method $this withComment($value)
 */
class ImportUserBackupFile extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getCommodityCode()
 * @method $this withCommodityCode($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getOrderType()
 * @method $this withOrderType($value)
 */
class ListClasses extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getResourceId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceType()
 * @method $this withResourceType($value)
 * @method string getNextToken()
 * @method $this withNextToken($value)
 * @method array getTag()
 */
class ListTagResources extends Rpc
{

    /**
     * @param array $resourceId
     *
     * @return $this
     */
	public function withResourceId(array $resourceId)
	{
	    $this->data['ResourceId'] = $resourceId;
		foreach ($resourceId as $i => $iValue) {
			$this->options['query']['ResourceId.' . ($i + 1)] = $iValue;
		}

		return $this;
    }

    /**
     * @param array $tag
     *
     * @return $this
     */
	public function withTag(array $tag)
	{
	    $this->data['Tag'] = $tag;
		foreach ($tag as $depth1 => $depth1Value) {
			if(isset($depth1Value['Value'])){
				$this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
			}
			if(isset($depth1Value['Key'])){
				$this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
			}
		}

		return $this;
    }
}

/**
 * @method string getTag4value()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTag2key()
 * @method string getTag3key()
 * @method string getTag1value()
 * @method string getEngine()
 * @method $this withEngine($value)
 * @method string getTag3value()
 * @method string getTag5key()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTag5value()
 * @method string getTags()
 * @method $this withTags($value)
 * @method string getTag1key()
 * @method string getOpsServiceVersion()
 * @method $this withOpsServiceVersion($value)
 * @method string getOssUrl()
 * @method $this withOssUrl($value)
 * @method string getTag2value()
 * @method string getTag4key()
 * @method string getComment()
 * @method $this withComment($value)
 * @method string getStatus()
 * @method $this withStatus($value)
 */
class ListUserBackupFiles extends Rpc
{

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag4value($value)
    {
        $this->data['Tag4value'] = $value;
        $this->options['query']['Tag.4.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag2key($value)
    {
        $this->data['Tag2key'] = $value;
        $this->options['query']['Tag.2.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag3key($value)
    {
        $this->data['Tag3key'] = $value;
        $this->options['query']['Tag.3.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag1value($value)
    {
        $this->data['Tag1value'] = $value;
        $this->options['query']['Tag.1.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag3value($value)
    {
        $this->data['Tag3value'] = $value;
        $this->options['query']['Tag.3.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag5key($value)
    {
        $this->data['Tag5key'] = $value;
        $this->options['query']['Tag.5.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag5value($value)
    {
        $this->data['Tag5value'] = $value;
        $this->options['query']['Tag.5.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag1key($value)
    {
        $this->data['Tag1key'] = $value;
        $this->options['query']['Tag.1.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag2value($value)
    {
        $this->data['Tag2value'] = $value;
        $this->options['query']['Tag.2.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag4key($value)
    {
        $this->data['Tag4key'] = $value;
        $this->options['query']['Tag.4.key'] = $value;

        return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class LockAccount extends Rpc
{
}

/**
 * @method string getConnectionString()
 * @method $this withConnectionString($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class MigrateConnectionToOtherZone extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSpecifiedTime()
 * @method $this withSpecifiedTime($value)
 * @method string getTargetDedicatedHostIdForSlave()
 * @method $this withTargetDedicatedHostIdForSlave($value)
 * @method string getZoneIdSlave1()
 * @method $this withZoneIdSlave1($value)
 * @method string getZoneIdSlave2()
 * @method $this withZoneIdSlave2($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getStorage()
 * @method $this withStorage($value)
 * @method string getZoneIdForFollower()
 * @method $this withZoneIdForFollower($value)
 * @method string getEffectiveTime()
 * @method $this withEffectiveTime($value)
 * @method string getDBInstanceTransType()
 * @method $this withDBInstanceTransType($value)
 * @method string getTargetDedicatedHostIdForMaster()
 * @method $this withTargetDedicatedHostIdForMaster($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDedicatedHostGroupId()
 * @method $this withDedicatedHostGroupId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getZoneIdForLog()
 * @method $this withZoneIdForLog($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTargetDBInstanceClass()
 * @method $this withTargetDBInstanceClass($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getTargetDedicatedHostIdForLog()
 * @method $this withTargetDedicatedHostIdForLog($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 */
class MigrateDBInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class MigrateSecurityIPMode extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceStorage()
 * @method $this withDBInstanceStorage($value)
 * @method string getIsModifySpec()
 * @method $this withIsModifySpec($value)
 * @method string getZoneIdSlave1()
 * @method $this withZoneIdSlave1($value)
 * @method string getZoneIdSlave2()
 * @method $this withZoneIdSlave2($value)
 * @method string getEffectiveTime()
 * @method $this withEffectiveTime($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getSwitchTime()
 * @method $this withSwitchTime($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceClass()
 * @method $this withDBInstanceClass($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getVPCId()
 * @method $this withVPCId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getCategory()
 * @method $this withCategory($value)
 */
class MigrateToOtherZone extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getAccountDescription()
 * @method $this withAccountDescription($value)
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ModifyAccountDescription extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getEnableEventLog()
 * @method $this withEnableEventLog($value)
 */
class ModifyActionEventPolicy extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getADAccountName()
 * @method $this withADAccountName($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getADDNS()
 * @method $this withADDNS($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getADPassword()
 * @method $this withADPassword($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getADServerIpAddress()
 * @method $this withADServerIpAddress($value)
 */
class ModifyADInfo extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getLocalLogRetentionHours()
 * @method $this withLocalLogRetentionHours($value)
 * @method string getLogBackupFrequency()
 * @method $this withLogBackupFrequency($value)
 * @method string getArchiveBackupKeepCount()
 * @method $this withArchiveBackupKeepCount($value)
 * @method string getBackupLog()
 * @method $this withBackupLog($value)
 * @method string getBackupInterval()
 * @method $this withBackupInterval($value)
 * @method string getDuplicationContent()
 * @method $this withDuplicationContent($value)
 * @method string getHighSpaceUsageProtection()
 * @method $this withHighSpaceUsageProtection($value)
 * @method string getLogBackupLocalRetentionNumber()
 * @method $this withLogBackupLocalRetentionNumber($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getEnableBackupLog()
 * @method $this withEnableBackupLog($value)
 * @method string getBackupPolicyMode()
 * @method $this withBackupPolicyMode($value)
 * @method string getPreferredBackupPeriod()
 * @method $this withPreferredBackupPeriod($value)
 * @method string getEnableIncrementDataBackup()
 * @method $this withEnableIncrementDataBackup($value)
 * @method string getReleasedKeepPolicy()
 * @method $this withReleasedKeepPolicy($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getCompressType()
 * @method $this withCompressType($value)
 * @method string getLocalLogRetentionSpace()
 * @method $this withLocalLogRetentionSpace($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getArchiveBackupKeepPolicy()
 * @method $this withArchiveBackupKeepPolicy($value)
 * @method string getDuplication()
 * @method $this withDuplication($value)
 * @method string getPreferredBackupTime()
 * @method $this withPreferredBackupTime($value)
 * @method string getBackupRetentionPeriod()
 * @method $this withBackupRetentionPeriod($value)
 * @method string getBackupMethod()
 * @method $this withBackupMethod($value)
 * @method string getDuplicationLocation()
 * @method $this withDuplicationLocation($value)
 * @method string getArchiveBackupRetentionPeriod()
 * @method $this withArchiveBackupRetentionPeriod($value)
 * @method string getCategory()
 * @method $this withCategory($value)
 * @method string getLogBackupRetentionPeriod()
 * @method $this withLogBackupRetentionPeriod($value)
 */
class ModifyBackupPolicy extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getTimezone()
 * @method $this withTimezone($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getCollation()
 * @method $this withCollation($value)
 */
class ModifyCollationTimeZone extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getStorageUpperBound()
 * @method $this withStorageUpperBound($value)
 * @method string getStorageThreshold()
 * @method $this withStorageThreshold($value)
 * @method string getStorageAutoScale()
 * @method $this withStorageAutoScale($value)
 */
class ModifyDasInstanceConfig extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDBDescription()
 * @method $this withDBDescription($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBName()
 * @method $this withDBName($value)
 */
class ModifyDBDescription extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAutoUpgradeMinorVersion()
 * @method $this withAutoUpgradeMinorVersion($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class ModifyDBInstanceAutoUpgradeMinorVersion extends Rpc
{
}

/**
 * @method string getConnectionMode()
 * @method $this withConnectionMode($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class ModifyDBInstanceConnectionMode extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getConnectionStringPrefix()
 * @method $this withConnectionStringPrefix($value)
 * @method string getGeneralGroupName()
 * @method $this withGeneralGroupName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getBabelfishPort()
 * @method $this withBabelfishPort($value)
 * @method string getCurrentConnectionString()
 * @method $this withCurrentConnectionString($value)
 * @method string getPort()
 * @method $this withPort($value)
 */
class ModifyDBInstanceConnectionString extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getReadSQLReplicationTime()
 * @method $this withReadSQLReplicationTime($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class ModifyDBInstanceDelayedReplicationTime extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDeletionProtection()
 * @method $this withDeletionProtection($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ModifyDBInstanceDeletionProtection extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDBInstanceDescription()
 * @method $this withDBInstanceDescription($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ModifyDBInstanceDescription extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDBInstanceEndpointDescription()
 * @method $this withDBInstanceEndpointDescription($value)
 * @method string getNodeItems()
 * @method $this withNodeItems($value)
 * @method string getDBInstanceEndpointId()
 * @method $this withDBInstanceEndpointId($value)
 */
class ModifyDBInstanceEndpoint extends Rpc
{
}

/**
 * @method string getConnectionStringPrefix()
 * @method $this withConnectionStringPrefix($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getConnectionString()
 * @method $this withConnectionString($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getDBInstanceEndpointId()
 * @method $this withDBInstanceEndpointId($value)
 * @method string getPort()
 * @method $this withPort($value)
 * @method string getVpcId()
 * @method $this withVpcId($value)
 */
class ModifyDBInstanceEndpointAddress extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDbInstanceId()
 * @method $this withDbInstanceId($value)
 * @method string getHAMode()
 * @method $this withHAMode($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getSyncMode()
 * @method $this withSyncMode($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ModifyDBInstanceHAConfig extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getMaintainTime()
 * @method $this withMaintainTime($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ModifyDBInstanceMaintainTime extends Rpc
{
}

/**
 * @method string getDBInstanceName()
 * @method $this withDBInstanceName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getMetricsConfig()
 * @method $this withMetricsConfig($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getScope()
 * @method $this withScope($value)
 */
class ModifyDBInstanceMetrics extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ModifyDBInstanceMonitor extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getConnectionString()
 * @method $this withConnectionString($value)
 * @method string getClassicExpiredDays()
 * @method $this withClassicExpiredDays($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ModifyDBInstanceNetworkExpireTime extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClassicExpiredDays()
 * @method $this withClassicExpiredDays($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getReadWriteSplittingPrivateIpAddress()
 * @method $this withReadWriteSplittingPrivateIpAddress($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getRetainClassic()
 * @method $this withRetainClassic($value)
 * @method string getVPCId()
 * @method $this withVPCId($value)
 * @method string getInstanceNetworkType()
 * @method $this withInstanceNetworkType($value)
 * @method string getReadWriteSplittingClassicExpiredDays()
 * @method $this withReadWriteSplittingClassicExpiredDays($value)
 */
class ModifyDBInstanceNetworkType extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getBusinessInfo()
 * @method $this withBusinessInfo($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getAgentId()
 * @method $this withAgentId($value)
 * @method string getAutoPay()
 * @method $this withAutoPay($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getResource()
 * @method $this withResource($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getUsedTime()
 * @method $this withUsedTime($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 */
class ModifyDBInstancePayType extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getProxyConfigurationValue()
 * @method $this withProxyConfigurationValue($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getProxyConfigurationKey()
 * @method $this withProxyConfigurationKey($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class ModifyDBInstanceProxyConfiguration extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceStorage()
 * @method $this withDBInstanceStorage($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getServerlessConfiguration()
 * @method $this withServerlessConfiguration($value)
 * @method string getEffectiveTime()
 * @method $this withEffectiveTime($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getSwitchTime()
 * @method $this withSwitchTime($value)
 * @method string getDBInstanceStorageType()
 * @method $this withDBInstanceStorageType($value)
 * @method string getSourceBiz()
 * @method $this withSourceBiz($value)
 * @method string getDedicatedHostGroupId()
 * @method $this withDedicatedHostGroupId($value)
 * @method string getDirection()
 * @method $this withDirection($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getUsedTime()
 * @method $this withUsedTime($value)
 * @method string getDBInstanceClass()
 * @method $this withDBInstanceClass($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getCategory()
 * @method $this withCategory($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 */
class ModifyDBInstanceSpec extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getConnectionString()
 * @method $this withConnectionString($value)
 * @method string getServerKey()
 * @method $this withServerKey($value)
 * @method string getClientCrlEnabled()
 * @method $this withClientCrlEnabled($value)
 * @method string getACL()
 * @method $this withACL($value)
 * @method string getClientCertRevocationList()
 * @method $this withClientCertRevocationList($value)
 * @method string getServerCert()
 * @method $this withServerCert($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getClientCAEnabled()
 * @method $this withClientCAEnabled($value)
 * @method string getClientCACert()
 * @method $this withClientCACert($value)
 * @method string getReplicationACL()
 * @method $this withReplicationACL($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getCAType()
 * @method $this withCAType($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getSSLEnabled()
 * @method $this withSSLEnabled($value)
 */
class ModifyDBInstanceSSL extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getCertificate()
 * @method $this withCertificate($value)
 * @method string getPrivateKey()
 * @method $this withPrivateKey($value)
 * @method string getPassWord()
 * @method $this withPassWord($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getIsRotate()
 * @method $this withIsRotate($value)
 * @method string getEncryptionKey()
 * @method $this withEncryptionKey($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBName()
 * @method $this withDBName($value)
 * @method string getRoleArn()
 * @method $this withRoleArn($value)
 * @method string getTDEStatus()
 * @method $this withTDEStatus($value)
 */
class ModifyDBInstanceTDE extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getDBProxyEngineType()
 * @method $this withDBProxyEngineType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBProxyInstanceNum()
 * @method $this withDBProxyInstanceNum($value)
 * @method string getConfigDBProxyService()
 * @method $this withConfigDBProxyService($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getAccountPassword()
 * @method $this withAccountPassword($value)
 * @method string getVPCId()
 * @method $this withVPCId($value)
 * @method string getInstanceNetworkType()
 * @method $this withInstanceNetworkType($value)
 */
class ModifyDBProxy extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getConfigDBProxyFeatures()
 * @method $this withConfigDBProxyFeatures($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getReadOnlyInstanceWeight()
 * @method $this withReadOnlyInstanceWeight($value)
 * @method string getReadOnlyInstanceMaxDelayTime()
 * @method $this withReadOnlyInstanceMaxDelayTime($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getDbEndpointAliases()
 * @method $this withDbEndpointAliases($value)
 * @method string getDBProxyEngineType()
 * @method $this withDBProxyEngineType($value)
 * @method string getDbEndpointOperator()
 * @method $this withDbEndpointOperator($value)
 * @method string getDbEndpointType()
 * @method $this withDbEndpointType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDbEndpointReadWriteMode()
 * @method $this withDbEndpointReadWriteMode($value)
 * @method string getDBProxyEndpointId()
 * @method $this withDBProxyEndpointId($value)
 * @method string getReadOnlyInstanceDistributionType()
 * @method $this withReadOnlyInstanceDistributionType($value)
 */
class ModifyDBProxyEndpoint extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBProxyConnectStringNetType()
 * @method $this withDBProxyConnectStringNetType($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDBProxyNewConnectStringPort()
 * @method $this withDBProxyNewConnectStringPort($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getDBProxyEngineType()
 * @method $this withDBProxyEngineType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBProxyEndpointId()
 * @method $this withDBProxyEndpointId($value)
 * @method string getDBProxyNewConnectString()
 * @method $this withDBProxyNewConnectString($value)
 */
class ModifyDBProxyEndpointAddress extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getEffectiveTime()
 * @method $this withEffectiveTime($value)
 * @method string getEffectiveSpecificTime()
 * @method $this withEffectiveSpecificTime($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getDBProxyEngineType()
 * @method $this withDBProxyEngineType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBProxyInstanceNum()
 * @method $this withDBProxyInstanceNum($value)
 * @method string getDBProxyInstanceType()
 * @method $this withDBProxyInstanceType($value)
 */
class ModifyDBProxyInstance extends Rpc
{
}

/**
 * @method string getDbProxySslEnabled()
 * @method $this withDbProxySslEnabled($value)
 * @method string getDbProxyConnectString()
 * @method $this withDbProxyConnectString($value)
 * @method string getDbInstanceId()
 * @method $this withDbInstanceId($value)
 * @method string getDBProxyEngineType()
 * @method $this withDBProxyEngineType($value)
 * @method string getDbProxyEndpointId()
 * @method $this withDbProxyEndpointId($value)
 */
class ModifyDbProxyInstanceSsl extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getWhiteListGroupName()
 * @method $this withWhiteListGroupName($value)
 * @method string getSecurityIpHosts()
 * @method $this withSecurityIpHosts($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ModifyDTCSecurityIpHostsForSQLServer extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getTcpConnectionType()
 * @method $this withTcpConnectionType($value)
 */
class ModifyHADiagnoseConfig extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getHAConfig()
 * @method $this withHAConfig($value)
 * @method string getManualHATime()
 * @method $this withManualHATime($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ModifyHASwitchConfig extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDuration()
 * @method $this withDuration($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAutoRenew()
 * @method $this withAutoRenew($value)
 */
class ModifyInstanceAutoRenewalAttribute extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getRetentType()
 * @method $this withRetentType($value)
 * @method string getBackupEnabled()
 * @method $this withBackupEnabled($value)
 * @method string getRelService()
 * @method $this withRelService($value)
 * @method string getStorageType()
 * @method $this withStorageType($value)
 * @method string getEndpoint()
 * @method $this withEndpoint($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getRetention()
 * @method $this withRetention($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getCrossBackupType()
 * @method $this withCrossBackupType($value)
 * @method string getLogBackupEnabled()
 * @method $this withLogBackupEnabled($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getCrossBackupRegion()
 * @method $this withCrossBackupRegion($value)
 * @method string getStorageOwner()
 * @method $this withStorageOwner($value)
 */
class ModifyInstanceCrossBackupPolicy extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getSwitchTimeMode()
 * @method $this withSwitchTimeMode($value)
 * @method string getParameterGroupId()
 * @method $this withParameterGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getForcerestart()
 * @method $this withForcerestart($value)
 * @method string getSwitchTime()
 * @method $this withSwitchTime($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getParameters()
 * @method $this withParameters($value)
 */
class ModifyParameter extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getParameterGroupId()
 * @method $this withParameterGroupId($value)
 * @method string getModifyMode()
 * @method $this withModifyMode($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getParameterGroupName()
 * @method $this withParameterGroupName($value)
 * @method string getParameters()
 * @method $this withParameters($value)
 * @method string getParameterGroupDesc()
 * @method $this withParameterGroupDesc($value)
 */
class ModifyParameterGroup extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getOpsType()
 * @method $this withOpsType($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method array getHbaItem()
 */
class ModifyPGHbaConfig extends Rpc
{

    /**
     * @param array $hbaItem
     *
     * @return $this
     */
	public function withHbaItem(array $hbaItem)
	{
	    $this->data['HbaItem'] = $hbaItem;
		foreach ($hbaItem as $depth1 => $depth1Value) {
			if(isset($depth1Value['Database'])){
				$this->options['query']['HbaItem.' . ($depth1 + 1) . '.Database'] = $depth1Value['Database'];
			}
			if(isset($depth1Value['Address'])){
				$this->options['query']['HbaItem.' . ($depth1 + 1) . '.Address'] = $depth1Value['Address'];
			}
			if(isset($depth1Value['Method'])){
				$this->options['query']['HbaItem.' . ($depth1 + 1) . '.Method'] = $depth1Value['Method'];
			}
			if(isset($depth1Value['Type'])){
				$this->options['query']['HbaItem.' . ($depth1 + 1) . '.Type'] = $depth1Value['Type'];
			}
			if(isset($depth1Value['User'])){
				$this->options['query']['HbaItem.' . ($depth1 + 1) . '.User'] = $depth1Value['User'];
			}
			if(isset($depth1Value['Mask'])){
				$this->options['query']['HbaItem.' . ($depth1 + 1) . '.Mask'] = $depth1Value['Mask'];
			}
			if(isset($depth1Value['PriorityId'])){
				$this->options['query']['HbaItem.' . ($depth1 + 1) . '.PriorityId'] = $depth1Value['PriorityId'];
			}
			if(isset($depth1Value['Option'])){
				$this->options['query']['HbaItem.' . ($depth1 + 1) . '.Option'] = $depth1Value['Option'];
			}
		}

		return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getReadSQLReplicationTime()
 * @method $this withReadSQLReplicationTime($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class ModifyReadonlyInstanceDelayReplicationTime extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getConnectionStringPrefix()
 * @method $this withConnectionStringPrefix($value)
 * @method string getDistributionType()
 * @method $this withDistributionType($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getWeight()
 * @method $this withWeight($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getPort()
 * @method $this withPort($value)
 * @method string getMaxDelayTime()
 * @method $this withMaxDelayTime($value)
 */
class ModifyReadWriteSplittingConnection extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ModifyResourceGroup extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getSecurityGroupId()
 * @method $this withSecurityGroupId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class ModifySecurityGroupConfiguration extends Rpc
{
}

/**
 * @method string getDBInstanceIPArrayName()
 * @method $this withDBInstanceIPArrayName($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getSecurityIps()
 * @method $this withSecurityIps($value)
 * @method string getSecurityGroupId()
 * @method $this withSecurityGroupId($value)
 * @method string getWhitelistNetworkType()
 * @method $this withWhitelistNetworkType($value)
 * @method string getSecurityIPType()
 * @method $this withSecurityIPType($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getModifyMode()
 * @method $this withModifyMode($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getFreshWhiteListReadins()
 * @method $this withFreshWhiteListReadins($value)
 * @method string getDBInstanceIPArrayAttribute()
 * @method $this withDBInstanceIPArrayAttribute($value)
 */
class ModifySecurityIps extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getStoragePeriod()
 * @method $this withStoragePeriod($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSQLCollectorStatus()
 * @method $this withSQLCollectorStatus($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ModifySQLCollectorPolicy extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getSecurityToken()
 * @method $this withSecurityToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getConfigValue()
 * @method $this withConfigValue($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class ModifySQLCollectorRetention extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class PurgeDBInstanceLog extends Rpc
{
}

/**
 * @method string getPageNumber()
 * @method string getWithConfirmed()
 * @method string getPageSize()
 * @method string getFrom()
 * @method string getTo()
 */
class QueryNotify extends Rpc
{

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageNumber($value)
    {
        $this->data['PageNumber'] = $value;
        $this->options['form_params']['PageNumber'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withWithConfirmed($value)
    {
        $this->data['WithConfirmed'] = $value;
        $this->options['form_params']['WithConfirmed'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withPageSize($value)
    {
        $this->data['PageSize'] = $value;
        $this->options['form_params']['PageSize'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withFrom($value)
    {
        $this->data['From'] = $value;
        $this->options['form_params']['From'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTo($value)
    {
        $this->data['To'] = $value;
        $this->options['form_params']['To'] = $value;

        return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getRebuildNodeType()
 * @method $this withRebuildNodeType($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDedicatedHostGroupId()
 * @method $this withDedicatedHostGroupId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getDedicatedHostId()
 * @method $this withDedicatedHostId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class RebuildDBInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getGuardDBInstanceId()
 * @method $this withGuardDBInstanceId($value)
 */
class ReceiveDBInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceStorage()
 * @method $this withDBInstanceStorage($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getDBInstanceDescription()
 * @method $this withDBInstanceDescription($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDBInstanceStorageType()
 * @method $this withDBInstanceStorageType($value)
 * @method string getRestoreTime()
 * @method $this withRestoreTime($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getUsedTime()
 * @method $this withUsedTime($value)
 * @method string getDBInstanceClass()
 * @method $this withDBInstanceClass($value)
 * @method string getDbNames()
 * @method $this withDbNames($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getTargetDBInstanceId()
 * @method $this withTargetDBInstanceId($value)
 * @method string getVPCId()
 * @method $this withVPCId($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 * @method string getInstanceNetworkType()
 * @method $this withInstanceNetworkType($value)
 */
class RecoveryDBInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getCurrentConnectionString()
 * @method $this withCurrentConnectionString($value)
 * @method string getInstanceNetworkType()
 * @method $this withInstanceNetworkType($value)
 */
class ReleaseInstanceConnection extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getCurrentConnectionString()
 * @method $this withCurrentConnectionString($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class ReleaseInstancePublicConnection extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class ReleaseReadWriteSplittingConnection extends Rpc
{
}

/**
 * @method string getTag4value()
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getTag2key()
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getTag3key()
 * @method string getTag1value()
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getTag3value()
 * @method string getProxyId()
 * @method string getTag5key()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTag5value()
 * @method string getTags()
 * @method $this withTags($value)
 * @method string getTag1key()
 * @method string getTag2value()
 * @method string getTag4key()
 */
class RemoveTagsFromResource extends Rpc
{

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag4value($value)
    {
        $this->data['Tag4value'] = $value;
        $this->options['query']['Tag.4.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag2key($value)
    {
        $this->data['Tag2key'] = $value;
        $this->options['query']['Tag.2.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag3key($value)
    {
        $this->data['Tag3key'] = $value;
        $this->options['query']['Tag.3.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag1value($value)
    {
        $this->data['Tag1value'] = $value;
        $this->options['query']['Tag.1.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag3value($value)
    {
        $this->data['Tag3value'] = $value;
        $this->options['query']['Tag.3.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withProxyId($value)
    {
        $this->data['ProxyId'] = $value;
        $this->options['query']['proxyId'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag5key($value)
    {
        $this->data['Tag5key'] = $value;
        $this->options['query']['Tag.5.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag5value($value)
    {
        $this->data['Tag5value'] = $value;
        $this->options['query']['Tag.5.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag1key($value)
    {
        $this->data['Tag1key'] = $value;
        $this->options['query']['Tag.1.key'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag2value($value)
    {
        $this->data['Tag2value'] = $value;
        $this->options['query']['Tag.2.value'] = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function withTag4key($value)
    {
        $this->data['Tag4key'] = $value;
        $this->options['query']['Tag.4.key'] = $value;

        return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getBusinessInfo()
 * @method $this withBusinessInfo($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getAutoPay()
 * @method $this withAutoPay($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAutoRenew()
 * @method $this withAutoRenew($value)
 */
class RenewInstance extends Rpc
{
}

/**
 * @method string getServiceRequestType()
 * @method $this withServiceRequestType($value)
 * @method string getServiceRequestParam()
 * @method $this withServiceRequestParam($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class RequestServiceOfCloudDBA extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAccountPassword()
 * @method $this withAccountPassword($value)
 */
class ResetAccount extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAccountPassword()
 * @method $this withAccountPassword($value)
 */
class ResetAccountPassword extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getRestartMethod()
 * @method $this withRestartMethod($value)
 * @method string getEffectiveTime()
 * @method $this withEffectiveTime($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getSwitchTime()
 * @method $this withSwitchTime($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class RestartDBInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSourceDBInstanceName()
 * @method $this withSourceDBInstanceName($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getUserBakSetURL()
 * @method $this withUserBakSetURL($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getTableMeta()
 * @method $this withTableMeta($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getBackupSetRegion()
 * @method $this withBackupSetRegion($value)
 * @method string getBackupSetType()
 * @method $this withBackupSetType($value)
 * @method string getRestoreTime()
 * @method $this withRestoreTime($value)
 * @method string getBakSetName()
 * @method $this withBakSetName($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getRestoreType()
 * @method $this withRestoreType($value)
 * @method string getSourceRegion()
 * @method $this withSourceRegion($value)
 */
class RestoreDdrTable extends Rpc
{
}

/**
 * @method string getRestoreTableMode()
 * @method $this withRestoreTableMode($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getInstantRecovery()
 * @method $this withInstantRecovery($value)
 * @method string getTableMeta()
 * @method $this withTableMeta($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getRestoreTime()
 * @method $this withRestoreTime($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class RestoreTable extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBName()
 * @method $this withDBName($value)
 */
class RevokeAccountPrivilege extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class RevokeOperatorPermission extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getSpecifiedTime()
 * @method $this withSpecifiedTime($value)
 * @method string getTargetDedicatedHostIdForSlave()
 * @method $this withTargetDedicatedHostIdForSlave($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getStorage()
 * @method $this withStorage($value)
 * @method string getEffectiveTime()
 * @method $this withEffectiveTime($value)
 * @method string getDBInstanceTransType()
 * @method $this withDBInstanceTransType($value)
 * @method string getTargetDedicatedHostIdForMaster()
 * @method $this withTargetDedicatedHostIdForMaster($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDedicatedHostGroupId()
 * @method $this withDedicatedHostGroupId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTargetDBInstanceClass()
 * @method $this withTargetDBInstanceClass($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getTargetDedicatedHostIdForLog()
 * @method $this withTargetDedicatedHostIdForLog($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 */
class StartDBInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class StopDBInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getEffectiveTime()
 * @method $this withEffectiveTime($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getNodeId()
 * @method $this withNodeId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getForce()
 * @method $this withForce($value)
 * @method string getOperation()
 * @method $this withOperation($value)
 */
class SwitchDBInstanceHA extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getConnectionStringPrefix()
 * @method $this withConnectionStringPrefix($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getConnectionStringType()
 * @method $this withConnectionStringType($value)
 * @method string getPort()
 * @method $this withPort($value)
 */
class SwitchDBInstanceNetType extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getVPCId()
 * @method $this withVPCId($value)
 */
class SwitchDBInstanceVpc extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class SwitchGuardToMasterInstance extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getTag()
 * @method array getResourceId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceType()
 * @method $this withResourceType($value)
 */
class TagResources extends Rpc
{

    /**
     * @param array $tag
     *
     * @return $this
     */
	public function withTag(array $tag)
	{
	    $this->data['Tag'] = $tag;
		foreach ($tag as $depth1 => $depth1Value) {
			if(isset($depth1Value['Value'])){
				$this->options['query']['Tag.' . ($depth1 + 1) . '.Value'] = $depth1Value['Value'];
			}
			if(isset($depth1Value['Key'])){
				$this->options['query']['Tag.' . ($depth1 + 1) . '.Key'] = $depth1Value['Key'];
			}
		}

		return $this;
    }

    /**
     * @param array $resourceId
     *
     * @return $this
     */
	public function withResourceId(array $resourceId)
	{
	    $this->data['ResourceId'] = $resourceId;
		foreach ($resourceId as $i => $iValue) {
			$this->options['query']['ResourceId.' . ($i + 1)] = $iValue;
		}

		return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getMigrateTaskId()
 * @method $this withMigrateTaskId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class TerminateMigrateTask extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getBusinessInfo()
 * @method $this withBusinessInfo($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getResource()
 * @method $this withResource($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getUsedTime()
 * @method $this withUsedTime($value)
 * @method string getAutoRenew()
 * @method $this withAutoRenew($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 */
class TransformDBInstancePayType extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getAccountName()
 * @method $this withAccountName($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 */
class UnlockAccount extends Rpc
{
}

/**
 * @method string getAll()
 * @method $this withAll($value)
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method array getResourceId()
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getResourceType()
 * @method $this withResourceType($value)
 * @method array getTagKey()
 */
class UntagResources extends Rpc
{

    /**
     * @param array $resourceId
     *
     * @return $this
     */
	public function withResourceId(array $resourceId)
	{
	    $this->data['ResourceId'] = $resourceId;
		foreach ($resourceId as $i => $iValue) {
			$this->options['query']['ResourceId.' . ($i + 1)] = $iValue;
		}

		return $this;
    }

    /**
     * @param array $tagKey
     *
     * @return $this
     */
	public function withTagKey(array $tagKey)
	{
	    $this->data['TagKey'] = $tagKey;
		foreach ($tagKey as $i => $iValue) {
			$this->options['query']['TagKey.' . ($i + 1)] = $iValue;
		}

		return $this;
    }
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getRetention()
 * @method $this withRetention($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getBackupId()
 * @method $this withBackupId($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getOpsServiceVersion()
 * @method $this withOpsServiceVersion($value)
 * @method string getComment()
 * @method $this withComment($value)
 */
class UpdateUserBackupFile extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getEngineVersion()
 * @method $this withEngineVersion($value)
 * @method string getEffectiveTime()
 * @method $this withEffectiveTime($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 */
class UpgradeDBInstanceEngineVersion extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getSwitchTime()
 * @method $this withSwitchTime($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getTargetMinorVersion()
 * @method $this withTargetMinorVersion($value)
 * @method string getUpgradeTime()
 * @method $this withUpgradeTime($value)
 */
class UpgradeDBInstanceKernelVersion extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceStorage()
 * @method $this withDBInstanceStorage($value)
 * @method string getClientToken()
 * @method $this withClientToken($value)
 * @method string getZoneIdSlave1()
 * @method $this withZoneIdSlave1($value)
 * @method string getZoneIdSlave2()
 * @method $this withZoneIdSlave2($value)
 * @method string getSwitchTimeMode()
 * @method $this withSwitchTimeMode($value)
 * @method string getSwitchOver()
 * @method $this withSwitchOver($value)
 * @method string getResourceGroupId()
 * @method $this withResourceGroupId($value)
 * @method string getCollectStatMode()
 * @method $this withCollectStatMode($value)
 * @method string getDBInstanceDescription()
 * @method $this withDBInstanceDescription($value)
 * @method string getSwitchTime()
 * @method $this withSwitchTime($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getDBInstanceStorageType()
 * @method $this withDBInstanceStorageType($value)
 * @method string getPeriod()
 * @method $this withPeriod($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getUsedTime()
 * @method $this withUsedTime($value)
 * @method string getDBInstanceClass()
 * @method $this withDBInstanceClass($value)
 * @method string getVSwitchId()
 * @method $this withVSwitchId($value)
 * @method string getPrivateIpAddress()
 * @method $this withPrivateIpAddress($value)
 * @method string getVPCId()
 * @method $this withVPCId($value)
 * @method string getZoneId()
 * @method $this withZoneId($value)
 * @method string getPayType()
 * @method $this withPayType($value)
 * @method string getInstanceNetworkType()
 * @method $this withInstanceNetworkType($value)
 * @method string getTargetMajorVersion()
 * @method $this withTargetMajorVersion($value)
 */
class UpgradeDBInstanceMajorVersion extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getOwnerAccount()
 * @method $this withOwnerAccount($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getTargetMajorVersion()
 * @method $this withTargetMajorVersion($value)
 */
class UpgradeDBInstanceMajorVersionPrecheck extends Rpc
{
}

/**
 * @method string getResourceOwnerId()
 * @method $this withResourceOwnerId($value)
 * @method string getDBInstanceId()
 * @method $this withDBInstanceId($value)
 * @method string getSwitchTime()
 * @method $this withSwitchTime($value)
 * @method string getResourceOwnerAccount()
 * @method $this withResourceOwnerAccount($value)
 * @method string getDBProxyEngineType()
 * @method $this withDBProxyEngineType($value)
 * @method string getOwnerId()
 * @method $this withOwnerId($value)
 * @method string getUpgradeTime()
 * @method $this withUpgradeTime($value)
 */
class UpgradeDBProxyInstanceKernelVersion extends Rpc
{
}
