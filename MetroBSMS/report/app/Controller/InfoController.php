<?php
    class InfoController extends AppController{
        
        public $helpers = array('Html','Form','Js'=>array('Jquery'));
        var $uses = array('Info', 'Answers','AssetData','InfoType',);
        public $components = array('RequestHandler');

        public function index() {
            
            $this->set('infos',$this->Info->find('list', 
            array( 
            'conditions' => array('domain_value_type_id IS NOT NULL'),
            'order' => 'description ASC',
            'name' => 'description',
            'value' => 'domain_type_id',
            'fields' => array('id', 'description')
            )));   
        }

        public function getAnswers()
        {
            $info_id = $this->request->data['Info']['Info_id'];

            $value_type=$this->Info->find('first', array(
                'conditions' => array('id'=>$info_id),
                'fields' => array('domain_type_id','domain_value_type_id',))
                );
           
		    $answers = $this->Answers->find('list', array(
			'conditions' => array('domaintype_id' => $value_type['Info']['domain_type_id']),
			'recursive' => -1,
            'fields' => array('id','description')
			));

            $infoTypes = $this->AssetData->find('list', array(
            'conditions' => array('fieldtype_id' => $info_id),
            'fields' =>array('informationtype_id')
            ));

            $infoTypes=array_unique($infoTypes);

            $finalTypes = array();
            foreach($infoTypes as $item)
            {
                $finalTypes[] = $this->InfoType->find('first', array(
                'fields'=>array('id','description'),
                'conditions'=>array('id '=>$item),
                ));
            }
          
		    $this->set('answers',$answers);
            $this->set('infotypes',$finalTypes);
            $this->set('valueType',$value_type);
            //$this->set("test",$finalTypes);

		    $this->layout = 'ajax';
        }

        public function createReport() {

            $filed_Type_id = $this-> request->data['Info']['Info_id'];
            $answType = $this->request->data['Info']['AnswType'];
            $infoId = $this->request->data['Info']['InfoType_id'];
            
            if($answType==0||$answType==1)
            {
                if(count($this->request->data['Info']['Answers_id'])!=0){
                     $answers = $this->request->data['Info']['Answers_id'];
                }
                else{
                    foreach($this->request->data['Answers_id'] as $answer)
                    $answers[]=$answer;
                }
                $AnyAll=$this->request->data['Info']['AnyAll'];    
                
                if($AnyAll==0)
                {
                    $report= $this->AssetData->find('all',array(
                                   'conditions'=>array(
                                     'fieldtype_id'=>$filed_Type_id,
                                     'domainvalue_id'=>$answers,                                                'informationtype_id'=>$infoId),

                                ));
                }
                else
                {
                    $reportTmp= $this->AssetData->find('list',array(
                                                   'conditions'=>array(
                                                        'fieldtype_id'=>$filed_Type_id,
                                                         'domainvalue_id'=>$answers,
                                                         'informationtype_id'=>$infoId),
                                                    'fields'=>array('id','domainvalue_id','asset_id',)
                                                     ));
                    $report = array();
                    
                    foreach($reportTmp as $key => $i)
                    {
                        if(count($i)==count($answers))
                        {
                            $report[]=$key;
                        }
                    }
                 
                }
            }
            elseif($answType==2)
            {
                $answer = $this->request->data['Info']['Answer'];
                $operator = $this->request->data['Info']['Operator'];
                $pattern="&quot;|'|''&";
                $realAnsw = preg_split($pattern,$answer);
                $realResult = $realAnsw[0]*12 + $realAnsw[1];

                $reportTmp = $this->AssetData->find('list',array(
                    'conditions'=>array('fieldtype_id'=>$filed_Type_id,
                                        'informationtype_id'=>$infoId),
                    'fields'=>array('value','asset_id')
                            ));

                  $report = array();
                 foreach($reportTmp as $i=>$value)
                 {
                     $answerDb = preg_split($pattern,$i);
                     $resDb = $answerDb[0]*12 + $answer[1];
                     switch($operator)
                     {
                         case(0):{
                             if($resDb>$realResult)
                             {
                                 $report[0]['StopId'] = $value;
                                 $report[0]['Answer'] = $i;
                                 $report[0]['Operator'] = '>';
                             }
                             break;
                         }
                         case(1):{
                             if($resDb>=$realResult)
                             {
                                 $report[0]['StopId'] = $value;
                                 $report[0]['Answer'] = $i;
                                 $report[0]['Operator'] = '>=';
                             }
                             break;
                         }
                         case(2):{
                             if($resDb==$realResult)
                             {
                                 $report[0]['StopId'] = $value;
                                 $report[0]['Answer'] = $i;
                                 $report[0]['Operator'] = '==';
                             }
                             break;
                         }
                         case(3):{
                             if($resDb<=$realResult)
                             {
                                 $report[0]['StopId'] = $value;
                                 $report[0]['Answer'] = $i;
                                 $report[0]['Operator'] = '<';
                             }
                             break;
                         }
                         case(4):{
                             if($resDb<$realResult)
                             {
                                 $report[0]['StopId'] = $value;
                                 $report[0]['Answer'] = $i;
                                 $report[0]['Operator'] = '<=';
                             }
                             break;
                         }
                     }
                 }

                
            }
            elseif($answType==3)
            {
                $answer = $this->request->data['Info']['Answer'];
                $operator = $this->request->data['Info']['Operator'];
                $reportTmp = $this->AssetData->find('list',array(
                    'conditions'=>array('fieldtype_id'=>$filed_Type_id,
                                        'informationtype_id'=>$infoId),
                    'fields'=>array('value','asset_id')
                            ));
                    $this->set('test',$answer);
                foreach($reportTmp as $i=>$value)
                {
                     switch($operator)
                     {
                         case(0):{
                             if($i>$answer)
                             {
                                 $report[0]['StopId'] = $value;
                                 $report[0]['Answer'] = $i;
                                 $report[0]['Operator'] = '>';
                             }
                             break;
                         }
                         case(1):{
                             if($i>=$answer)
                             {
                                 $report[0]['StopId'] = $value;
                                 $report[0]['Answer'] = $i;
                                 $report[0]['Operator'] = '>=';
                             }
                             break;
                         }
                         case(2):{
                             if($i==$answer)
                             {
                                 $report[0]['StopId'] = $value;
                                 $report[0]['Answer'] = $i;
                                 $report[0]['Operator'] = '=';
                             }
                             break;
                         }
                         case(3):{
                             if($i<$answer)
                             {
                                 $report[0]['StopId'] = $value;
                                 $report[0]['Answer'] = $i;
                                 $report[0]['Operator'] = '<';
                             }
                             break;
                         }
                         case(4):{
                             if($i<=$answer)
                             {
                                 $report[0]['StopId'] = $value;
                                 $report[0]['Answer'] = $i;
                                 $report[0]['Operator'] = '<=';
                             }
                             break;
                         }
                     }
                }

            }

            $reportTest= $this->AssetData->find('all',array(
                 'conditions'=> array(
                      'fieldtype_id'=>$filed_Type_id,
                      'domainvalue_id'=>$answers,                                                
                      'informationtype_id'=>$infoId
                 )));

            $this->set('reportList',$report);
            
            //$this->set('test',$report);
        }

       public function view_pdf() {
           
            Configure::write('debug',0);
            header('Content-type: application/pdf');
            header('Content-Disposition: attachment; filename="Report.pdf"');

            // increase memory limit in PHP 
            ini_set('memory_limit', '512M');

            $data=array();
            $data['stops'] =unserialize(base64_decode($this->request->data['data1']));
            $data['answers'] = unserialize(base64_decode($this->request->data['data2']));
            $this->set('data', $data);

            
          
           
        }

        public function createcsv() {
    
	        Configure::write('debug',0);
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename="Report.csv"');
            $data=array();
            $data['stops'] =unserialize(base64_decode($this->request->data['data1']));
            $data['answers'] = unserialize(base64_decode($this->request->data['data2']));

             $headers = array( 
                'stops'=>'Bus Stop','answers'=>'Answer'
                );
            array_unshift($data,$headers);
            $this->set(compact('data'));
             
        }
        
    }

?>
