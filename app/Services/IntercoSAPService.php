<?php
namespace App\Services;
ini_set('max_execution_time', -1); //3 minutes
ini_set("memory_limit", "-1");
use App\Models\BaDetail;
use App\Models\BaCompany;
use App\Models\Company_SAP;
use App\Models\IntercoSAP;
use App\Models\Company;
use App\Models\Vendor;
use App\Models\Account;
use App\Models\IntercoDetail;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;
/**
 *  BWConsolidation                   = Open Item Date
 *  Akun 1 (GetCustomer         fbl5n = Open Item Date)
 *  Akun 2 (GetVendor           fbl1n = Open Item Date)
 *  Akun 4 dan 7 (GetInterco    fbl3n = Range Item Date)
 */
class IntercoSAPService
{
    private $client;
    public function _client($wsdl="",$Endpoint="",$server="")
    {
        // $wsdl = "http://sap-pi-qas.pupuk-indonesia.com:58200/dir/wsdl?p=sa/272934013d613dfbbe1678cb633879d4";
        $username = "";$password="";
        if(env('APP_ENV')=='local'){
            if($server!=""){
                if($server=="QAS"){
                    $username = env('PISAP_USERNAME_QAS');
                    $password = env('PISAP_PASSWORD_QAS');
                }else if($server=="DEV"){
                    $username = env('PISAP_USERNAME_DEV');
                    $password = env('PISAP_PASSWORD_DEV');
                }
            }else{
                $username = env('PISAP_USERNAME_DEV');
                $password = env('PISAP_PASSWORD_DEV');
            }
        }
        else{
            $username = env('PISAP_USERNAME_PROD');
            $password = env('PISAP_PASSWORD_PROD');
        }
        if($username==""){
            echo '<h2>Constructor error</h2><pre>Username is Empty.</pre>';
            die;
        }

        if($password==""){
            echo '<h2>Constructor error</h2><pre>Password is Empty.</pre>';
            die;
        }

        
        if($wsdl==""){
            echo '<h2>Constructor error</h2><pre>WSDL is Empty.</pre>';
            die;
        }
        // if($Endpoint==""){
        //     echo '<h2>Constructor error</h2><pre>Endpoint is Empty.</pre>';
        //     die;
        // }

        try {
            $this->client = new \nusoap_client($wsdl, true);
            $this->client->setCredentials($username, $password);
            // $this->client->setEndpoint('http://sap-pi-qas.pupuk-indonesia.com:58200/XISOAPAdapter/MessageServlet?senderParty=&senderService=E_PROCApplication_BC&receiverParty=&receiverService=&interface=SI_MasterCompany&interfaceNamespace=urn%3AE_PROC_Get_MasterCompany');
            if($Endpoint!="")
            $this->client->setEndpoint($Endpoint);
            $this->client->soap_defencoding = 'UTF-8';
            $this->client->decode_utf8 = FALSE;
            $this->client->use_curl = TRUE;
            $this->client->setCurlOption(CURLOPT_COOKIESESSION,1);
            $this->client->setCurlOption(CURLOPT_TIMEOUT,2000);
            $this->client->useHTTPPersistentConnection();
            $err = $this->client->getError();
            if ($err) {
                // Display the error
                // echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
                // die;
                $response['status'] = false;
                $response['messages'] = 'Constructor error : ' . $err;
                return $response;
            }
            
            // echo "Get List All Function in WSDL";
            // $proxy = $this->client->getProxyClassCode();
            // print_r($proxy);
            // die;
        } catch (Exception $e) {
            // echo "Error Connection.";
            // Log::info('Caught Exception in client' . $e->getMessage());
            // die;
            $response['status'] = false;
            $response['messages'] = 'Caught Exception in client : ' . $e->getMessage();
            return $response;
        }
    }

    private function xmlName($fl){
        //XML Name by Environment
        if(env('APP_ENV')=='local'){
            $fl = str_replace(".xml","-QA.xml",$fl);
        }
        return $fl;
    }
    public function getCompany()
    {
        $status = true;
        try {
            $wsdl = "http://sap-pi-dev.pupuk-indonesia.com:50600/dir/wsdl?p=sa/a65e053da75d3ce6bb42ba0d84310cf9";
            $Endpoint = "";//"http://sap-pi-dev.pupuk-indonesia.com:50600/XISOAPAdapter/MessageServlet?senderParty=&senderService=WEB_RECONApplication_BC&receiverParty=&receiverService=&interface=SI_GET_COMPANY_ADD&interfaceNamespace=urn%3APIHC_WEB_RECON_BW_Get_Company";    
            $RFC = "SI_GET_COMPANY_ADD";
            $this->_client($wsdl,$Endpoint);
            die;
            $sendData = array(
                'T_DATA' => array()
            );
            $ret = $this->client->call($RFC, $sendData);
            $err = $this->client->getError();
            if ($err) {
                $status =  false;
                Log::info('Caught Exception in WSDL : ' . $err);
                // Display the error
                // echo '<h2>Call Function error</h2><pre>' . $err . '</pre>';
                // die;
            }
            $data = null;
            if (isset($ret) && $status) {
                $dataItem = $ret['T_DATA'];
                if(is_array($dataItem))
                foreach ($dataItem as $k=>$entry) {
                    $singleData = false;
                    foreach($entry as $ki=>$val){
                        if(is_numeric($ki)){
                        $data[] = array(
                            'BUKRS'=>$val['BUKRS'],
                            'BUTXT'=>$val['BUTXT']
                        );
                        }else{
                            $singleData=true;
                        }

                    }
                    if($singleData){
                        $data[] = array(
                            'BUKRS'=>$entry['BUKRS'],
                            'BUTXT'=>$entry['BUTXT']
                        );
                    }

                }
            }
            //Insert To DB
            if($data){
                $cdata = count($data);
                $inserted = 0;
                $updated = 0;
                $exist=0;
                foreach($data as $k=>$v){
                    $find = Company_SAP::all()
                    ->where('company_code', '=', $v["BUKRS"])->count();
                    if($find){
                        //Update When company Name Different
                        $diff = Company_SAP::all()
                        ->where('company_code', '=', $v["BUKRS"])
                        ->where('company_name', '=', $v["BUTXT"])->count()
                        ;
                        if(!$diff){
                            Company_SAP::where('company_code','=', $v["BUKRS"])
                            ->update(['company_name' => $v["BUTXT"]]);
                            $updated++;
                        }else{
                            $exist++;
                        }
                    }else {
                        //new inster
                        Company_SAP::create([
                            'company_code'  => $v["BUKRS"],
                            'company_name'  => $v["BUTXT"]
                        ]);
                        $inserted++;
                    }

                }
               
                $message = "Exist : ".$exist.", Inserted : ".$inserted.",Updated : ".$updated." From ".$cdata;
                echo $message;
                // print_r($data);
            }else{
                $response['status'] = false;
                $response['messages'] = 'Empty Data';
                return $response;
            }
           
        } catch (SoapFault $fault) {
            // echo 'Caught SoapFault :' . $fault->getMessage();
            $status = false;
            Log::info('Caught SoapFault :' . $fault->getMessage());
            // die;
            // return $e;       // just re-throw it
        }

        return $status;
    }

    private function cekSUMME($val){
        $ret =  true;
        foreach($val as $k=>$v){
            if(strtolower($v)=='summe'){
                $ret = false;
                break;
            }
        }
        return $ret;
    }

