<?php

use Bitrix\Main\EventManager;
use \Sp\Editor\Editor;

$eventManager = EventManager::getInstance();

$eventManager->addEventHandler('fileman', 'OnBeforeHTMLEditorScriptRuns',
    [Editor::class, 'OnBeforeHTMLEditorScriptRuns']);
