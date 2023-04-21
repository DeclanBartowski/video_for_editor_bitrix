<?
define("NO_KEEP_STATISTIC", true);
define("BX_STATISTIC_BUFFER_USED", false);
define("NO_LANG_FILES", true);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

use Bitrix\Main\Context;
use Bitrix\Main\Loader;

$request = Context::getCurrent()->getRequest();
$currentId = $request->get("id");

Loader::includeModule('iblock');
$result = [];
$res = CIBlockElement::GetList(array(), ["IBLOCK_ID" => getIblockIdByCode('video_archive'), "ACTIVE" => "Y"], false,
    false,
    ['ID', "NAME"]);
while ($ob = $res->Fetch()) {
    $result[] = [
        'ID' => $ob['ID'],
        'NAME' => $ob['NAME'],
    ];
}
?>
<select name="" id="video_player">
    <? foreach ($result as $key => $value): ?>
        <option <?if($value['ID'] == $currentId):?> selected <?endif?> value="<?= $value['ID'] ?>"><?= $value['NAME'] ?></option>
    <? endforeach; ?>
</select>