    public function getConsolidationBW($params)
    {
        if($params->periode_id==0){
            $response['status'] = false;
            $response['messages'] = 'Periode ID is Empty';
            return $response;
        }
        //Field Old Upload
        $arrMap = array(
            "ID_ACCOUNT"=>"account_key",
            "DESC_ACCOUNT"=>"account",
            "ID_ENTITY"=>"company",
            "ID_INTERCO"=>"interco",
            "ID_TIME"=>"time_key",
            "AMOUNT"=>"saldo_awal"
        );
        //Field Yang masuk ke Database
        $arrInc = array(
            "TUPLE"=>"TUPLE",
            "ID_ACCOUNT"=>"ID_ACCOUNT",
            "DESC_ACCOUNT"=>"DESC_ACCOUNT",
            "ID_AUDITTRAIL"=>"ID_AUDITTRAIL",
            "DESC_AUDITTRAIL"=>"DESC_AUDITTRAIL",
            "ID_BUSINESSAREA"=>"ID_BUSINESSAREA",
            "DESC_BUSINESSAREA"=>"DESC_BUSINESSAREA",
            "ID_BUSINESSPARTNER"=>"ID_BUSINESSPARTNER",
            "DESC_BUSINESSPARTNER"=>"DESC_BUSINESSPARTNER",
            "ID_CATEGORY"=>"ID_CATEGORY",
            "DESC_CATEGORY"=>"DESC_CATEGORY",
            "ID_ENTITY"=>"ID_ENTITY",
            "DESC_ENTITY"=>"DESC_ENTITY",
            "ID_FLOW"=>"ID_FLOW",
            "DESC_FLOW"=>"DESC_FLOW",
            "ID_FUNCTIONALAREA"=>"ID_FUNCTIONALAREA",
            "DESC_FUNCTIONALAREA"=>"DESC_FUNCTIONALAREA",
            "ID_INTERCO"=>"ID_INTERCO",
            "DESC_INTERCO"=>"DESC_INTERCO",
            "ID_RPTCURRENCY"=>"ID_RPTCURRENCY",
            "DESC_RPTCURRENCY"=>"DESC_RPTCURRENCY",
            "ID_SCOPE"=>"ID_SCOPE",
            "DESC_SCOPE"=>"DESC_SCOPE",
            "ID_SEQUENCE"=>"ID_SEQUENCE",
            "DESC_SEQUENCE"=>"DESC_SEQUENCE",
            "ID_TIME"=>"ID_TIME",
            "DESC_TIME"=>"DESC_TIME",
            "ID_SRCURRENCY"=>"ID_SRCURRENCY",
            "DESC_SRCCURRENCY"=>"DESC_SRCCURRENCY",
            "AMOUNT"=>"AMOUNT"
        );

        //List Master Account Updateable
        $account =   Account::select('account_code')->where('is_synchronize','=',1)->get();
        if(count($account)==0){
            $response['status'] = false;
            $response['messages'] = 'Account is Empty';
            return $response;
        }
        $listAccount = array();
        foreach($account as $k=>$v){
            $listAccount[$v['account_code']] = $v['account_code']; 
        }
        //List Master Company Fixed
        $company =   Company::select('company_code')->where('delete_mark','=','0')->get();
        if(count($company)==0){
            $response['status'] = false;
            $response['messages'] = 'Company is Empty';
            return $response;
        }
        $listCompany = array();
        foreach($company as $k=>$v){
            $listCompany[$v['company_code']] = $v['company_code']; 
        }
       
        try {
            $wsdl = storage_path($this->xmlName("sap/BWConsolidationwsdl.xml"));//
            // $wsdl = "http://sap-pi-qas.pupuk-indonesia.com:58200/dir/wsdl?p=sa/8d84af17cabc3bcfb9a67a9afbf2d101";
            $Endpoint = "";// = "http://sap-pi-dev.pupuk-indonesia.com:50600/XISOAPAdapter/MessageServlet?senderParty=&senderService=WEB_RECON_BWApplication_BC&receiverParty=&receiverService=&interface=SI_Get_Consolidation&interfaceNamespace=urn:PIHC_WEB_RECON_BW_Get_Consolidation";    
            $RFC = "SI_Get_Consolidation";
            $this->_client($wsdl,$Endpoint,"DEV");
            $eldate = explode("-",$params->end_date);// str_replace(".","",$params->start_date);
            $date   = $eldate[0].".".$eldate[1];//YYYY.MM
            /* Format Sample Paramater
            <R_PERIOD>
            <!--Optional:-->
            <SIGN>I</SIGN>
            <!--Optional:-->
            <OPTION>BT</OPTION>
            <!--Optional:-->
            <LOW>2019.01</LOW>
            <!--Optional:-->
            <HIGH>2019.01</HIGH>
            </R_PERIOD>
            <!--Optional:-->
            <T_DATA>
            </T_DATA>
            End Format */
            $sendData =
                array (
                  'R_PERIOD' => 
                    array (
                      'SIGN' => 'I',
                      'OPTION' => 'BT',
                      'LOW' => $date,
                      'HIGH' => $date,
                    )
                  ,'T_DATA' => array()
                );
            $ret = $this->client->call($RFC, $sendData);
            $err = $this->client->getError();
            if ($err) {
                $response['status'] = false;
                $response['messages'] = $this->CustomError($err);
                return $response;
            }
            $data = null;
            $listHashData = array();
            if (isset($ret)) {
                if($ret!=""){
                $dataItem = $ret['T_DATA'];
                if(is_array($dataItem))
                foreach ($dataItem as $k=>$entry) {
                    $singleData = false;
                    foreach($entry as $ki=>$val){
                        if(is_numeric($ki)){
                        $cd = array();
                        $cd['periode_id'] = $params->periode_id;
                        $cd['saldo_akhir'] = '0';
                        $cd['verifikasi'] = '0';
                        $cd['created_at'] = date("Y-m-d H:i:s");
                        $cd['create_by'] = 'SyncSAP';
                        $cd['source'] = 'BWConsol';
                        //eliminate R
                        if(strlen($val['ID_ENTITY'])==5)
                        $val['ID_ENTITY'] = ltrim($val['ID_ENTITY'], 'R');
                        if(strlen($val['ID_INTERCO'])==5)
                        $val['ID_INTERCO'] = ltrim($val['ID_INTERCO'], 'R');
                        $val['ID_ACCOUNT'] = trim($val['ID_ACCOUNT']);//add trim
                        $val['ID_ACCOUNT'] = ltrim($val['ID_ACCOUNT'],'0'); //elminate padding zero
                        //is contain Summe skipped
                        if(!$this->cekSUMME($val))
                            continue;
                        //company is not exist skipped
                        if(!array_key_exists($val['ID_ENTITY'],$listCompany))
                            continue;
                        //Interco is not exist skipped
                        if(!array_key_exists($val['ID_INTERCO'],$listCompany))
                            continue;
                        //Account is not in is_sycnrhonize skipped
                        if(!array_key_exists($val['ID_ACCOUNT'],$listAccount))
                            continue;
                        //Company
                        // Company::firstOrCreate(
                        //     ['company_code' => $v['company']],
                        //     ['company_name' => $v['entity']]
                        // );

                        //interco
                        // Company::firstOrCreate(
                        //     ['company_code' => $interco],
                        //     ['company_name' => $v['interco']]
                        // );
                        //Account is not exist Create New
                        // if(!array_key_exists($val['ID_ACCOUNT'],$listAccount)){
                        //     Account::create(
                        //         [
                        //             'account_code' => $val['ID_ACCOUNT'],
                        //             'account_name' => $val['DESC_ACCOUNT'],
                        //             'group_code' => 'TS00'
                        //         ]
                        //     );
                        //     $listAccount  = Arr::add($listAccount,$val['ID_ACCOUNT'],$val['ID_ACCOUNT']);
                        // }
                        foreach($val as $kj=>$valj){
                            //Skip Eliminate Not Used Field
                            if(!isset($arrInc[$kj]))
                            continue;
                            
                            $cd[$kj] = $valj;
                            if(isset($arrMap[$kj])){
                                $kj = $arrMap[$kj];
                                if($kj=="time_key")
                                $valj = str_replace("/",".",$valj);
                                else if($kj=="account_key")
                                $valj =  ltrim($valj, '0');  //eliminate prefix zero
                                //add for has defined Kolum for Old Data
                                $cd[$kj] = $valj;
                            } 
                        }
                         //Skip empty Interco / Trade Partner / Vendor / Customer
                        if(isset($cd['interco']) && $cd['interco']!="" && isset($cd['company']) && $cd['company']!=""){ //.$cd['interco']
                            /* Dummy */
                            // if($cd['interco']=="" && $cd['company']!="C000")
                            // $cd['interco']= 'C000';
                            // else if($cd['interco']=="" && $cd['company']=="C000")
                            // $cd['interco']= 'A000';
                            /* End Dummy */
                            $cd['hash'] = hash('md5', $cd['periode_id'].$cd['company'].$cd['interco'].$cd['account_key']);
                            $listHashData[$cd['hash']] = $cd['hash'];
                            $data[] = $cd;
                        }
                        }else{
                            $singleData=true;
                        }

                    }
                    if($singleData){
                        $cd = array();
                        $cd['periode_id'] = $params->periode_id;
                        $cd['saldo_akhir'] = '0';
                        $cd['verifikasi'] = '0';
                        $cd['created_at'] = date("Y-m-d H:i:s");
                        $cd['create_by'] = 'SyncSAP';
                        $cd['source'] = 'BWConsol';
                        //Deliminate R
                        if(strlen($entry['ID_ENTITY'])==5)
                        $entry['ID_ENTITY'] = ltrim($entry['ID_ENTITY'], 'R');
                        if(strlen($entry['ID_INTERCO'])==5)
                        $entry['ID_INTERCO'] = ltrim($entry['ID_INTERCO'], 'R');
                        $entry['ID_ACCOUNT']=trim($entry['ID_ACCOUNT']);//add trim
                        //company is not exist skipped
                        if(!array_key_exists($entry['ID_ENTITY'],$listCompany))
                            continue;
                        //Interco is not exist skipped
                        if(!array_key_exists($entry['ID_INTERCO'],$listCompany))
                            continue;
                        //Account is not in is_sycnrhonize skipped
                        if(!array_key_exists($entry['ID_ACCOUNT'],$listAccount))
                            continue;
                        foreach($entry as $kj=>$valj){
                            //Skip Eliminate Not Used Field
                            if(!isset($arrInc[$kj]))
                            continue;

                            $cd[$kj] = $valj;
                            if(isset($arrMap[$kj])){
                                $kj = $arrMap[$kj];
                                if($kj=="time_key")
                                $valj = str_replace("/",".",$valj);
                                else if($kj=="account_key")
                                $valj =  ltrim($valj, '0');  //eliminate prefix zero
                                // else if($kj=="saldo_awal")
                                // $valj = $valj*100;
                                //add for has defined Kolum for Old Data
                                $cd[$kj] = $valj;
                            } 
                        }
                         //Skip empty Interco / Trade Partner / Vendor / Customer
                         if(isset($cd['interco']) && $cd['interco']!="" && isset($cd['company']) && $cd['company']!=""){ //.$cd['interco']
                            $cd['hash'] = hash('md5', $cd['periode_id'].$cd['company'].$cd['interco'].$cd['account_key']);
                            $listHashData[$cd['hash']] = $cd['hash'];
                            $data[] = $cd;
                        }
                    }
                }
                }
                // echo "<pre>";
                // echo count($data);
                // echo "<pre>";
                // print_r($data);die;
            }
            //Insert To DB
            if($data){
                $cdata = count($data);
                $inserted = 0;
                $deleted = 0;
                $updated = 0;
                $IsUsedBA=0;
                $newIns =  array();
                $delData =  array();

                $hashData = IntercoSAP::select('hash','status')
                ->where('periode_id', '=', $params->periode_id)->get();
                if(count($hashData)==0){
                    //Bulk Insert For New Record
                    $cnewIns = array_chunk($data,1000);
                    foreach($cnewIns as $k=>$v){
                        IntercoSAP::insert($v);
                        $inserted += count($v);
                    }
                    $cnewIns = array();
                }
                else{
                    $listHash = array();
                    foreach($hashData as $k=>$v){
                        $listHash[trim($v['hash'])] = $v['status']==""?"Belum Ada BA":$v['status'];
                    }
                    
                    foreach($data as $k=>$v){
                        if(array_key_exists($v['hash'],$listHash)){
                                //Jika Interco sudah Verified tidak di update
                            if(trim($listHash[$v['hash']])=="Verified" && isset($listHash[$v['hash']])){
                                //skippped tidak boleh di update sudah di Create BA
                                $IsUsedBA++;
                            }else{
                                //Update ALL
                                IntercoSAP::where('periode_id','=', $params->periode_id)->where('hash','=', $v["hash"])
                                    ->update($v);
                                    $updated++;
                            }
                        }else {
                            //new insert
                            $newIns[] = $v;
                        }

                    }
                    //Delete not in BWCONSOL
                    foreach($listHash as $k=>$v){
                        if(!array_key_exists($k,$listHashData) && $v=='Belum Ada BA'){
                            $delData[] = $k;
                        }
                    }
                    if(count($delData)>0){
                        $cnewDel = array_chunk($delData,1000);
                        foreach($cnewDel as $k=>$v){
                            IntercoSAP::where('periode_id','=', $params->periode_id)->whereIn('hash',$v)->delete();
                            $deleted += count($v);
                            
                        }
                    }
                    
                    //Bulk Insert For New Record
                    if(count($newIns)>0){
                        $cnewIns = array_chunk($newIns,1000);
                        foreach($cnewIns as $k=>$v){
                            IntercoSAP::insert($v);
                            $inserted += count($v);
                            
                        }
                    }
                }
                // $message = "Exist : ".$exist.", Empty Interco : ".$emptyInterco.", Have BA : ".$IsUsedBA.", Inserted : ".$inserted.", Updated : ".$updated." From ".$cdata;
                // echo $message;
                $response['status'] = true;
                $response['total_data'] = $cdata;
                $response['inserted_data'] = $inserted;
                $response['updated_data'] = $updated;
                return $response;
            }else{
                $response['status'] = false;
                $response['messages'] = 'Empty Data';
                return $response;
            }
           
        } catch (SoapFault $fault) {
            // echo 'Caught SoapFault :' . $fault->getMessage();
            // Log::info('Caught SoapFault :' . $fault->getMessage());
            $response['status'] = false;
            $response['messages'] = $fault->getMessage();
            return $response;
            // die;
            // return $e;       // just re-throw it
        }
    }
         
