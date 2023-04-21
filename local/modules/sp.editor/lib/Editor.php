<?php

namespace Sp\Editor;

use CJSCore;

class Editor
{

    public static function OnBeforeHTMLEditorScriptRuns()
    {

        CJSCore::RegisterExt('sp_editor', [
            'js' => [
                '/local/modules/sp.editor/f/js/sp_editor.js',
            ],
        ]);

        CJSCore::Init([
            'sp_editor',
            'jquery'
        ]);
    }
}
