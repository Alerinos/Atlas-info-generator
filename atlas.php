<?php
/**
 * Created by PhpStorm.
 * User: Alerinos
 * Date: 24.05.2019
 * Time: 14:25
 */

$maps = [
    'metin2_map_m1' => [6,6],
    'metin2_map_m2' => [5,5],
    'metin2_map_orcs' => [6,6],
    'metin2_map_hwang' => [4,4],
    'metin2_map_spider1' => [3,3],
    'metin2_map_spider2' => [4,4],
    'metin2_map_trent' => [2,2],
    'metin2_map_trent2' => [4,4],
    'metin2_map_skipia1' => [6,6],
    'metin2_map_skipia2' => [6,6],
    'metin2_map_desert' => [6,6],
    'metin2_map_snow' => [6,6],
    'metin2_map_flame' => [6,6],
    'metin2_map_snake' => [4,4],
    'metin2_map_fishing' => [4,4],
    'metin2_map_admin' => [3,3],
    'metin2_map_ox' => [2,2],
    'metin2_map_guildwar' => [2,2],
    'metin2_map_wedding' => [1,1],
    'metin2_map_kingdonwar' => [2,2],
    'metin2_map_monkey' => [3,3],
    'metin2_map_giant' => [2,2],
];

$id = 1;
$atlas = [];
$base = [
    'x' => [ 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0 ]
];
foreach ($maps as $r => $v) {
    $x = $v[0];
    $y = $v[1];
    $map = $r;

    $sy = 0;
    for($i= $y; $i >1; $i--) $sy += $i - 1;

    $sx = $base['x'][$y];
    $base['x'][$y] += $x;

    $atlas[] = [
        'sx'    => $x,
        'sy'    => $y,
        'x'     => $sx * 256 * 100,
        'y'     => $sy * 256 * 100,
        'px'    => $sx *256,
        'py'    => $sy *256,

        'id'    => $v[2],
        'map'   => $map,
        'name'  => str_replace('metin2_map_', '', $map),
    ];

    $id ++;
}

if($_GET['type'] == 'preview'){

    $canvas = imagecreatetruecolor(14080, 5376);
    imagefill($canvas, 0, 0, imagecolorallocate($canvas, 30,30,30));       // Green);

    $color = [
        imagecolorallocate($canvas, 255, 105, 180),     // Pink
        imagecolorallocate($canvas, 255, 255, 255),     // White
        imagecolorallocate($canvas, 132, 135, 28),       // Green

        imagecolorallocate($canvas, 255, 0, 0),       // Green
        imagecolorallocate($canvas, 0, 255, 0),       // Green
        imagecolorallocate($canvas, 220,220,220),       // Green
    ];

    foreach ($atlas as $item){
        $x = ($item['x'] / 100);
        $y = ($item['y'] / 100);
        $sx = ($x + ($item['sx'] * 256) -1);
        $sy = ($y + ($item['sy'] * 256) -1);

        imagerectangle($canvas, $x, $y, $sx, $sy, $color[rand(0,5)]);
    }

    header('Content-Type: image/jpeg');

    imagejpeg($canvas);
    imagedestroy($canvas);

    exit; // remove

}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Atlasinfo</title>
</head>
<body>
<div class="container">
    <div class="row">


        <div class="row">
            <div class="col-md-4 col-xs-12">
                <div class="d-flex">
                    <h3><i class="fas fa-atlas"></i> Atlas info</h3>
                    <a href="#" class="ml-auto"> <button onclick="location.href = '?type=preview';" class="btn btn-outline-dark"><i class="far fa-eye"></i> Podgląd</button></a>
                </div>
                <div class="form-group">
                    <label for="list">Położenie każdej mapy</label>
                    <textarea class="form-control" id="list" rows="10" readonly><?PHP foreach($atlas as $r){ echo $r['map'].' '.$r['x'].' '.$r['y'].' '.$r['sx'].' '.$r['sy'].'&#13;&#10;'; } ?></textarea>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <h3><i class="fas fa-book"></i> Index maps</h3>
                <div class="form-group">
                    <label for="index">Lista wszystkch map</label>
                    <textarea class="form-control" id="index" rows="10" readonly><?PHP $i=1; foreach($atlas as $r){ echo $i.' '.$r['map'].'&#13;&#10;'; $i++;} ?></textarea>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <h3><i class="fas fa-book"></i> Index client</h3>
                <div class="form-group">
                    <label for="index">Lista wszystkch map</label>
                    <textarea class="form-control" id="index" rows="10" readonly><?PHP foreach($atlas as $r){ echo 'pack/&#10;'.$r['map'].'&#13;&#10;';} ?></textarea>
                </div>
            </div>

            <div class="col-12">
                <div class="row">
                    <?PHP foreach($atlas as $r){ echo '
                    <div class="col-4">
                        <div class="form-group">
                            <label for="map-'.$r['name'].'">'.$r['map'].'</label>
                            <textarea class="form-control" id="map-'.$r['name'].'" rows="8" readonly>ScriptType	MapSetting
CellScale	200
HeightScale	0.500000
ViewRadius	128
MapSize	'.$r['sx'].'	'.$r['sy'].'
BasePosition	'.$r['x'].'	'.$r['y'].'
TextureSet	textureset\metin2_'.$r['name'].'.txt
Environment	'.$r['name'].'.msenv</textarea>
                        </div>
                    </div>';} ?>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