    /**
     * getIntercoperACType
     * Get Fbl5n by Account differ in Date Open item and Range
     * @param  mixed $RFC
     * @param  mixed $params
     * @param  mixed $listAkun
     * @param  mixed $arrInc
     * @param  mixed $arrMap
     * @return void
     */
    public  function getIntercoperACType($type,$RFC,$params,$listAkun,$listCompany,$arrInc,$arrMap)
    {
        $customDate = array();
        $startDate = str_replace("-","",$params->start_date);
        $endDate = str_replace("-","",$params->end_date);
        $openItem ='X';
        if($type=="A") //Akun 1 dan 2
        $customDate = array (
            'SIGN' => 'I',
            'OPTION' => 'EQ',
            'LOW' => $endDate,
            'HIGH' => '',
        );
        if($type=="B"){ //Akun 4 dan 7
        $openItem ='';
        $customDate = array (
            'SIGN' => 'I',
            'OPTION' => 'BT',
            'LOW' => $startDate,
            'HIGH' => $endDate,
        );
        }
        $sendData =
                array (
                  'XOPSEL' => $openItem,
                  'R_BUDAT' => 
                  array (
                    'item' => 
                    $customDate
                  ),
                  'R_BUKRS' => 
                  array (
                    'item' => 
                    array (
                      'SIGN' => 'I',
                      'OPTION' => 'EQ',
                      'LOW' => $params->company,
                      'HIGH' => '',
                    ),
                  ),
                  'R_SAKNR' => $listAkun
                  ,'T_DATA' => array()
                );
            $ret = $this->client->call($RFC, $sendData);
            // $this->showRespons();
            $err = $this->client->getError();
            if ($err) {
                // Log::info('Caught Exception in WSDL : ' . $err);
                $response['status'] = false;
                //." X " .print_r($sendData,true)
                $response['messages'] = $this->CustomError($err);
                return $response;
            }
            $data = null;
            if (isset($ret)) {
                $dataItem = $ret['T_DATA'];
                if(is_array($dataItem))
                foreach ($dataItem as $k=>$entry) {
                    $singleData = false;
                    foreach($entry as $ki=>$val){
                        if(is_numeric($ki)){
                        $cd = array();
                        $cd['periode_id'] = $params->periode_id;
                        $cd['created_at'] = date("Y-m-d H:i:s");
                        $cd['create_by'] = 'SyncSAP';
                        $cd['saldo_awal'] = 0;
                        
                        //company is not exist skipped
                        if(!array_key_exists($val['BUKRS'],$listCompany))
                            continue;

                        //Interco is not exist skipped
                        if($type=="A") //Akun 1 dan 2
                        if(!array_key_exists($val['VBUND_TBL'],$listCompany))
                            continue;

                        else if($type=="B") //Akun 4 dan 7
                        if(!array_key_exists($val['VBUND'],$listCompany))
                            continue;

                        foreach($val as $kj=>$valj){
                            //Skip Eliminate Not Used Field
                            if(!isset($arrInc[$kj]))
                            continue;
                            
                            //Formatting
                            if($kj=="DMSHB" || ($val['WAERS']=="IDR" && $kj=="WRSHB")) //Amount Local Currency di kali 100
                            $valj = $valj*100;
                            $cd[$kj] = $valj;
                            if(isset($arrMap[$kj])){
                                $kj = $arrMap[$kj];
                                if($kj=="time_key")
                                $valj = str_replace("/",".",$valj);
                                else if($kj=="account_key")
                                $valj =  ltrim($valj, '0');  //eliminate prefix zero
                                //add for has defined Kolum for Old Data
                                $cd[$kj] = $valj;
                            } 
                        }
                         //Skip empty Interco / Trade Partner / Vendor / Customer
                        if(isset($cd['interco']) && $cd['interco']!=""){ //.$cd['interco']
                            $hashheader = hash('md5', $cd['periode_id'].$cd['company'].$cd['interco'].$cd['account_key']);
                            $cd['hashheader'] = $hashheader;
                            $cd['hash'] = hash('md5', $cd['periode_id'].$cd['BELNR'].$cd['account_key'].$cd['time_key']);
                            $data[] = $cd;
                        }
                        }else{
                            $singleData=true;
                        }

                    }
                    if($singleData){
                        $cd = array();
                        $cd['periode_id'] = $params->periode_id;
                        $cd['created_at'] = date("Y-m-d H:i:s");
                        $cd['create_by'] = 'SyncSAP';
                        $cd['saldo_awal'] = 0;

                        //company is not exist skipped
                        if(!array_key_exists($entry['BUKRS'],$listCompany))
                        continue;

                        //Interco is not exist skipped
                        if($type=="A") //Akun 1 dan 2
                        if(!array_key_exists($entry['VBUND_TBL'],$listCompany))
                            continue;

                        else if($type=="B") //Akun 4 dan 7
                        if(!array_key_exists($entry['VBUND'],$listCompany))
                            continue;

                        foreach($entry as $kj=>$valj){
                            //Skip Eliminate Not Used Field
                            if(!isset($arrInc[$kj]))
                            continue;
                            
                            //Formatting
                            if($kj=="DMSHB" || ($entry['WAERS']=="IDR" && $kj=="WRSHB")) //Amount Local Currency di kali 100
                            $valj = $valj*100;
                            $cd[$kj] = $valj;
                            if(isset($arrMap[$kj])){
                                $kj = $arrMap[$kj];
                                if($kj=="time_key")
                                $valj = str_replace("/",".",$valj);
                                else if($kj=="account_key")
                                $valj = ltrim($valj, '0');  //eliminate prefix zero
                                //add for has defined Kolum for Old Data
                                $cd[$kj] = $valj;
                            } 
                        }
                         //Skip empty Interco / Trade Partner / Vendor / Customer
                        if(isset($cd['interco']) && $cd['interco']!=""){ //.$cd['interco']
                            $hashheader = hash('md5', $cd['periode_id'].$cd['company'].$cd['interco'].$cd['account_key']);
                            $cd['hashheader'] = $hashheader;
                            $cd['hash'] = hash('md5', $cd['periode_id'].$cd['BELNR'].$cd['account_key'].$cd['time_key']);
                            $data[] = $cd;
                        }
                    }
                }
            }
            $response['status'] = true;
            $response['messages'] = $data;
            return $response;
    }

