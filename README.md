# Atlas-info-generator
Automatic atlas info generator. Generates correctly positions without map overlaps.

Config:
```
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
```

IMPORTANT! The order must not be changed. The generator correctly generates values from top to bottom.


![panel](https://github.com/Alerinos/Atlas-info-generator/blob/master/Screenshot_1.png)

The algorithm also has a graphic preview. PHP GD is required.

![panel](https://github.com/Alerinos/Atlas-info-generator/blob/master/Screenshot_2.png)
