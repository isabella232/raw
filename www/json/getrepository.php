<?php
//    header('Content-Type: application/json');
?>
{
    "data":
<?php
    include_once "../../config.php";
    include_once "../functions.php";

    $raws=raw_getalldata();
    $i=0;
    foreach($raws as $raw){
        if($raw['validated'] == "1" ){

            $rawpath=datapath."/".hash_id($raw['id'])."/".$raw['id'];

            if(filesize($rawpath."/".$raw['filename'].".exif.txt") > 0 ) {
                $exifdata="<a target='_blank' href='".baseurl."/getfile.php?type=exif&id=".$raw['id']."'>exifdata</a>";
            } else {
                $exifdata="no exifdata";
            }

            $data[]=array($raw['make'],
                          $raw['model'],
                          $raw['mode'],
                          $raw['remark'],
                          $raw['license'],
                          $raw['checksum'],
                          "<a href='".baseurl."/getfile.php?type=raw&id=".$raw['id']."'>".$raw['filename']."</a>",
                          $exifdata);
        }
    }
    echo json_encode($data);
?>
}