    public  function getInterco($params)
    {
        
        if($params->periode_id==0){
            $response['status'] = false;
            $response['messages'] = 'Periode ID is Empty';
            return $response;
        }
        $account = IntercoSAP::getAccountByType('G/L Account', $params->periode_id);
        // $account = IntercoSAP::select('account_key')->where('periode_id','=',$params->periode_id)->groupBy('account_key')->orderBy('account_key')->get();
        if(count($account)==0){
            $response['status'] = false;
            $response['messages'] = 'List Account From BW Consolidation is Empty';
            return $response;
        }
        //Generate Akun
        // $listAkunOpenItem = array();
        $listAkunRange = array();
        foreach($account as $k=>$v){
            $acc = array (
                  'SIGN' => 'I',
                  'OPTION' => 'EQ',
                  'LOW' => $v['account_key'],//'110631100',
                  'HIGH' => '',
                );
            $listAkunRange['item'][] = $acc;
        }

        //List Master Company Fixed
        $company =   Company::select('company_code')->where('delete_mark','=','0')->get();
        if(count($company)==0){
            $response['status'] = false;
            $response['messages'] = 'Company is Empty';
            return $response;
        }
        $listCompany = array();
        foreach($company as $k=>$v){
            $listCompany[$v['company_code']] = $v['company_code']; 
        }
        //Field Old Upload
        $arrMap12 = array(
            "BUKRS"=>"company",
            "VBUND_TBL"=>"interco",
            "JAMON"=>"time_key",
            "HKONT"=>"account_key",
            "DMSHB"=>"saldo_awal",
        );
        $arrMap47 = array(
            "BUKRS"=>"company",
            "VBUND"=>"interco",
            "JAMON"=>"time_key",
            "HKONT"=>"account_key",
            "DMSHB"=>"saldo_awal",
        );
        //Field Yang masuk ke Database
        $arrInc = array(
            "BUKRS"=>"BUKRS",
            "BELNR"=>"BELNR",
            "BLART"=>"BLART",
            "BUDAT"=>"BUDAT",
            "BLDAT"=>"BLDAT",
            "BSCHL"=>"BSCHL",
            "DMSHB"=>"DMSHB",
            "HKONT"=>"HKONT",
            "HWAER"=>"HWAER",
            "MWSKZ"=>"MWSKZ",
            "SGTXT"=>"SGTXT",
            "MONAT"=>"MONAT",
            "U_KUNNR"=>"U_KUNNR",
            "U_LIFNR"=>"U_LIFNR",
            "VBUND"=>"VBUND",
            "VBUND_TBL"=>"VBUND_TBL",
            "XBLNR"=>"XBLNR",
            "U_AWKEY"=>"U_AWKEY",
            "WRSHB"=>"WRSHB",
            "WAERS"=>"WAERS",
            "JAMON"=>"JAMON",
            "U_BKTXT"=>"U_BKTXT",
            "ZUONR"=>"ZUONR"
        );
     
        try {
           
            $wsdl = storage_path($this->xmlName("sap/Fbl3nwsdl.xml"));//
            // $wsdl = "http://sap-pi-qas.pupuk-indonesia.com:58200/dir/wsdl?p=sa/8d84af17cabc3bcfb9a67a9afbf2d101";
            $Endpoint = "";// = "http://sap-pi-qas.pupuk-indonesia.com:58200/XISOAPAdapter/MessageServlet?senderParty=&senderService=WEB_RECON_ECCApplication_BC&receiverParty=&receiverService=&interface=SI_Get_Fbl3n&interfaceNamespace=urn%3APIHC_WEB_RECON_ECC_Get_Fbl3n";    
            $RFC = "SI_Get_Fbl3n";
            $this->_client($wsdl,$Endpoint,"QAS");
            $dataA = array();
            // $dataA = $this->getIntercoperACType("A",$RFC,$params,$listAkunOpenItem,$listCompany,$arrInc,$arrMap12);
            $dataB = $this->getIntercoperACType("B",$RFC,$params,$listAkunRange,$listCompany,$arrInc,$arrMap47);
            $data=null;
            if($dataB['status']){
                $data = array();
                // if($dataA['status']){
                //     if(is_array($dataA['messages']))
                //     $data = array_merge($data,$dataA['messages']);
                // }
                if($dataB['status']){
                    if(is_array($dataB['messages']))
                    $data = array_merge($data,$dataB['messages']);
                }
            }
            else{
                return $dataB; //$dataA == $dataB
            }
            //Insert To DB
            if($data){
                $cdata = count($data);
                $inserted = 0;
                $updated = 0;
                $IsUsedBA=0;
                $newIns =  array();

                $hashData = IntercoDetail::select('hash')
                ->where('periode_id', '=', $params->periode_id)->where('company', '=', $params->company)->get();
                if(count($hashData)==0){
                    //Bulk Insert For New Record
                    $cnewIns = array_chunk($data,1000);
                    foreach($cnewIns as $k=>$v){
                        IntercoDetail::insert($v);
                        $inserted += count($v);
                    }
                }
                else{
                    $detele = IntercoDetail::where('periode_id', '=', $params->periode_id)->where('company', '=', $params->company)->delete();
                    //Bulk Insert For New Record
                    $cnewIns = array_chunk($data,1000);
                    foreach($cnewIns as $k=>$v){
                        IntercoDetail::insert($v);
                        $inserted += count($v);
                    }
                }
                $response['status'] = true;
                $response['total_data'] = $cdata;
                $response['inserted_data'] = $inserted;
                $response['updated_data'] = $updated;
                return $response;
            }else{
                $response['status'] = false;
                $response['messages'] = 'Empty Data';
                return $response;
            }
           
        } catch (SoapFault $fault) {
            Log::channel('syslog')->debug('Caught SoapFault :' . $fault->getMessage());
            $response['status'] = false;
            $response['messages'] = $fault->getMessage();
            return $response;
        }
    }

    public  function getVendor($params)
    {
        if($params->periode_id==0){
            $response['status'] = false;
            $response['messages'] = 'Periode ID is Empty';
            return $response;
        }

        $account = IntercoSAP::getAccountByType('Vendor', $params->periode_id);
        // $account = IntercoSAP::select('account_key')->where('periode_id','=',$params->periode_id)->groupBy('account_key')->orderBy('account_key')->get();
        if(count($account)==0){
            $response['status'] = false;
            $response['messages'] = 'List Account From BW Consolidation is Empty';
            return $response;
        }

        $listAkun = array();
        foreach($account as $k=>$v){
            $listAkun[$v['account_key']] = $v['account_key'];            
        }

        //List Master Company Fixed
        $company =   Company::select('company_code')->where('delete_mark','=','0')->get();
        if(count($company)==0){
            $response['status'] = false;
            $response['messages'] = 'Company is Empty';
            return $response;
        }
        $listCompany = array();
        foreach($company as $k=>$v){
            $listCompany[$v['company_code']] = $v['company_code']; 
        }
        //Field Old Upload
        $arrMap = array(
            "BUKRS"=>"company",
            // "BELNR"=>"doc_no",            
            "HKONT"=>"account_key",
            "VBUND_TBL"=>"interco",
            "JAMON"=>"time_key",
            "DMSHB"=>"saldo_awal"
        );
        //Field Yang masuk ke Database
        $arrInc = array(
            "BUKRS"=>"BUKRS",
            "BELNR"=>"BELNR",
            "BLART"=>"BLART",
            "BUDAT"=>"BUDAT",
            "BLDAT"=>"BLDAT",
            "BSCHL"=>"BSCHL",
            "DMSHB"=>"DMSHB",
            "HKONT"=>"HKONT",
            "HWAER"=>"HWAER",
            "MWSKZ"=>"MWSKZ",
            "SGTXT"=>"SGTXT",
            "MONAT"=>"MONAT",
            "U_KUNNR"=>"U_KUNNR",
            "U_LIFNR"=>"U_LIFNR",
            "VBUND"=>"VBUND",
            "VBUND_TBL"=>"VBUND_TBL",
            "XBLNR"=>"XBLNR",
            "U_AWKEY"=>"U_AWKEY",
            "WRSHB"=>"WRSHB",
            "WAERS"=>"WAERS",
            "JAMON"=>"JAMON",
            "U_BKTXT"=>"U_BKTXT",
            "ZUONR"=>"ZUONR"
        );
        
        try {
           
            $wsdl = storage_path($this->xmlName("sap/Fbl1nwsdl.xml"));//
            // $wsdl = "http://sap-pi-qas.pupuk-indonesia.com:58200/dir/wsdl?p=sa/8d84af17cabc3bcfb9a67a9afbf2d101";
            $Endpoint = "";//$Endpoint = "http://sap-pi-qas.pupuk-indonesia.com:58200/XISOAPAdapter/MessageServlet?senderParty=&senderService=WEB_RECON_ECCApplication_BC&receiverParty=&receiverService=&interface=SI_Get_Fbl1n&interfaceNamespace=urn:PIHC_WEB_RECON_ECC_Get_Fbl1n";
            $RFC = "SI_Get_Fbl1n";
            $this->_client($wsdl,$Endpoint,"QAS");
            $date = str_replace("-","",$params->end_date);//End Open Item Onlye
            $sendData =
                array (
                  'XOPSEL' => 'X',
                  'R_BUDAT' => 
                  array (
                    'item' => 
                    array (
                      'SIGN' => 'I',
                      'OPTION' => 'EQ',
                      'LOW' => $date,
                      'HIGH' => '',
                    ),
                  ),
                  'R_BUKRS' => 
                  array (
                    'item' => 
                    array (
                      'SIGN' => 'I',
                      'OPTION' => 'EQ',
                      'LOW' => $params->company,
                      'HIGH' => '',
                    ),
                  ),
                  'R_LIFNR' => array()
                  ,'T_DATA' => array()
                );
            $ret = $this->client->call($RFC, $sendData);
            // $this->showRespons();
            $err = $this->client->getError();
            if ($err) {
                $response['status'] = false;
                $response['messages'] = $this->CustomError($err);
                return $response;
            }            
            $data = null;

            if (isset($ret)) {
                
                $dataItem = $ret['T_DATA'];
                if(is_array($dataItem))
                foreach ($dataItem as $k=>$entry) {
                    $singleData = false;
                    foreach($entry as $ki=>$val){
                        if(is_numeric($ki)){
                        $cd = array();
                        $cd['periode_id'] = $params->periode_id;                        
                        $cd['created_at'] = date("Y-m-d H:i:s");
                        $cd['create_by'] = 'SyncSAP';
                        $cd['saldo_awal'] = 0;
                        $val['HKONT'] = trim($val['HKONT']); //elminate space
                        $val['HKONT'] = ltrim($val['HKONT'],'0'); //elminate padding zero
                        //skip account not in BW Consolidation
                        if(!array_key_exists($val['HKONT'],$listAkun))
                        continue;

                        //company is not exist skipped
                        if(!array_key_exists($val['BUKRS'],$listCompany))
                            continue;

                        //Interco is not exist skipped
                        if(!array_key_exists($val['VBUND_TBL'],$listCompany))
                            continue;

                        foreach($val as $kj=>$valj){
                            //Skip Eliminate Not Used Field
                            if(!isset($arrInc[$kj]))
                            continue;
                            //Formatting
                            if($kj=="DMSHB" || ($val['WAERS']=="IDR" && $kj=="WRSHB")) //Amount Local Currency di kali 100
                            $valj = $valj*100;
                            $cd[$kj] = $valj;   
                            if(isset($arrMap[$kj])){
                                $kj = $arrMap[$kj];
                                if($kj=="time_key")
                                $valj = str_replace("/",".",$valj);
                                else if($kj=="account_key")
                                $valj =  ltrim($valj, '0');  //eliminate prefix zero
                                // else if($kj=="saldo_awal")
                                // $valj = $valj*100;
                                //add for has defined Kolum for Old Data
                                $cd[$kj] = $valj;
                            }
                             
                        }
                         //Skip empty Vendor / Trade Partner / Vendor / Customer
                        if(isset($cd['company']) && $cd['company']!="" && 
                        isset($cd['account_key']) && $cd['account_key']!="" && isset($cd['interco']) && $cd['interco']!="" 
                        && isset($cd['time_key']) && $cd['time_key']!=""){ //.$cd['interco']
                            $hashheader = hash('md5', $cd['periode_id'].$cd['company'].$cd['interco'].$cd['account_key']);
                            $cd['hashheader'] = $hashheader;
                            $cd['hash'] = hash('md5', $cd['periode_id'].$cd['BELNR'].$cd['account_key'].$cd['time_key']);
                            $data[] = $cd;
                        }
                        }else{
                            $singleData=true;
                        }

                    }
                    if($singleData){
                        $cd = array();
                        $cd['periode_id'] = $params->periode_id;
                        $cd['saldo_akhir'] = '0';
                        $cd['verifikasi'] = '0';
                        $cd['created_at'] = date("Y-m-d H:i:s");
                        $cd['create_by'] = 'SyncSAP';
                        $cd['saldo_awal'] = 0;
                        
                        $entry['HKONT'] = trim($entry['HKONT']); //elminate space
                        $entry['HKONT'] = ltrim($entry['HKONT'],'0'); //elminate padding zero
                        foreach($entry as $kj=>$valj){
                            //Skip Eliminate Not Used Field
                            if(!isset($arrInc[$kj]))
                            continue;

                            //Formatting
                            if($kj=="DMSHB" || ($entry['WAERS']=="IDR" && $kj=="WRSHB"))  //Amount Local Currency di kali 100
                            $valj = $valj*100;
                            $cd[$kj] = $valj;  
                            if(isset($arrMap[$kj])){
                                $kj = $arrMap[$kj];
                                if($kj=="time_key")
                                $valj = str_replace("/",".",$valj);
                                else if($kj=="account_key")
                                $valj =  ltrim($valj, '0');  //eliminate prefix zero
                                // else if($kj=="saldo_awal")
                                // $valj = $valj*100;
                                //add for has defined Kolum for Old Data
                                $cd[$kj] = $valj;
                            }
                              
                        }
                         //Skip empty Vendor / Trade Partner / Vendor / Customer
                         if(isset($cd['company']) && $cd['company']!="" && 
                         isset($cd['account_key']) && $cd['account_key']!="" && isset($cd['interco']) && $cd['interco']!="" 
                         && isset($cd['time_key']) && $cd['time_key']!=""){ //.$cd['interco']
                            $hashheader = hash('md5', $cd['periode_id'].$cd['company'].$cd['interco'].$cd['account_key']);
                            $cd['hashheader'] = $hashheader;
                            $cd['hash'] = hash('md5', $cd['periode_id'].$cd['BELNR'].$cd['account_key'].$cd['time_key']);
                            $data[] = $cd;
                         }
                    }
                }                
            }
            //Insert To DB
            if($data){
                $cdata = count($data);
                $inserted = 0;
                $updated = 0;
                $IsUsedBA=0;
                $newIns =  array();

                $hashData = Vendor::select('hash')
                ->where('periode_id', '=', $params->periode_id)->where('company', '=', $params->company)->get();
                if(count($hashData)==0){
                    //Bulk Insert For New Record
                    $cnewIns = array_chunk($data,1000);
                    foreach($cnewIns as $k=>$v){
                        Vendor::insert($v);
                        $inserted += count($v);
                    }
                }
                else{
                    $detele = Vendor::where('periode_id', '=', $params->periode_id)->where('company', '=', $params->company)->delete();
                    //Bulk Insert For New Record
                    $cnewIns = array_chunk($data,1000);
                    foreach($cnewIns as $k=>$v){
                        Vendor::insert($v);
                        $inserted += count($v);
                    }
                }                
                $response['status'] = true;
                $response['total_data'] = $cdata;
                $response['inserted_data'] = $inserted;
                $response['updated_data'] = $updated;
                return $response;
            }else{
                $response['status'] = false;
                $response['messages'] = 'Empty Data';
                return $response;
            }
           
        } catch (SoapFault $fault) {
            $response['status'] = false;
            $response['messages'] = $fault->getMessage();
            return $response;
        }
    }

