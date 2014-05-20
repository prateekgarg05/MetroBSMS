<?php
class AssetData extends AppModel {
   
   public $useTable = 'asset_data';
   //public $hasAndBelongsToMany  = array(
   // "Value" => array(
   //     'className' => 'DomainValue',
   //     'foreignKey' => 'id',
   //     'associationForeignKey' => 'domainvalue_id',
   //     'joinTable' => 'domain_value',
   //     'with' => 'AssetData',
   //      ));
   public $belongsTo = array(
    'Value' => array(
        'className' => 'DomainValue',
        'foreignKey' => 'domainvalue_id'
    ));
   
}
?>