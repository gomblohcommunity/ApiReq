<?php
 header('Content-Type: application/json');
class control{
    
    function checking(){
        $action=$_GET['act'];
        $do = new querying();
        switch($action){
            case'1':
                $do->getMasjid();
            break;
            case '2':
                $do->getMasjidTerdekat();
                break;
            case'3':
                $do->getEvent();
            break;
            case'4':
                $do->getKasMasjid();
            break;
            case'5':
                $do->getDetailMasjid();
            break;
            default:
                $do->def();
            break;
        }
        }
    }

class querying{
    public function getMasjid(){
        $query="select * from daftar_masjid where verified=1";
        $this->EchoDataToList($query);
    }
    public function getMasjidTerdekat()
    {
        $logitude=$_GET['longitude'];
        $latitude=$_GET['latitude'];
        $query="";
        $this->EchoDataToList($query);
    }
    public function searchMasjid()
    {
        $param=$_GET['masjid'];
        $query="";
        $this->EchoDataToList();
    }

    public function getDetailMasjid(){
        $param=$_POST['id_masjid'];
        if(empty($_POST['id_masjid'])){
            $this-> def();
        }
        else{
            $query="select * from daftar_masjid where id=$param and verified=1";
            $this-> EchoDataToObject($query);
        }
    }
    public function getEvent(){
        $query="select * from event_masjid";
        $this-> EchoDataToList($query);
    }
    public function getKasMasjid(){
        $id=$_POST['id'];
        if(empty($_POST['id'])){
            $this->  def();
        }
         else{
            $bulan=$_POST['bulan'];
            $tahun=$_POST['tahun'];
            $query="select *,sum(masuk), sum(keluar) from kas_masjid where id_masjid=.$id. and MONTH(tanggal)=.$bulan. and YEAR(tanggal)=.$tahun";
            $this-> EchoDataToList($query);
        }
    }
    public function def(){
        http_response_code(400);
        $data['error']="Bad Request";
        echo json_encode($data);
    }

    public function EchoDataToObject($query)
    {
        include('DbConnect.php');
        $result=$connection->query($query);
        $data;
        while($r=mysqli_fetch_assoc($result)){
            $data=$r;
        }
        http_response_code(200);
        echo json_encode($data);
    }

    public function EchoDataToList($query)
    { 
        include('DbConnect.php');
        $result=$connection->query($query);
        $data=array();
        while($r=mysqli_fetch_assoc($result)){
            $data[]=$r;
        }
        http_response_code(200);
        echo json_encode($data);
    }
}

$control = new control();
$control->checking();