    private function showRespons(){

        echo "<h2>Request</h2>";
        echo "<pre>" . htmlspecialchars($this->client->request, ENT_QUOTES) . "</pre>";
        echo "<h2>Response</h2>";
        echo "<pre>" . htmlspecialchars($this->client->response, ENT_QUOTES) . "</pre>";
        // Display the debug messages
        echo '<h2>Debug</h2>';
        echo '<pre>' . htmlspecialchars($this->client->debug_str, ENT_QUOTES) . '</pre>';
        echo "<pre>";
        // print_r($ret);
        die;
    }

    private function CustomError($err){
        $response['status'] = false;
        $mess ="";
        if($err=="SOAP:Server: Server Error")
        $mess = "Invalid Paramater. (SOAP:Server: Server Error)";
        else if(strpos($err, 'Unauthorized') !== false)
        $mess = "Invalid Account.";
        else if(strpos($err, 'cURL ERROR:') !== false)
        $mess = "Error Connection to SAP. (E)";
        else
        $mess = $err;
        return $mess;
    }

    public  function getCustomer($params)
    {
        if($params->periode_id==0){
            $response['status'] = false;
            $response['messages'] = 'Periode ID is Empty';
            return $response;
        }

        $account = IntercoSAP::getAccountByType('Customer', $params->periode_id);
        // $account = IntercoSAP::select('account_key')->where('periode_id','=',$params->periode_id)->groupBy('account_key')->orderBy('account_key')->get();
        if(count($account)==0){
            $response['status'] = false;
            $response['messages'] = 'List Account From BW Consolidation is Empty';
            return $response;
        }

        $listAkun = array();
        foreach($account as $k=>$v){
            $listAkun[$v['account_key']] = $v['account_key'];            
        }

        //List Master Company Fixed
        $company =   Company::select('company_code')->where('delete_mark','=','0')->get();
        if(count($company)==0){
            $response['status'] = false;
            $response['messages'] = 'Company is Empty';
            return $response;
        }
        $listCompany = array();
        foreach($company as $k=>$v){
            $listCompany[$v['company_code']] = $v['company_code']; 
        }

        //Field Old Upload
        $arrMap = array(
            "BUKRS"=>"company",
            "VBUND_TBL"=>"interco",
            "JAMON"=>"time_key",
            "HKONT"=>"account_key",
            "DMSHB"=>"saldo_awal",
        );
        //Field Yang masuk ke Database
        $arrInc = array(
            "BUKRS"=>"BUKRS",
            "BELNR"=>"BELNR",
            "BLART"=>"BLART",
            "BUDAT"=>"BUDAT",
            "BLDAT"=>"BLDAT",
            "BSCHL"=>"BSCHL",
            "DMSHB"=>"DMSHB",
            "HKONT"=>"HKONT",
            "HWAER"=>"HWAER",
            "MWSKZ"=>"MWSKZ",
            "SGTXT"=>"SGTXT",
            "MONAT"=>"MONAT",
            "U_KUNNR"=>"U_KUNNR",
            "U_LIFNR"=>"U_LIFNR",
            "VBUND"=>"VBUND",
            "VBUND_TBL"=>"VBUND_TBL",
            "XBLNR"=>"XBLNR",
            "U_AWKEY"=>"U_AWKEY",
            "WRSHB"=>"WRSHB",
            "WAERS"=>"WAERS",
            "JAMON"=>"JAMON",
            "U_BKTXT"=>"U_BKTXT",
            "ZUONR"=>"ZUONR"
        );

        try {
           
            $wsdl = storage_path($this->xmlName("sap/Fbl5nwsdl.xml"));//
            // $wsdl = "http://sap-pi-qas.pupuk-indonesia.com:58200/dir/wsdl?p=sa/8d84af17cabc3bcfb9a67a9afbf2d101";
            $Endpoint = "";// = "http://sap-pi-qas.pupuk-indonesia.com:58200/XISOAPAdapter/MessageServlet?senderParty=&senderService=WEB_RECON_ECCApplication_BC&receiverParty=&receiverService=&interface=SI_Get_Fbl5n&interfaceNamespace=urn:PIHC_WEB_RECON_ECC_Get_Fbl5n";    
            $RFC = "SI_Get_Fbl5n";
            $this->_client($wsdl,$Endpoint,"QAS");
            $date = str_replace("-","",$params->end_date);
            $sendData =
                array (
                  'XOPSEL' => 'X',
                  'R_BUDAT' => 
                  array (
                    'item' => 
                    array (
                      'SIGN' => 'I',
                      'OPTION' => 'EQ',
                      'LOW' => $date,
                      'HIGH' => '',
                    ),
                  ),
                  'R_BUKRS' => 
                  array (
                    'item' => 
                    array (
                      'SIGN' => 'I',
                      'OPTION' => 'EQ',
                      'LOW' => $params->company,
                      'HIGH' => '',
                    ),
                  ),
                  'R_KUNNR' => array()
                  ,'T_DATA' => array()
                );
            $ret = $this->client->call($RFC, $sendData);
            $err = $this->client->getError();
            if ($err) {
                $response['status'] = false;
                $response['messages'] = $this->CustomError($err);
                return $response;
            }            
            $data = null;
            if (isset($ret)) {
                
                $dataItem = $ret['T_DATA'];
                if(is_array($dataItem))
                foreach ($dataItem as $k=>$entry) {
                    $singleData = false;
                    foreach($entry as $ki=>$val){
                        if(is_numeric($ki)){
                            $cd = array();
                            $cd['periode_id'] = $params->periode_id;
                            $cd['created_at'] = date("Y-m-d H:i:s");
                            $cd['create_by'] = 'SyncSAP';
                            $cd['saldo_awal'] = 0;
                            $val['HKONT'] = trim($val['HKONT']); //elminate space
                            $val['HKONT'] = ltrim($val['HKONT'],'0'); //elminate padding zero
                            //skip account not in BW Consolidation
                            if(!array_key_exists($val['HKONT'],$listAkun))
                            continue;

                            //company is not exist skipped
                            if(!array_key_exists($val['BUKRS'],$listCompany))
                                continue;

                            //Interco is not exist skipped
                            if(!array_key_exists($val['VBUND_TBL'],$listCompany))
                                continue;

                                foreach($val as $kj=>$valj){
                                    //Skip Eliminate Not Used Field
                                    if(!isset($arrInc[$kj]))
                                    continue;
                                    //Formatting
                                    if($kj=="DMSHB" || ($val['WAERS']=="IDR" && $kj=="WRSHB"))  //Amount Local Currency di kali 100
                                    $valj = $valj*100;
                                    $cd[$kj] = $valj;
                                    if(isset($arrMap[$kj])){ 
                                        $kj = $arrMap[$kj];
                                        if($kj=="time_key")
                                        $valj = str_replace("/",".",$valj);
                                        else if($kj=="account_key")
                                        $valj =  ltrim($valj, '0');  //eliminate prefix zero
                                        // else if($kj=="saldo_awal")
                                        // $valj = $valj*100;
                                        //add for has defined Kolum for Old Data
                                        $cd[$kj] = $valj;
                                    }
                                    
                                }
                                //Skip empty Vendor / Trade Partner / Vendor / Customer
                                if(isset($cd['interco']) && $cd['interco']!=""){ //.$cd['interco']
                                    $hashheader = hash('md5', $cd['periode_id'].$cd['company'].$cd['interco'].$cd['account_key']);
                                    $cd['hashheader'] = $hashheader;
                                    $cd['hash'] = hash('md5', $cd['periode_id'].$cd['BELNR'].$cd['account_key'].$cd['time_key']);
                                    $data[] = $cd;
                                }
                        }else{
                            $singleData=true;
                        }

                    }
                    if($singleData){
                        $cd = array();
                        $cd['periode_id'] = $params->periode_id;
                        $cd['created_at'] = date("Y-m-d H:i:s");
                        $cd['create_by'] = 'SyncSAP';
                        $cd['saldo_awal'] = 0;
                        $entry['HKONT'] = trim($entry['HKONT']); //elminate space
                        $entry['HKONT'] = ltrim($entry['HKONT'],'0'); //elminate padding zero
                        foreach($entry as $kj=>$valj){
                            //Skip Eliminate Not Used Field
                            if(!isset($arrInc[$kj]))
                            continue;
                            if($kj=="DMSHB" || ($entry['WAERS']=="IDR" && $kj=="WRSHB"))            
                            $valj = ($valj * 100);
                            $cd[$kj] = $valj; 
                            if(isset($arrMap[$kj])){
                                $kj = $arrMap[$kj];
                                if($kj=="time_key")
                                $valj = str_replace("/",".",$valj);
                                else if($kj=="account_key")
                                $valj =  ltrim($valj, '0');  //eliminate prefix zero
                                // else if($kj=="saldo_awal")
                                // $valj = $valj*100;
                                //add for has defined Kolum for Old Data
                                $cd[$kj] = $valj;
                            }   
                        }
                         //Skip empty Vendor / Trade Partner / Vendor / Customer
                        if(isset($cd['interco']) && $cd['interco']!=""){ //.$cd['interco']
                            $hashheader = hash('md5', $cd['periode_id'].$cd['company'].$cd['interco'].$cd['account_key']);
                            $cd['hashheader'] = $hashheader;
                            $cd['hash'] = hash('md5', $cd['periode_id'].$cd['BELNR'].$cd['account_key'].$cd['time_key']);
                            $data[] = $cd;
                        }
                    }
                }                
            }
            // print_r($data);
            // die;
            //Insert To DB
            if($data){
                $cdata = count($data);
                $inserted = 0;
                $updated = 0;
                $IsUsedBA=0;
                $newIns =  array();

                $hashData = Customer::select('hash')->where('periode_id', '=', $params->periode_id)->where('company', '=', $params->company)->get();
                if(count($hashData)==0){
                    $cnewIns = array_chunk($data,1000);
                    foreach($cnewIns as $k=>$v){
                        Customer::insert($v);
                        $inserted += count($v);
                    }
                }else{
                    $detele = Customer::where('periode_id', '=', $params->periode_id)->where('company', '=', $params->company)->delete();
                    $cnewIns = array_chunk($data,1000);
                    foreach($cnewIns as $k=>$v){
                        Customer::insert($v);
                        $inserted += count($v);
                    }
                }                
                $response['status'] = true;
                $response['total_data'] = $cdata;
                $response['inserted_data'] = $inserted;
                $response['updated_data'] = $updated;
                return $response;
            }else{
                $response['status'] = false;
                $response['messages'] = 'Empty Data';
                return $response;
            }
           
        } catch (SoapFault $fault) {
            $response['status'] = false;
            $response['messages'] = $fault->getMessage();
            return $response;
        }
    }

    public  function postingGLOld($params)
    {
        $accountGL = array();
        $currencyAmount = array();
        if(isset($params['CHILD'])){            
            foreach($params['CHILD'] as $k => $v){
                $accountGL['item'][] = array (
                    'ITEMNO_ACC' => $v['ITEMNO_ACC'],
                    'GL_ACCOUNT' => '0'.$v['GL_ACCOUNT'],
                    'COMP_CODE' => '',
                    'PSTNG_DATE' => '',
                    'DOC_TYPE' => '',
                    'AC_DOC_NO' => '',
                    'FISC_YEAR' => '',
                    'FIS_PERIOD' => '',
                    'STAT_CON' => '',
                    'REF_KEY_1' => '',
                    'REF_KEY_2' => '',
                    'REF_KEY_3' => '',
                    'CUSTOMER' => '',
                    'VENDOR_NO' => '',
                    'ALLOC_NMBR' => '',
                    'ITEM_TEXT' => '',
                    'BUS_AREA' => '',
                    'COSTCENTER' => '',
                    'ACTTYPE' => '',
                    'ORDERID' => '',
                    'ORIG_GROUP' => '',
                    'COST_OBJ' => '',
                    'PROFIT_CTR' => '',
                    'PART_PRCTR' => '',
                    'WBS_ELEMENT' => '',
                    'NETWORK' => '',
                    'ROUTING_NO' => '',
                    'ORDER_ITNO' => '',
                    'ACTIVITY' => '',
                    'PLANT' => '',
                    'SALES_ORD' => '',
                    'S_ORD_ITEM' => '',
                    'SEGMENT' => '',
                    'PARTNER_SEGMENT' => ''
                );
                $currencyAmount['item'][] = array (
                    'ITEMNO_ACC' => $v['ITEMNO_ACC'],
                    'CURR_TYPE' => '',
                    'CURRENCY' => '',
                    'CURRENCY_ISO' => $v['CURRENCY_ISO'],
                    'AMT_DOCCUR' => $v['AMT_DOCCUR'],
                    'EXCH_RATE' => '',
                    'EXCH_RATE_V' => ''
                );
            }    
        }else{  
            $response['status'] = false;
            $response['messages'] = 'Invalid Data';
            $response['doc_no_sap'] =  '-';
            return $response;
        }
        
        // print_r($currencyAmount);exit;
        //Field Old Upload
        // $arrMap = array(
        //     "BUKRS"=>"company",
        //     "VBUND"=>"interco",
        //     "JAMON"=>"time_key",
        //     "HKONT"=>"account_key",
        //     "DMSHB"=>"saldo_awal",
        // );

        // if($params->periode_id==0)
        // return false;
        try {
           
            $wsdl = storage_path($this->xmlName("sap/GLPostingwsdl.xml"));//
            $Endpoint = "";// = "http://sap-pi-qas.pupuk-indonesia.com:58200/XISOAPAdapter/MessageServlet?senderParty=&amp;senderService=WEB_RECON_ECCApplication_BC&amp;receiverParty=&amp;receiverService=&amp;interface=SI_Create_GL&amp;interfaceNamespace=urn%3APIHC_WEB_RECON_ECC_Create_GL";    
            $RFC = "SI_Create_GL";
            $this->_client($wsdl,$Endpoint,"QAS");
            $sendData =
                array (
                  'DOCUMENTHEADER' => $params['HEADER'],
                  'ACCOUNTGL' => $accountGL,
                  'CURRENCYAMOUNT' => $currencyAmount,
                  'EXTENSION1' => array(),
                  'RETURN' => array()
                );
            $ret = $this->client->call($RFC, $sendData);
            // $this->showRespons();
            $err = $this->client->getError();
            if ($err) {
                BaDetail::where('id','=', $params['BA_ID_DETAIL'])->update(array('ket_sap' => $err(),'status_post' => 'gagal')); 
                
                $response['status'] = false;
                $response['messages'] = $err;//"Call Function errorxx : ".$err." X " .print_r($sendData,true);
                $response['doc_no_sap'] =  '-';
                return $response;
            }    
            // print_r($ret['RETURN']);
            // exit;        
            // $data = null;
            $sts = true;
            if (isset($ret['RETURN'])) {                
                $dataItem = $ret['RETURN']['item'];
                $return = array();
                $no_doc = '-';
                $pesan = '';     
                if(isset($dataItem['MESSAGE']))  {
                    // $pesan += strval($dataItem['MESSAGE']).',';
                    $no_doc = substr($dataItem['MESSAGE_V2'],0,10);
                    $return = array(
                        'doc_no_sap' => $no_doc,
                        'ket_sap' => $dataItem['MESSAGE'],
                        'status_post' => 'berhasil'
                    );
                }else{
                    foreach ($dataItem as $k => $item) {
                        if($item['MESSAGE_V1'] != 'BKPFF'){
                            $pesan .= $item['MESSAGE'].',';
                        }
                    }  

                    $return = array(
                        'doc_no_sap' => $no_doc,
                        'ket_sap' => $pesan,
                        'status_post' => 'gagal'
                    );
                }            
            }
        //    print_r($return);exit;
            //Insert To DB
            if($return){
                BaDetail::where('id','=', $params['BA_ID_DETAIL'])->update($return); 
                                 
                $response['status'] = $return['status_post'] == 'gagal' ? false : true;
                $response['messages'] =  $return['ket_sap'];
                $response['doc_no_sap'] =  $return['doc_no_sap'];
                return $response;
            }
           
        } catch (SoapFault $fault) {
            BaDetail::where('id','=', $params['BA_ID_DETAIL'])->update(array('ket_sap' => $fault->getMessage(),'status_post' => 'gagal')); 

            $response['status'] = false;
            $response['messages'] = $fault->getMessage();
            $response['doc_no_sap'] =  '-';
            return $response;
        }
    }

    public  function postingGL($params)
    {
        $accountGL = array();
        $accountCust = array();
        $accountVendor = array();
        $currencyAmount = array();
        $criteria = array();
        $jenis = '0';
        $costcenter = '';
        if(isset($params['CHILD'])){            
            foreach($params['CHILD'] as $k => $v){
                $jenis = $v['JENIS_POST'];
                //Add profit center 
                if(isset($v['PRCTR']) &&  $v['PRCTR'] != ''){   
                    $criteria['item'][] = array (
                        'ITEMNO_ACC' => $v['ITEMNO_ACC'],
                        'FIELDNAME' => 'PRCTR',
                        'CHARACTER' => $v['PRCTR']
                    );
                }
                if($v['ACCOUNT_TYPE'] == 'customer'){   
                    $dtcust = array (
                        'ITEMNO_ACC' => $v['ITEMNO_ACC'],
                        'CUSTOMER' => $v['CUSTOMER'],
                        'GL_ACCOUNT' => '0'.$v['GL_ACCOUNT'],
                        'PMNTTRMS' => $v['PMNTTRMS'],
                        'BLINE_DATE' => $v['BLINE_DATE'],
                        'PMNT_BLOCK' => $v['PMNT_BLOCK'],
                        'DSCT_DAYS1' => $v['DSCT_DAYS1'],
                        'DSCT_DAYS2' => $v['DSCT_DAYS2'],
                        'NETTERMS' => $v['NETTERMS'],
                        'DSCT_PCT1' => $v['DSCT_PCT1'],
                        'DSCT_PCT2' => $v['DSCT_PCT2'],
                        'PYMT_METH' => $v['PYMT_METH'],
                        'PMTMTHSUPL' => $v['PMTMTHSUPL'],
                        'PAYMT_REF' => $v['PAYMT_REF'],
                        'BANK_ID' => $v['BANK_ID'],
                        'HOUSEBANKACCTID' => $v['HOUSEBANKACCTID'],
                        'SP_GL_IND' => $v['SP_GL_IND'],
                        'BUS_AREA' => $v['BUS_AREA'],
                        'TAX_CODE' => $v['TAX_CODE'],
                        'PROFIT_CTR' => $v['PRCTR']
                    );                  
                    if($v['SP_GL_IND']!="")
                    $dtcust['GL_ACCOUNT'] = "";
                    $accountCust['item'][] = $dtcust;


                } else if($v['ACCOUNT_TYPE'] == 'vendor'){ 
                    $dtvend = array (
                        'ITEMNO_ACC' => $v['ITEMNO_ACC'],
                        'VENDOR_NO' => $v['VENDOR_NO'],
                        'GL_ACCOUNT' => '0'.$v['GL_ACCOUNT'],
                        'PMNTTRMS' => $v['PMNTTRMS'],
                        'BLINE_DATE' => $v['BLINE_DATE'],
                        'PMNT_BLOCK' => $v['PMNT_BLOCK'],
                        'DSCT_DAYS1' => $v['DSCT_DAYS1'],
                        'DSCT_DAYS2' => $v['DSCT_DAYS2'],
                        'NETTERMS' => $v['NETTERMS'],
                        'DSCT_PCT1' => $v['DSCT_PCT1'],
                        'DSCT_PCT2' => $v['DSCT_PCT2'],
                        'PYMT_METH' => $v['PYMT_METH'],
                        'PMTMTHSUPL' => $v['PMTMTHSUPL'],
                        'PAYMT_REF' => $v['PAYMT_REF'],
                        'BANK_ID' => $v['BANK_ID'],
                        'HOUSEBANKACCTID' => $v['HOUSEBANKACCTID'],
                        'SP_GL_IND' => $v['SP_GL_IND'],
                        'PARTNER_BK' => $v['PARTNER_BK'],
                        'REF_KEY_1' => $v['REF_KEY_1'],
                        'REF_KEY_2' => $v['REF_KEY_2'],
                        'REF_KEY_3' => $v['REF_KEY_3'],
                        'BUS_AREA' => $v['BUS_AREA'],
                        'TAX_CODE' => $v['TAX_CODE'],
                        'PROFIT_CTR' => $v['PRCTR']
                    );
                    if($v['SP_GL_IND']!="")
                    $dtvend['GL_ACCOUNT'] = "";
                    $accountVendor['item'][] = $dtvend;
                }else{
                    $accountGL['item'][] = array (
                        'ITEMNO_ACC' => $v['ITEMNO_ACC'],
                        'GL_ACCOUNT' => '0'.$v['GL_ACCOUNT'],
                        'VALUE_DATE' => $v['VALUE_DATE'],
                        'FUND' => $v['FUND'],
                        'FUNDS_CTR' => $v['FUNDS_CTR'],
                        'COSTCENTER' => $v['COSTCENTER'],
                        'CMMT_ITEM_LONG' => $v['CMMT_ITEM_LONG'],
                        'ALLOC_NMBR' => $v['ALLOC_NMBR'],               
                        'WBS_ELEMENT' => $v['WBS_ELEMENT'],
                        'BUS_AREA' => $v['BUS_AREA'],
                        'TAX_CODE' => $v['TAX_CODE'],
                        'PROFIT_CTR' => $v['PRCTR']          
                    );
                }
                // if($v['FLAG'] == 1){ 
                //     // if($jenis == '2'){
                //     //     $costcenter = 'A002100000';
                //     // }                   
                //     // $accountGL['item'][] = array (
                //     //     'ITEMNO_ACC' => $v['ITEMNO_ACC'],
                //     //     'GL_ACCOUNT' => '0'.$v['GL_ACCOUNT'],
                //     //     'COSTCENTER' => $costcenter,
                //     // );
                //     if($jenis == '1'){
                //         $accountCust['item'][] = array (
                //             'ITEMNO_ACC' => $v['ITEMNO_ACC'],
                //             'CUSTOMER' => $v['CUSTOMER'],
                //             'GL_ACCOUNT' => '0'.$v['GL_ACCOUNT'],
                //             'PMNTTRMS' => $v['PMNTTRMS'],
                //             'BLINE_DATE' => $v['BLINE_DATE'],
                //             'PMNT_BLOCK' => $v['PMNT_BLOCK'],
                //             'DSCT_DAYS1' => $v['DSCT_DAYS1'],
                //             'DSCT_DAYS2' => $v['DSCT_DAYS2'],
                //             'NETTERMS' => $v['NETTERMS'],
                //             'DSCT_PCT1' => $v['DSCT_PCT1'],
                //             'DSCT_PCT2' => $v['DSCT_PCT2'],
                //             'PYMT_METH' => $v['PYMT_METH'],
                //             'PMTMTHSUPL' => $v['PMTMTHSUPL'],
                //             'PAYMT_REF' => $v['PAYMT_REF'],
                //             'BANK_ID' => $v['BANK_ID'],
                //             'HOUSEBANKACCTID' => $v['HOUSEBANKACCTID'],
                //             'SP_GL_IND' => $v['SP_GL_IND']
                //         );
                //     }else if($jenis == '2'){
                //         $accountVendor['item'][] = array (
                //             'ITEMNO_ACC' => $v['ITEMNO_ACC'],
                //             'VENDOR_NO' => $v['VENDOR_NO'],
                //             'GL_ACCOUNT' => '0'.$v['GL_ACCOUNT'],
                //             'PMNTTRMS' => $v['PMNTTRMS'],
                //             'BLINE_DATE' => $v['BLINE_DATE'],
                //             'PMNT_BLOCK' => $v['PMNT_BLOCK'],
                //             'DSCT_DAYS1' => $v['DSCT_DAYS1'],
                //             'DSCT_DAYS2' => $v['DSCT_DAYS2'],
                //             'NETTERMS' => $v['NETTERMS'],
                //             'DSCT_PCT1' => $v['DSCT_PCT1'],
                //             'DSCT_PCT2' => $v['DSCT_PCT2'],
                //             'PYMT_METH' => $v['PYMT_METH'],
                //             'PMTMTHSUPL' => $v['PMTMTHSUPL'],
                //             'PAYMT_REF' => $v['PAYMT_REF'],
                //             'BANK_ID' => $v['BANK_ID'],
                //             'HOUSEBANKACCTID' => $v['HOUSEBANKACCTID'],
                //             'SP_GL_IND' => $v['SP_GL_IND'],
                //             'PARTNER_BK' => $v['PARTNER_BK'],
                //             'REF_KEY_1' => $v['REF_KEY_1'],
                //             'REF_KEY_2' => $v['REF_KEY_2'],
                //             'REF_KEY_3' => $v['REF_KEY_3']
                //         );
                //     }else{
                //         $accountGL['item'][] = array (
                //             'ITEMNO_ACC' => $v['ITEMNO_ACC'],
                //             'GL_ACCOUNT' => '0'.$v['GL_ACCOUNT'],
                //             'VALUE_DATE' => $v['VALUE_DATE'],
                //             'FUND' => $v['FUND'],
                //             'FUNDS_CTR' => $v['FUNDS_CTR'],
                //             'CMMT_ITEM_LONG' => $v['CMMT_ITEM_LONG'],
                //             'ALLOC_NMBR' => $v['ALLOC_NMBR']                            
                //         );
                //     }
                // }else{
                //     if($jenis == '1'){
                //         $accountCust['item'][] = array (
                //             'ITEMNO_ACC' => $v['ITEMNO_ACC'],
                //             'CUSTOMER' => $v['CUSTOMER'],
                //             'GL_ACCOUNT' => '0'.$v['GL_ACCOUNT'],
                //             'PMNTTRMS' => $v['PMNTTRMS'],
                //             'BLINE_DATE' => $v['BLINE_DATE'],
                //             'PMNT_BLOCK' => $v['PMNT_BLOCK'],
                //             'DSCT_DAYS1' => $v['DSCT_DAYS1'],
                //             'DSCT_DAYS2' => $v['DSCT_DAYS2'],
                //             'NETTERMS' => $v['NETTERMS'],
                //             'DSCT_PCT1' => $v['DSCT_PCT1'],
                //             'DSCT_PCT2' => $v['DSCT_PCT2'],
                //             'PYMT_METH' => $v['PYMT_METH'],
                //             'PMTMTHSUPL' => $v['PMTMTHSUPL'],
                //             'PAYMT_REF' => $v['PAYMT_REF'],
                //             'BANK_ID' => $v['BANK_ID'],
                //             'HOUSEBANKACCTID' => $v['HOUSEBANKACCTID'],
                //             'SP_GL_IND' => $v['SP_GL_IND']
                //         );
                //     }else if($jenis == '2'){
                //         $accountVendor['item'][] = array (
                //             'ITEMNO_ACC' => $v['ITEMNO_ACC'],
                //             'VENDOR_NO' => $v['VENDOR_NO'],
                //             'GL_ACCOUNT' => '0'.$v['GL_ACCOUNT'],
                //             'PMNTTRMS' => $v['PMNTTRMS'],
                //             'BLINE_DATE' => $v['BLINE_DATE'],
                //             'PMNT_BLOCK' => $v['PMNT_BLOCK'],
                //             'DSCT_DAYS1' => $v['DSCT_DAYS1'],
                //             'DSCT_DAYS2' => $v['DSCT_DAYS2'],
                //             'NETTERMS' => $v['NETTERMS'],
                //             'DSCT_PCT1' => $v['DSCT_PCT1'],
                //             'DSCT_PCT2' => $v['DSCT_PCT2'],
                //             'PYMT_METH' => $v['PYMT_METH'],
                //             'PMTMTHSUPL' => $v['PMTMTHSUPL'],
                //             'PAYMT_REF' => $v['PAYMT_REF'],
                //             'BANK_ID' => $v['BANK_ID'],
                //             'HOUSEBANKACCTID' => $v['HOUSEBANKACCTID'],
                //             'SP_GL_IND' => $v['SP_GL_IND'],
                //             'PARTNER_BK' => $v['PARTNER_BK'],
                //             'REF_KEY_1' => $v['REF_KEY_1'],
                //             'REF_KEY_2' => $v['REF_KEY_2'],
                //             'REF_KEY_3' => $v['REF_KEY_3']
                //         );
                //     }else{
                //         $accountGL['item'][] = array (
                //             'ITEMNO_ACC' => $v['ITEMNO_ACC'],
                //             'GL_ACCOUNT' => '0'.$v['GL_ACCOUNT'],
                //             'VALUE_DATE' => $v['VALUE_DATE'],
                //             'FUND' => $v['FUND'],
                //             'FUNDS_CTR' => $v['FUNDS_CTR'],
                //             'CMMT_ITEM_LONG' => $v['CMMT_ITEM_LONG'],
                //             'ALLOC_NMBR' => $v['ALLOC_NMBR']                            
                //         );
                //     }
                // }
                $currencyAmount['item'][] = array (
                    'ITEMNO_ACC' => $v['ITEMNO_ACC'],
                    'CURR_TYPE' => '',
                    'CURRENCY' => '',
                    'CURRENCY_ISO' => $v['CURRENCY_ISO'],
                    'AMT_DOCCUR' => $v['AMT_DOCCUR'],
                    'EXCH_RATE' => '',
                    'EXCH_RATE_V' => ''
                );
            }    
        }else{  
            $response['status'] = false;
            $response['messages'] = 'Invalid Data';
            $response['doc_no_sap'] =  '-';
            $response['type_sap'] =  '-';
            return $response;
        }
        // $sendData =
        //     array (
        //       'CONTRACTHEADER' => array(),
        //       'CUSTOMERCPD' => array(),
        //       'DOCUMENTHEADER' => $params['HEADER'],
        //       'ACCOUNTGL' => $accountGL,
        //       'ACCOUNTPAYABLE' => $accountVendor, //VENDOR
        //       'ACCOUNTRECEIVABLE' => $accountCust, //CUSTOMER
        //       'ACCOUNTTAX' => array(),
        //       'ACCOUNTWT' => array(),
        //       'CONTRACTITEM' => array(),
        //       'CRITERIA' => array(),
        //       'CURRENCYAMOUNT' => $currencyAmount,
        //       'EXTENSION1' => array(),
        //       'EXTENSION2' => array(),
        //       'PAYMENTCARD' => array(),
        //       'REALESTATE' => array(),
        //       'RETURN' => array(),
        //       'VALUEFIELD' => array()
        //     );
        
        // print_r($sendData);exit;
        //Field Old Upload
        // $arrMap = array(
        //     "BUKRS"=>"company",
        //     "VBUND"=>"interco",
        //     "JAMON"=>"time_key",
        //     "HKONT"=>"account_key",
        //     "DMSHB"=>"saldo_awal",
        // );

        // if($params->periode_id==0)
        // return false;
        try {
           
            $wsdl = storage_path($this->xmlName("sap/GLPostingnewwsdl.xml"));//
            $Endpoint = "";// = "http://sap-pi-qas.pupuk-indonesia.com:58200/XISOAPAdapter/MessageServlet?senderParty=&senderService=WEB_RECON_ECCApplication_BC&receiverParty=&receiverService=&interface=SI_Document_Posting&interfaceNamespace=urn:PIHC_WEB_RECON_ECC_Document_Posting";    
            $RFC = "SI_Document_Posting";
            $this->_client($wsdl,$Endpoint,"QAS");
            $sendData =
                array (
                  'CONTRACTHEADER' => array(),
                  'CUSTOMERCPD' => array(),
                  'DOCUMENTHEADER' => $params['HEADER'],
                  'ACCOUNTGL' => $accountGL,
                  'ACCOUNTPAYABLE' => $accountVendor, //VENDOR
                  'ACCOUNTRECEIVABLE' => $accountCust, //CUSTOMER
                  'ACCOUNTTAX' => array(),
                  'ACCOUNTWT' => array(),
                  'CONTRACTITEM' => array(),
                  'CRITERIA' => $criteria,
                  'CURRENCYAMOUNT' => $currencyAmount,
                  'EXTENSION1' => array(),
                  'EXTENSION2' => array(),
                  'PAYMENTCARD' => array(),
                  'REALESTATE' => array(),
                  'RETURN' => array(),
                  'VALUEFIELD' => array()
                );
            $ret = $this->client->call($RFC, $sendData);
            // $this->showRespons();
            // print_r($ret);exit;
            $err = $this->client->getError();
            if ($err) {
                BaDetail::where('id','=', $params['BA_ID_DETAIL'])->update(array('ket_sap' => $this->CustomError($err),'status_post' => 'gagal')); 
                
                $response['status'] = false;
                $response['message'] = $this->CustomError($err);//"Call Function errorxx : ".$err." X " .print_r($sendData,true);
                $response['doc_no_sap'] =  '-';
                $response['type_sap'] =  '-';
                return $response;
            }    
            // print_r($ret['RETURN']);
            // exit;        
            // $data = null;
            $sts = true;
            if (isset($ret['RETURN'])) {                
                $dataItem = $ret['RETURN']['item'];
                $return = array();
                $no_doc = '-';
                $pesan = '';     
                $type = '';     
                if(isset($dataItem['MESSAGE']))  {
                    // $pesan += strval($dataItem['MESSAGE']).',';
                    $no_doc = substr($dataItem['MESSAGE_V2'],0,10);
                    $return = array(
                        'doc_no_sap' => $no_doc,
                        'ket_sap' => $dataItem['MESSAGE'],
                        'type_sap' => 'S',
                        'status_post' => 'berhasil'
                    );
                }else{
                    $sts = 'gagal';
                    foreach ($dataItem as $k => $item) {
                        if($item['TYPE'] != 'E'){ //Warning  
                            if($k == 0 && $item['TYPE'] == 'S'){
                                $no_doc = substr($item['MESSAGE_V2'],0,10);  
                            }   
                            $type = 'W';             
                            if($no_doc!="-"){
                                $type = 'S'; 
                                $sts = 'berhasil';
                            }
                            $pesan .= $item['MESSAGE']." (".$item['TYPE'].") ".',';
                        }else{            
                            $type = 'E';
                            if($item['MESSAGE_V1'] != 'BKPFF'){
                                $pesan .= $item['MESSAGE']." (".$type.") ".',';
                            }
                            $sts = 'gagal';
                        }
                    }  

                    $return = array(
                        'doc_no_sap' => $no_doc,
                        'ket_sap' => $pesan,
                        'type_sap' => $type,
                        'status_post' => $sts
                    );
                }            
            }
        //    print_r($return);exit;
            //Insert To DB
            if($return){
                BaDetail::where('id','=', $params['BA_ID_DETAIL'])->update($return); 
                                 
                $response['status'] = $return['status_post'] == 'gagal' ? false : true;
                $response['message'] =  $return['ket_sap'];
                $response['type_sap'] =  $return['type_sap'];
                $response['doc_no_sap'] =  $return['doc_no_sap'];
                return $response;
            }
           
        } catch (SoapFault $fault) {
            BaDetail::where('id','=', $params['BA_ID_DETAIL'])->update(array('ket_sap' => $fault->getMessage(),'status_post' => 'gagal')); 

            $response['status'] = false;
            $response['messages'] = $fault->getMessage();
            $response['doc_no_sap'] =  '-';
            $response['type_sap'] =  '-';
            return $response;
        }
    }

}